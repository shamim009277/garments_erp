<?php

namespace Modules\Inventory\Models\Setup;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Modules\Inventory\Models\Setup\GoodsCategory;
use Modules\Inventory\Models\Setup\GoodsSubcategory;
use App\Models\Master\Setup\Unit;
// use Modules\Inventory\Database\Factories\Setup/ItemFactory;

class Item extends Model
{
    use HasFactory;
    //         $table->id();
    //         //relationship
    //         $table->unsignedBigInteger('goods_category_id');
    //         $table->unsignedBigInteger('goods_subcategory_id');
    //         $table->unsignedBigInteger('unit_id');
    //         //items info 
    //         $table->string('item_code', 20)->unique(); // Like IT001
    //         $table->string('item_name', 100);
    //         $table->string('item_description')->nullable();
    //         $table->string('item_barcode')->nullable();
    //         $table->string('item_image')->nullable();
    //         $table->boolean('is_active')->default(true);
    //         //varient 
    //         $table->json('varient')->nullable();
    //         $table->string('model')->nullable();
    //         $table->string('type')->nullable();
    //         $table->string('remarks')->nullable();
    //         //present stock
    //         $table->integer('present_stock')->default(0);
    //         $table->integer('minimum_stock')->default(0);
    //         $table->integer('maximum_stock')->default(0);
    //         $table->integer('reorder_level')->default(0);
    //         $table->integer('reorder_quantity')->default(0);
    //         $table->integer('reorder_quantity')->default(0);
    //         //foreign key
    //         $table->foreign('goods_category_id')
    //             ->references('id')
    //             ->on('inventory_setup_goods_setup_category')
    //             ->onDelete('restrict');
    //         $table->foreign('goods_subcategory_id')
    //             ->references('id')
    //             ->on('inventory_setup_goods_setup_subcategory')
    //             ->onDelete('restrict');
    //         $table->foreign('unit_id')
    //             ->references('id')
    //             ->on('master_setup_units')
    //             ->onDelete('restrict');
    //         $table->timestamps();
    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'inventory_setup_items';
    protected $fillable = [
        'goods_category_id',
        'goods_subcategory_id',
        'unit_id',
        'item_code',
        'item_name',
        'item_description',
        'item_barcode',
        'item_image',
        'is_active',
        'varient',
        'model',
        'type',
        'remarks',
    ];
    //booted
    protected static function booted()
    {
        static::created(function ($item) {
            $item->created_by = Auth::user()->id;
        });

        static::updated(function ($item) {
            $item->updated_by = Auth::user()->id;
        });
    }
    //relationship
    public function goodsCategory()
    {
        return $this->belongsTo(GoodsCategory::class, 'goods_category_id');
    }

    public function goodsSubcategory()
    {
        return $this->belongsTo(GoodsSubcategory::class, 'goods_subcategory_id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    // protected static function newFactory(): Setup/ItemFactory
    // {
    //     // return Setup/ItemFactory::new();
    // }
}
