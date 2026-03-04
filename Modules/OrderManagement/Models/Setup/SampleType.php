<?php

namespace Modules\OrderManagement\Models\Setup;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class SampleType extends Model
{
    use HasFactory;

    protected $table = 'om_setup_sample_types';
    protected $fillable = [
        'sample_type_code',
        'sample_type_name',
        'sample_type_description',
        'is_active',
        'created_by',
        'updated_by'
    ];

    protected static function booted()
    {
        static::created(function ($sampleType) {
            $sampleType->created_by = Auth::id();
            $sampleType->save();
        });

        static::updated(function ($sampleType) {
            $sampleType->updated_by = Auth::id();
        });
    }
}
