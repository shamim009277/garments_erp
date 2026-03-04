<?php

namespace Modules\OrderManagement\Models\Setup;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Modules\OrderManagement\Models\Setup\Buyer;
use Modules\OrderManagement\Models\Setup\Item;
use Modules\Inventory\Models\Setup\Supplier;
use App\Models\Master\Setup\Unit;
use Modules\HRIS\Models\Setup\Organization;

class BomSetup extends Model
{
    use HasFactory;

    protected $table = 'om_setup_bom_setups';

    protected $fillable = [
        'buyer_id',
        'organization_id',
        'item_id',
        'consumption',
        'consumption_pcs',
        'convert_ratio',
        'consumption_unit_id',
        'unit_id',
        'extra',
        'supplier_id',
        'breakdown_id',
        'create_date',
        'remarks',
        'created_by',
    ];

    protected $dates = ['create_date'];

    protected static function booted()
    {
        static::creating(function ($bom) {
            if (Auth::check()) {
                $bom->created_by = Auth::id();
            }
        });

        static::updating(function ($bom) {
            if (Auth::check()) {
                $bom->updated_by = Auth::id();
            }
        });
    }

    public function buyer()
    {
        return $this->belongsTo(Buyer::class, 'buyer_id');
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    public function consumptionUnit()
    {
        return $this->belongsTo(Unit::class, 'consumption_unit_id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
}
