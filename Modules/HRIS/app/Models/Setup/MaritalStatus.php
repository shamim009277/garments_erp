<?php

namespace Modules\HRIS\Models\Setup;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\HRIS\Database\Factories\Setup\MaritalStatusFactory;

class MaritalStatus extends Model
{
    use HasFactory;

    protected $table = 'hris_setup_maritalstatus';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'maritalstatus',
        'ms_code',
        'maritalstatus_bangla',
        'is_active',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public static function booted()
    {
        static::created(function ($maritalStatus) {
            $maritalStatus->created_by = Auth::user()->id;
        });

        static::updated(function ($maritalStatus) {
            $maritalStatus->updated_by = Auth::user()->id;
        });
    }
    // protected static function newFactory(): Setup\MaritalStatusFactory
    // {
    //     // return Setup\MaritalStatusFactory::new();
    // }
}
