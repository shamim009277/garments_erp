<?php

namespace Modules\IPE\Models\Setup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
// use Modules\IPE\Database\Factories\Setup/HelperQuestionFactory;

class HelperQuestion extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'ipe_setup_helper_questions';
    protected $fillable = ['sl', 'question', 'question_bn', 'answer', 'answer_bn', 'is_active'];

    public static function booted()
    {
        static::creating(function ($assessmentAccess) {
            $assessmentAccess->created_by = Auth::id();
            $assessmentAccess->updated_by = Auth::id();
        });

        static::updating(function ($assessmentAccess) {
            $assessmentAccess->updated_by = Auth::id();
        });
    }

    public function scopeActive($query) {
        return $query->where('is_active', true);
    }

    
}
