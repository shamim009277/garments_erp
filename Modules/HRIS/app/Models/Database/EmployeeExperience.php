<?php

namespace Modules\HRIS\Models\Database;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\HRIS\Models\Database\Employee;
// use Modules\HRIS\Database\Factories\Database\EmployeeExperienceFactory;

class EmployeeExperience extends Model
{
    use HasFactory;

    protected $table = 'hris_database_employee_experiences';
    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = ['id'];
    protected static function booted()
    {
        static::creating(function ($experience) {
            $experience->created_by = Auth::id();
            $experience->updated_by = Auth::id();
        });

        static::updating(function ($experience) {
            $experience->updated_by = Auth::id();
        });
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    // protected static function newFactory(): Database\EmployeeExperienceFactory
    // {
    //     // return Database\EmployeeExperienceFactory::new();
    // }
}
