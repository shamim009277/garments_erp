<?php

namespace Modules\Payroll\Models\Tools;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReadMachineData extends Model
{
    use HasFactory;
    protected $table = 'payroll_tools_read_machinedata';

    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = ['id'];

    public static function booted()
    {
        static::creating(function ($readmachinedata) {
            $readmachinedata->created_by = Auth::id();
            $readmachinedata->updated_by = Auth::id();
        });

        static::updating(function ($readmachinedata) {
            $readmachinedata->updated_by = Auth::id();
        });
    }
}
