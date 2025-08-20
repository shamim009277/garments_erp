<?php

namespace Modules\HRIS\Models\Tools;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\HRIS\Database\Factories\Tools\ShiftingListFactory;

class ShiftingList extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    // protected static function newFactory(): Tools\ShiftingListFactory
    // {
    //     // return Tools\ShiftingListFactory::new();
    // }
}
