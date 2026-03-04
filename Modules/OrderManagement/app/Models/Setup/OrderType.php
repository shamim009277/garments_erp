<?php

namespace Modules\OrderManagement\Models\Setup;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class OrderType extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'om_setup_order_type';
    protected $fillable = [
        'order_type',
        'is_active',
        'created_by',
        'updated_by',
    ];

    //booted
    protected static function booted()
    {
        static::created(function ($orderType) {
            $orderType->created_by = Auth::user()->id;
        });

        static::updated(function ($orderType) {
            $orderType->updated_by = Auth::user()->id;
        });
    }
}
