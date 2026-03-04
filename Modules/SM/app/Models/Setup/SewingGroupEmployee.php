<?php

namespace Modules\SM\Models\Setup;

use Illuminate\Database\Eloquent\Model;
use Modules\HRIS\Models\Database\Employee;

class SewingGroupEmployee extends Model
{
    protected $table = 'sm_setup_sewing_group_employees';

    protected $fillable = [
        'group_id',
        'employee_id',
    ];

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }

    public function employee()
    {
        // employee_id in this table -> employee_id in Employee table
        return $this->belongsTo(Employee::class, 'employee_id', 'employee_id');
    }
}
