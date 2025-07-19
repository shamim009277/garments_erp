<?php

namespace Modules\HRIS\Models\Setup;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
// use Modules\HRIS\Database\Factories\Setup\ParentDesignationFactory;

class ParentDesignation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'hris_setup_parentdesignation';
    protected $fillable = [
        'parent_designation',
        'parent_designation_bn',
        'approved_mp',
        'is_active',
        'created_by',
        'updated_by',
    ];
    protected $casts = [
        'is_active' => 'boolean',
    ];
    
    public static function booted()
    {
        static::created(function ($parentDesignation) {
            $parentDesignation->created_by = Auth::user()->id;
        });

        static::updated(function ($parentDesignation) {
            $parentDesignation->updated_by = Auth::user()->id;
        });
    }

    // protected static function newFactory(): Setup\ParentDesignationFactory
    // {
    //     // return Setup\ParentDesignationFactory::new();
    // }
}
