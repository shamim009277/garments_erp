<?php

namespace Modules\HRIS\Models\Setup;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class ParentDepartment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'hris_setup_parent_departments';

    protected $fillable = ['department', 'department_bn', 'is_active', 'created_by', 'updated_by'];
    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public static function booted()
    {
        static::creating(function ($parentDepartment) {
            $parentDepartment->created_by = Auth::id();
            $parentDepartment->updated_by = Auth::id();
        });

        static::updating(function ($parentDepartment) {
            $parentDepartment->updated_by = Auth::id();
        });
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function departments(): HasMany
    {
        return $this->hasMany(Department::class, 'parent_department_id', 'id');
    }
}
