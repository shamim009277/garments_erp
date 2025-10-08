<?php

namespace Modules\Payroll\Models\Database;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Modules\HRIS\Models\Setup\Department;
use Modules\HRIS\Models\Database\Employee;
use Modules\HRIS\Models\Setup\Designation;
use Modules\HRIS\Models\Setup\Organization;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Advance extends Model
{
    use HasFactory;

    protected $table = 'payroll_database_advance';
    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = ['id'];

    public static function booted()
    {
        static::creating(function ($advance) {
            $advance->created_by = Auth::id();
            $advance->updated_by = Auth::id();

            $nextId = (self::max('id') ?? 0) + 1;
            $year = date('Y');
            $advance->advance_id = 'AD' . $year . str_pad($nextId, 4, '0', STR_PAD_LEFT);
        });

        static::updating(function ($advance) {
            $advance->updated_by = Auth::id();
        });
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function employee() : BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'employee_id');
    }

    public function organization() : BelongsTo
    {
        return $this->belongsTo(Organization::class);
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
