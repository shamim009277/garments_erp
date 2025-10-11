<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Modules\HRIS\Models\Database\EmployeeIncrement;

class EmployeeIncrementExport implements FromArray, WithHeadings
{
    /**
    * Export collection (DB rows)
    */
    public function array(): array
    {
        return [
            ['101', '1', '2025-09-01', '2025-09-15', '2025-09-30', 'B', 'F', 5000, 'Good performance'],
        ];
    }

    /**
    * Add headings for Excel
    */
    public function headings(): array
    {
        return [
            'employee_id',
            'increment_type_id',
            'increment_date',
            'effective_date',
            'arrear_upto_date',
            'increment_source',
            'increment_value',
            'amount',
            'remarks',
        ];
    }
}
