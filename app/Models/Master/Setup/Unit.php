<?php

namespace App\Models\Master\Setup;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $table = 'master_setup_units';

    protected $fillable = [
        'name',
        'code',
        'conversion_rate',
        'root_id',
        'is_active',
        'is_root',
        'created_by',
        'updated_by',
    ];

    public function root()
    {
        return $this->belongsTo(Unit::class, 'root_id');
    }
    public function children()
    {
        return $this->hasMany(Unit::class, 'root_id');
    }
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
    protected static function booted()
    {
        static::creating(function ($model) {
            if (Auth::check()) {
                $model->created_by = Auth::id();
                $model->updated_by = Auth::id();
            }
        });

        static::updating(function ($model) {
            if (Auth::check()) {
                $model->updated_by = Auth::id();
            }
        });
    }
}
