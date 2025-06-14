<?php

namespace App\Models\Administration;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Database\Factories\ModuleFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Module extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'is_active',
        'created_by',
        'updated_by',
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
        'created_by' => 'integer',
        'updated_by' => 'integer',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

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

        static::creating(function ($category) {
            $slug = Str::slug($category->name);
            $originalSlug = $slug;
            $i = 1;

            while (self::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $i++;
            }

            $category->slug = $slug;
        });
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
    
}
