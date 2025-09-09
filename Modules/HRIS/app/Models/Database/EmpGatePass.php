<?php

namespace Modules\HRIS\Models\Database;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Modules\HRIS\Models\Setup\Department;
use Modules\HRIS\Models\Setup\Designation;
use Modules\HRIS\Models\Setup\EmpGatepassReason;
use Modules\HRIS\Models\Setup\EmpGatepassPurpose;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\HRIS\Database\Factories\Database\EmpGatePassFactory;

class EmpGatePass extends Model
{
    use HasFactory;

    protected $table = 'hris_database_employee_gatepass';
    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = ['id'];

    protected $appends = ['duration'];

    public function getDurationAttribute()
    {
        if ($this->start_time && $this->end_time && $this->type_id == 1) {
            $start = Carbon::parse($this->start_time);
            $end = Carbon::parse($this->end_time);

            if ($end->lessThanOrEqualTo($start)) {
                $end->addDay();
            }
            $diff = $start->diff($end);
            return $diff->format('%H:%I');
        }else{
            return "Day Out";
        }
    }

    public function employee() {
        return $this->belongsTo(Employee::class, 'employee_id', 'employee_id');
    }

    public function purpose() {
        return $this->belongsTo(EmpGatepassPurpose::class, 'purpose_id', 'id');
    }

    public function reason() {
        return $this->belongsTo(EmpGatepassReason::class, 'reason_id', 'id');
    }

    public function department() {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function designation() {
        return $this->belongsTo(Designation::class, 'designation_id', 'id');
    }

    public function approvedBy() {
        return $this->belongsTo(User::class, 'approved_by', 'id');
    }

    public static function booted()
    {
        static::creating(function ($gatepass) {
            $gatepass->created_by = Auth::id();
            $gatepass->updated_by = Auth::id();
        });

        static::updating(function ($gatepass) {
            $gatepass->updated_by = Auth::id();
        });
    }

    // protected static function newFactory(): Database\EmpGatePassFactory
    // {
    //     // return Database\EmpGatePassFactory::new();
    // }
}
