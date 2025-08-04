<?php

namespace Modules\Inventory\Models\Setup;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Modules\Inventory\Models\Setup\Country;
// use Modules\Inventory\Database\Factories\Setup/BuyerFactory;

class Buyer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'inventory_setup_buyer';
    protected $fillable = [
        'buyer_code',
        'buyer_name',
        'buyer_type',
        'contact_person',
        'email',
        'phone',
        'mobile',
        'fax',
        'address',
        'country_id',
        'website',
        'is_active',
        'created_by',
        'updated_by',
    ];

    //booted
    protected static function booted()
    {
        static::created(function ($buyer) {
            $buyer->created_by = Auth::user()->id;
        });

        static::updated(function ($buyer) {
            $buyer->updated_by = Auth::user()->id;
        });
    }
    //country
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    // protected static function newFactory(): Setup/BuyerFactory
    // {
    //     // return Setup/BuyerFactory::new();
    // }
}
