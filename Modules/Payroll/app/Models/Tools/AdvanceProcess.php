<?php

namespace Modules\Payroll\Models\Tools;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Modules\HRIS\Models\Setup\Department;
use Modules\HRIS\Models\Database\Employee;
use Modules\HRIS\Models\Setup\Designation;
use Modules\HRIS\Models\Setup\Organization;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Payroll\Database\Factories\Tools\AdvanceProcessFactory;

class AdvanceProcess extends Model
{
    use HasFactory;

    protected $table = 'payroll_tools_process_advance';
    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = ['id'];

    public static function booted()
    {
        static::creating(function ($advanceprocess) {
            $advanceprocess->created_by = Auth::id();
            $advanceprocess->updated_by = Auth::id();
        });

        static::updating(function ($advanceprocess) {
            $advanceprocess->updated_by = Auth::id();
        });
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
    public function organization() : BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }
    public function employee() : BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
    public function department() : BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
    public function designation() : BelongsTo
    {
        return $this->belongsTo(Designation::class);
    }
}
