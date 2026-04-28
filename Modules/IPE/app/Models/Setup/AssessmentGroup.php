<?php

namespace Modules\IPE\Models\Setup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Modules\HRIS\Models\Setup\Designation;
// use Modules\IPE\Database\Factories\Setup/AssessmentGroupFactory;

class AssessmentGroup extends Model
{
    use HasFactory;

    protected $table = 'ipe_setup_assessment_groups';
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['name', 'code', 'designation_id', 'is_active'];

    public static function booted()
    {
        static::creating(function ($assessmentGroup) {
            $assessmentGroup->created_by = Auth::id();
            $assessmentGroup->updated_by = Auth::id();
        });

        static::updating(function ($assessmentGroup) {
            $assessmentGroup->updated_by = Auth::id();
        });
    }

    public function scopeActive($query) {
        return $query->where('is_active', true);
    }

    public function designations() {
        return $this->belongsTo(Designation::class, 'designation_id');
    }
}
