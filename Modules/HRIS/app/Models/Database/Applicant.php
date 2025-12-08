<?php

namespace Modules\HRIS\Models\Database;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Modules\HRIS\Models\Setup\District;
use Modules\HRIS\Models\Setup\Department;
use Modules\HRIS\Models\Setup\Designation;
use Modules\HRIS\Models\Setup\Organization;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\HRIS\Models\Database\Employee;
// use Modules\HRIS\Database\Factories\Database\ApplicantFactory;

class Applicant extends Model
{
    use HasFactory;

    protected $table = 'hris_database_new_applicant';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'org_id',
        'name_bangla',
        'mobile',
        'department_id',
        'designation_id',
        'district_id',
        'identification_type',
        'national_id',
        'birth_certificate_no',
        'interviewer_employee_id',
        'interview_status',
        'joining_date',
        'birth_date',
        'entry_date',
        'proposed_salary',
        'determined_salary',
        'final_designation_id',
        'remarks',
        'recruitment_type',
        'replace_id',
        'file_entry',
        'ipe_assessment_required',
        'is_active',
        'final_status',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'identification_type' => 'integer',
        'proposed_salary' => 'decimal:2',
        'determined_salary' => 'decimal:2',
        'is_active' => 'boolean',
        'ipe_assessment_required' => 'boolean',
    ];

    protected $dates = [
        'joining_date',
        'entry_date',
        'birth_date',
    ];

    protected $appends = [
        'interview_status_label',
    ];

    public function organization() : BelongsTo
    {
        return $this->belongsTo(Organization::class,'org_id','id');
    }

    public function getInterviewStatusLabelAttribute()
    {
        return $this->interview_status;
    }

    public static function booted()
    {
        static::creating(function ($applicant) {
            $applicant->created_by = Auth::id();
            $applicant->updated_by = Auth::id();
        });

        static::updating(function ($applicant) {
            $applicant->updated_by = Auth::id();
        });
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeNoFileEntry($query)
    {
        return $query->where('file_entry', 'N');
    }

    public function scopeFileEntry($query)
    {
        return $query->where('file_entry', 'Y');
    }

    public function department() : BelongsTo
    {
        return $this->belongsTo(Department::class,'department_id','id');
    }

    public function designation() : BelongsTo
    {
        return $this->belongsTo(Designation::class,'designation_id','id');
    }

    public function district() : BelongsTo
    {
        return $this->belongsTo(District::class,'district_id','id');
    }
    public function employee() : BelongsTo
    {
        return $this->belongsTo(Employee::class,'employee_id','id');
    }

    // protected static function newFactory(): Database\ApplicantFactory
    // {
    //     // return Database\ApplicantFactory::new();
    // }
}
