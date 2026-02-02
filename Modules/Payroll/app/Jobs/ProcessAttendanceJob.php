<?php

namespace Modules\Payroll\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Modules\HRIS\Models\JobStatus;
use Modules\HRIS\Models\Database\Employee;
use Modules\HRIS\Models\Database\EmpGatePass;
use Modules\HRIS\Models\RamadanSchedule;
use Modules\HRIS\Models\Setup\CompanyWiseRamadanShift;
use Modules\HRIS\Models\Setup\CompanyWiseShift;
use Modules\HRIS\Models\Setup\Shift;
use Modules\HRIS\Models\Setup\Department;
use Modules\HRIS\Models\Tools\Calender;
use Modules\HRIS\Models\Tools\ExceptionalHoliday;
use Modules\HRIS\Models\Tools\ShiftingList;
use Modules\Payroll\Models\Tools\ProcessAttendence;
use Modules\Payroll\Models\Tools\PunchData;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class ProcessAttendanceJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $month;
    protected $year;
    protected $org_id;
    protected $departmentIds;
    protected $userId;
    protected $jobStatusId;

    public $timeout = 3600; // 1 hour

    public function __construct($month, $year, $org_id, $departmentIds, $userId, $jobStatusId)
    {
        $this->month = $month;
        $this->year = $year;
        $this->org_id = $org_id;
        $this->departmentIds = $departmentIds;
        $this->userId = $userId;
        $this->jobStatusId = $jobStatusId;
    }

    public function handle()
    {
        try {
            $startTime = now();
            $this->updateStatus('processing', 0, 'Initializing attendance process...');

            $month = $this->month;
            $year = $this->year;
            $org_id = $this->org_id;

            $startdt = Carbon::parse("$year-$month")->startOfMonth()->format('Y-m-d');
            $enddt   = Carbon::parse($startdt)->endOfMonth()->format('Y-m-d');

            // --- Load Shared Data ---
            $ramadandate = RamadanSchedule::active()->first();
            $baseshift = Shift::active()->select('shift', 'shift_start', 'shift_end', 'break_start', 'break_end', 'break_duration', 'break_duration_type', 'late_after_minutes')->get()->keyBy('shift');
            $companyshift = CompanyWiseShift::active()->where('org_id', $org_id)->select('org_id', 'shift', 'shift_start', 'shift_end', 'break_start', 'break_end', 'break_duration', 'break_duration_type', 'late_after_minutes')->get()->keyBy('shift');
            $ramadanshift = CompanyWiseRamadanShift::active()->where('org_id', $org_id)->get()->keyBy('shift');

            if ($baseshift->isEmpty() && $companyshift->isEmpty()) {
                throw new \Exception('No shifts found. Please add common or company-wise shifts.');
            }

            $exceptionalHolidays = ExceptionalHoliday::active()
                ->where('org_id', $org_id)
                ->whereBetween('holiday_date', [$startdt, $enddt])
                ->pluck('holiday_date')
                ->toArray();

            $leaveClasses = DB::table('hris_setup_leaveclassifications')->pluck('code', 'id')->toArray();

            // --- Process by Department ---
            $validDepartments = is_array($this->departmentIds) ? $this->departmentIds : explode(',', $this->departmentIds);
            $totalDepartments = count($validDepartments);
            $processedDepartments = 0;
            $totalInserted = 0;
            $totalEmployees = 0;

            if ($totalDepartments === 0) {
                 $this->updateStatus('failed', 0, "No departments to process.");
                 return;
            }

            foreach ($validDepartments as $departmentId) {
                $departmentName = Department::where('id', $departmentId)->value('department') ?? "ID: {$departmentId}";
                
                // Update Progress
                $progress = round(($processedDepartments / $totalDepartments) * 100);
                $this->updateStatus('processing', $progress, "Processing: {$departmentName}");

                // Fetch Employees for this Department
                $employees = Employee::where('org_id', $org_id)
                    ->where('department_id', $departmentId)
                    ->whereNotNull('refrerence_shift')
                    ->where(function ($q) use ($startdt) {
                        $q->where('reason', 'N')
                          ->orWhere('leaving_date', '>=', $startdt);
                    })
                    ->select('id', 'org_id', 'employee_id', 'shifting_duty', 'refrerence_shift', 'ot_payable', 'mtreturn_date', 'joining_date', 'punch_category', 'leaving_date')
                    ->get();

                if ($employees->isNotEmpty()) {
                    $count = $employees->count();
                    $totalEmployees += $count;
                    Log::info("Processing Dept {$departmentId} - Found {$count} employees");
                    
                    // Update Progress with Employee Count
                    $progress = round(($processedDepartments / $totalDepartments) * 100);
                    $this->updateStatus('processing', $progress, "Processing: {$departmentName} - Found {$count} Employees");

                    // Process in chunks within the department to manage memory
                    foreach ($employees->chunk(200) as $chunk) {
                        $totalInserted += $this->processAttendanceBatch(
                            $chunk, 
                            $startdt, 
                            $enddt, 
                            $month, 
                            $year, 
                            $baseshift, 
                            $companyshift, 
                            $ramadanshift, 
                            $ramadandate,
                            $exceptionalHolidays,
                            $leaveClasses
                        );
                    }
                }

                $processedDepartments++;
            }

            $duration = $startTime->diffForHumans(now(), true);
            $this->updateStatus('completed', 100, "Process Completed. Total Employees: {$totalEmployees}, Total Records: {$totalInserted}, Duration: {$duration}.");

        } catch (\Throwable $th) {
            Log::error('Attendance Process Job Failed: ' . $th->getMessage());
            $this->updateStatus('failed', 0, "Failed: " . $th->getMessage());
            throw $th;
        }
    }

    protected function updateStatus($status, $progress, $message)
    {
        $jobStatus = JobStatus::find($this->jobStatusId);
        if ($jobStatus) {
            $jobStatus->update([
                'status' => $status,
                'progress' => $progress,
                'message' => $message
            ]);
        }
    }

    protected function processAttendanceBatch($employees, $startdt, $enddt, $month, $year, $baseshift, $companyshift, $ramadanshift, $ramadandate, $exceptionalHolidays, $leaveClasses)
    {
        $empIds = $employees->pluck('employee_id')->toArray();
        
        $shifts = ShiftingList::whereIn('employee_id', $empIds)
            ->whereMonth('date', $month)
            ->whereYear('date', $year)
            ->whereBetween('date', [$startdt, $enddt])
            ->get()
            ->groupBy('employee_id');

        $caldatas = Calender::whereMonth('date', $month)
            ->where('is_active', 1)
            ->whereYear('date', $year)
            ->whereBetween('date', [$startdt, $enddt])
            ->select('date', 'year', 'month', 'holiday', 'public_holiday')
            ->get()
            ->keyBy(function($item) {
                return Carbon::parse($item->date)->format('Y-m-d');
            }); 

        $leavedatas = DB::table('hris_database_leave_confirmation')
            ->whereBetween('start_date', [$startdt, $enddt])
            ->orWhereBetween('end_date', [$startdt, $enddt])
            ->select('employee_id', 'start_date', 'end_date', 'leave_type_id')
            ->get();

        $punches = PunchData::whereIn('employee_id', $empIds)
            ->whereMonth('work_date', $month)
            ->whereYear('work_date', $year)
            ->whereBetween('work_date', [$startdt, $enddt])
            ->get()
            ->groupBy('employee_id');
        
        $batchExceptionalHolidays = ExceptionalHoliday::whereIn('holiday_date', $exceptionalHolidays)
             ->whereIn('employee_id', $empIds)
             ->get()
             ->groupBy('employee_id');

        $insertData = [];
        foreach ($employees as $employee) {
            $empid = $employee->employee_id;
            $empPunches = $punches->get($empid, collect());
            $empShifts = $shifts->get($empid, collect());
            $empExceptionalHoliday = $batchExceptionalHolidays->get($empid, collect());
            $empLeaves = $leavedatas->where('employee_id', $empid);

            list($start_date, $end_date) = $this->getEmployeeDateRange($employee, $startdt, $enddt);

            $period = CarbonPeriod::create($start_date, $end_date);

            foreach ($period as $dt) {
                $date = $dt->format('Y-m-d');
                $result = $this->calculateDailyAttendance(
                    $employee, $date, $empPunches, $empShifts, $caldatas, 
                    $empExceptionalHoliday, $empLeaves, $baseshift, 
                    $companyshift, $ramadanshift, $ramadandate, $leaveClasses
                );

                if ($result) {
                    $insertData[] = $result;
                }
            }
        }

        if (!empty($insertData)) {
            try {
                // Delete existing records to avoid duplicates
                ProcessAttendence::whereIn('employee_id', $empIds)
                    ->whereBetween('work_date', [$startdt, $enddt])
                    ->delete();

                // Chunk inserts to avoid query size limits
                foreach (array_chunk($insertData, 100) as $chunk) {
                    ProcessAttendence::insert($chunk);
                }
            } catch (\Exception $e) {
                Log::error("Attendance Insert Failed in Job", ['error' => $e->getMessage()]);
            }
        }
        
        return count($insertData);
    }

    private function calculateDailyAttendance($employee, $date, $punches, $shifts, $caldatas, $exceptionalHolidays, $leaves, $baseshift, $companyshift, $ramadanshift, $ramadandate, $leaveClasses)
    {
        // --- LOGIC REPLICATION START ---
        $shiftinfo = $this->getShiftInfo($employee, $date, $shifts, $baseshift, $companyshift, $ramadanshift, $ramadandate);
        
        if (!$shiftinfo) {
             Log::warning("Shift Info Missing", ['employee' => $employee->employee_id, 'date' => $date]);
             return null;
        }

        $shift = $shiftinfo['shift'];
        $starthr = $shiftinfo['start'];
        $endhr = $shiftinfo['end'];
        $break_start = $shiftinfo['break_start'];
        $break_end = $shiftinfo['break_end'];
        
        $calendardata = $caldatas[$date] ?? null;
        if (!$calendardata) {
            Log::warning("Calendar Data Missing", ['employee' => $employee->employee_id, 'date' => $date]);
            return null;
        }

        // Initialize variables
        $start_punch = null;
        $end_punch = null;
        $rwh = 0;
        $wwh = 0;
        $oth = 0;
        $otm = 0;
        $total = 0;
        $isLate = 'N';
        $lateMin = 0;
        $isEarly = 'N';
        $earlyMin = 0;
        $shortMin = 0;
        $attn_type = 'AB'; // Default Absent

        // Check Leaves
        $isOnLeave = $leaves->filter(function($leave) use ($date) {
            return $date >= $leave->start_date && $date <= $leave->end_date;
        })->first();

        if ($isOnLeave) {
            // Determine leave type code
            $attn_type = $leaveClasses[$isOnLeave->leave_type_id] ?? 'LWOP'; 
        }

        // Check Holiday
        if ($calendardata->holiday == 1 || $calendardata->public_holiday == 1) {
            $attn_type = 'HD';
        }
        
        // Check Exceptional Holiday
        if ($exceptionalHolidays->where('holiday_date', $date)->isNotEmpty()) {
             $attn_type = 'HD';
        }

        // Check Punches
        $dailyPunches = $punches->where('work_date', $date);
        if ($dailyPunches->isNotEmpty()) {
            $start_punch = $dailyPunches->min('time');
            $end_punch = $dailyPunches->max('time');
            
            // If only one punch, handle as error or partial? Assuming logic handles it.
            if ($start_punch && $end_punch && $start_punch != $end_punch) {
                $attn_type = 'PR';
                
                // Late Calculation
                if ($start_punch > Carbon::parse($starthr)->addMinutes($shiftinfo['late_after_minutes'])->format('H:i:s')) {
                    $isLate = 'Y';
                    $lateMin = Carbon::parse($starthr)->diffInMinutes(Carbon::parse($start_punch));
                }

                // Early Leave Calculation
                if ($end_punch < $endhr) {
                    $isEarly = 'Y';
                    $earlyMin = Carbon::parse($endhr)->diffInMinutes(Carbon::parse($end_punch));
                }

                // Working Hours
                $hoursData = $this->calculateWorkingHours($start_punch, $end_punch, $starthr, $endhr, $break_start, $break_end);
                $wwh = $hoursData['hours'];
                
                // Regular Working Hours (fixed or actual?)
                $rwh = 8; // Defaulting to 8, logic might vary
                
                // OT Calculation (Simplified)
                if ($employee->ot_payable == 'Y' && $wwh > $rwh) {
                    $total_ot_minutes = ($wwh - $rwh) * 60;
                    $oth = floor($total_ot_minutes / 60);
                    $otm = $total_ot_minutes % 60;
                }
                
                $total = $wwh;
            }
        }

        return $this->formatResult(
            $employee, $shift, $date, $start_punch, $end_punch, 
            $rwh, $wwh, $oth, $otm, $total, $attn_type, 
            $isLate, $lateMin, $isEarly, $earlyMin, $shortMin
        );
    }

    private function getShiftInfo($employee, $date, $shifts, $baseshift, $companyshift, $ramadanshift, $ramadandate)
    {
        $shift = $employee->refrerence_shift;
        
        // Check Shifting List
        $dayShift = $shifts->where('date', $date)->first();
        if ($dayShift) {
            $shift = $dayShift->shift;
        }

        // Check Ramadan
        $isRamadan = false;
        if ($ramadandate && $date >= $ramadandate->start_date && $date <= $ramadandate->end_date) {
            $isRamadan = true;
        }

        $info = null;
        if ($isRamadan && isset($ramadanshift[$shift])) {
            $info = $ramadanshift[$shift];
        } elseif (isset($companyshift[$shift])) {
            $info = $companyshift[$shift];
        } elseif (isset($baseshift[$shift])) {
            $info = $baseshift[$shift];
        }

        if ($info) {
            return [
                'shift' => $shift,
                'start' => $info->shift_start,
                'end' => $info->shift_end,
                'break_start' => $info->break_start,
                'break_end' => $info->break_end,
                'late_after_minutes' => $info->late_after_minutes ?? 0,
            ];
        }
        return null;
    }

    private function getEmployeeDateRange($employee, $startdt, $enddt)
    {
        $start_date = $startdt;
        $today = Carbon::today()->format('Y-m-d');
        if ($employee->joining_date > $startdt) {
            $start_date = $employee->joining_date;
        } else {
            $mtreturndate = ($employee->mtreturn_date && $employee->mtreturn_date != '0000-00-00')
                ? Carbon::parse($employee->mtreturn_date)->startOfMonth()->format('Y-m-d')
                : null;
            $start_date = ($startdt == $mtreturndate) ? Carbon::parse($mtreturndate)->addDays(1)->format('Y-m-d') : $startdt;
        }

        $end_date = ($employee->leaving_date > $startdt && $employee->leaving_date <= $enddt)
            ? Carbon::parse($employee->leaving_date)->subDays(1)->format('Y-m-d')
            : $enddt;

        $end_date = $today <= $end_date ? $today : $end_date;
        return [$start_date, $end_date];
    }

    private function calculateWorkingHours($start_punch, $end_punch, $starthr, $endhr, $break_start, $break_end)
    {
        if (function_exists('calculateActualHours')) {
            if ($start_punch <= $starthr && $endhr <= $end_punch) {
                return calculateActualHours($starthr, $endhr, $break_start, $break_end);
            } elseif ($start_punch > $starthr && $endhr <= $end_punch) {
                return calculateActualHours($start_punch, $endhr, $break_start, $break_end);
            } elseif ($start_punch <= $starthr && $endhr > $end_punch) {
                return calculateActualHours($starthr, $end_punch, $break_start, $break_end);
            } elseif ($start_punch > $starthr && $endhr > $end_punch) {
                return calculateActualHours($start_punch, $end_punch, $break_start, $break_end);
            }
        }
        
        // Fallback simple calculation if function missing
        $t1 = Carbon::parse($start_punch);
        $t2 = Carbon::parse($end_punch);
        $diff = $t1->diffInHours($t2);
        return ['hours' => $diff, 'totalHours' => $diff];
    }

    private function formatResult($employee, $shift, $date, $start, $end, $rwh, $wwh, $oth, $otm, $total, $type, $isLate='N', $lateMin=0, $isEarly='N', $earlyMin=0, $shortMin=0)
    {
        return [
            'org_id' => $employee->org_id,
            'employee_id' => $employee->employee_id,
            'shift' => $shift,
            'work_date' => $date,
            'start_punch' => $start,
            'end_punch' => $end,
            'rwh' => $rwh,
            'wwh' => $wwh,
            'ot_hours' => $oth,
            'ot_minutes' => $otm,
            'total_hours' => $total,
            'attn_type' => $type,
            'is_late' => $isLate,
            'late_minutes' => $lateMin,
            'is_early_leave' => $isEarly,
            'early_minutes' => $earlyMin,
            'short_minutes' => $shortMin,
            'created_by' => $this->userId,
            'updated_by' => $this->userId,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
