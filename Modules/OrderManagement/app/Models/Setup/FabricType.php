<?php

namespace Modules\OrderManagement\Models\Setup;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
// use Modules\Inventory\Database\Factories\Setup/FabricTypeFactory;

class FabricType extends Model
{
    use HasFactory;

    // $table->string('fabric_type_code', 20)->unique(); // Like FT001
    // $table->string('fabric_type_name', 100);
    // $table->string('fabric_type_description')->nullable();
    // $table->boolean('is_active')->default(true);
    protected $table = 'inventory_setup_fabric_types';
    protected $fillable = [
        'fabric_type_code',
        'fabric_type_name',
        'fabric_type_description',
        'is_active',
    ];

    // protected static function newFactory(): Setup/FabricTypeFactory
    // {
    //     // return Setup/FabricTypeFactory::new();
    // }
    //booted
    protected static function booted()
    {
        static::created(function ($fabricType) {
            $fabricType->created_by = Auth::user()->id;
        });

        static::updated(function ($fabricType) {
            $fabricType->updated_by = Auth::user()->id;
        });
    }

    //relationship
}