<?php

namespace Modules\HRIS\Models\Tools;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Modules\HRIS\Models\Setup\Department;
use Modules\HRIS\Models\Database\Employee;
use Modules\HRIS\Models\Setup\Designation;
use Modules\HRIS\Models\Setup\Organization;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DesignationChange extends Model
{
    use HasFactory;

    protected $table = 'hris_tools_designationchange';

    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = ['id'];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class, 'designation_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'org_id');
    }

    public function newDesignation()
    {
        return $this->belongsTo(Designation::class, 'new_designation_id');
    }

    public function newDepartment()
    {
        return $this->belongsTo(Department::class, 'new_department_id');
    }

    public function newOrganization()
    {
        return $this->belongsTo(Organization::class, 'new_org_id');
    }

    public static function booted()
    {
        static::creating(function ($designationchange) {
            $designationchange->created_by = Auth::id();
            $designationchange->updated_by = Auth::id();
        });

        static::updating(function ($designationchange) {
            $designationchange->updated_by = Auth::id();
        });
    }
}
