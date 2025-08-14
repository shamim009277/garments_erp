<?php

namespace Modules\HRIS\Models\Tools;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\HRIS\Database\Factories\Tools\DesignationChangeFactory;

class DesignationChange extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    // protected static function newFactory(): Tools\DesignationChangeFactory
    // {
    //     // return Tools\DesignationChangeFactory::new();
    // }
}
