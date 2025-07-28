<?php

namespace Modules\HRIS\Models\Setup;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
// use Modules\HRIS\Database\Factories\Setup\SourceReferenceFactory;

class SourceReference extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'hris_setup_source_reference';
    
    protected $casts = [
        'is_active' => 'boolean',
    ];
    
    protected $fillable = [
        'name',
        'is_active',
    ];

    public static function booted()
    {
        static::creating(function ($model) {
            $model->created_by = Auth::user()->id;
            $model->updated_by = Auth::user()->id;
        });

        static::updating(function ($model) {
            $model->updated_by = Auth::user()->id;
        });
    }

    // protected static function newFactory(): Setup\SourceReferenceFactory
    // {
    //     // return Setup\SourceReferenceFactory::new();
    // }
}
