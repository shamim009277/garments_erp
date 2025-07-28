<?php

namespace Modules\HRIS\Models\Setup;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
// use Modules\HRIS\Database\Factories\Setup\ShiftFactory;

class Shift extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'hris_setup_shifts';
    protected $fillable = [
        'shift',
        'shift_start',
        'shift_end',
        'break_start',
        'break_end',
        'break_duration',
        'break_duration_type',
        'late_after_minutes',
        'is_active',
        'created_by',
        'updated_by',
    ];
    protected $casts = [
        'is_active' => 'boolean',
    ];

    public static function booted()
    {
        static::created(function ($shift) {
            $shift->created_by = Auth::user()->id;
        });

        static::updated(function ($shift) {
            $shift->updated_by = Auth::user()->id;
        });
    }
    // protected static function newFactory(): Setup\ShiftFactory
    // {
    //     // return Setup\ShiftFactory::new();
    // }
}
