<?php

namespace Modules\HRIS\Models\Setup;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LeaveReason extends Model
{
    use HasFactory;

    protected $table = 'hris_setup_leavereason';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['classification_id', 'reason', 'is_active', 'created_by', 'updated_by'];

    protected $casts = [
        'classification_id' => 'array',
        'is_active' => 'boolean',
    ];

    public static function booted()
    {
        static::created(function ($leavereason) {
            $leavereason->created_by = Auth::user()->id;
            $leavereason->updated_by = Auth::user()->id;
        });

        static::updated(function ($leavereason) {
            $leavereason->updated_by = Auth::user()->id;
        });
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
