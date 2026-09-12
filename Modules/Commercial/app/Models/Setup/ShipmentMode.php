<?php

namespace Modules\Commercial\Models\Setup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
// use Modules\Commercial\Database\Factories\Setup\ShipmentModeFactory;

class ShipmentMode extends Model
{
    use HasFactory;

    protected $table = 'commercial_setup_shipment_modes';
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['name', 'description', 'is_active', 'created_by', 'updated_by'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public static function booted()
    {
        static::creating(function ($shipmentMode) {
            $shipmentMode->created_by = Auth::id();
        });

        static::updating(function ($shipmentMode) {
            $shipmentMode->updated_by = Auth::id();
        });
    }

    public function scopeActive($query) {
        return $query->where('is_active', true);
    }
}
