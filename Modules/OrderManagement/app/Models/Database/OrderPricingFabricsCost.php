<?php

namespace Modules\OrderManagement\Models\Database;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Modules\OrderManagement\Models\Setup\CostingHead;

class OrderPricingFabricsCost extends Model
{
    use HasFactory;

    protected $table = 'om_database_order_pricing_fabrics_costs';

    protected $fillable = [
        'order_pricing_id',
        'costing_head_id',
        'value',
        'created_by',
        'updated_by',
    ];

    public function orderPricing()
    {
        return $this->belongsTo(OrderPricing::class, 'order_pricing_id');
    }

    public function costingHead()
    {
        return $this->belongsTo(CostingHead::class, 'costing_head_id');
    }

    protected static function booted()
    {
        static::created(function ($model) {
            $model->created_by = Auth::id();
            $model->saveQuietly();
        });

        static::updated(function ($model) {
            $model->updated_by = Auth::id();
            $model->saveQuietly();
        });
    }
}
