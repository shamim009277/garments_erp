<?php

namespace Modules\HRIS\Models\Database;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Modules\HRIS\Models\Database\Employee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\HRIS\Database\Factories\Database\EmployeeTrainingFactory;

class EmployeeTraining extends Model
{
    use HasFactory;
    protected $table = 'hris_database_employee_training';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'employee_id',
        'training_name',
        'organization',
        'duration',
        'description',
        'is_active',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeInactive($query)
    {
        return $query->where('is_active', false);
    }

    public static function booted()
    {
        static::creating(function ($training) {
            $training->created_by = Auth::id();
            $training->updated_by = Auth::id();
        });

        static::updating(function ($training) {
            $training->updated_by = Auth::id();
        });
    }

    // protected static function newFactory(): Database\EmployeeTrainingFactory
    // {
    //     // return Database\EmployeeTrainingFactory::new();
    // }
}
