<?php

namespace Modules\HRIS\Models\Database;

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

    // protected static function newFactory(): Database\EmployeeFactory
    // {
    //     // return Database\EmployeeFactory::new();
    // }
}
