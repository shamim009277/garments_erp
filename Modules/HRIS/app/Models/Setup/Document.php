<?php

namespace Modules\HRIS\Models\Setup;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
// use Modules\HRIS\Database\Factories\Setup\DocumentFactory;

class Document extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     */
    protected $table = 'hris_setup_documents';

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected $fillable = [
        'name',
        'is_active',
    ];

    public static function booted()
    {
        static::created(function ($document) {
            $document->created_by = Auth::user()->id;
        });

        static::updated(function ($document) {
            $document->updated_by = Auth::user()->id;
        });
    }

    public function scopeActive($query){
        return $query->where('is_active', true);
    }

    // protected static function newFactory(): Setup\DocumentFactory
    // {
    //     // return Setup\DocumentFactory::new();
    // }
}
