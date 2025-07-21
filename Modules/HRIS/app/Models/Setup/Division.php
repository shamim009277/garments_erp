<?php

namespace Modules\HRIS\Models\Setup;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\HRIS\Database\Factories\Setup\DivisionFactory;

class Division extends Model
{
    use HasFactory;

    protected $table = 'hris_setup_divisions';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'bn_name',
        'is_active',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public static function booted()
    {
        static::creating(function ($division) {
            $division->created_by = Auth::id();
            $division->updated_by = Auth::id();
        });

        static::updating(function ($division) {
            $division->updated_by = Auth::id();
        });
    }

    public function districts()
    {
        return $this->hasMany(District::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
    // protected static function newFactory(): Setup\DivisionFactory
    // {
    //     // return Setup\DivisionFactory::new();
    // }
}
