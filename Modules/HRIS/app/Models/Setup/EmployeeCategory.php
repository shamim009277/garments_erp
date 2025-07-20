<?php

namespace Modules\HRIS\Models\Setup;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
// use Modules\HRIS\Database\Factories\Setup\EmployeeCategoryFactory;

class EmployeeCategory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'hris_setup_employee_categories';
    protected $fillable = [
        'category',
        'category_bn',
        'category_code',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public static function booted()
    {
        static::created(function ($employeeCategory) {
            $employeeCategory->created_by = Auth::user()->id;
        });

        static::updated(function ($employeeCategory) {
            $employeeCategory->updated_by = Auth::user()->id;
        });
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // protected static function newFactory(): Setup\EmployeeCategoryFactory
    // {
    //     // return Setup\EmployeeCategoryFactory::new();
    // }
}
