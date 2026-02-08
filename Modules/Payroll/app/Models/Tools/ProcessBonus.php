<?php

namespace Modules\Payroll\Models\Tools;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Modules\HRIS\Models\Database\Employee;
use Modules\HRIS\Models\Setup\Organization;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProcessBonus extends Model
{
    use HasFactory;

    protected $table = 'payroll_tools_process_bonus';
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'org_id',
        'employee_id',
        'bonus_type',
        'base_date',
        'year',
        'month',
        'department_id',
        'designation_id',
        'line',
        'unit',
        'category',
        'leaving_date',
        'joining_date',
        'gross_salary',
        'percentage',
        'basic',
        'amount',
        'confirm',
        'created_by',
        'updated_by',
    ];

    protected $date = ['base_date', 'leaving_date', 'joining_date'];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id','employee_id');
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'org_id','id');
    }

    public static function booted()
    {
        static::creating(function ($processbonus) {
            $processbonus->created_by = Auth::id();
            $processbonus->updated_by = Auth::id();
        });

        static::updating(function ($processbonus) {
            $processbonus->updated_by = Auth::id();
        });
    }
}
