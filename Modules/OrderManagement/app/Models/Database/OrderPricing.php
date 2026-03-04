<?php

namespace Modules\OrderManagement\Models\Database;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Modules\OrderManagement\Models\Setup\BrandCategory;
use Modules\OrderManagement\Models\Setup\Buyer;
use Modules\HRIS\Models\Setup\Organization;



class OrderPricing extends Model
{
    use HasFactory;

    protected $table = 'om_database_order_pricing';
    protected $guarded = [];

    // Relationships
    public function initialOrder()
    {
        return $this->belongsTo(InitialOrder::class, 'initial_order_id');
    }

    public function accessories()
    {
        return $this->hasMany(OrderPricingAccessory::class, 'order_pricing_id');
    }

    public function measurements()
    {
        return $this->hasMany(OrderPricingMeasurement::class, 'order_pricing_id');
    }

    public function fabricsCosts()
    {
        return $this->hasMany(OrderPricingFabricsCost::class, 'order_pricing_id');
    }

    public function brandCategory()
    {
        return $this->belongsTo(BrandCategory::class);
    } 
    public function buyer()
    {
        return $this->belongsTo(Buyer::class);
    }
    public function organization()
    {
        return $this->belongsTo(Organization::class);
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
