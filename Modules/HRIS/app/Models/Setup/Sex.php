<?php

namespace Modules\HRIS\Models\Setup;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\HRIS\Database\Factories\Setup\SexFactory;

class Sex extends Model
{
    use HasFactory;

    protected $table = 'hris_setup_sex';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'sex',
        'sx_code',
        'sex_bangla',
        'is_active',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected static function booted()
    {
        static::created(function ($sex) {
            $sex->created_by = Auth::user()->id;
        });

        static::updated(function ($sex) {
            $sex->updated_by = Auth::user()->id;
        });
    }

    // protected static function newFactory(): Setup\SexFactory
    // {
    //     // return Setup\SexFactory::new();
    // }
}
