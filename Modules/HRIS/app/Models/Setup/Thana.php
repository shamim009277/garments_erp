<?php

namespace Modules\HRIS\Models\Setup;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\HRIS\Database\Factories\Setup\ThanaFactory;

class Thana extends Model
{
    use HasFactory;

    protected $table = 'hris_setup_thanas';
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'district_id',
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
        static::created(function ($thana) {
            $thana->created_by = Auth::user()->id;
        });

        static::updated(function ($thana) {
            $thana->updated_by = Auth::user()->id;
        });
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function thanas()
    {
        return $this->hasMany(Thana::class);
    }
    // protected static function newFactory(): Setup\ThanaFactory
    // {
    //     // return Setup\ThanaFactory::new();
    // }
}
