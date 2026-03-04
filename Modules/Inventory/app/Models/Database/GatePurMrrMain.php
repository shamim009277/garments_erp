<?php

namespace Modules\Inventory\Models\Database;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\HRIS\Models\Setup\Organization;
use Modules\Inventory\Models\Setup\Supplier;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
// use Modules\Inventory\Database\Factories\Database/GatePurMrrMainFactory;

class GatePurMrrMain extends Model
{
    protected $table = 'inventory_database_gate_pur_mrr_mains';
    protected $fillable = [
        'mrr_no',
        'mrr_date',
        'organization_id',
        'gate_entry_id',
        'received_by_id',
        'supplier_id',
        'note',
        'year',
        'month',
        'act_challan_no',
        'vehicle_no',
        'driver_name',
        'bill_amount',
        'paid_amount',
        'due_amount',
        'is_done',
        'done_by',
        'done_date',
        'is_qa_checked',
        'qa_checked_by',
        'qa_checked_date',
        'qa_stage',
        'is_store_rcv',
        'store_rcv_by',
        'store_rcv_date',
        'is_audit_chck',
        'audit_chck_by',
        'audit_chck_date',
        'is_returned',
        'returned_by',
        'returned_date',
        'document',
        'is_bill_paid',
        'bill_paid_by',
        'bill_paid_date',
        'created_by',
        'updated_by'
    ];
    //booted
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



    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function gate_entry()
    {
        return $this->belongsTo(User::class, 'gate_entry_id');
    }

    public function received_by()
    {
        return $this->belongsTo(User::class, 'received_by_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function bill_paid_by()
    {
        return $this->belongsTo(User::class, 'bill_paid_by');
    }

    public function store_rcv_by()
    {
        return $this->belongsTo(User::class, 'store_rcv_by');
    }

    public function returned_by()
    {
        return $this->belongsTo(User::class, 'returned_by');
    }

    public function done_by()
    {
        return $this->belongsTo(User::class, 'done_by_id');
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updated_by()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function rcv_gate_by()
    {
        return $this->belongsTo(User::class, 'rcv_gate_by');
    }   


}
