<?php

namespace Modules\Inventory\Models\Setup;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
// use Modules\Inventory\Database\Factories\Setup/SupplierFactory;

class Supplier extends Model
{
    use HasFactory;
    protected $table = 'inventory_setup_suppliers';
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'supplier_code',
        'supplier_type_id',
        'contact_person',
        'email',
        'phone',
        'mobile',
        'address_line_1',
        'address_line_2',
        'city',
        'state',
        'zip_code',
        'country',
        'tax_id',
        'trade_license',
        'bank_account',
        'bank_name',
        'swift_code',
        'is_active',
        'created_by',
        'updated_by',
    ];
    protected static function booted()
    {
        static::created(function ($supplier) {
            $supplier->created_by = Auth::user()->id;
        });

        static::updated(function ($supplier) {
            $supplier->updated_by = Auth::user()->id;
        });
    }
    // protected static function newFactory(): Setup/SupplierFactory
    // {
    //     // return Setup/SupplierFactory::new();
    // }
}
