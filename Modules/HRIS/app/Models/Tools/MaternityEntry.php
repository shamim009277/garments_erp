<?php

namespace Modules\HRIS\Models\Tools;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\HRIS\Database\Factories\Tools\MaternityEntryFactory;

class MaternityEntry extends Model
{
    use HasFactory;

    protected $table = 'hris_tools_maternity_entry';

    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = ['id'];

    public static function booted()
    {
        static::creating(function ($line) {
            $line->created_by = Auth::id();
            $line->updated_by = Auth::id();
        });

        static::updating(function ($line) {
            $line->updated_by = Auth::id();
        });
    }

    // protected static function newFactory(): Tools\MaternityEntryFactory
    // {
    //     // return Tools\MaternityEntryFactory::new();
    // }
}
