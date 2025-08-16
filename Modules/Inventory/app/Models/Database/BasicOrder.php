<?php

namespace Modules\Inventory\Models\Database;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Inventory\Database\Factories\Database/BasicOrderFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\Inventory\Models\Setup\Buyer;
use Modules\Inventory\Models\Setup\Organization;
use Modules\Inventory\Models\Setup\ProductCategory;
use Modules\Inventory\Models\Setup\Merchandiser;
use Modules\Inventory\Models\Setup\FabricType;
use Modules\Inventory\Models\Setup\Composition;
use Modules\Inventory\Models\Setup\FabricTreatments;
use Modules\Inventory\Models\Setup\YarnCount;
use Modules\Inventory\Models\Setup\YarnCategory;
use Modules\Inventory\Models\Setup\OrderLot;
use Modules\Inventory\Models\Setup\OrderLotColor;
use Modules\Inventory\Models\Setup\OrderLotColorSize;

class BasicOrder extends Model
{
    use HasFactory;

    
    protected $table = 'inventory_databases_orders';

    protected $fillable = [
        'order_type',
        'compile_type',
        'organization_id',
        'buyer_id',
        'style_no',
        'style_description',
        'order_no',
        'season',
        'fitting_type',
        'product_category_id',
        'merchandiser_id',
        'fabric_type_id',
        'composition_id',
        'fabric_treatment_id',
        'yarn_count_id',
        'yarn_category_id',
    ];

    //booted
    protected static function booted()
    {
        static::created(function ($basic_order) {
            $basic_order->created_by = Auth::user()->id;
        });

        static::updated(function ($basic_order) {
            $basic_order->updated_by = Auth::user()->id;
        });
    }

    // protected static function newFactory(): Setup/BasicOrderFactory
    // {
    //     // return Setup/BasicOrderFactory::new();
    // }

    // Order.php
    public function lots()
    {
        return $this->hasMany(OrderLot::class);
    }
    public function order()
    {
        return $this->belongsTo(BasicOrder::class);
    }
    public function colors()
    {
        return $this->hasMany(OrderLotColor::class);
    }

    // OrderLotColor.php
    public function lot()
    {
        return $this->belongsTo(OrderLot::class);
    }
    public function sizes()
    {
        return $this->hasMany(OrderLotColorSize::class);
    }

    // OrderLotColorSize.php
    public function color()
    {
        return $this->belongsTo(OrderLotColor::class);
    }
    //buyer
    public function buyer()
    {
        return $this->belongsTo(Buyer::class);
    }
}
