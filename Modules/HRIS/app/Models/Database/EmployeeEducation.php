<?php

namespace Modules\HRIS\Models\Database;

use Illuminate\Support\Facades\Auth;
use Modules\HRIS\Models\Setup\Degree;
use Illuminate\Database\Eloquent\Model;
use Modules\HRIS\Models\Setup\EducationBoard;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\HRIS\Database\Factories\Database\EmployeeEducationFactory;

class EmployeeEducation extends Model
{
    use HasFactory;

    protected $table = 'hris_database_employee_educations';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'employee_id',
        'degree_id',
        'passing_year',
        'institute',
        'institute_bangla',
        'board',
        'result_type',
        'obtain_degree',
        'obtain_cgpa',
        'obtain_grade',
        'is_active',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function degree()
    {
        return $this->belongsTo(Degree::class);
    }

    public function board()
    {
        return $this->belongsTo(EducationBoard::class,'board','id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public static function booted()
    {
        static::creating(function ($employeeEducation) {
            $employeeEducation->created_by = Auth::id();
            $employeeEducation->updated_by = Auth::id();
        });

        static::updating(function ($employeeEducation) {
            $employeeEducation->updated_by = Auth::id();
        });
    }

    // protected static function newFactory(): Database\EmployeeEducationFactory
    // {
    //     // return Database\EmployeeEducationFactory::new();
    // }
}
