<?php

namespace Modules\Inventory\Models\Setup;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
// use Modules\Inventory\Database\Factories\Setup/SupplierTypeFactory;

class SupplierType extends Model
{
    use HasFactory;
    // $table->bigIncrements('id');
    // $table->string('type_code', 50)->unique();
    // $table->string('name', 100);
    // $table->text('description')->nullable();
    // $table->boolean('is_active')->default(true);
    // $table->unsignedBigInteger('created_by')->nullable();
    // $table->unsignedBigInteger('updated_by')->nullable();
    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'inventory_setup_supplier_types';
    protected $fillable = [
        'type_code',
        'name',
        'description',
        'is_active',
        'created_by',
        'updated_by',
    ];

    protected static function booted()
    {
        static::created(function ($supplierType) {
            $supplierType->created_by = Auth::user()->id;
        });

        static::updated(function ($supplierType) {
            $supplierType->updated_by = Auth::user()->id;
        });
    }

    // protected static function newFactory(): Setup/SupplierTypeFactory
    // {
    //     // return Setup/SupplierTypeFactory::new();
    // }
}
