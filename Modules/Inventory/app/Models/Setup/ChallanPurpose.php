<?php

namespace Modules\Inventory\Models\Setup;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
// use Modules\Inventory\Database\Factories\Setup/ChallanPurposeFactory;

class ChallanPurpose extends Model
{
    use HasFactory;
    protected $table = 'inventory_setup_challan_purposes';
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'purpose_name',
        'description',
        'is_active',
        'created_by',
        'updated_by',
    ];
    //booted
    protected static function booted()
    {
        static::created(function ($purpose) {
            $purpose->created_by = Auth::user()->id;
        });

        static::updated(function ($purpose) {
            $purpose->updated_by = Auth::user()->id;
        });
    }

    // protected static function newFactory(): Setup/ChallanPurposeFactory
    // {
    //     // return Setup/ChallanPurposeFactory::new();
    // }
}
