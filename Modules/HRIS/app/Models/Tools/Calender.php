<?php

namespace Modules\HRIS\Models\Tools;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\HRIS\Database\Factories\Tools\CalenderFactory;

class Calender extends Model
{
    use HasFactory;
    protected $table = 'hris_tools_calender';

    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = ['id'];

    protected $casts = [
        'date'           => 'date',
        'year'           => 'integer',
        'month'          => 'integer',
        'holiday'        => 'string',
        'public_holiday' => 'string',
        'note'           => 'string',
    ];

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
}
