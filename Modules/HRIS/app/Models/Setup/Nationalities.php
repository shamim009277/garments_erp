<?php

namespace Modules\HRIS\Models\Setup;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\HRIS\Database\Factories\Setup\NationalitiesFactory;

class Nationalities extends Model
{
    use HasFactory;

    protected $table = 'hris_setup_nationalities';
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'nationality',
        'nl_code',
        'nationality_bangla',
        'is_active',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public static function booted()
    {
        static::created(function ($nationality) {
            $nationality->created_by = Auth::user()->id;
        });

        static::updated(function ($nationality) {
            $nationality->updated_by = Auth::user()->id;
        });
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // protected static function newFactory(): Setup\NationalitiesFactory
    // {
    //     // return Setup\NationalitiesFactory::new();
    // }
}
