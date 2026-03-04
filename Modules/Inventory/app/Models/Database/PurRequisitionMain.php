<?php

namespace Modules\Inventory\Models\Database;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Modules\HRIS\Models\Setup\Organization;

use Modules\Inventory\Models\Setup\StoreLocation;
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
        'done_by_id',
        'done_date',
        'is_forward',
        'forward_by_id',
        'forward_date',
        'is_priced',
        'priced_by_id',
        'priced_date',
        'is_confirmed',
        'confirmed_by_id',
        'confirmed_date',
        'is_approved',
        'approved_by_id',
        'approved_date',
        'is_rejected',
        'rejected_by_id',
        'rejected_date',
        'is_fapproved',
        'fapproved_by_id',
        'fapproved_date',
        'is_rcv_gate',
        'is_store_rcv',
        'is_purchased',
        'purchase_stage',
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

    public function done_by()
    {
        return $this->belongsTo(User::class, 'done_by_id');
    }

    public function forward_by()
    {
        return $this->belongsTo(User::class, 'forward_by_id');
    }

    public function priced_by()
    {
        return $this->belongsTo(User::class, 'priced_by_id');
    }

    public function confirmed_by()
    {
        return $this->belongsTo(User::class, 'confirmed_by_id');
    }

    public function approved_by()
    {
        return $this->belongsTo(User::class, 'approved_by_id');
    }

    public function rejected_by()
    {
        return $this->belongsTo(User::class, 'rejected_by_id');
    }

    public function fapproved_by()
    {
        return $this->belongsTo(User::class, 'fapproved_by_id');
    }

    public function store()
    {
        return $this->belongsTo(StoreLocation::class, 'store_id');
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
