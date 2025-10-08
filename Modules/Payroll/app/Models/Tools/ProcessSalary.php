<?php

namespace Modules\Payroll\Models\Tools;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Payroll\Database\Factories\Tools/ProcessSalaryFactory;

class ProcessSalary extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    // protected static function newFactory(): Tools/ProcessSalaryFactory
    // {
    //     // return Tools/ProcessSalaryFactory::new();
    // }
}
