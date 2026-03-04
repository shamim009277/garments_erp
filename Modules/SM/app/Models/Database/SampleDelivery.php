<?php

namespace Modules\SM\Models\Database;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Modules\OrderManagement\Models\Setup\Buyer;
use Modules\HRIS\Models\Database\Employee;

class SampleDelivery extends Model
{
    use HasFactory;

    protected $table = 'design_database_sampledelivery';

    protected $fillable = [
        'ChallanNo',
        'Date',
        'BuyerID',
        'EmployeeID',
        'ChallanType',
        'GoodsType',
        'Comments',
        'C4S',
        'CreatedBy',
    ];

    protected static function booted()
    {
        static::created(function ($model) {
            $model->CreatedBy = Auth::id();
        });
    }

    public function details()
    {
        return $this->hasMany(SampleDeliveryDetail::class, 'ChallanID');
    }

    public function buyer()
    {
        return $this->belongsTo(Buyer::class, 'BuyerID');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'EmployeeID');
    }
}
