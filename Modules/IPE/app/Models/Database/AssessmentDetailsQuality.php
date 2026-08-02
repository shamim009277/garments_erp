<?php

namespace Modules\IPE\Models\Database;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Modules\IPE\Models\Database\Assessment;
// use Modules\IPE\Database\Factories\Database/AssessmentDetailsQualityFactory;

class AssessmentDetailsQuality extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'ipe_database_assessment_details_quality';

    protected $fillable = ['assessment_id','question_id','sl','answer','status','is_active'];

    public static function booted()
    {
        static::creating(function ($assessment) {
            $assessment->created_by = Auth::id();
            $assessment->updated_by = Auth::id();
        });

        static::updating(function ($assessment) {
            $assessment->updated_by = Auth::id();
        });
    }

    public function scopeActive($query) {
        return $query->where('is_active', true);
    }

    public function assessment() {
        return $this->belongsTo(Assessment::class, 'assessment_id');
    }
}
