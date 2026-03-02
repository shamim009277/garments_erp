<?php

namespace Modules\Payroll\Models\Tools;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Modules\HRIS\Models\Setup\Department;
use Modules\HRIS\Models\Database\Employee;
use Modules\HRIS\Models\Setup\Designation;
use Modules\HRIS\Models\Setup\Organization;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProcessHalfSalary extends Model
{
    use HasFactory;

    protected $table = 'payroll_tools_process_halfsalary';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'org_id',
        'year',
        'month',
        'base_date',
        'employee_id',
        'department_id',
        'designation_id',
        'line',
        'unit',
        'category',
        'reason',
        'grade',
        'leaving_date',
        'salary_from_bank',
        'account_no',
        'mobile_banking',
        'late_days',
        'days',
        'absent_days',
        'leave_days',
        'rwh',
        'wrh',
        'basic',
        'home_allowance',
        'medical_allowance',
        'food_allowance',
        'other_allowance',
        'conveyance',
        'absent_deduction',
        'basic_payable',
        'oa_payable',
        'gross_payable',
        'total_deduction',
        'net_payable',
        'total_net_payable',
        'remark',
        'confirm',
        'created_by'
    ];

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class, 'org_id');
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function designation(): BelongsTo
    {
        return $this->belongsTo(Designation::class, 'designation_id');
    }

    public static function booted()
    {
        static::creating(function ($processsalary) {
            $processsalary->created_by = Auth::id();
        });
    }

}
