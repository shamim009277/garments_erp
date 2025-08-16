<?php

namespace Modules\HRIS\Models\Setup;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\HRIS\Database\Factories\Setup\EmpGatepassReasonFactory;

class EmpGatepassReason extends Model
{
    use HasFactory;

    protected $table = 'hris_setup_emp_gatepass_reason';
    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = ['id'];

    public function getReasonForTextAttribute(): string
    {
        return match ($this->reason_for) {
            1 => 'Gate Pass',
            2 => 'Late Entry',
            3 => 'Gate Pass & Late Entry',
            default => 'N/A',
        };
    }

    public static function booted()
    {
        static::creating(function ($reason) {
            $reason->created_by = Auth::id();
            $reason->updated_by = Auth::id();
        });

        static::updating(function ($reason) {
            $reason->updated_by = Auth::id();
        });
    }

    public function purpose()
    {
        return $this->belongsTo(EmpGatepassPurpose::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
