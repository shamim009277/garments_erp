<?php

namespace Modules\Inventory\Models\Setup;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
// use Modules\Inventory\Database\Factories\Setup/ColorGroupFactory;

class ColorGroup extends Model
{
    use HasFactory;
    // $table->string('group_code', 20)->unique();
    // $table->string('group_name', 100);
    // $table->boolean('is_active')->default(true);
    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'inventory_setup_color_groups';
    protected $fillable = ['group_code', 'group_name', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeInactive($query)
    {
        return $query->where('is_active', false);
    }

    //booted 
    protected static function booted()
    {
       //created
       static::created(function ($colorGroup) {
        $colorGroup->created_by = Auth::user()->id;
    });
    //updated
    static::updated(function ($colorGroup) {
        $colorGroup->updated_by = Auth::user()->id;
    });
    }
    // protected static function newFactory(): Setup/ColorGroupFactory
    // {
    //     // return Setup/ColorGroupFactory::new();
    // }
}
