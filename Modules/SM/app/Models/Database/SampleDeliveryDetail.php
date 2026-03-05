<?php

namespace Modules\SM\Models\Database;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Modules\OrderManagement\Models\Database\SampleOrderProgramme;

class SampleDeliveryDetail extends Model
{
    use HasFactory;

    protected $table = 'sm_database_sampledelivery_details';

    protected $fillable = [
        'ChallanID',
        'ProgrammeID',
        'ProductionID',
        'Color',
        'size',
        'Quantity',
        'Comments',
        'CreatedBy',
    ];

    protected static function booted()
    {
        static::created(function ($model) {
            $model->CreatedBy = Auth::id();
        });
    }

    public function delivery()
    {
        return $this->belongsTo(SampleDelivery::class, 'ChallanID');
    }

    public function sampleOrderProgramme()
    {
        return $this->belongsTo(SampleOrderProgramme::class, 'SampleOrderProgrammeID');
    }

    public function sampleOrderProduction()
    {
        return $this->belongsTo(SampleOrderProduction::class, 'SampleOrderProductionID');
    }
}
