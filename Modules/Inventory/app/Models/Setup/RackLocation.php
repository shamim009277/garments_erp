<?php

namespace Modules\Inventory\Models\Setup;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
// use Modules\Inventory\Database\Factories\Setup/RackLocationFactory;

class RackLocation extends Model
{
    use HasFactory;
    protected $table = 'inventory_setup_rack_locations';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'rack_name',
        'rack_code',
        'aisle',
        'row',
        'column',
        'floor_level',
        'store_line_id',
        'description',
        'is_active',
        'created_by',
        'updated_by',
    ];

   //booted
   protected static function booted()
   {
       static::created(function ($sex) {
           $sex->created_by = Auth::user()->id;
       });

       static::updated(function ($sex) {
           $sex->updated_by = Auth::user()->id;
       });
   }
}
