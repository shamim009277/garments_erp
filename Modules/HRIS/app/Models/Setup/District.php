<?php

namespace Modules\HRIS\Models\Setup;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\HRIS\Database\Factories\Setup\DistrictFactory;

class District extends Model
{
    use HasFactory;

    protected $table = 'hris_setup_districts';
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'bn_name',
        'is_active',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public static function booted()
    {
        static::created(function ($district) {
            $district->created_by = Auth::user()->id;
        });

        static::updated(function ($district) {
            $district->updated_by = Auth::user()->id;
        });
    }
    public function division()
    {
        return $this->belongsTo(Division::class);
    }
    public function thanas()
    {
        return $this->hasMany(Thana::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // protected static function newFactory(): Setup\DistrictFactory
    // {
    //     // return Setup\DistrictFactory::new();
    // }
}
