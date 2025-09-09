<?php

namespace Modules\HRIS\Models\Setup;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
// use Modules\HRIS\Database\Factories\Setup\DepartureReasonFactory;

class DepartureReason extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'hris_setup_departurereasons';
    protected $fillable = ['reason', 'reason_short_name', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public static function booted()
    {
        static::creating(function ($departureReason) {
            $departureReason->created_by = Auth::id();
            $departureReason->updated_by = Auth::id();
        });

        static::updating(function ($departureReason) {
            $departureReason->updated_by = Auth::id();
        });
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

}
