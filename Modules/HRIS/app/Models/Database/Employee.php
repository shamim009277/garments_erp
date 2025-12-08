<?php

namespace Modules\HRIS\Models\Database;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Modules\HRIS\Models\Setup\Thana;
use Illuminate\Database\Eloquent\Model;
use Modules\HRIS\Models\Setup\District;
use Modules\HRIS\Models\Setup\Department;
use Modules\HRIS\Models\Setup\Designation;
use Modules\HRIS\Models\Setup\Organization;
use Modules\HRIS\Models\Database\EmployeePersonal;
use Modules\HRIS\Models\Setup\Sex;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\HRIS\Models\Database\Applicant;
// use Modules\HRIS\Database\Factories\Database\EmployeeFactory;
use Modules\HRIS\Models\Database\EmpGatePass;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'hris_database_employee_basic';
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'employee_id',
        'salaried',
        'ot_payable',
        'name',
        'department_id',
        'designation_id',
        'org_id',
        'unit',
        'line',
        'grade',
        'mdistrict_id',
        'mthana_id',
        'mpost_office',
        'mvillage',
        'pdistrict_id',
        'shifting_duty',
        'pthana_id',
        'ppost_office',
        'pvillage',
        'joining_date',
        'confirmation_date',
        'punch_category',
        'refrerence_shift',
        'refrerence_date',
        'refrerence_holiday',
        'mtreturn_date',
        'father_name',
        'mother_name',
        'spouse_name',
        'leaving_date',
        'reason',
        'leaving_note',
        'present_address_duration',
        'photo',
        'signature',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected $dates = [
        'joining_date',
        'confirmation_date',
        'refrerence_date',
        'mtreturn_date',
        'leaving_date',
    ];

    public static function booted()
    {
        static::creating(function ($employee) {
            $employee->created_by = Auth::id();
            $employee->updated_by = Auth::id();
            $employee->line = $employee->line ?? 0;
            $employee->grade = $employee->grade ?? 0;
        });

        static::updating(function ($employee) {
            $employee->updated_by = Auth::id();
            $employee->line = $employee->line ?? 0;
            $employee->grade = $employee->grade ?? 0;
        });

        static::addGlobalScope('accessFilter', function ($query) {
            if (Auth::check()) {
                $accessId = Auth::user()->access_id;

                if ($accessId != 0) {
                    $query->where('org_id', $accessId);
                }
            }
        });
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)
            ->where(function($q) {
                $q->where('reason', 'N')
                ->orWhere('leaving_date', '>=', Carbon::today());
            });
    }

    public function scopeInactive($query) {
        return $query->where('is_active', false);
    }

    public function scopeSalaried($query) {
        return $query->where('salaried', true);
    }

    public function scopeResigned($query) {
        return $query->where('reason', 'R');
    }

    public function scopeLongAbsence($query) {
        return $query->where('reason', 'L');
    }

    public function scopeDeath($query) {
        return $query->where('reason', 'D');
    }

    public function scopeMaternity($query) {
        return $query->where('reason', 'M');
    }

    public function scopeNotLeaving($query) {
        return $query->where('reason', 'N');
    }

    public function scopeLeaving($query) {
        return $query->where('reason', 'L');
    }

    public function scopeShiftingDuty($query) {
        return $query->where('shifting_duty', 'Y');
    }

    public function department() {
        return $this->belongsTo(Department::class);
    }

    public function designation() {
        return $this->belongsTo(Designation::class);
    }

    public function organization() {
        return $this->belongsTo(Organization::class);
    }

    public function mdistrict() {
        return $this->belongsTo(District::class);
    }

    public function mthana() {
        return $this->belongsTo(Thana::class);
    }

    public function pdistrict() {
        return $this->belongsTo(District::class);
    }

    public function pthana() {
        return $this->belongsTo(Thana::class);
    }
    public function employeePersonal() {
        return $this->hasOne(EmployeePersonal::class, 'employee_id', 'employee_id');
    }

    public function employeeSalary() {
        return $this->hasOne(EmployeeSalary::class, 'employee_id', 'employee_id');
    }
    public function applicant() {
        return $this->hasOne(Applicant::class, 'employee_id', 'entry_date');
    }
    public function sex() {
        return $this->belongsTo(Sex::class);
    }
    public function gatepasses() {
        return $this->hasMany(EmpGatePass::class, 'employee_id', 'employee_id');
    }
}
