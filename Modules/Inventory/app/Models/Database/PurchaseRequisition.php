<?php

namespace Modules\Inventory\Models\Database;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Inventory\Database\Factories\Database/PurchaseRequisitionFactory;

class PurchaseRequisition extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    // protected static function newFactory(): Database/PurchaseRequisitionFactory
    // {
    //     // return Database/PurchaseRequisitionFactory::new();
    // }
}
