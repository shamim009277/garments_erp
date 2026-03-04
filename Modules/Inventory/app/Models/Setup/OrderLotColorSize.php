<?php

namespace Modules\Inventory\Models\Setup;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Inventory\Database\Factories\Setup/OrderLotColorSizeFactory;

class OrderLotColorSize extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'inventory_setup_order_lot_color_sizes';
    protected $guarded = [];

    // protected static function newFactory(): Setup/OrderLotColorSizeFactory
    // {
    //     // return Setup/OrderLotColorSizeFactory::new();
    // }
    public function color()
    {
        return $this->belongsTo(OrderLotColor::class);
    }
}
