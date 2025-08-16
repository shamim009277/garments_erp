<?php

namespace Modules\HRIS\Models\Setup;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
class ParentDesignation extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'hris_setup_parent_designations';
    protected $fillable = [
        'designation',
        'designation_bn',
        'approved_mp',
        'is_active',
        'created_by',
        'updated_by',
    ];
    protected $casts = [
        'is_active' => 'boolean',
    ];

    public static function booted()
    {
        static::creating(function ($parentDesignation) {
            $parentDesignation->created_by = Auth::id();
            $parentDesignation->updated_by = Auth::id();
        });

        static::updating(function ($parentDesignation) {
            $parentDesignation->updated_by = Auth::id();
        });
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
