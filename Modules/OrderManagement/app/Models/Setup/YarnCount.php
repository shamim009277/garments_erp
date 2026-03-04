<?php

namespace Modules\OrderManagement\Models\Setup;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
// use Modules\Inventory\Database\Factories\Setup/YarnCountFactory;

class YarnCount extends Model
{
    use HasFactory;

    // $table->string('yarn_count_code', 20)->unique(); // Like YC001
    // $table->string('yarn_count_name', 100);
    // $table->string('yarn_count_description')->nullable();
    // $table->boolean('is_active')->default(true);

    protected $table = 'inventory_setup_yarn_counts';
    protected $fillable = [
        'yarn_count_code',
        'yarn_count_name',
        'yarn_count_description',
        'is_active',
    ];

    // protected static function newFactory(): Setup/YarnCountFactory
    // {
    //     // return Setup/YarnCountFactory::new();
    // }
    //booted
    protected static function booted()
    {
        static::created(function ($yarnCount) {
            $yarnCount->created_by = Auth::user()->id;
        });

        static::updated(function ($yarnCount) {
            $yarnCount->updated_by = Auth::user()->id;
        });
    }
}
