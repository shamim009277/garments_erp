<?php

namespace Modules\Inventory\Models\Setup;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
// use Modules\Inventory\Database\Factories\Setup/StoreLineFactory;

class StoreLine extends Model
{
    use HasFactory;
    // add table name
    protected $table = 'inventory_setup_store_line';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'line_code',
        'name',
        'description',
        'is_active',
        'created_by',
        'updated_by',
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

    // protected static function newFactory(): Setup/StoreLineFactory
    // {
    //     // return Setup/StoreLineFactory::new();
    // }
}
