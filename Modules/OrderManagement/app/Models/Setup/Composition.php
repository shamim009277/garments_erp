<?php

namespace Modules\OrderManagement\Models\Setup;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
// use Modules\Inventory\Database\Factories\Setup/CompositionFactory;

class Composition extends Model
{
    use HasFactory;


    protected $table = 'inventory_setup_compositions';
    protected $fillable = [
        'composition_code',
        'composition_name',
        'composition_description',
        'is_active',
    ];

    // protected static function newFactory(): Setup/CompositionFactory
    // {
    //     // return Setup/CompositionFactory::new();
    // }
    //booted
    protected static function booted()
    {
        static::created(function ($composition) {
            $composition->created_by = Auth::user()->id;
        });

        static::updated(function ($composition) {
            $composition->updated_by = Auth::user()->id;
        });
    }
}
