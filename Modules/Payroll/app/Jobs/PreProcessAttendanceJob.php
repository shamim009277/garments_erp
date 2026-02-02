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
use Modules\Payroll\Models\Tools\ReadMachineData;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class PreProcessAttendanceJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $date;
    protected $org_id;
    protected $departmentIds;
    protected $userId;
    protected $jobStatusId;

    public $timeout = 3600; // 1 hour

    public function __construct($date, $org_id, $departmentIds, $userId, $jobStatusId)
    {
        $this->date = $date;
        $this->org_id = $org_id;
        $this->departmentIds = $departmentIds;
        $this->userId = $userId;
        $this->jobStatusId = $jobStatusId;
    }

    public function handle()
    {
        try {
            $startTime = now();
            $this->updateStatus('processing', 0, 'Initializing pre-process attendance...');

            $org_id = $this->org_id;
            $preDate = Carbon::parse($this->date);
            
            $startdt = $preDate->copy()->startOfMonth()->format('Y-m-d');
            $enddt   = $preDate->copy()->endOfMonth()->format('Y-m-d');
            
            $end = $preDate->between($startdt, $enddt) ? $preDate : Carbon::parse($enddt);
            $end_date_str = $end->format('Y-m-d');

            // --- Load Shared Data ---
            $ramadandate = RamadanSchedule::active()->first();
            $baseshift = Shift::active()->get()->keyBy('shift');
            $companyshift = CompanyWiseShift::active()->where('org_id', $org_id)->get()->keyBy('shift');
            $ramadanshift = CompanyWiseRamadanShift::active()->where('org_id', $org_id)->get()->keyBy('shift');

            if ($baseshift->isEmpty() && $companyshift->isEmpty()) {
                throw new \Exception('Please add shift. Common shift or company wise shift.');
            }

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
                    ->select('id', 'org_id', 'employee_id', 'shifting_duty', 'refrerence_shift', 'department_id')
                    ->get();

                if ($employees->isNotEmpty()) {
                    $count = $employees->count();
                    $totalEmployees += $count;
                    Log::info("Pre-Processing Dept {$departmentId} - Found {$count} employees");
                    
                    // Update Progress with Employee Count
                    $progress = round(($processedDepartments / $totalDepartments) * 100);
                    $this->updateStatus('processing', $progress, "Processing: {$departmentName} - Found {$count} Employees");

                    // Process in chunks within the department to manage memory
                    foreach ($employees->chunk(200) as $chunk) {
                        $totalInserted += $this->processPreAttendanceChunk(
                            $chunk, 
                            $startdt, 
                            $end, // Carbon object
                            $baseshift, 
                            $companyshift, 
                            $ramadanshift, 
                            $ramadandate
                        );
                    }
                }

                $processedDepartments++;
            }

            $duration = $startTime->diffForHumans(now(), true);
            $this->updateStatus('completed', 100, "Pre-Process Completed. Total Employees: {$totalEmployees}, Total Records: {$totalInserted}, Duration: {$duration}.");

        } catch (\Throwable $th) {
            Log::error('Pre-Process Attendance Job Failed: ' . $th->getMessage());
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

    private function processPreAttendanceChunk($employees, $start_date, $end, $baseshift, $companyshift, $ramadanshift, $ramadandate)
    {
        $empIds = $employees->pluck('employee_id')->all();
        
        // Ensure $end is Carbon object, though type hint might not be strict here
        $endCarbon = $end instanceof Carbon ? $end : Carbon::parse($end);

        $punches = ReadMachineData::whereIn('employee_id', $empIds)
            ->whereBetween('attendance_date', [$start_date, $endCarbon->copy()->addDay()->toDateString()])
            ->orderBy('attendance_date')
            ->get()
            ->groupBy('employee_id');

        $shifts = ShiftingList::whereIn('employee_id', $empIds)
            ->whereBetween('date', [$start_date, $endCarbon->toDateString()])
            ->get()
            ->groupBy('employee_id');

        $gatepasses = EmpGatePass::whereIn('employee_id', $empIds)
            ->whereBetween('date', [$start_date, $endCarbon->toDateString()])
            ->get()
            ->groupBy('employee_id');

        $dates = collect(CarbonPeriod::create($start_date, $endCarbon))->map(fn($d) => $d->toDateString());
        $insertData = [];

        foreach ($employees as $employee) {
            $empPunch = $punches->get($employee->employee_id, collect());
            if ($empPunch->isEmpty()) continue;

            $empShift = $shifts->get($employee->employee_id, collect());
            $empGate  = $gatepasses->get($employee->employee_id, collect());

            foreach ($dates as $date) {
                $shift = $empShift->firstWhere('date', $date)?->shift ?? $employee->refrerence_shift;
                
                // Helper to get shift info
                $shiftTime = $this->getShiftInfo($shift, $date, $baseshift, $companyshift, $ramadanshift, $ramadandate);

                if (!$shiftTime) continue;
                
                // Next day shift for limit calculation
                $nextDayShift = $empShift->firstWhere('date', Carbon::parse($date)->addDay()->toDateString())?->shift;

                $starthr = Carbon::parse($date . ' ' . $shiftTime->shift_start);
                $endhr   = Carbon::parse($date . ' ' . $shiftTime->shift_end);

                // Determine limits based on shift duty and next day shift
                $isConsecutive = $nextDayShift && $nextDayShift == $shift;
                $isNMShift = in_array($employee->shifting_duty, ['N', 'M']);
                
                $endLimitHours = ($isConsecutive || !$isNMShift) ? 12 : 10;
                
                $startlimit = $starthr->copy()->subHours(2);
                $endlimit   = $endhr->copy()->addHours($endLimitHours);

                $rangePunch = $empPunch->whereBetween('attendance_date', [$startlimit, $endlimit]);
                if ($rangePunch->isEmpty()) continue;

                $startpunch = $rangePunch->first()->attendance_date;
                $endpunch   = $rangePunch->last()->attendance_date;

                if ($empGate->firstWhere('date', $date)) {
                    $endpunch = $endhr->toDateTimeString();
                }

                $insertData[] = [
                    'org_id' => $employee->org_id,
                    'employee_id' => $employee->employee_id,
                    'shift' => $shift,
                    'work_date' => $date,
                    'start_punch' => $startpunch,
                    'end_punch' => $endpunch,
                    'created_by' => $this->userId,
                    'updated_by' => $this->userId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        if (!empty($insertData)) {
             // Avoid duplicates by deleting first? The original controller logic checked existence at the beginning but didn't delete per chunk.
             // But since we might re-run, deleting duplicates for this batch is safer.
             // However, `PunchData` table might not have unique constraints causing issues if we don't.
             // Original logic: `if (PunchData::where('org_id', $request->org_id)->whereBetween('work_date', [$start_date, $end_date])->exists()) return error`
             // So it assumed clean slate.
             // We will try to just insert. If the user wants to re-process, they should use "Undo/Revert" (Title 2) first.
             // Or we can be safe and delete for these employees and dates.
             
             // Let's stick to simple insert for now to match original logic, or maybe delete to be robust?
             // Given the job nature, robustness is better.
             
             /*
             PunchData::whereIn('employee_id', $empIds)
                 ->whereBetween('work_date', [$start_date, $endCarbon->toDateString()])
                 ->delete();
             */
             // Actually, original logic returned error if data existed.
             // I'll stick to insert.
             
             foreach (array_chunk($insertData, 100) as $chunk) {
                 PunchData::insert($chunk);
             }
        }
        
        return count($insertData);
    }

    private function getShiftInfo($shift, $date, $baseshift, $companyshift, $ramadanshift, $ramadandate)
    {
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
            return $info;
        }
        return null;
    }
}
