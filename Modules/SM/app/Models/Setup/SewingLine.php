<?php

namespace Modules\SM\Models\Setup;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Modules\HRIS\Models\Database\Employee;

class SewingLine extends Model
{
    use HasFactory;

    protected $table = 'sm_setup_sewing_lines';

    protected $fillable = [
        'line_id',
        'line_incharge_id',
        'total_machine',
        'is_active',
        'created_by',
        'updated_by',
    ];

    public static function booted()
    {
        static::creating(function ($model) {
            $model->created_by = Auth::id();
            $model->updated_by = Auth::id();
        });

        static::updating(function ($model) {
            $model->updated_by = Auth::id();
        });
    }

    public function line()
    {
        return $this->belongsTo(Line::class, 'line_id');
    }

    public function incharge()
    {
        return $this->belongsTo(Employee::class, 'line_incharge_id', 'employee_id');
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'sm_setup_sewing_line_groups', 'sewing_line_id', 'group_id')
                    ->withTimestamps();
    }
}
