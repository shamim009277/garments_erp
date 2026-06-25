<?php

namespace Modules\HRIS\Models\Setup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
// use Modules\HRIS\Database\Factories\CompanyUnitFactory;

class CompanyUnit extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'hris_setup_company_units';
    protected $fillable = ['org_id', 'unit',    'code', 'line_id', 'line', 'is_active'];

    protected $casts = [
        'line_id' => 'array',
        'line' => 'array',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public static function booted()
    {
        static::creating(function ($unit) {
            $unit->created_by = Auth::user()->id;
            $unit->updated_by = Auth::user()->id;
        });

        static::updating(function ($unit) {
            $unit->updated_by = Auth::user()->id;
        });
    }

    public function company()
    {
        return $this->belongsTo(Organization::class, 'org_id', 'id');
    }
}
