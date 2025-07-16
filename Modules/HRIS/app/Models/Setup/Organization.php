<?php

namespace Modules\HRIS\Models\Setup;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
// use Modules\HRIS\Database\Factories\Setup\OrganizationFactory;

class Organization extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'hris_setup_organizations';
    protected $fillable = [
        'name',
        'bn_name',
        'short_name',
        'is_active',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public static function booted()
    {
        static::created(function ($organization) {
            $organization->created_by = Auth::user()->id;
        });

        static::updated(function ($organization) {
            $organization->updated_by = Auth::user()->id;
        });
    }

    // protected static function newFactory(): Setup\OrganizationFactory
    // {
    //     // return Setup\OrganizationFactory::new();
    // }
}
