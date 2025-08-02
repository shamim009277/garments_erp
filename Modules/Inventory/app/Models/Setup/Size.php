<?php

namespace Modules\Inventory\Models\Setup;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
// use Modules\Inventory\Database\Factories\Setup/SizeFactory;

class Size extends Model
{
    use HasFactory;
    protected $table = 'inventory_setup_size';
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'size_code',
        'size_name',
        'size_rank',
        'is_active',
        'created_by',
        'updated_by',
    ];
    // booted
    protected static function booted()
    {
        static::created(function ($size) {
            $size->created_by = Auth::user()->id;
        });

        static::updated(function ($size) {
            $size->updated_by = Auth::user()->id;
        });
    }
    public function sizeGroup()
    {
        return $this->belongsTo(SizeGroup::class, 'size_group_id');
    }
    // protected static function newFactory(): Setup/SizeFactory
    // {
    //     // return Setup/SizeFactory::new();
    // }
}
