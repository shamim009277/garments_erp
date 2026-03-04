<?php

namespace Modules\OrderManagement\Models\Database;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Modules\OrderManagement\Models\Database\InitialOrder;
use Modules\OrderManagement\Models\Setup\Color;
use Modules\OrderManagement\Models\Setup\SampleType;
use Modules\OrderManagement\Models\Setup\Composition;
use Modules\OrderManagement\Models\Setup\ProductCategory;
use Modules\OrderManagement\Models\Setup\FabricTreatments;
use Modules\OrderManagement\Models\Setup\Size;
use Modules\SM\Models\Database\SampleOrderProduction;

class SampleOrderProgramme extends Model
{
    use HasFactory;

    protected $table = 'om_database_sample_order_programme';
    protected $guarded = [];

    protected static function booted()
    {
        static::created(function ($model) {
            $model->created_by = Auth::id();
        });

        static::updated(function ($model) {
            $model->updated_by = Auth::id();
        });
    }

    public function initialOrder()
    {
        return $this->belongsTo(InitialOrder::class, 'initial_order_id');
    }

    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }

    public function sampleType()
    {
        return $this->belongsTo(SampleType::class, 'sample_type_id');
    }

    public function composition()
    {
        return $this->belongsTo(Composition::class, 'composition_id');
    }

    public function item()
    {
        return $this->belongsTo(ProductCategory::class, 'item_id');
    }

    public function fabricTreatment()
    {
        return $this->belongsTo(FabricTreatments::class, 'fabric_treatment_id');
    }

    public function size()
    {
        return $this->belongsTo(Size::class, 'size_id');
    }

    public function production()
    {
        return $this->hasOne(SampleOrderProduction::class, 'sample_order_programme_id');
    }

     public function colors()
    {
        return $this->belongsToMany(Color::class, 'om_database_order_programme_colors', 'program_id', 'color_id');
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'om_database_order_programme_sizes', 'program_id', 'size_id');
    }
}
