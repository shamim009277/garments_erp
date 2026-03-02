<?php

namespace Modules\HRIS\Models\Tools;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Modules\HRIS\Models\Setup\Department;
use Modules\HRIS\Models\Database\Employee;
use Modules\HRIS\Models\Setup\Designation;
use Modules\HRIS\Models\Setup\Organization;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\HRIS\Database\Factories\Tools\MaternityEntryFactory;

class MaternityEntry extends Model
{
    use HasFactory;

    protected $table = 'hris_tools_maternity_entry';

    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = ['id'];

    public static function booted()
    {
        static::creating(function ($line) {
            $line->created_by = Auth::id();
            $line->updated_by = Auth::id();
        });

        static::updating(function ($line) {
            $line->updated_by = Auth::id();
        });
    }

    public function employeeBasic() : BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'employee_id');
    }

    public function designation() : BelongsTo
    {
        return $this->belongsTo(Designation::class);
    }

    public function department() : BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function organization() : BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }
}
