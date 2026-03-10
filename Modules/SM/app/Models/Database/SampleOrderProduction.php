<?php

namespace Modules\SM\Models\Database;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\OrderManagement\Models\Database\InitialOrder;
use Modules\OrderManagement\Models\Database\SampleOrderProgramme;
use Modules\OrderManagement\Models\Setup\Buyer;
use Modules\OrderManagement\Models\Setup\Color;
use Modules\OrderManagement\Models\Setup\Size;
use Modules\OrderManagement\Models\Setup\SampleType;

class SampleOrderProduction extends Model
{
    use HasFactory;

    protected $table = 'sm_database_productions';

    protected $fillable = [
        'buyer_id',
        'order_id',
        'programme_id',
        'color_id',
        'size_id',
        'sample_type_id',
        'production_quantity',
        'used_fabric_quantity',
        'production_notes',
        'delivery_qty',
        'balance_qty',
        'production_date'
    ];

    public function initialOrder()
    {
        return $this->belongsTo(InitialOrder::class, 'order_id');
    }

    public function buyer()
    {
        return $this->belongsTo(Buyer::class, 'buyer_id');
    }

    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }

    public function size()
    {
        return $this->belongsTo(Size::class, 'size_id');
    }

    public function sampleType()
    {
        return $this->belongsTo(SampleType::class, 'sample_type_id');
    }

     public function programme()
    {
        return $this->belongsTo(SampleOrderProgramme::class, 'programme_id');
    }
}
