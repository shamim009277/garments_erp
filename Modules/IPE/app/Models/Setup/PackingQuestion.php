<?php

namespace Modules\IPE\Models\Setup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
// use Modules\IPE\Database\Factories\Setup/PackingQuestionFactory;

class PackingQuestion extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'ipe_setup_packing_questios';
    protected $fillable = ['sl', 'type', 'question', 'question_bn', 'answer', 'answer_bn', 'is_active'];

    public static function booted()
    {
        static::creating(function ($packingQuestion) {
            $packingQuestion->created_by = Auth::id();
            $packingQuestion->updated_by = Auth::id();
        });

        static::updating(function ($packingQuestion) {
            $packingQuestion->updated_by = Auth::id();
        });
    }

    public function scopeActive($query) {
        return $query->where('is_active', true);
    }
}
