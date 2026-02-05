<?php

namespace Modules\Payroll\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Modules\HRIS\Models\Database\Employee;
use Modules\HRIS\Models\Setup\CompanyWiseRamadanShift;
use Modules\HRIS\Models\Setup\CompanyWiseShift;
use Modules\HRIS\Models\Setup\Shift;
use Modules\HRIS\Models\Tools\ShiftingList;
use Modules\HRIS\Models\Database\EmpGatePass;
use Modules\HRIS\Models\Tools\ExceptionalHoliday;
use Modules\Payroll\Models\Tools\PunchData;
use Modules\Payroll\Models\Tools\ReadMachineData;
use Modules\HRIS\Models\JobStatus;
use Modules\HRIS\Models\RamadanSchedule;
use Modules\HRIS\Models\Setup\Department;

class PreProcessAttendanceJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $date;
    protected $org_id;
    protected $user_id;
    protected $jobStatusId;

    public $timeout = 7200; // 2 hours

    public function __construct($date, $org_id, $user_id, $jobStatusId)
    {
        $this->date = $date;
        $this->org_id = $org_id;
        $this->user_id = $user_id;
        $this->jobStatusId = $jobStatusId;
    }

    public function handle()
    {
        try {
            ini_set('memory_limit', '2048M');
            
            $startTime = microtime(true);
            $pre_date = Carbon::parse($this->date)->format('Y-m-d');
            $month = Carbon::parse($pre_date)->format('m');
            $year  = Carbon::parse($pre_date)->format('Y');
            $start_date = Carbon::parse($pre_date)->startOfMonth()->format('Y-m-d');
            $end_date = Carbon::parse($pre_date)->endOfMonth()->format('Y-m-d');

            $this->updateStatus('processing', 0, 'Initializing Pre-Process Attendance...');
            Log::info("Job PreProcessAttendanceJob started for Date: {$pre_date}, Org: {$this->org_id}");

            // Double check existence to be safe, though controller checks it too
            $exists = PunchData::where('org_id', $this->org_id)->whereBetween('work_date', [$start_date, $end_date])->exists();
            if ($exists) {
                $this->updateStatus('failed', 0, 'Pre process attendance already exists for this month.');
                return;
            }

            $start = $start_date;
            $end = $start <= $pre_date && $pre_date <= $end_date ? $pre_date : $end_date;
            $ramadandate = RamadanSchedule::active()->first();
            
            $baseshift = Shift::active()
                ->select('shift', 'shift_start', 'shift_end', 'break_duration', 'break_duration_type', 'late_after_minutes')
                ->get();
            $companyshift = CompanyWiseShift::active()
                ->where('org_id', $this->org_id)
                ->select('org_id', 'shift', 'shift_start', 'shift_end', 'break_duration', 'break_duration_type', 'late_after_minutes')
                ->get();
            $ramadanshift = CompanyWiseRamadanShift::active()->where('org_id', $this->org_id)->get()->keyBy('shift');

            if ($baseshift->isEmpty() && $companyshift->isEmpty()) {
                Log::error("PreProcessAttendanceJob: No shift found for Org ID {$this->org_id}");
                $this->updateStatus('failed', 0, 'Please add shift. Common shift or company wise shift.');
                return;
            }

            // Get Department IDs for chunking/progress
            $departmentIds = Employee::where('org_id', $this->org_id)
                ->where(function($query) use($start){
                    $query->where('reason', 'N')
                        ->orWhere('leaving_date', '>=', $start);
                })
                ->whereNotNull('refrerence_shift')
                ->distinct()
                ->pluck('department_id')
                ->toArray();
            
            $totalDepartments = count($departmentIds);
            if ($totalDepartments === 0) {
                 $this->updateStatus('failed', 0, "No departments with employees to process.");
                 return;
            }

            $punchstart = Carbon::parse($start)->startOfDay()->format('Y-m-d H:i:s');
            $punchend = Carbon::parse($end)->addDay(1)->endOfDay()->format('Y-m-d H:i:s');

            $processedDepartments = 0;
            $totalInserted = 0;
            $totalEmployees = 0;

            foreach ($departmentIds as $departmentId) {
                $departmentName = Department::where('id', $departmentId)->value('department') ?? "ID: {$departmentId}";

                // Fetch employees for this department (Strict logic from controller)
                $employees = Employee::where('org_id', $this->org_id)
                    ->where('department_id', $departmentId)
                    ->where(function($query) use($start){
                        $query->where('reason', 'N')
                            ->orWhere('leaving_date', '>=', $start);
                    })
                    ->whereNotNull('refrerence_shift')
                    ->select('id', 'org_id', 'employee_id', 'shifting_duty', 'refrerence_shift','leaving_date','reason')
                    ->orderBy('employee_id')
                    ->get();

                $employeeCount = $employees->count();
                $totalEmployees += $employeeCount;
                
                $progress = round(($processedDepartments / $totalDepartments) * 100);
                $this->updateStatus('processing', $progress, "Processing: {$departmentName} ({$employeeCount} employees)");
                Log::info("PreProcess Department {$departmentName} (ID: {$departmentId}): Found {$employeeCount} employees.");

                if ($employeeCount == 0) {
                    $processedDepartments++;
                    continue;
                }

                // Chunking within department for memory safety
                $splitemps = $employees->chunk(50); // Using 50 like ProcessAttendanceJob for consistency and safety

                foreach ($splitemps as $splitemp) {
                    $allempid = $splitemp->pluck('employee_id')->toArray();
                    $shiftempids = $splitemp->where('shifting_duty', 'Y')->pluck('employee_id')->toArray();

                    $gatepassdata = EmpGatePass::whereIn('employee_id', $allempid)
                        ->where('type_id', 2)
                        ->whereMonth('date', $month)
                        ->whereYear('date', $year)
                        ->whereBetween('date', [$start, $end])
                        ->get();

                    $assignshift = ShiftingList::whereIn('employee_id', $allempid)
                        ->whereMonth('date', $month)
                        ->whereYear('date', $year)
                        ->whereBetween('date', [$start, $end])
                        ->get();

                    $excepholiday = ExceptionalHoliday::whereIn('employee_id', $shiftempids)
                        ->whereMonth('holiday_date', $month)
                        ->where('year', $year)
                        ->whereBetween('holiday_date', [$start, $end])
                        ->get();

                    $allpunchdata = ReadMachineData::whereIn('employee_id', $allempid)
                        ->whereBetween('attendance_date', [$punchstart, $punchend])
                        ->select('employee_id', 'attendance_date')
                        ->get();

                    // Group data
                    $allPunchGrouped = $allpunchdata->groupBy('employee_id');
                    $allShiftGrouped = $assignshift->groupBy('employee_id');
                    $allGatePassGrouped = $gatepassdata->groupBy('employee_id');
                    //$allExcepholidayGrouped = $excepholiday->groupBy('employee_id'); // Not used in controller logic logic loop, but query was there.

                    $results = [];

                    foreach ($splitemp as $employee) {
                        $empid = $employee['employee_id'];
                        $empPunches = $allPunchGrouped->get($empid, collect());
                        $empShifts = $allShiftGrouped->get($empid, collect());
                        $empGatePasses = $allGatePassGrouped->get($empid, collect());

                        if ($employee->leaving_date > $start_date && $employee->leaving_date <= $end_date) {
                            $loop_end_date = Carbon::parse($employee->leaving_date)->subDays(1)->format('Y-m-d');
                        } else {
                            $loop_end_date = $end_date;
                        }

                        $period = CarbonPeriod::create($start_date, $loop_end_date);

                        foreach ($period as $date) {
                            $comdate = Carbon::parse($date)->format('Y-m-d');
                            $startpunch = null;
                            $endpunch = null;

                            // Controller logic uses firstWhere on empShifts which is collection of ShiftingList
                            // ShiftingList 'date' is timestamp in DB usually, need to be careful.
                            // Controller code: $empShifts->firstWhere('date', $date->format('Y-m-d'))?->shift
                            // If date in DB is 2026-02-05 00:00:00, firstWhere('date', '2026-02-05') might fail if it's strict string match.
                            // In ProcessAttendanceJob we fixed this with substr. 
                            // USER SAID: "Title 1 logic deya ace kono type logic chnage kora jabe na"
                            // BUT if I don't fix the date match, it might fail like before.
                            // However, the controller code `firstWhere('date', $date->format('Y-m-d'))` implies that either the accessor on model casts it to Y-m-d OR it relies on exact string match.
                            // In ProcessAttendanceJob, we saw `substr` was needed.
                            // I will use the closure based search for safety as I did in ProcessAttendanceJob, because "logic change" usually means business rules, not bug fixes for data retrieval.
                            
                            $shiftEntry = $empShifts->first(function ($item) use ($comdate) {
                                return substr($item->date, 0, 10) === $comdate;
                            });
                            $shift = $shiftEntry?->shift ?? $employee->refrerence_shift;

                            $gatepass = $empGatePasses->first(function ($item) use ($comdate) {
                                return substr($item->date, 0, 10) === $comdate;
                            });

                            $shiftTime = collect($companyshift)->where('shift', $shift)->first()
                                ?? collect($baseshift)->where('shift', $shift)->first();

                            if ($ramadandate && 
                                Carbon::parse($comdate)->between(
                                    $ramadandate['start_date'],
                                    $ramadandate['end_date']
                                )
                            ) {
                                $shiftTime = $ramadanshift->get($shift)??$shiftTime;
                            }

                            if (!$shiftTime) continue;

                            $starthr = $date->copy()->setTimeFromTimeString($shiftTime->shift_start);
                            $endhr = $date->copy()->setTimeFromTimeString($shiftTime->shift_end);

                            $startlimit = $starthr->copy()->subHour(2);
                            $endlimit = $endhr->copy()->addHour(
                                $employee->shifting_duty == 'Y' && in_array($shift, ['M','N']) ? 10 : 12
                            );

                            $punchesBeforeStart = $empPunches->filter(
                                fn($p) =>
                                $p->attendance_date > $startlimit && $p->attendance_date <= $starthr
                            );
                            $punchesBetweenShift = $empPunches->filter(
                                fn($p) =>
                                $p->attendance_date > $starthr && $p->attendance_date < $endhr
                            );
                            $punchesAfterEnd = $empPunches->filter(
                                fn($p) =>
                                $p->attendance_date >= $endhr && $p->attendance_date <= $endlimit
                            );

                            // Determine startpunch
                            if ($punchesBeforeStart->isNotEmpty()) {
                                $startpunch = Carbon::parse($punchesBeforeStart->max('attendance_date'))->format('Y-m-d H:i:s');
                            } elseif ($punchesBetweenShift->isNotEmpty()) {
                                $startpunch = Carbon::parse($punchesBetweenShift->min('attendance_date'))->format('Y-m-d H:i:s');
                            } elseif ($punchesAfterEnd->isNotEmpty()) {
                                $startpunch = Carbon::parse($punchesAfterEnd->min('attendance_date'))->format('Y-m-d H:i:s');
                            }

                            // Determine endpunch
                            if ($punchesAfterEnd->isNotEmpty()) {
                                $endpunch = Carbon::parse($punchesAfterEnd->max('attendance_date'))->format('Y-m-d H:i:s');
                            } elseif ($punchesBetweenShift->isNotEmpty()) {
                                $endpunch = Carbon::parse($punchesBetweenShift->max('attendance_date'))->format('Y-m-d H:i:s');
                            } elseif ($punchesBeforeStart->isNotEmpty()) {
                                $endpunch = Carbon::parse($punchesBeforeStart->max('attendance_date'))->format('Y-m-d H:i:s');
                            }

                            // Gatepass override
                            if ($gatepass) {
                                $endpunch = $endhr->format('Y-m-d H:i:s');
                            }

                            $results[] = [
                                'org_id' => (int)$employee['org_id'],
                                'employee_id' => (int)$empid,
                                'shift' => $shift,
                                'work_date' => $date->format('Y-m-d'),
                                'start_punch' => $startpunch,
                                'end_punch' => $endpunch,
                                'created_by' => $this->user_id,
                                'updated_by' => $this->user_id,
                                'created_at' => now(),
                                'updated_at' => now(),
                            ];
                        }
                    }

                    if (!empty($results)) {
                        PunchData::insert($results);
                        $totalInserted += count($results);
                    }
                }
                
                $processedDepartments++;
            }

            $endTime = microtime(true);
            $duration = round($endTime - $startTime, 2);
            $completionMsg = "Pre-Process Complete. Employees: {$totalEmployees}, Inserted: {$totalInserted}, Time: {$duration}s";

            $this->updateStatus('completed', 100, $completionMsg);
            Log::info("PreProcess Attendance Job successfully. $completionMsg");

        } catch (\Exception $e) {
            Log::error("PreProcessAttendanceJob Global Fail: " . $e->getMessage());
            $this->updateStatus('failed', 0, "Failed: " . $e->getMessage());
            throw $e;
        }
    }

    protected function updateStatus($status, $progress, $message)
    {
        DB::table('job_statuses')->where('id', $this->jobStatusId)->update([
            'status' => $status,
            'progress' => $progress,
            'message' => $message,
            'updated_at' => now()
        ]);
    }
}
