<?php

namespace Modules\HRIS\Models\Database;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\HRIS\Database\Factories\Database\EmployeeDocumentFactory;

class EmployeeDocument extends Model
{
    use HasFactory;

    protected $table = 'hris_database_employee_documents';
    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = ['id'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
    public function document()
    {
        return $this->belongsTo(EmployeeDocument::class);
    }
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public static function booted()
    {
        static::creating(function ($employeeDocument) {
            $employeeDocument->created_by = Auth::id();
            $employeeDocument->updated_by = Auth::id();
        });

        static::updating(function ($employeeDocument) {
            $employeeDocument->updated_by = Auth::id();
        });
    }

    // protected static function newFactory(): Database\EmployeeDocumentFactory
    // {
    //     // return Database\EmployeeDocumentFactory::new();
    // }
}
