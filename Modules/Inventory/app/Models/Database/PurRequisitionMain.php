<?php

namespace Modules\Inventory\Models\Database;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Modules\Inventory\Models\Setup\StoreLocation;
use Modules\HRIS\Models\Setup\Organization;
use App\Models\User;


class PurRequisitionMain extends Model
{
    use HasFactory;

    protected $table = 'inventory_database_pur_requisition_mains';
    protected $fillable = [
        'requisition_no',
        'organization_id',
        'required_by_id',
        'store_id',
        'purpose',
        'note',
        'req_date',
        'year',
        'month',
        'is_done',
        'is_forward',
        'forward_by',
        'forward_date',
        'is_priced',
        'priced_by',
        'priced_date',
        'is_confirmed',
        'confirmed_by',
        'confirmed_date',
        'is_approved',
        'approved_by',
        'approved_date',
        'is_rejected',
        'rejected_by',
        'rejected_date',
        'is_fapproved',
        'fapproved_by',
        'fapproved_date',
        'is_rcv_gate',
        'rcv_gate_by',
        'rcv_gate_date',
        'created_by',
        'updated_by',
    ];
    //booted
    public static function booted()
    {
        static::creating(function ($purRequisitionMain) {
            $purRequisitionMain->created_by = Auth::id();
            $purRequisitionMain->updated_by = Auth::id();
        });

        static::updating(function ($purRequisitionMain) {
            $purRequisitionMain->updated_by = Auth::id();
        });
    }



    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function required_by()
    {
        return $this->belongsTo(User::class, 'required_by_id');
    }

    public function store()
    {
        return $this->belongsTo(StoreLocation::class, 'store_id');
    }

    public function forward_by()
    {
        return $this->belongsTo(User::class, 'forward_by');
    }

    public function priced_by()
    {
        return $this->belongsTo(User::class, 'priced_by');
    }

    public function confirmed_by()
    {
        return $this->belongsTo(User::class, 'confirmed_by');
    }

    public function approved_by()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function rejected_by()
    {
        return $this->belongsTo(User::class, 'rejected_by');
    }

    public function fapproved_by()
    {
        return $this->belongsTo(User::class, 'fapproved_by');
    }

    public function rcv_gate_by()
    {
        return $this->belongsTo(User::class, 'rcv_gate_by');
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
