<?php

namespace Modules\HRIS\Models\Database;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\HRIS\Database\Factories\Database\EmployeeIncrementFactory;

class EmployeeIncrement extends Model
{
    use HasFactory;

    protected $table = 'hris_database_employee_increments';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'employee_id',
        'org_id',
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
        'amount',
        'increment_date',
        'effective_date',
        'arrear_upto_date',
        'increment_type_id',
        'increment_source',
        'increment_value',
        'house_rent_basic',
        'enforce',
        'remarks',
        'is_active',
        'created_by',
        'updated_by',
    ];

    protected static function booted()
    {
        static::creating(function ($increment) {
            $increment->created_by = Auth::id();
            $increment->updated_by = Auth::id();
        });

        static::updating(function ($increment) {
            $increment->updated_by = Auth::id();
        });
    }

    // protected static function newFactory(): Database\EmployeeIncrementFactory
    // {
    //     // return Database\EmployeeIncrementFactory::new();
    // }
}
