<?php

namespace Modules\Inventory\Models\Setup;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Inventory\Database\Factories\Setup/OrderLotFactory;
use Modules\Inventory\Models\Database\BasicOrder;

class OrderLot extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'inventory_setup_order_lots';
    protected $guarded = [];

    // protected static function newFactory(): Setup/OrderLotFactory
    // {
    //     // return Setup/OrderLotFactory::new();
    // }
    public function colors()
    {
        return $this->hasMany(OrderLotColor::class);
    }
    public function order()
    {
        return $this->belongsTo(BasicOrder::class);
    }
}
