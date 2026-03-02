<?php

namespace Modules\HRIS\Models\Tools;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Modules\HRIS\Models\Database\Employee;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\HRIS\Database\Factories\Tools\ExceptionalHolidayFactory;

class ExceptionalHoliday extends Model
{
    use HasFactory;
    protected $table = 'hris_tools_exceptional_holidays';

    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = ['id'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public static function booted()
    {
        static::creating(function ($exceptional_holiday) {
            $exceptional_holiday->created_by = Auth::id();
            $exceptional_holiday->updated_by = Auth::id();
        });

        static::updating(function ($exceptional_holiday) {
            $exceptional_holiday->updated_by = Auth::id();
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
        return $query->where('is_active', 1);
    }

    public function employeeBasic(): BelongsTo
    {
        return $this->belongsTo(Employee::class,'employee_id','employee_id')->select('employee_id','name','joining_date');
    }
}
