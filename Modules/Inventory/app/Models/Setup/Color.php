<?php

namespace Modules\Inventory\Models\Setup;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
// use Modules\Inventory\Database\Factories\Setup/ColorFactory;

class Color extends Model
{
    use HasFactory;
    protected $table = 'inventory_setup_colors';
    protected $fillable = ['color_code', 'color_name', 'color_hex', 'color_group_id', 'is_active'];

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
    //Get Color Group
    public function colorGroup()
    {
        return $this->belongsTo(ColorGroup::class, 'color_group_id');
    }

    //booted 
    protected static function booted()
    {
       //created
       static::created(function ($color) {
        $color->created_by = Auth::user()->id;
    });
    //updated
    static::updated(function ($color) {
        $color->updated_by = Auth::user()->id;
    });
    
    }

    
}
