<?php

namespace Modules\IPE\Models\Setup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Modules\HRIS\Models\Setup\Department;
// use Modules\IPE\Database\Factories\Setup/QualityQuestionFactory;

class QualityQuestion extends Model
{
    use HasFactory;

    protected $table = 'ipe_setup_quality_questions';
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['sl','type','department_id','question','question_bn','answer','answer_bn','is_active'];

    public static function booted()
    {
        static::creating(function ($qualityQuestion) {
            $qualityQuestion->created_by = Auth::id();
            $qualityQuestion->updated_by = Auth::id();
        });

        static::updating(function ($qualityQuestion) {
            $qualityQuestion->updated_by = Auth::id();
        });
    }

    public function scopeActive($query) {
        return $query->where('is_active', true);
    }

    public function department() {
        return $this->belongsTo(Department::class, 'department_id');
    }
}
