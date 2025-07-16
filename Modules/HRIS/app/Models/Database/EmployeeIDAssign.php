<?php

namespace Modules\HRIS\Models\Database;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\HRIS\Database\Factories\Database\EmployeeIDAssignFactory;

class EmployeeIDAssign extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    // protected static function newFactory(): Database\EmployeeIDAssignFactory
    // {
    //     // return Database\EmployeeIDAssignFactory::new();
    // }
}
