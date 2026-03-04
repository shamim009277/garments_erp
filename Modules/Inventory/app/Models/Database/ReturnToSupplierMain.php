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

class ReturnToSupplierMain extends Model
{
    use HasFactory;

    protected $table = 'inventory_database_return_to_sup_mains';
    
    protected $fillable = [
        'challan_no',
        'challan_by_id',
        'org_id',
        'party_id',
        'store_id',
        'purpose_id',
        'note',
        'challan_date',
        'year',
        'month',
        'is_done',
        'done_by_id',
        'done_date',
        'is_approved',
        'approved_by_id',
        'approved_date',
        'is_rejected',
        'rejected_by_id',
        'rejected_date',
        'is_gate_out',
        'gate_out_by_id',
        'gate_out_date',
        'created_by',
        'updated_by',
    ];

    //booted
    public static function booted()
    {
        static::creating(function ($gateOutChallanMain) {
            $gateOutChallanMain->created_by = Auth::id();
            $gateOutChallanMain->updated_by = Auth::id();
        });

        static::updating(function ($gateOutChallanMain) {
            $gateOutChallanMain->updated_by = Auth::id();
        });
    }



    public function organization()
    {
        return $this->belongsTo(Organization::class,'org_id');
    }

    public function party()
    {
        return $this->belongsTo(Supplier::class, 'party_id');
    }

    public function challan_by()
    {
        return $this->belongsTo(User::class, 'challan_by_id');
    }

    public function done_by()
    {
        return $this->belongsTo(User::class, 'done_by_id');
    }

    public function approved_by()
    {
        return $this->belongsTo(User::class, 'approved_by_id');
    }

    public function rejected_by()
    {
        return $this->belongsTo(User::class, 'rejected_by_id');
    }

    public function gate_out_by()
    {
        return $this->belongsTo(User::class, 'gate_out_by_id');
    }

    public function store()
    {
        return $this->belongsTo(StoreLocation::class, 'store_id');
    }

    public function purpose()
    {
        return $this->belongsTo(ChallanPurpose::class, 'purpose_id');
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
