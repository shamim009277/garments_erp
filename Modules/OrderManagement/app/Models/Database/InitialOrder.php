<?php

namespace Modules\OrderManagement\Models\Database;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Modules\OrderManagement\Models\Setup\Buyer;
use Modules\OrderManagement\Models\Setup\Color;
use Modules\OrderManagement\Models\Setup\Size;
use Modules\OrderManagement\Models\Setup\OrderType;
use Modules\OrderManagement\Models\Setup\YarnCount;
use Modules\OrderManagement\Models\Setup\ProductCategory;
use Modules\HRIS\Models\Database\Employee;
use Modules\HRIS\Models\Setup\Organization;

class InitialOrder extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'om_database_initial_order';
    protected $fillable = [
        'order_code',
        'buyer_id',
        'description',
        'organization_id',
        'order_quantity',
        'style',
        'gsm',
        'po',
        'seasson',
        'fabrication',
        'finish_type',
        'instructions',
        'color_id',
        'size_id',
        'order_type_id',
        'merchant_id',
        'yarn_count_id',
        'product_category_id',
        'file',
        'created_by',
        'updated_by',
    ];

    //booted
    protected static function booted()
    {
        static::created(function ($order) {
            $order->created_by = Auth::user()->id;
        });

        static::updated(function ($order) {
            $order->updated_by = Auth::user()->id;
        });
    }

    //relationships
    public function buyer()
    {
        return $this->belongsTo(Buyer::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    public function colors()
    {
        return $this->belongsToMany(Color::class, 'om_database_initial_order_colors', 'initial_order_id', 'color_id');
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }
    
    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'om_database_initial_order_sizes', 'initial_order_id', 'size_id');
    }

    public function orderType()
    {
        return $this->belongsTo(OrderType::class);
    }

    public function merchant()
    {
        return $this->belongsTo(Employee::class, 'merchant_id');
    }

    public function yarnCount()
    {
        return $this->belongsTo(YarnCount::class);
    }

    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function pricing()
    {
        return $this->hasOne(OrderPricing::class, 'initial_order_id');
    }
}
