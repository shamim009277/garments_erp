<?php

namespace Modules\HRIS\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
// use Modules\HRIS\Database\Factories\RamadanScheduleFactory;

class RamadanSchedule extends Model
{
    use HasFactory;

    protected $table = 'hris_setting_ramadan_schedule';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'start_date',
        'end_date',
        'is_active',
        'created_by',
        'updated_by',
    ];

    public static function booted()
    {
        static::creating(function ($model) {
            $model->created_by = Auth::id();
            $model->updated_by = Auth::id();
        });

        static::updating(function ($model) {
            $model->updated_by = Auth::id();
        });
    }

    public function scopeActive($query) {
        return $query->where('is_active', true);
    }
}
