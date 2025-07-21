<?php

namespace Modules\HRIS\Models\Database;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\HRIS\Database\Factories\Database\EmployeeFactory;

class Employee extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];


    public static function booted()
    {
        static::creating(function ($employee) {
            $employee->created_by = Auth::id();
            $employee->updated_by = Auth::id();
        });

        static::updating(function ($employee) {
            $employee->updated_by = Auth::id();
        });
    }

    // protected static function newFactory(): Database\EmployeeFactory
    // {
    //     // return Database\EmployeeFactory::new();
    // }
}
