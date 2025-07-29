<?php

namespace Modules\Inventory\Models\Setup;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
// use Modules\Inventory\Database\Factories\Setup/GoodsCategoryFactory;

class GoodsCategory extends Model
{
    //         $table->id();
    //         $table->string('category_code', 20)->unique();  // e.g., RM01, FG02
    //         $table->string('name', 100);                   // e.g., Raw Material, Finished Goods
    //         $table->text('description')->nullable();       // Optional details
    //         $table->unsignedBigInteger('parent_id')->nullable(); // For hierarchical categories
    //         $table->boolean('is_active')->default(true);
    //         $table->timestamps();
    //         // Optional: Add foreign key if hierarchical
    //         $table->foreign('parent_id')->references('id')->on('inventory_setup_goods_categories')->onDelete('set null');
    use HasFactory;
    protected $table = 'inventory_setup_goods_categories';
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'category_code',
        'name',
        'description',
        'parent_id',
        'is_active',
        'created_by',
        'updated_by',
    ];
    // protected $casts = [
    //     'is_active' => 'boolean',
    //     'created_by' => 'unsignedBigInteger',
    //     'updated_by' => 'unsignedBigInteger',
    // ];  

    public function parent()
    {
        return $this->belongsTo(GoodsCategory::class, 'parent_id');
    }
    
    public function children()
    {
        return $this->hasMany(GoodsCategory::class, 'parent_id');
    }
    
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
    
    public function scopeInactive($query)
    {
        return $query->where('is_active', false);
    }
    
    public static function booted()
    {
        static::created(function ($goodsCategory) {
            $goodsCategory->created_by = Auth::user()->id;
        });

        static::updated(function ($goodsCategory) {
            $goodsCategory->updated_by = Auth::user()->id;
        });
    }
    
    // protected static function newFactory(): Setup/GoodsCategoryFactory
    // {
    //     // return Setup/GoodsCategoryFactory::new();
    // }
}
