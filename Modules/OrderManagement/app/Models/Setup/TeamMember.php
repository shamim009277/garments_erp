<?php

namespace Modules\OrderManagement\Models\Setup;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Modules\OrderManagement\Models\Setup\Team;
use Modules\HRIS\Models\Database\Employee;

class TeamMember extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'om_setup_team_member';
    protected $fillable = [
        'team_id',
        'merchant_id',
        'is_leader',
        'is_assistant',
        'is_active',
        'created_by',
        'updated_by',
    ];

    //booted
    protected static function booted()
    {
        static::created(function ($teamMember) {
            $teamMember->created_by = Auth::user()->id;
        });

        static::updated(function ($teamMember) {
            $teamMember->updated_by = Auth::user()->id;
        });
    }

    //relationships
    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function merchant()
    {
        return $this->belongsTo(Employee::class, 'merchant_id');
    }
}
