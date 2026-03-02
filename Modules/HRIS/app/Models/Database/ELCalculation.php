<?php

namespace Modules\HRIS\Models\Database;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Modules\HRIS\Models\Database\Employee;
use Modules\HRIS\Models\Setup\Organization;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\HRIS\Database\Factories\Database\ELCalculationFactory;

class ELCalculation extends Model
{
    use HasFactory;

    protected $table = 'hris_database_elcalculation';

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
        'category',
        'month',
        'year',
        'joining_date',
        'base_date',
        'present_days',
        'earned_days',
        'previous_days',
        'confirm',
        'is_active',
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class,'org_id','id');
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class,'employee_id','employee_id');
    }

    public static function booted()
    {
        static::creating(function ($elcalculation) {
            $elcalculation->created_by = Auth::id();
            $elcalculation->updated_by = Auth::id();
            $elcalculation->line = $elcalculation->line ?? 0;
            $elcalculation->grade = $elcalculation->grade ?? 0;
        });

        static::updating(function ($elcalculation) {
            $elcalculation->updated_by = Auth::id();
            $elcalculation->line = $elcalculation->line ?? 0;
            $elcalculation->grade = $elcalculation->grade ?? 0;
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
}
