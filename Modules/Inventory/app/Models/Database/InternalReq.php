<?php

namespace Modules\Inventory\Models\Database;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Modules\HRIS\Models\Setup\Organization;
use Modules\Inventory\Models\Setup\Supplier;
use Modules\Inventory\Models\Setup\ChallanPurpose;

use Modules\Inventory\Models\Setup\StoreLocation;
use App\Models\User;

class InternalReqController extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    // protected static function newFactory(): Database\InternalReqControllerFactory
    // {
    //     // return Database\InternalReqControllerFactory::new();
    // }
}
