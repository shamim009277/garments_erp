<?php

namespace Modules\HRIS\Models\Tools;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\HRIS\Database\Factories\Tools\EditShiftingListFactory;

class EditShiftingList extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    // protected static function newFactory(): Tools\EditShiftingListFactory
    // {
    //     // return Tools\EditShiftingListFactory::new();
    // }
}
