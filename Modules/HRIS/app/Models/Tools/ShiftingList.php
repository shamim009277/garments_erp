<?php

namespace Modules\HRIS\Models\Tools;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Modules\HRIS\Models\Database\Employee;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\HRIS\Database\Factories\Tools\ShiftingListFactory;

class ShiftingList extends Model
{
    use HasFactory;

    protected $table = 'hris_tools_shifting_list';

    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    public static function booted()
    {
        static::creating(function ($shifting_list) {
            $shifting_list->created_by = Auth::id();
            $shifting_list->updated_by = Auth::id();
        });

        static::updating(function ($shifting_list) {
            $shifting_list->updated_by = Auth::id();
        });
    }

    public function employeeBasic():BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'employee_id')->select('employee_id','name','joining_date');
    }
}
