<?php

namespace Modules\OrderManagement\Models\Setup;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Modules\HRIS\Models\Setup\Organization;

class Team extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'om_setup_team';
    protected $fillable = [
        'team_name',
        'organization_id',
        'is_active',
        'created_by',
        'updated_by',
    ];

    //booted
    protected static function booted()
    {
        static::created(function ($team) {
            $team->created_by = Auth::user()->id;
        });

        static::updated(function ($team) {
            $team->updated_by = Auth::user()->id;
        });
    }

    //organization relationship
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function members()
    {
        return $this->hasMany(TeamMember::class, 'team_id');
    }
}
