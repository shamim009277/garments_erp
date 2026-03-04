<?php

namespace Modules\SM\Models\Setup;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class Group extends Model
{
    use HasFactory;

    protected $table = 'sm_setup_groups';

    protected $fillable = [
        'group_code',
        'name',
        'description',
        'is_active',
        'created_by',
        'updated_by',
    ];

    public static function booted()
    {
        static::created(function ($group) {
            $group->created_by = Auth::id();
            $group->saveQuietly();
        });

        static::updated(function ($group) {
            $group->updated_by = Auth::id();
            $group->saveQuietly();
        });
    }

    public function sewingGroupEmployees()
    {
        return $this->hasMany(SewingGroupEmployee::class, 'group_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
