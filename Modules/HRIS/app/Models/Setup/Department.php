<?php

namespace Modules\HRIS\Models\Setup;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
// use Modules\HRIS\Database\Factories\Setup\DepartmentFactory;

class Department extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'hris_setup_departments';

    protected $fillable = ['department', 'department_bn', 'parent_department_id','approved_mp', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

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

    public function parentDepartment(): BelongsTo
    {
        return $this->belongsTo(ParentDepartment::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
