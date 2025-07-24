<?php

namespace Modules\HRIS\Models\Setup;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\HRIS\Database\Factories\Setup\DegreeFactory;

class Degree extends Model
{
    use HasFactory;

    protected $table = 'hris_setup_degrees';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'degree',
        'degree_bangla',
        'is_active',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public static function booted()
    {
        static::creating(function ($degree) {
            $degree->created_by = Auth::id();
            $degree->updated_by = Auth::id();
        });

        static::updating(function ($degree) {
            $degree->updated_by = Auth::id();
        });
    }

    public function scopeActive($query) {
        return $query->where('is_active', true);
    }

    // protected static function newFactory(): Setup\DegreeFactory
    // {
    //     // return Setup\DegreeFactory::new();
    // }
}
