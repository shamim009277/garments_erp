<?php

namespace Modules\HRIS\Models\Database;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Modules\HRIS\Models\Setup\Organization;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\HRIS\Database\Factories\Database\EmployeeSalaryFactory;

class EmployeeSalary extends Model
{
    use HasFactory;

    protected $table = 'hris_database_employee_salary';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'employee_id',
        'org_id',
        'gross_salary',
        'basic',
        'home_allowance',
        'medical_allowance',
        'food_allowance',
        'other_allowance',
        'conveyance',
        'attendance_bonus',
        'ot_payable',
        'ot_rate',
        'holiday_allowance',
        'salary_from_bank',
        'account_no',
        'mobile_banking',
        'bank_name',
        'pf_member',
        'pf_member_date',
        'pf_close_date',
        'tin_no',
        'tax',
        'pf',
    ];

    protected $casts = [

    ];

    protected $dates = [
        'pf_member_date',
        'pf_close_date',
    ];

    public function employee() {
        return $this->belongsTo(Employee::class);
    }

    public function org() {
        return $this->belongsTo(Organization::class);
    }

    public static function booted()
    {
        static::creating(function ($employee) {
            $employee->created_by = Auth::id();
            $employee->updated_by = Auth::id();
        });

        static::updating(function ($employee) {
            $employee->updated_by = Auth::id();
        });
    }

    public function scopeActive($query) {
        return $query->where('is_active', true);
    }
}
