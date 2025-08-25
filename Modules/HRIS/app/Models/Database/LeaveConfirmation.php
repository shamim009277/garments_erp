<?php

namespace Modules\HRIS\Models\Database;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Modules\HRIS\Models\Setup\Department;
use Modules\HRIS\Models\Setup\Designation;
use Modules\HRIS\Models\Setup\LeaveReason;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\HRIS\Database\Factories\Database\LeaveConfirmationFactory;

class LeaveConfirmation extends Model
{
    use HasFactory;

    protected $table = 'hris_database_leave_confirmation';
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'leave_id',
        'employee_id',
        'department_id',
        'designation_id',
        'leave_type_id',
        'reason_id',
        'application_date',
        'start_date',
        'end_date',
        'days',
        'remarks',
        'form_id',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id','employee_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id','department_id');
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class, 'designation_id','designation_id');
    }

    public function leaveReason()
    {
        return $this->belongsTo(LeaveReason::class, 'reason_id','reason_id');
    }

    public static function booted()
    {
        static::creating(function ($leaveConfirmation) {
            $leaveConfirmation->created_by = Auth::id();
            $leaveConfirmation->updated_by = Auth::id();

            $nextId = (self::max('id') ?? 0) + 1;
            $year = date('Y');
            $leaveConfirmation->leave_id = 'LV'.$year . str_pad($nextId, 6, '0', STR_PAD_LEFT);
        });

        static::updating(function ($leaveConfirmation) {
            $leaveConfirmation->updated_by = Auth::id();
        });
    }
}
