<?php

namespace Modules\HRIS\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\HRIS\Models\JobStatus;
use Modules\HRIS\Models\Database\Employee;
use Modules\HRIS\Models\Tools\ShiftingList;
use Modules\HRIS\Models\Setup\Department;
use Carbon\Carbon;
use Throwable;

class GenerateShiftingListJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $year;
    protected $departmentIds;
    protected $organizationId;
    protected $userId;
    protected $jobStatusId;

    public $timeout = 3600; // 1 hour for large processing

    /**
     * Create a new job instance.
     */
    public function __construct($year, $departmentIds, $organizationId, $userId, $jobStatusId)
    {
        $this->year = $year;
        $this->departmentIds = $departmentIds;
        $this->organizationId = $organizationId;
        $this->userId = $userId;
        $this->jobStatusId = $jobStatusId;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $startTime = now();
            $totalEmployeesProcessed = 0;
            $totalInsertedRows = 0;

            // Log the received departmentIds to debug
            Log::info('GenerateShiftingListJob started', [
                'year' => $this->year,
                'departmentIds' => $this->departmentIds,
                'type' => gettype($this->departmentIds)
            ]);

            $this->updateStatus('processing', 0, 'Starting shifting list generation...');
            
            // Ensure departmentIds is an array
            $departmentIds = is_array($this->departmentIds) ? $this->departmentIds : explode(',', $this->departmentIds);
            
            // Filter valid departments
            $validDepartments = [];
            foreach ($departmentIds as $departmentId) {
                $departmentId = trim($departmentId);
                if (empty($departmentId)) continue;
                
                $hasEmployees = Employee::active()
                    ->where('department_id', $departmentId)
                    ->when($this->organizationId, fn($q) => $q->where('org_id', $this->organizationId))
                    ->exists();

                if (!$hasEmployees) {
                    Log::info("Skipping Dept ID {$departmentId} - No active employees.");
                    continue;
                }
                
                $validDepartments[] = $departmentId;
            }

            $totalDepartments = count($validDepartments);
            
            if ($totalDepartments === 0) {
                 $this->updateStatus('failed', 0, "No departments with employees to process.");
                 return;
            }

            Log::info("Processing {$totalDepartments} departments.");
            
            $processedDepartments = 0;
            $start_date = Carbon::createFromDate($this->year, 1, 1);
            $end_date   = Carbon::createFromDate($this->year, 12, 31);

            foreach ($validDepartments as $index => $departmentId) {
                // Fetch Department Name and Employee Count
                $departmentName = Department::where('id', $departmentId)->value('department') ?? "ID: {$departmentId}";
                $employeeCount = Employee::active()
                    ->where('department_id', $departmentId)
                    ->when($this->organizationId, fn($q) => $q->where('org_id', $this->organizationId))
                    ->count();

                Log::info("Processing Department Shifting: {$departmentName} ({$employeeCount} employees)");
                
                $progress = round(($processedDepartments / $totalDepartments) * 100);
                $this->updateStatus('processing', $progress, "Processing: {$departmentName} (Total Employees: {$employeeCount})");

                try {
                    $stats = $this->processDepartment($departmentId, $start_date, $end_date);
                    
                    $totalEmployeesProcessed += $stats['employees'];
                    $totalInsertedRows += $stats['rows'];
                    $processedDepartments++;
                    
                    // Update progress after each department
                    $progress = round(($processedDepartments / $totalDepartments) * 100);
                    $this->updateStatus('processing', $progress, "Completed: {$departmentName} (Total Employees: {$employeeCount})");
                    
                } catch (\Throwable $e) {
                    Log::error("Error processing department {$departmentId}: " . $e->getMessage());
                    // Continue with other departments even if one fails
                }
            }

            $duration = $startTime->diffForHumans(now(), true);
            $finalMessage = "Completed! Total Employees: {$totalEmployeesProcessed}, Total Data Inserted: {$totalInsertedRows}, Time Taken: {$duration}.";
            
            $this->updateStatus('completed', 100, $finalMessage);

        } catch (\Throwable $th) {
            Log::error('Shifting List Dispatch Error: ' . $th->getMessage());
            $this->updateStatus('failed', 0, "Failed to process. Error: " . $th->getMessage());
            throw $th;
        }
    }

    protected function processDepartment($departmentId, $start_date, $end_date)
    {
        $insertedRowsCount = 0;
        
        $employees = Employee::active()
            ->where('department_id', $departmentId)
            ->when($this->organizationId, fn($q) => $q->where('org_id', $this->organizationId))
            ->get();
        
        Log::info("Found " . $employees->count() . " employees for Dept {$departmentId}");

        if ($employees->isEmpty()) {
            return ['employees' => 0, 'rows' => 0];
        }

        $regulars = $employees->where('shifting_duty', 'N');
        $shiftEmployees = $employees->where('shifting_duty', 'Y');

        // Process Regular Employees
        foreach ($regulars as $employee) {
            // Reduced delay (e.g. 5ms) to prevent timeout but keep some visualization
            usleep(5000); 

            $rows = [];
            $employeeJoining = Carbon::parse($employee->joining_date);
            $empStartDate = $employeeJoining->gt($start_date) ? $employeeJoining : $start_date;
            
            $date = $empStartDate->copy();
            while ($date->lte($end_date)) {
                $rows[] = [
                    'year' => $this->year,
                    'employee_id' => $employee->employee_id,
                    'org_id' => $employee->org_id,
                    'date' => $date->format('Y-m-d'),
                    'shift' => $employee->refrerence_shift,
                    'created_by' => $this->userId,
                    'updated_by' => $this->userId,
                ];
                $date->addDay();
            }

            if (!empty($rows)) {
                $insertedRowsCount += count($rows);
                foreach (array_chunk($rows, 500) as $batch) {
                    ShiftingList::insert($batch);
                }
            }
        }

        // Process Shift Employees
        if ($shiftEmployees->isNotEmpty()) {
            $previousShifts = ShiftingList::whereIn('employee_id', $shiftEmployees->pluck('employee_id'))
                ->when($this->organizationId, fn($q) => $q->where('org_id', $this->organizationId))
                ->where('year', $this->year - 1)
                ->get()
                ->keyBy('employee_id');

            foreach ($shiftEmployees as $employee) {
                // Reduced delay
                usleep(5000); 

                $rows = [];
                $employeeJoining = Carbon::parse($employee->joining_date);
                $empStartDate = $employeeJoining->gt($start_date) ? $employeeJoining : $start_date;
                $changeday = Carbon::parse($employee->refrerence_holiday)->addDay()->format('l');
                
                $prevShift = $previousShifts[$employee->employee_id]->shift ?? $employee->refrerence_shift;
                $shift2 = $prevShift;
                
                $date = $empStartDate->copy();
                while ($date->lte($end_date)) {
                    if ($date->format('l') === $changeday) {
                        $shift2 = match ($shift2) {
                            'A' => 'C',
                            'C' => 'B',
                            'B' => 'A',
                            'M' => 'N',
                            'N' => 'M',
                            default => $shift2,
                        };
                    }
                    
                    $rows[] = [
                        'year' => $this->year,
                        'employee_id' => $employee->employee_id,
                        'org_id' => $employee->org_id,
                        'date' => $date->format('Y-m-d'),
                        'shift' => $shift2,
                        'created_by' => $this->userId,
                        'updated_by' => $this->userId,
                    ];
                    $date->addDay();
                }

                if (!empty($rows)) {
                    $insertedRowsCount += count($rows);
                    foreach (array_chunk($rows, 500) as $batch) {
                        ShiftingList::insert($batch);
                    }
                }
            }
        }
        
        Log::info("Completed Department Shifting: Dept ID {$departmentId}");
        
        return ['employees' => $employees->count(), 'rows' => $insertedRowsCount];
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
