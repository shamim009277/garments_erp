<?php

namespace Modules\IPE\Models\Setting;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Modules\HRIS\Models\Setup\Department;
use Modules\HRIS\Models\Setup\Organization;
// use Modules\IPE\Database\Factories\Setting/AssessmentAccessFactory;

class AssessmentAccess extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'ipe_settings_assessment_access';

    protected $fillable = ['org_id','user_id','department_id','type'];

    public static function booted()
    {
        static::creating(function ($assessmentAccess) {
            $assessmentAccess->created_by = Auth::id();
            $assessmentAccess->updated_by = Auth::id();
        });

        static::updating(function ($assessmentAccess) {
            $assessmentAccess->updated_by = Auth::id();
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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'org_id');
    }
}
