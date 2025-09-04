<?php

namespace Modules\Inventory\Models\Database;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Inventory\Models\Setup\Item;
use Modules\HRIS\Models\Setup\Organization;
use App\Models\User;
use Modules\Inventory\Models\Database\PurRequisitionMain;
use App\Models\Master\Setup\Unit;

use Illuminate\Support\Facades\Auth;

// use Modules\Inventory\Database\Factories\Database/PurRequisitionDetailFactory;

class PurRequisitionDetail extends Model
{
    use HasFactory;
    protected $table = 'inventory_database_pur_requisition_details';
    protected $fillable = [
        'pur_req_id',
        'item_id',
        'pur_unit_id',
        'prev_stock',
        'req_qty',
        'for_qty',
        'forward_by',
        'forward_date',
        'aprx_priced',
        'total_value',
        'aprx_priced_by',
        'aprx_priced_date',
        'pricing_note',
        'app_qty',
        'approved_by',
        'approved_date',
        'rejected_stage',
        'is_rejected',
        'rejected_by',
        'rejected_date',
        'acc_cleared',
        'acc_cleared_by',
        'acc_cleared_date',
        'final_app_qty',
        'final_approved_by',
        'final_approved_date',
        'send_to_pur',
        'send_to_by',
        'send_to_date',
        'note',
        'received_gate',
        'rcv_gate_qty',
        'received_gate_by',
        'received_gate_date',
        'rcv_qty',
        'received_by',
        'received_date',
        'done',
        'purchased',
        'pur_qty',
        'pur_price',
        'purchase_by',
        'purchase_date',
        'who_purcahsed',
        'remarks',
        'comment',
        'created_by',
        'updated_by',
    ];
    //booted
    public static function booted()
    {
        static::creating(function ($purRequisitionDetail) {
            $purRequisitionDetail->created_by = Auth::id();
            $purRequisitionDetail->updated_by = Auth::id();
        });

        static::updating(function ($purRequisitionDetail) {
            $purRequisitionDetail->updated_by = Auth::id();
        });
    }



    public function pur_req_id()
    {
        return $this->belongsTo(PurRequisitionMain::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    public function pur_unit()
    {
        return $this->belongsTo(Unit::class, 'pur_unit_id');
    }
    
    public function forward_by()
    {
        return $this->belongsTo(User::class, 'forward_by');
    }

    public function priced_by()
    {
        return $this->belongsTo(User::class, 'aprx_priced_by');
    }

    public function approved_by()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function rejected_by()
    {
        return $this->belongsTo(User::class, 'rejected_by');
    }

    public function final_approved_by()
    {
        return $this->belongsTo(User::class, 'final_approved_by');
    }

    public function received_gate_by()
    {
        return $this->belongsTo(User::class, 'received_gate_by');
    }   

    public function received_by()
    {
        return $this->belongsTo(User::class, 'received_by');
    }   

    public function purchase_by()
    {
        return $this->belongsTo(User::class, 'purchase_by');
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
