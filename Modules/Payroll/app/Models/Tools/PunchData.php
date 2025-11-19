<?php

namespace Modules\Payroll\Models\Tools;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Payroll\Database\Factories\PunnchDataFactory;

class PunchData extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'payroll_tools_punch_data';

    protected $fillable = [
        'org_id',
        'employee_id',
        'shift',
        'work_date',
        'start_punch',
        'end_punch',
        'created_by',
        'updated_by',
    ];
}
