<?php

namespace Modules\HRIS\Models\Setup;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Modules\HRIS\Models\Setup\EmpGatepassReason;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmpGatepassPurpose extends Model
{
    use HasFactory;

    protected $table = 'hris_setup_emp_gatepass_purpose';
    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = ['id'];


    public function reasons()
    {
        return $this->hasMany(EmpGatepassReason::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public static function booted()
    {
        static::creating(function ($purpose) {
            $purpose->created_by = Auth::id();
            $purpose->updated_by = Auth::id();
        });

        static::updating(function ($purpose) {
            $purpose->updated_by = Auth::id();
        });
    }
}
