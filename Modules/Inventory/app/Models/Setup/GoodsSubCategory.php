<?php

namespace Modules\Inventory\Models\Setup;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
// use Modules\Inventory\Database\Factories\Setup/GoodsSubCategoryFactory;
use Modules\HRIS\Models\Setup\Organization;
use Modules\Inventory\Models\Setup\GoodsCategory;

class GoodsSubCategory extends Model
{
    // $table->id();
    // $table->unsignedBigInteger('goods_category_id');
    // $table->unsignedBigInteger('organization_id');
    // $table->string('name');
    // $table->string('bn_name')->nullable();
    // $table->boolean('is_active')->default(true);

    // $table->unsignedBigInteger('created_by')->nullable();
    // $table->unsignedBigInteger('updated_by')->nullable();
    // //foreign key
    // $table->foreign('goods_category_id')->references('id')->on('inventory_setup_goods_categories')->onDelete('cascade');
    // $table->foreign('organization_id')->references('id')->on('hris_setup_organizations')->onDelete('cascade');
    // $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
    // $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
    use HasFactory;
    protected $table = 'inventory_setup_goods_subcategories';
    /**
     * The attributes that are mass assignable.
     */
 protected $guarded = [];
    //relationships
    public function goodsCategory()
    {
        return $this->belongsTo(GoodsCategory::class, 'goods_category_id');
    }
    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }

    //booted
    public static function booted()
    {
        static::created(function ($goodsSubCategory) {
            $goodsSubCategory->created_by = Auth::user()->id;
        });

        static::updated(function ($goodsSubCategory) {
            $goodsSubCategory->updated_by = Auth::user()->id;
        });
    }

    // protected static function newFactory(): Setup/GoodsSubCategoryFactory
    // {
    //     // return Setup/GoodsSubCategoryFactory::new();
    // }
}
