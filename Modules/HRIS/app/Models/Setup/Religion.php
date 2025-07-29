<?php

namespace Modules\HRIS\Models\Setup;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\HRIS\Database\Factories\Setup\ReligionFactory;

class Religion extends Model
{
    use HasFactory;

    protected $table = 'hris_setup_religions';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'religion',
        'religion_code',
        'religion_bangla',
        'is_active',
        'created_by',
        'updated_by',
    ];


    protected $casts = [
        'is_active' => 'boolean',
    ];

    public static function booted()
    {
        static::created(function ($religion) {
            $religion->created_by = Auth::user()->id;
        });

        static::updated(function ($religion) {
            $religion->updated_by = Auth::user()->id;
        });
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // protected static function newFactory(): Setup\ReligionFactory
    // {
    //     // return Setup\ReligionFactory::new();
    // }
}
