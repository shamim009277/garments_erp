<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Modules\HRIS\Models\Database\EmployeeIncrement;
use Modules\HRIS\Models\Database\EmployeeSalary;
use Exception;
use Illuminate\Support\Facades\Log;

class EmployeeIncrementImport implements ToModel,WithHeadingRow
{
    protected $houseRentBasic;

    public function __construct($houseRentBasic)
    {
        $this->houseRentBasic = isset($houseRentBasic) ? (float) str_replace('%', '', $houseRentBasic): null;
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        try {
            $employeeId = $row['employee_id'] ?? null;

            if (empty($employeeId)) {
                throw new Exception('Employee ID is missing.');
            }

            $empSalary = EmployeeSalary::with([
                'employee:id,employee_id,department_id,designation_id,line,unit'
            ])
            ->where('employee_id', $employeeId)
            ->first();

            if (!$empSalary) {
                throw new Exception("No salary record found for Employee ID: {$employeeId}");
            }

            if (!in_array($row['increment_value'], ['F', 'P'])) {
                throw new Exception("Invalid increment value type for Employee ID: {$employeeId}");
            }

            if (!in_array($row['increment_source'], ['B', 'G'])) {
                throw new Exception("Invalid increment source for Employee ID: {$employeeId}");
            }

            //Calculate increment amount
            $incAmount = 0;
            if ($row['increment_value'] === 'F') {
                $incAmount = $row['amount'];
            } elseif ($row['increment_value'] === 'P') {
                if ($row['increment_source'] === 'B') {
                    $incAmount = $empSalary->basic * ($row['amount'] / 100);
                } elseif ($row['increment_source'] === 'G') {
                    $incAmount = $empSalary->gross_salary * ($row['amount'] / 100);
                }
            }

            //Return new record for insertion
            return new EmployeeIncrement([
                'org_id'              => $empSalary->org_id ?? null,
                'employee_id'         => $employeeId,
                'department_id'       => $empSalary->employee->department_id,
                'designation_id'      => $empSalary->employee->designation_id,
                'line'                => $empSalary->employee->line,
                'unit'                => $empSalary->employee->unit,
                'new_department_id'   => $empSalary->employee->department_id,
                'new_designation_id'  => $empSalary->employee->designation_id,
                'gross_salary'        => $empSalary->gross_salary ?? null,
                'basic'               => $empSalary->basic ?? null,
                'medical_allowance'   => $empSalary->medical_allowance ?? null,
                'home_allowance'      => $empSalary->home_allowance ?? null,
                'food_allowance'      => $empSalary->food_allowance ?? null,
                'conveyance'          => $empSalary->conveyance ?? null,
                'increment_date'      => $row['increment_date'] ?? null,
                'effective_date'      => $row['effective_date'] ?? null,
                'arrear_upto_date'    => $row['arrear_upto_date'] ?? null,
                'increment_type_id'   => $row['increment_type_id'] ?? null,
                'increment_source'    => $row['increment_source'] ?? null,
                'increment_value_type'=> $row['increment_value'] ?? null,
                'increment_value'     => $row['amount'] ?? null,
                'amount'              => $incAmount,
                'house_rent_basic'    => $this->houseRentBasic,
                'remarks'             => $row['remarks'] ?? null,
                'created_by'          => auth()->id(),
                'updated_by'          => auth()->id(),
            ]);
        } catch (Exception $e) {
            // Log error details (you can check in storage/logs/laravel.log)
            Log::error('EmployeeIncrementImport failed', [
                'row'     => $row,
                'message' => $e->getMessage(),
            ]);

            // Optionally, you can stop the import with a clear message
            throw new Exception('Import failed for Employee ID ' . ($row['employee_id'] ?? 'Unknown') . ': ' . $e->getMessage());
        }
    }
}
