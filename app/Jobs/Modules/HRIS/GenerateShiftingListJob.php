<?php

namespace App\Jobs\Modules\HRIS;

use Modules\HRIS\Models\Database\Employee;
use Modules\HRIS\Models\Tools\ShiftingList;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;

class GenerateShiftingListJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $year;
    protected $departmentIds;
    protected $userId;

    public function __construct($year, $departmentIds, $userId)
    {
        $this->year = $year;
        $this->departmentIds = $departmentIds;
        $this->userId = $userId;
    }

    public function handle(): void
    {
        $startDate = Carbon::createFromDate($this->year, 1, 1);
        $endDate = Carbon::createFromDate($this->year, 12, 31);

        // Fetch employees in these departments
        $employees = Employee::active()->whereIn('department_id', $this->departmentIds)->get();

        // Prevent duplicate for this year
        if (ShiftingList::whereIn('employee_id', $employees->pluck('employee_id'))->where('year', $this->year)->exists()) {
            return;
        }

        // --- Regular Employees ---
        $this->generateRegularEmployees($employees->where('shifting_duty', 'N'), $startDate, $endDate);

        // --- Shift Employees ---
        $this->generateShiftEmployees($employees->where('shifting_duty', 'Y'), $startDate, $endDate);
    }

    protected function generateRegularEmployees($employees, $startDate, $endDate)
    {
        $employees->chunk(50)->each(function($chunk) use ($startDate, $endDate) {
            foreach ($chunk as $employee) {
                $rows = [];
                $empStart = Carbon::parse($employee->joining_date)->gt($startDate)
                            ? Carbon::parse($employee->joining_date)
                            : $startDate;

                $date = $empStart->copy();
                while ($date->lte($endDate)) {
                    $rows[] = [
                        'year'        => (int)$this->year,
                        'employee_id' => (int)$employee->employee_id,
                        'date'        => $date->format('Y-m-d'),
                        'shift'       => $employee->refrerence_shift,
                        'created_by'  => $this->userId,
                        'updated_by'  => $this->userId,
                    ];

                    if(count($rows) == 10){
                        ShiftingList::insert($rows);
                        $rows = [];
                    }
                    $date->addDay();
                }

                if(!empty($rows)){
                    ShiftingList::insert($rows);
                }
            }
        });
    }

    protected function generateShiftEmployees($employees, $startDate, $endDate)
    {
        if($employees->isEmpty()) return;

        $prevYearShifts = ShiftingList::where('year', $this->year - 1)
                              ->whereIn('employee_id', $employees->pluck('employee_id'))
                              ->get()
                              ->keyBy('employee_id');

        $employees->chunk(50)->each(function($chunk) use ($startDate, $endDate, $prevYearShifts) {
            foreach ($chunk as $employee) {
                $rows = [];
                $empStart = Carbon::parse($employee->joining_date)->gt($startDate)
                            ? Carbon::parse($employee->joining_date)
                            : $startDate;

                $date = $empStart->copy();
                $changedDay = Carbon::parse($employee->refrerence_holiday)->addDay()->format('l');

                $shift = $prevYearShifts->has($employee->employee_id)
                         ? $prevYearShifts[$employee->employee_id]->shift
                         : $employee->refrerence_shift;

                while ($date->lte($endDate)) {
                    if($date->format('l') === $changedDay){
                        $shift = $this->rotateShift($shift);
                    }

                    $rows[] = [
                        'year'        => (int)$this->year,
                        'employee_id' => (int)$employee->employee_id,
                        'date'        => $date->format('Y-m-d'),
                        'shift'       => $shift,
                        'created_by'  => $this->userId,
                        'updated_by'  => $this->userId,
                    ];

                    if(count($rows) == 10){
                        ShiftingList::insert($rows);
                        $rows = [];
                    }

                    $date->addDay();
                }

                if(!empty($rows)){
                    ShiftingList::insert($rows);
                }
            }
        });
    }

    protected function rotateShift($currentShift)
    {
        return match($currentShift){
            'A' => 'C',
            'C' => 'B',
            'B' => 'A',
            'M' => 'N',
            'N' => 'M',
            default => $currentShift,
        };
    }
}
