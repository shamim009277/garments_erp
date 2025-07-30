<?php

namespace Modules\HRIS\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\HRIS\Database\Factories\SettingFactory;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'hris_settings';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'medical_allowance',
        'food_allowance',
        'conveyance',
        'house_rant_percent_basic',
        'is_active',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public static function booted()
    {
        static::creating(function ($setting) {
            $setting->created_by = Auth::id();
            $setting->updated_by = Auth::id();
        });

        static::updating(function ($setting) {
            $setting->updated_by = Auth::id();
        });
    }

    public function scopeActive($query) {
        return $query->where('is_active', true);
    }

    // protected static function newFactory(): SettingFactory
    // {
    //     // return SettingFactory::new();
    // }
}
