<?php

namespace Modules\IPE\Models\Database;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Modules\IPE\Models\Database\Assessment;
use Modules\IPE\Models\Setup\MachineProcess;
use Modules\IPE\Models\Setup\MachineType;
use Modules\IPE\Models\Setup\Process;
// use Modules\IPE\Database\Factories\Database\AssessmentMachineProcessFactory;

class AssessmentMachineProcess extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * 
     * @var array<int, string>
     */
    protected $table = 'ipe_database_assessment_machine_processes';

    protected $fillable = [
        'assessment_id','process_id','machine_id','declare','cycle_one','cycle_two','cycle_three','cycle_four','cycle_five','average','smv','target','efficiency','is_active'
    ];

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

    public function processName() {
        return $this->belongsTo(MachineProcess::class, 'process_id');
    }

    public function machineName() {
        return $this->belongsTo(MachineType::class, 'machine_id');
    }

    
}
