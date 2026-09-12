<?php

namespace Modules\Commercial\Models\Database;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Commercial\Database\Factories\Database\SalesContactFactory;

class SalesContact extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    // protected static function newFactory(): Database\SalesContactFactory
    // {
    //     // return Database\SalesContactFactory::new();
    // }
}
