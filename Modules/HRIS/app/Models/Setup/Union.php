<?php

namespace Modules\HRIS\Models\Setup;

use Illuminate\Support\Facades\Auth;
use Modules\HRIS\Models\Setup\Thana;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\HRIS\Database\Factories\Setup\UnionFactory;

class Union extends Model
{
    use HasFactory;

    protected $table = 'hris_setup_unions';
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'thana_id',
        'name',
        'bn_name',
        'url',
        'is_active',
        'created_by',
        'updated_by',
    ];

    public function thana()
    {
        return $this->belongsTo(Thana::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public static function booted()
    {
        static::created(function ($union) {
            $union->created_by = Auth::user()->id;
        });

        static::updated(function ($union) {
            $union->updated_by = Auth::user()->id;
        });
    }

    // protected static function newFactory(): Setup\UnionFactory
    // {
    //     // return Setup\UnionFactory::new();
    // }
}
