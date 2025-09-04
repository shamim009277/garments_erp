<?php

namespace Modules\Inventory\Models\Setup;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
// use Modules\Inventory\Database\Factories\Setup/ForwardApprovePannelFactory;
use Modules\HRIS\Models\Setup\Organization;
use App\Models\User;

class ForwardApprovePannel extends Model
{
    use HasFactory;

    protected $table = 'inventory_setup_forward_approve_pannels';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'employee_id',
        'email',
        'is_active',
        'access_level',
        'organization_id',
        'user_id'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public static function booted()
    {
        static::creating(function ($forwardApprovePannel) {
            $forwardApprovePannel->created_by = Auth::id();
            $forwardApprovePannel->updated_by = Auth::id();
        });

        static::updating(function ($forwardApprovePannel) {
            $forwardApprovePannel->updated_by = Auth::id();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
    
    // protected static function newFactory(): Setup/ForwardApprovePannelFactory
    // {
    //     // return Setup/ForwardApprovePannelFactory::new();
    // }
}
