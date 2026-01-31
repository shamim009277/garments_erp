<?php

namespace Modules\HRIS\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\HRIS\Models\Database\Employee;
use Modules\HRIS\Models\Tools\ShiftingList;
use Modules\HRIS\Models\JobStatus;
use Carbon\Carbon;

class GenerateShiftingListJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $year;
    protected $departmentIds;
    protected $organizationId;
    protected $userId;
    protected $jobStatusId;

    public $timeout = 1200; // 20 minutes

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
            $startTime = microtime(true);
            date_default_timezone_set('Asia/Dhaka');
            
            // Initial Progress
            $this->updateStatus('processing', 0, 'Starting initialization...');

            $year = $this->year;
            $start_date = Carbon::createFromDate($year, 1, 1);
            $end_date   = Carbon::createFromDate($year, 12, 31);

            // Fetch Employees
            $this->updateStatus('processing', 5, 'Fetching employees...');
            
            $employees = Employee::active()
                ->whereIn('department_id', $this->departmentIds)
                ->when($this->organizationId, fn($q) => $q->where('org_id', $this->organizationId))
                ->get();

            $totalEmployees = $employees->count();
            if ($totalEmployees === 0) {
                $this->updateStatus('failed', 0, "No active employees found to generate shifting list.");
                return;
            }

            $totalInserted = 0;
            $processedCount = 0;

            // Split employees
            $regulars = $employees->where('shifting_duty', 'N');
            $shiftEmployees = $employees->where('shifting_duty', 'Y');

            $this->updateStatus('processing', 10, "Found {$totalEmployees} employees. Processing...");

            DB::transaction(function () use ($regulars, $shiftEmployees, $year, $start_date, $end_date, $totalEmployees, &$totalInserted, &$processedCount) {
                
                // Process Regular Employees
                foreach ($regulars as $employee) {
                    $rows = [];
                    $employeeJoining = Carbon::parse($employee->joining_date);
                    $empStartDate = $employeeJoining->gt($start_date) ? $employeeJoining : $start_date;
                    
                    $date = $empStartDate->copy();
                    while ($date->lte($end_date)) {
                        $rows[] = [
                            'year' => $year,
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
                        foreach (array_chunk($rows, 500) as $batch) {
                            ShiftingList::insert($batch);
                        }
                        $totalInserted += count($rows);
                    }

                    $processedCount++;
                    $this->updateProgress($processedCount, $totalEmployees);
                }

                // Process Shift Employees
                if ($shiftEmployees->isNotEmpty()) {
                    $previousShifts = ShiftingList::whereIn('employee_id', $shiftEmployees->pluck('employee_id'))
                        ->when($this->organizationId, fn($q) => $q->where('org_id', $this->organizationId))
                        ->where('year', $year - 1)
                        ->get()
                        ->keyBy('employee_id');

                    foreach ($shiftEmployees as $employee) {
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
                                'year' => $year,
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
                            foreach (array_chunk($rows, 500) as $batch) {
                                ShiftingList::insert($batch);
                            }
                            $totalInserted += count($rows);
                        }

                        $processedCount++;
                        $this->updateProgress($processedCount, $totalEmployees);
                    }
                }
            });

            $endTime = microtime(true);
            $executionTime = round($endTime - $startTime, 2);
            $message = "Shifting list generated successfully for Year: {$year}. Total inserted: {$totalInserted}. Time: {$executionTime}s";
            
            // Final Success Status
            $this->updateStatus('completed', 100, $message);

        } catch (\Throwable $th) {
            Log::error('Shifting List Job Error: ' . $th->getMessage());
            $this->updateStatus('failed', 0, "Failed to generate shifting list. Error: " . $th->getMessage());
            throw $th;
        }
    }

    protected function updateStatus($status, $progress, $message)
    {
        JobStatus::where('id', $this->jobStatusId)->update([
            'status' => $status,
            'progress' => $progress,
            'message' => $message
        ]);
    }

    protected function updateProgress($processed, $total)
    {
        // Update every 5% or at least every 10 items if total is small
        $percentage = round(($processed / $total) * 90) + 10; // Map 0-100% of processing to 10-100% of total progress
        
        // Update DB only if percentage changed significantly or periodically to avoid DB thrashing
        if ($processed % 20 === 0 || $processed === $total) {
             $this->updateStatus('processing', $percentage, "Processing employees... {$percentage}%");
        }
    }
}
