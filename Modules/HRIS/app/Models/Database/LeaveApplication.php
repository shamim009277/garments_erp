<?php

namespace Modules\HRIS\Models\Database;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\HRIS\Database\Factories\Database\LeaveApplicationFactory;

class LeaveApplication extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    // protected static function newFactory(): Database\LeaveApplicationFactory
    // {
    //     // return Database\LeaveApplicationFactory::new();
    // }
}
