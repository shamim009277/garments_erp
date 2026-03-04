<?php

namespace Modules\OrderManagement\Models\Database;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

use Modules\OrderManagement\Models\Setup\Accessories;

class OrderPricingAccessory extends Model
{
    use HasFactory;

    protected $table = 'om_database_order_pricing_accessories';
    protected $guarded = [];

    // Relationships
    public function orderPricing()
    {
        return $this->belongsTo(OrderPricing::class, 'order_pricing_id');
    }

    public function accessory()
    {
        return $this->belongsTo(Accessories::class, 'accessory_id');
    }

    // Booted
    protected static function booted()
    {
        static::created(function ($model) {
            $model->created_by = Auth::id();
        });

        static::updated(function ($model) {
            $model->updated_by = Auth::id();
        });
    }
}
