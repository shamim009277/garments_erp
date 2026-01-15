<?php

namespace Modules\Payroll\Models\Tools;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Modules\HRIS\Models\Database\Employee;
use Modules\HRIS\Models\Setup\Organization;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProcessAttendence extends Model
{
    use HasFactory;

    protected $table = 'payroll_tools_process_attendence';
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'org_id',
        'employee_id',
        'shift',
        'work_date',
        'start_punch',
        'end_punch',
        'rwh',
        'wwh',
        'ot_hours',
        'ot_minutes',
        'total_hours',
        'attn_type',
        'is_late',
        'is_early_leave',
        'late_minutes',
        'early_minutes',
        'short_minutes',
        'created_by',
        'updated_by',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id','employee_id');
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'org_id','id');
    }

    public static function booted()
    {
        static::creating(function ($processattendence) {
            $processattendence->created_by = Auth::id();
            $processattendence->updated_by = Auth::id();
        });

        static::updating(function ($processattendence) {
            $processattendence->updated_by = Auth::id();
        });
    }
}
