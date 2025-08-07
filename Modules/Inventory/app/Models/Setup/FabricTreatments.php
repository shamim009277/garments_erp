<?php

namespace Modules\Inventory\Models\Setup;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
// use Modules\Inventory\Database\Factories\Setup/FabricTreatmentsFactory;

class FabricTreatments extends Model
{
    use HasFactory;

    // $table->string('fabric_treatment_code', 20)->unique(); // Like FT001
    // $table->string('fabric_treatment_name', 100);
    // $table->string('fabric_treatment_description')->nullable();
    // $table->boolean('is_active')->default(true);
    protected $table = 'inventory_setup_fabric_treatments';
    protected $fillable = [
        'fabric_treatment_code',
        'fabric_treatment_name',
        'fabric_treatment_description',
        'is_active',
    ];

    // protected static function newFactory(): Setup/FabricTreatmentsFactory
    // {
    //     // return Setup/FabricTreatmentsFactory::new();
    // }
    //booted
    protected static function booted()
    {
        static::created(function ($fabricTreatments) {
            $fabricTreatments->created_by = Auth::user()->id;
        });

        static::updated(function ($fabricTreatments) {
            $fabricTreatments->updated_by = Auth::user()->id;
        });
    }
}
