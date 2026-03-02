<?php

namespace Modules\HRIS\Models\Setup;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Unit extends Model
{
    use HasFactory;

    protected $table = 'hris_setup_units';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['unit', 'code', 'line_id', 'line', 'is_active', 'created_by', 'updated_by'];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public static function booted()
    {
        static::creating(function ($unit) {
            $unit->created_by = Auth::user()->id;
            $unit->updated_by = Auth::user()->id;
        });

        static::updating(function ($unit) {
            $unit->updated_by = Auth::user()->id;
        });
    }
}
