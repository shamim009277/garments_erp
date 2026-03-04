<?php

namespace Modules\OrderManagement\Models\Setup;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class WashType extends Model
{
    use HasFactory;

    protected $table = 'om_setup_wash_types';
    protected $fillable = [
        'wash_type_code',
        'wash_type_name',
        'wash_type_description',
        'is_active',
        'created_by',
        'updated_by',
    ];

    protected static function booted()
    {
        static::creating(function ($washType) {
            $washType->created_by = Auth::id();
            $washType->updated_by = Auth::id();
        });

        static::updating(function ($washType) {
            $washType->updated_by = Auth::id();
        });
    }
}
