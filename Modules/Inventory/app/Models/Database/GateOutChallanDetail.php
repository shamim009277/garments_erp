<?php

namespace Modules\Inventory\Models\Database;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Modules\Inventory\Models\Setup\Item;
use App\Models\Master\Setup\Unit;

use Modules\Inventory\Models\Database\GateOutChallanMain;


class GateOutChallanDetail extends Model
{
    use HasFactory;

    protected $table = 'inventory_database_gate_out_challan_details';
    
    protected $fillable = [
        'challan_id',
        'item_id',
        'unit_id',
        'challan_qty',
        'note',
        'app_qty',
        'approved_by',
        'approved_date',
        'is_rejected',
        'rejected_by',
        'rejected_date',
        'is_gate_out',
        'gate_out_qty',
        'gate_out_by',
        'gate_out_date',
        'remarks',
        'comment',
        'created_by',
        'updated_by',
    ];

    //booted
    public static function booted()
    {
        static::creating(function ($gateOutChallanDetail) {
            $gateOutChallanDetail->created_by = Auth::id();
            $gateOutChallanDetail->updated_by = Auth::id();
        });

        static::updating(function ($gateOutChallanDetail) {
            $gateOutChallanDetail->updated_by = Auth::id();
        });
    }



    public function challan()
    {
        return $this->belongsTo(GateOutChallanMain::class,'challan_id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function approved_by()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function rejected_by()
    {
        return $this->belongsTo(User::class, 'rejected_by');
    }

    public function gate_out_by()
    {
        return $this->belongsTo(User::class, 'gate_out_by');
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updated_by()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

}
