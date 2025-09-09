<?php

namespace Modules\HRIS\Models\Setup;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Line extends Model
{
    use HasFactory;

    protected $table = 'hris_setup_lines';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['line', 'code', 'is_active', 'created_by', 'updated_by'];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

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
