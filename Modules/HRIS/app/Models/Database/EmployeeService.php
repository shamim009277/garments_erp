<?php

namespace Modules\HRIS\Models\Database;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmployeeService extends Model
{
    use HasFactory;

    protected $table = 'hris_database_employee_services';
    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = [];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function scopeActive($query) {
        return $query->where('is_active', true);
    }

    public function scopeInactive($query) {
        return $query->where('is_active', false);
    }

    public static function booted()
    {
        static::creating(function ($employeeService) {
            $employeeService->created_by = Auth::id();
            $employeeService->updated_by = Auth::id();
        });

        static::updating(function ($employeeService) {
            $employeeService->updated_by = Auth::id();
        });
    }

}
