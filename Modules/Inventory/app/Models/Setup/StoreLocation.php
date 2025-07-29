<?php

namespace Modules\Inventory\Models\Setup;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
// use Modules\Inventory\Database\Factories\Setup/StoreLocationFactory;

class StoreLocation extends Model
{
    use HasFactory;
    protected $table = 'inventory_setup_store_locations';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'store_code',
        'address_line_1',
        'address_line_2',
        'city',
        'state',
        'zip_code',
        'country',
        'store_size',
        'store_type_id',
        'organization_id',
        'owner_id',
        'owner_name',
        'latitude',
        'longitude',
        'contact_person',
        'phone',
        'email',
        'is_active',
        'created_by',
        'updated_by',
    ];

    protected static function booted()
    {
        static::created(function ($storeLocation) {
            $storeLocation->created_by = Auth::user()->id;
        });

        static::updated(function ($storeLocation) {
            $storeLocation->updated_by = Auth::user()->id;
        });
    }
    // protected static function newFactory(): Setup/StoreLocationFactory
    // {
    //     // return Setup/StoreLocationFactory::new();
    // }
}
