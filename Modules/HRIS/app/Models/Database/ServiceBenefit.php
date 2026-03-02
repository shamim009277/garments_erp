<?php

namespace Modules\HRIS\Models\Database;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Modules\HRIS\Models\Setup\Department;
use Modules\HRIS\Models\Database\Employee;
use Modules\HRIS\Models\Setup\Designation;
use Modules\HRIS\Models\Setup\Organization;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

// use Modules\HRIS\Database\Factories\Database\ServiceBenefitFactory;

class ServiceBenefit extends Model
{
    use HasFactory;

    protected $table = "hris_database_service_benefits";
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'org_id',	'year',	'month',	'employee_id',	'department_id',	'designation_id',	'line',	'unit',	'leaving_date',	'joining_date',	'paydays',	'basic',	'rate',	'for_pay',	'status',	'confirm',	'category',	'reason',	'created_by',	'updated_by'
    ];

    protected $casts = [
        'line' => 'integer',
        'unit' => 'integer',
        'joining_date' => 'date',
        'leaving_date' => 'date',
    ];

    public static function booted()
    {
        static::creating(function ($serviceBenefit) {
            $serviceBenefit->created_by = Auth::id();
            $serviceBenefit->updated_by = Auth::id();
            $serviceBenefit->line = $serviceBenefit->line ?? 0;
            $serviceBenefit->unit = $serviceBenefit->unit ?? 0;
        });

        static::updating(function ($serviceBenefit) {
            $serviceBenefit->updated_by = Auth::id();
            $serviceBenefit->line = $serviceBenefit->line ?? 0;
            $serviceBenefit->unit = $serviceBenefit->unit ?? 0;
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

    public function employee():BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id','employee_id');
    }

    public function organization():BelongsTo
    {
        return $this->belongsTo(Organization::class, 'org_id','id');
    }

    public function department():BelongsTo
    {
        return $this->belongsTo(Department::class, 'department_id','id');
    }

    public function designation():BelongsTo
    {
        return $this->belongsTo(Designation::class, 'designation_id','id');
    }
}
