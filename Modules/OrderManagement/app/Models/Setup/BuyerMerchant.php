<?php

namespace Modules\OrderManagement\Models\Setup;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Modules\OrderManagement\Models\Setup\Buyer;
use Modules\HRIS\Models\Database\Employee;
use Modules\HRIS\Models\Setup\Organization;

class BuyerMerchant extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'om_setup_buyer_merchant';
    protected $fillable = [
        'buyer_id',
        'merchant_id',
        'organization_id',
        'is_active',
        'created_by',
        'updated_by',
    ];

    //booted
    protected static function booted()
    {
        static::created(function ($buyerMerchant) {
            $buyerMerchant->created_by = Auth::user()->id;
        });

        static::updated(function ($buyerMerchant) {
            $buyerMerchant->updated_by = Auth::user()->id;
        });
    }

    //relationships
    public function buyer()
    {
        return $this->belongsTo(Buyer::class);
    }

    public function merchant()
    {
        return $this->belongsTo(Employee::class, 'merchant_id');
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}
