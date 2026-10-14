<?php

namespace Modules\Commercial\Models\Database;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
// use Modules\Commercial\Database\Factories\Database\SalesContactVersionFactory;

class SalesContactVersion extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    public static function booted()
    {
        static::creating(function ($version) {
            $version->created_by = Auth::id();
            $version->updated_by = Auth::id();
        });

        static::updating(function ($version) {
            $version->updated_by = Auth::id();
        });
    }

    public function scopeActive($query) {
        return $query->where('is_active', true);
    }
}
