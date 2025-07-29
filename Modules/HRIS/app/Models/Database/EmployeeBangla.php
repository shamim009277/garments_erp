<?php

namespace Modules\HRIS\Models\Database;

use Illuminate\Support\Facades\Auth;
use Modules\HRIS\Models\Setup\Thana;
use Illuminate\Database\Eloquent\Model;
use Modules\HRIS\Models\Setup\District;
use Modules\HRIS\Models\Setup\Organization;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\HRIS\Database\Factories\Database\EmployeeBanglaFactory;

class EmployeeBangla extends Model
{
    use HasFactory;

    protected $table = 'hris_database_employee_bangla';
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'employee_id',
        'org_id',
        'name_bangla',
        'fname_bangla',
        'mname_bangla',
        'nname_bangla',
        'relation_bangla',
        'national_id_bangla',
        'mdistrict_id_bangla',
        'mthana_id_bangla',
        'mpost_office_bangla',
        'mvillage_bangla',
        'pdistrict_id_bangla',
        'pthana_id_bangla',
        'ppost_office_bangla',
        'pvillage_bangla',
        'ndistrict_id_bangla',
        'nthana_id_bangla',
        'npost_office_bangla',
        'nvillage_bangla',
        'identification',
        'conduct',
        'spouse_name_bangla'
    ];

    public function employee() : BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function org() : BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    public function mdistrict() : BelongsTo
    {
        return $this->belongsTo(District::class, 'mdistrict_id_bangla');
    }

    public function mthana() : BelongsTo
    {
        return $this->belongsTo(Thana::class, 'mthana_id_bangla');
    }

    public function pdistrict() : BelongsTo
    {
        return $this->belongsTo(District::class, 'pdistrict_id_bangla');
    }

    public function pthana() : BelongsTo
    {
        return $this->belongsTo(Thana::class, 'pthana_id_bangla');
    }

    public function ndistrict() : BelongsTo
    {
        return $this->belongsTo(District::class, 'ndistrict_id_bangla');
    }

    public function nthana() : BelongsTo
    {
        return $this->belongsTo(Thana::class, 'nthana_id_bangla');
    }

    public static function booted()
    {
        static::creating(function ($employeeb) {
            $employeeb->created_by = Auth::id();
            $employeeb->updated_by = Auth::id();
        });

        static::updating(function ($employeeb) {
            $employeeb->updated_by = Auth::id();
        });
    }

    public function scopeActive($query) {
        return $query->where('is_active', true);
    }

    public function scopeInactive($query) {
        return $query->where('is_active', false);
    }

    // protected static function newFactory(): Database\EmployeeBanglaFactory
    // {
    //     // return Database\EmployeeBanglaFactory::new();
    // }
}
