<?php

namespace Modules\HRIS\Models\Database;

use Illuminate\Support\Facades\Auth;
use Modules\HRIS\Models\Setup\Thana;
use Illuminate\Database\Eloquent\Model;
use Modules\HRIS\Models\Setup\District;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmployeePersonal extends Model
{
    use HasFactory;

    protected $table = 'hris_database_employee_personal';

    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = ['id'];

    public function employee() {
        return $this->belongsTo(Employee::class);
    }

    public function district() {
        return $this->belongsTo(District::class);
    }

    public function thana() {
        return $this->belongsTo(Thana::class);
    }

    public function scopeActive($query) {
        return $query->where('status', 1);
    }

    protected static function booted()
    {
        static::creating(function ($personal) {
            $personal->created_by = Auth::id();
            $personal->updated_by = Auth::id();
        });

        static::updating(function ($personal) {
            $personal->updated_by = Auth::id();
        });
    }
}
