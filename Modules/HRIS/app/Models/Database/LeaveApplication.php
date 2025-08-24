<?php

namespace Modules\HRIS\Models\Database;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Modules\HRIS\Models\Setup\Department;
use Modules\HRIS\Models\Setup\Designation;
use Modules\HRIS\Models\Setup\LeaveReason;
use Modules\HRIS\Models\Setup\LeaveClassification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\HRIS\Database\Factories\Database\LeaveApplicationFactory;

class LeaveApplication extends Model
{
    use HasFactory;
    protected $table = 'hris_database_leave_application';

    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = ['id'];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id','employee_id');
    }

    public function leaveReason()
    {
        return $this->belongsTo(LeaveReason::class, 'reason_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class, 'designation_id');
    }

    public function leaveType()
    {
        return $this->belongsTo(LeaveClassification::class, 'leave_type_id','code');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function scopeRejected($query)
    {
        return $query->where('is_rejected', 'Y');
    }

    public function scopeApproved($query)
    {
        return $query->where('is_approved', 'Y');
    }

    public function scopeForwarded($query)
    {
        return $query->where('is_forward', 'Y');
    }

    public function scopePending($query)
    {
        return $query->where('is_forward', 'N')->where('is_rejected', 'N')->where('is_approved', 'N');
    }

    public static function booted()
    {
        static::creating(function ($leaveApplication) {
            $leaveApplication->created_by = Auth::id();
            $leaveApplication->updated_by = Auth::id();

            $nextId = (self::max('id') ?? 0) + 1;
            $year = date('Y');
            $leaveApplication->form_id = $year . str_pad($nextId, 6, '0', STR_PAD_LEFT);
        });

        static::updating(function ($leaveApplication) {
            $leaveApplication->updated_by = Auth::id();
        });
    }
}
