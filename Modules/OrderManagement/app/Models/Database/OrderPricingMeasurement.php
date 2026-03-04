<?php

namespace Modules\OrderManagement\Models\Database;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\OrderManagement\Models\Setup\PartName;
use Illuminate\Support\Facades\Auth;

class OrderPricingMeasurement extends Model
{
    use HasFactory;

    protected $table = 'om_database_order_pricing_measurements';
    protected $fillable = [
        'order_pricing_id',
        'part_name_id',
        'value',
        'created_by',
        'updated_by',
    ];

    public function partName()
    {
        return $this->belongsTo(PartName::class, 'part_name_id');
    }

    public function orderPricing()
    {
        return $this->belongsTo(OrderPricing::class, 'order_pricing_id');
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
