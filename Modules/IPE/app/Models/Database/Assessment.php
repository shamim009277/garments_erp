<?php

namespace Modules\IPE\Models\Database;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
// use Modules\IPE\Database\Factories\Database/AssessmentFactory;

class Assessment extends Model
{
    use HasFactory;

    protected $table = 'ipe_database_new_assessment';
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['org_id','applicant_id','name','name_bangla','mobile','department_id','designation_id','entry_date','degree_id','exp_year','exp_month','line','is_active'];

    public static function booted()
    {
        static::creating(function ($assessment) {
            $assessment->created_by = Auth::id();
            $assessment->updated_by = Auth::id();
        });

        static::updating(function ($assessment) {
            $assessment->updated_by = Auth::id();
        });

        static::addGlobalScope('accessFilter', function ($query) {
            if (Auth::check()) {
                $accessId = Auth::user()->access_id;

                if ($accessId != 0) {
                    $query->where('org_id', $accessId);
                }
            }
        });
    }

    public function scopeActive($query) {
        return $query->where('is_active', true);
    }

}
