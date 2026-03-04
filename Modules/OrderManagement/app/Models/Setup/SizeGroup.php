<?php

namespace Modules\OrderManagement\Models\Setup;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
// use Modules\Inventory\Database\Factories\Setup/SizeGroupFactory;

class SizeGroup extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'inventory_setup_size_group';
    protected $fillable = [
        'size_group_code',
        'size_group_name',
        'is_active',
        'created_by',
        'updated_by',
    ];

    // protected static function newFactory(): Setup/SizeGroupFactory
    // {
    //     // return Setup/SizeGroupFactory::new();
    // }
    
    protected static function booted()
    {
        static::created(function ($sizeGroup) {
            $sizeGroup->created_by = Auth::user()->id;
        });

        static::updated(function ($sizeGroup) {
            $sizeGroup->updated_by = Auth::user()->id;
        });
    }
}
