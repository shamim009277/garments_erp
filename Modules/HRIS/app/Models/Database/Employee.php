<?php

namespace Modules\HRIS\Models\Database;

use Illuminate\Support\Facades\Auth;
use Modules\HRIS\Models\Setup\Thana;
use Illuminate\Database\Eloquent\Model;
use Modules\HRIS\Models\Setup\District;
use Modules\HRIS\Models\Setup\Department;
use Modules\HRIS\Models\Setup\Designation;
use Modules\HRIS\Models\Setup\Organization;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\HRIS\Models\Database\EmployeePersonal;
// use Modules\HRIS\Database\Factories\Database\EmployeeFactory;

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
        'pthana_id',
        'ppost_office',
        'pvillage',
        'joining_date',
        'confirmation_date',
        'punch_category',
        'refrerence_shift',
        'refrerence_date',
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
        'ot_payable' => 'boolean',
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
    }

    public function scopeActive($query) {
        return $query->where('is_active', true);
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

    // protected static function newFactory(): Database\EmployeeFactory
    // {
    //     // return Database\EmployeeFactory::new();
    // }
}
