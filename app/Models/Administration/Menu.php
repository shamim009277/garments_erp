<?php

namespace App\Models\Administration;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Menu extends Model
{
    protected $fillable = [
        'module_id',
        'parent_id',
        'title',
        'slug',
        'url',
        'icon',
        'order',
        'is_active',
        'has_child',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'has_child' => 'boolean',
        'created_by' => 'integer',
        'updated_by' => 'integer',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function module() : BelongsTo
    {
        return $this->belongsTo(Module::class);
    }

    public function parent() : BelongsTo
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    public function children() : HasMany
    {
        return $this->hasMany(Menu::class, 'parent_id');
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

        static::creating(function ($model) {
            $slug = Str::slug($model->title);
            $originalSlug = $slug;
            $i = 1;

            while (self::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $i++;
            }

            $model->slug = $slug;
        });
    }

    public function creator() : BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater() : BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeInactive($query)
    {
        return $query->where('is_active', false);
    }
}
