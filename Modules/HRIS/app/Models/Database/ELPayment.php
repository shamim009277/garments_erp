<?php

namespace Modules\HRIS\Models\Database;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Modules\HRIS\Models\Setup\Department;
use Modules\HRIS\Models\Setup\Designation;
use Modules\HRIS\Models\Setup\Organization;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\HRIS\Database\Factories\Database\ELPaymentFactory;

class ELPayment extends Model
{
    use HasFactory;

    protected $table = 'hris_database_elpayment';

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
        'reason',
        'joining_date',
        'base_date',
        'leaving_date',
        'pay_days',
        'gross_salary',
        'basic',
        'rate',
        'amount',
        'confirm',
        'is_active',
        'created_by',
        'updated_by',
    ];

    public function organization():BelongsTo
    {
        return $this->belongsTo(Organization::class, 'org_id', 'id');
    }

    public function employee():BelongsTo
    {
         return $this->belongsTo(Employee::class, 'employee_id', 'employee_id');
    }

    public function department():BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function designation():BelongsTo
    {
        return $this->belongsTo(Designation::class);
    }

    public static function booted()
    {
        static::creating(function ($elpayment) {
            $elpayment->created_by = Auth::id();
            $elpayment->updated_by = Auth::id();
            $elpayment->line = $elpayment->line ?? 0;
            $elpayment->grade = $elpayment->grade ?? 0;
        });

        static::updating(function ($elpayment) {
            $elpayment->updated_by = Auth::id();
            $elpayment->line = $elpayment->line ?? 0;
            $elpayment->grade = $elpayment->grade ?? 0;
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
