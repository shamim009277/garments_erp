<?php

namespace Modules\OrderManagement\Models\Setup;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class PartName extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'om_setup_part_name';
    protected $fillable = [
        'part_name',
        'is_active',
        'created_by',
        'updated_by',
    ];

    //booted
    protected static function booted()
    {
        static::created(function ($partName) {
            $partName->created_by = Auth::user()->id;
        });

        static::updated(function ($partName) {
            $partName->updated_by = Auth::user()->id;
        });
    }
}
