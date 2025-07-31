<?php

namespace Modules\Inventory\Models\Setup;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class StoreType extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     */
    protected $table = 'inventory_setup_storetype';
    protected $guarded = [];
     protected static function booted()
    {
        static::created(function ($sex) {
            $sex->created_by = Auth::user()->id;
        });

        static::updated(function ($sex) {
            $sex->updated_by = Auth::user()->id;
        });
    }

    // protected static function newFactory(): Setup/StoreTypeFactory
    // {
    //     // return Setup/StoreTypeFactory::new();
    // }
}
