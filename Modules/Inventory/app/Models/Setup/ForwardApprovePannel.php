<?php

namespace Modules\Inventory\Models\Setup;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
// use Modules\Inventory\Database\Factories\Setup/ForwardApprovePannelFactory;

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
        'user_id',
        'created_by',  
        'updated_by'
    ];

    public static function booted()
    {
        static::created(function ($forwardApprovePannel) {
            $forwardApprovePannel->created_by = Auth::user()->id;
        });

        static::updated(function ($forwardApprovePannel) {
            $forwardApprovePannel->updated_by = Auth::user()->id;
        });
    }
    // protected static function newFactory(): Setup/ForwardApprovePannelFactory
    // {
    //     // return Setup/ForwardApprovePannelFactory::new();
    // }
}
