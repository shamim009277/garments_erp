<?php

namespace Modules\Inventory\Models\Database;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Modules\Inventory\Models\Database\GatePurMrrMain;
use Modules\Inventory\Models\Database\PurRequisitionMain;
use Modules\Inventory\Models\Setup\Item;
use App\Models\Master\Setup\Unit;
use App\Models\User;


class GatePurMrrDetails extends Model
{
    use HasFactory;

    protected $table = 'inventory_database_gate_pur_mrr_details';

    protected $fillable = [

        'mrr_id',
        'req_main_id',
        'req_detail_id',
        'item_id',
        'req_unit_id',
        'req_qty',
        'received_qty',
        'store_rcv_qty',
        'req_price',
        'pur_price',
        'req_amount',
        'pur_amount',
        'note',
        'remarks',
        'check_qty',
        'pass_qty',
        'is_qa_pass',
        'qa_check_by',
        'qa_check_date',
        'is_store_received',
        'store_received_by',
        'store_received_date',
        'created_by',
        'updated_by'

    ];

    public static function booted()
    {
        static::creating(function ($mrr) {
            $mrr->created_by = Auth::id();
            $mrr->updated_by = Auth::id();
        });

        static::updating(function ($mrr) {
            $mrr->updated_by = Auth::id();
        });
    }

    public function mrr()
    {
        return $this->belongsTo(GatePurMrrMain::class, 'mrr_id');
    }

    public function req_main()
    {
        return $this->belongsTo(PurRequisitionMain::class, 'req_main_id');
    }

    public function req_detail()
    {
        return $this->belongsTo(PurRequisitionDetail::class, 'req_detail_id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    public function req_unit()
    {
        return $this->belongsTo(Unit::class, 'req_unit_id');
    }

    public function store_received_by()
    {
        return $this->belongsTo(User::class, 'store_received_by');
    }

    public function qa_check_by()
    {
        return $this->belongsTo(User::class, 'qa_check_by');
    }

}
