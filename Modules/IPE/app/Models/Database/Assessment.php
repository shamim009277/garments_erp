<?php

namespace Modules\IPE\Models\Database;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Modules\HRIS\Models\Database\Applicant;
use Modules\HRIS\Models\Setup\Department;
use Modules\HRIS\Models\Setup\Designation;
use Modules\IPE\Models\Database\AssessmentDetailsHelper;
use Modules\IPE\Models\Database\AssessmentDetailsQuality;
use Modules\IPE\Models\Database\AssessmentMachineProcess;
use Modules\IPE\Models\Database\AssessmentProcess;
// use Modules\IPE\Database\Factories\Database/AssessmentFactory;

class Assessment extends Model
{
    use HasFactory;

    protected $table = 'ipe_database_new_assessment';
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['org_id','applicant_id','assessment_date','name','name_bangla','mobile','department_id','designation_id','entry_date','degree_id','exp_year','exp_month','line','total_marks','get_marks','efficiency','is_done','is_active'];

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

    public function details(){
        return $this->hasMany(AssessmentDetailsHelper::class,'assessment_id','id');
    }

    public function detailsQuality(){
        return $this->hasMany(AssessmentDetailsQuality::class,'assessment_id','id');
    }

    public function processes(){
        return $this->hasMany(AssessmentProcess::class,'assessment_id','id');
    }

    public function machineProcesses(){
        return $this->hasMany(AssessmentMachineProcess::class,'assessment_id','id');
    }

    public function designation(){
        return $this->belongsTo(Designation::class,'designation_id','id');
    }

    public function department(){
        return $this->belongsTo(Department::class,'department_id','id');
    }

    public function applicant() {
        return $this->belongsTo(Applicant::class, 'applicant_id',);
    }

    public function scopeActive($query) {
        return $query->where('is_active', true);
    }

}
