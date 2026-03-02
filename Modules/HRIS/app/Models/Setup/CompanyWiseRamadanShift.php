<?php

namespace Modules\HRIS\Models\Setup;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Modules\HRIS\Models\Setup\Organization;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\HRIS\Database\Factories\CompanyWiseShiftFactory;

class CompanyWiseRamadanShift extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'hris_setup_company_wise_ramadan_shifts';
    protected $guarded = ['id'];

    public static function booted()
    {
        static::creating(function ($shift) {
            $shift->created_by = Auth::user()->id;
            $shift->updated_by = Auth::user()->id;
        });

        static::updating(function ($shift) {
            $shift->updated_by = Auth::user()->id;
        });
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function company()
    {
        return $this->belongsTo(Organization::class,'org_id','id');
    }

}
