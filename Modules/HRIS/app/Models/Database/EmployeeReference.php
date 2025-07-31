<?php

namespace Modules\HRIS\Models\Database;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmployeeReference extends Model
{
    use HasFactory;

    protected $table = 'hris_database_employee_reference';
    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = ['id'];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function reference()
    {
        return $this->belongsTo(Employee::class, 'reference_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public static function booted()
    {
        static::creating(function ($reference) {
            $reference->created_by = Auth::id();
            $reference->updated_by = Auth::id();
        });

        static::updating(function ($reference) {
            $reference->updated_by = Auth::id();
        });
    }
}
