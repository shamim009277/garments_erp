<?php

namespace Modules\IPE\Models\Setup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class MachineType extends Model
{
    use HasFactory;

    protected $table = 'ipe_setup_machine_types';
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name','name_bn', 'is_active'
    ];

    public static function booted()
    {
        static::creating(function ($machine) {
            $machine->created_by = Auth::id();
            $machine->updated_by = Auth::id();
        });

        static::updating(function ($machine) {
            $machine->updated_by = Auth::id();
        });
    }

    public function scopeActive($query) {
        return $query->where('is_active', true);
    }
}
