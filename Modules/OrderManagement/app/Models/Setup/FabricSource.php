<?php

namespace Modules\OrderManagement\Models\Setup;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class FabricSource extends Model
{
    use HasFactory;

    protected $table = 'om_setup_fabric_sources';
    protected $fillable = [
        'fabric_source_code',
        'fabric_source_name',
        'fabric_source_description',
        'is_active',
        'created_by',
        'updated_by'
    ];

    protected static function booted()
    {
        static::creating(function ($fabricSource) {
            $fabricSource->created_by = Auth::id();
            $fabricSource->updated_by = Auth::id();
        });

        static::updating(function ($fabricSource) {
            $fabricSource->updated_by = Auth::id();
        });
    }
}
