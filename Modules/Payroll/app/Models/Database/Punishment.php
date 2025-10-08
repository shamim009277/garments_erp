<?php

namespace Modules\Payroll\Models\Database;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Modules\HRIS\Models\Database\Employee;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Punishment extends Model
{
    use HasFactory;

    protected $table = 'payroll_database_punishment';
    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = ['id'];

    public static function booted()
    {
        static::creating(function ($punishment) {
            $punishment->created_by = Auth::id();
            $punishment->updated_by = Auth::id();
        });

        static::updating(function ($punishment) {
            $punishment->updated_by = Auth::id();
        });
    }
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id','employee_id');
    }
}
