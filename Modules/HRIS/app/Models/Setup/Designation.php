<?php

namespace Modules\HRIS\Models\Setup;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Modules\HRIS\Models\Database\Applicant;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\HRIS\Database\Factories\Setup\DesignationFactory;

class Designation extends Model
{
    use HasFactory;

    protected $table = 'hris_setup_designations';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'designation',
        'designation_bn',
        'parent_designation_id',
        'grade',
        'category_code',
        'approved_mp',
        'is_attn_bonus',
        'attendance_bonus',
        'min_gross',
        'max_gross',
        'tiffin_bill',
        'night_bill1',
        'night_bill2',
        'night_bill3',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_attn_bonus' => 'boolean',
        'parent_designation_id' => 'integer',
        'category_code' => 'string',
    ];

    public static function booted()
    {
        static::creating(function ($designation) {
            $designation->created_by = Auth::id();
            $designation->updated_by = Auth::id();
        });

        static::updating(function ($designation) {
            $designation->updated_by = Auth::id();
        });
    }

    public function parentDesignation(): BelongsTo
    {
        return $this->belongsTo(ParentDesignation::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(EmployeeCategory::class, 'category_code', 'category_code');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function applicatnts(): HasMany
    {
        return $this->hasMany(Applicant::class);
    }

    // protected static function newFactory(): Setup\DesignationFactory
    // {
    //     // return Setup\DesignationFactory::new();
    // }
}
