<?php

namespace Modules\Inventory\Models\Setup;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
// use Modules\Inventory\Database\Factories\Setup/ProductCategoryFactory;

class ProductCategory extends Model
{
    use HasFactory;

    // $table->id();
    // $table->string('product_category_code', 20)->unique(); // Like PC001
    // $table->string('product_category_name', 100);
    // $table->string('product_category_description')->nullable();
    // $table->boolean('is_active')->default(true);
    
    // $table->timestamps();
    protected $table = 'inventory_setup_product_categories';
    protected $fillable = [
        'product_category_code',
        'product_category_name',
        'product_category_description',
        'is_active',
    ];

    // protected static function newFactory(): Setup/ProductCategoryFactory
    // {
    //     // return Setup/ProductCategoryFactory::new();
    // }
    //booted
    protected static function booted()
    {
        static::created(function ($productCategory) {
            $productCategory->created_by = Auth::user()->id;
        });

        static::updated(function ($productCategory) {
            $productCategory->updated_by = Auth::user()->id;
        });
    }
}
