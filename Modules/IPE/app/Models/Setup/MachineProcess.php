<?php

namespace Modules\IPE\Models\Setup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
// use Modules\IPE\Database\Factories\Setup/MachineProcessFactory;

class MachineProcess extends Model
{
    use HasFactory;


    protected $table = 'ipe_setup_machine_processes';
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['type_id','process_type','process','process_code','process_name','process_name_bn','item','capacity', 'time', 'is_active'];

    public static function booted()
    {
        static::creating(function ($machineprocess) {
            $machineprocess->created_by = Auth::id();
            $machineprocess->updated_by = Auth::id();
        });

        static::updating(function ($machineprocess) {
            $machineprocess->updated_by = Auth::id();
        });
    }

    public function scopeActive($query) {
        return $query->where('is_active', true);
    }

    public function machineType(){
        return $this->belongsTo(MachineType::class,'type_id','id');
    }
}
