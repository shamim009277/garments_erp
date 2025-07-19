<?php

namespace Modules\HRIS\Models\Setup;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
// use Modules\HRIS\Database\Factories\Setup\ParentDepartmentFactory;

class ParentDepartment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'hris_setup_parent_department';
    protected $fillable = ['parent_department', 'parent_department_bn', 'is_active'];

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

    // protected static function newFactory(): Setup\ParentDepartmentFactory
    // {
    //     // return Setup\ParentDepartmentFactory::new();
    // }

    public static function booted()
    {
        static::created(function ($parentDepartment) {
            $parentDepartment->created_by = Auth::user()->id;
        });

        static::updated(function ($parentDepartment) {
            $parentDepartment->updated_by = Auth::user()->id;
        });
    }
    
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
