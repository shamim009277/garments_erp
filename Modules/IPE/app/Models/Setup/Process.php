<?php

namespace Modules\IPE\Models\Setup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
// use Modules\IPE\Database\Factories\Setup/ProcessFactory;

class Process extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'ipe_setup_process';
    protected $fillable = [
        'process', 'process_code', 'process_name', 'process_name_bn', 'item', 'capacity', 'time', 'is_active'
    ];

    public static function booted()
    {
        static::creating(function ($process) {
            $process->created_by = Auth::id();
            $process->updated_by = Auth::id();
        });

        static::updating(function ($process) {
            $process->updated_by = Auth::id();
        });
    }

    public function scopeActive($query) {
        return $query->where('is_active', true);
    }
}
