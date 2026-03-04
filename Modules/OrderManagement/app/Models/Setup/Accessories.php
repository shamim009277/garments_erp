<?php

namespace Modules\OrderManagement\Models\Setup;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\HRIS\Models\Setup\Organization;
use Illuminate\Support\Facades\Auth;

class Accessories extends Model
{
    use HasFactory;

    protected $table = 'om_setup_accessories';
    protected $fillable = [
        'accessories_name',
        'organization_id',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }

    // protected static function booted()
    // {
    //     static::creating(function ($model) {
    //         $model->created_by = Auth::id();
    //     });

    //     static::updating(function ($model) {
    //         $model->updated_by = Auth::id();
    //     });
    // }
}
