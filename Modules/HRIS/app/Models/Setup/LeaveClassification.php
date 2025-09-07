<?php

namespace Modules\HRIS\Models\Setup;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
// use Modules\HRIS\Database\Factories\Setup\LeaveClassificationFactory;

class LeaveClassification extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'hris_setup_leaveclassifications';
    protected $fillable = [
        'code',
        'signification',
        'signification_bn',
        'yearly_limit',
        'max_permission',
        'pay_ratio',
        'is_active',
        'created_by',
        'updated_by',
    ];
    protected $casts = [
        'is_active' => 'boolean',
    ];

    public static function booted()
    {
        static::created(function ($leaveClassification) {
            $leaveClassification->created_by = Auth::user()->id;
        });

        static::updated(function ($leaveClassification) {
            $leaveClassification->updated_by = Auth::user()->id;
        });
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
