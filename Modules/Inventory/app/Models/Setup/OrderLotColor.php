<?php

namespace Modules\Inventory\Models\Setup;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Inventory\Database\Factories\Setup/OrderLotColorFactory;

class OrderLotColor extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'inventory_setup_order_lot_colors';
    protected $guarded = [];

    // protected static function newFactory(): Setup/OrderLotColorFactory
    // {
    //     // return Setup/OrderLotColorFactory::new();
    // }
    public function lot()
    {
        return $this->belongsTo(OrderLot::class);
    }
    public function sizes()
    {
        return $this->hasMany(OrderLotColorSize::class);
    }
}
