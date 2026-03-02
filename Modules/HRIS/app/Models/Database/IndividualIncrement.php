<?php

namespace Modules\HRIS\Models\Database;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
// use Modules\HRIS\Database\Factories\Database\IndividualIncrementFactory;

class IndividualIncrement extends Model
{
    use HasFactory;

    protected $table = 'hris_database_employee_increments';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'org_id',
        'employee_id',
        'department_id',
        'designation_id',
        'line',
        'unit',
        'new_department_id',
        'new_designation_id',
        'gross_salary',
        'basic',
        'medical_allowance',
        'home_allowance',
        'food_allowance',
        'conveyance',
        'increment_date',
        'effective_date',
        'arrear_upto_date',
        'increment_type_id',
        'increment_source',
        'increment_value_type',
        'increment_value',
        'amount',
        'house_rent_basic',
        'enforce',
        'discard',
        'remarks',
        'is_active',
        'created_by',
        'updated_by',
    ];

    public static function booted()
    {
        static::creating(function ($employee) {
            $employee->created_by = Auth::id();
            $employee->updated_by = Auth::id();
        });

        static::updating(function ($employee) {
            $employee->updated_by = Auth::id();
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

    public function scopeActive($query) {
        return $query->where('is_active', true);
    }
}
