<?php

namespace Modules\Inventory\Models\Setup;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
// use Modules\Inventory\Database\Factories\Setup/CountryFactory;

class Country extends Model
{
    use HasFactory;

    
    // $table->string('country_name', 100)->unique();
    // $table->string('country_code', 20)->unique();
    // $table->boolean('is_active')->default(true);
    // //currency
    // $table->string('currency', 20)->unique();
    // $table->string('currency_code', 20)->unique();
    // $table->string('currency_symbol', 20)->unique();
    // //exchange rate
    // $table->decimal('exchange_rate', 10, 2)->default(1);
    protected $table = 'inventory_setup_goods_setup_country';
    protected $fillable = [
        'country_name',
        'country_code',
        'is_active',
        'currency',
        'currency_code',
        'currency_symbol',
        'exchange_rate',
        'description',
        'created_by',
        'updated_by',
    ];
    //booted
    protected static function booted()
    {
        //created
        static::created(function ($country) {
            $country->created_by = Auth::user()->id;
        });
        //updated
        static::updated(function ($country) {
            $country->updated_by = Auth::user()->id;
        });
    }

    // protected static function newFactory(): Setup/CountryFactory
    // {
    //     // return Setup/CountryFactory::new();
    // }
}
