<?php

namespace Modules\HRIS\Models\Setup;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
// use Modules\HRIS\Database\Factories\Setup\EducationBoardFactory;

class EducationBoard extends Model
{
    use HasFactory;

    protected $table = 'hris_setup_educationboard';

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'is_active',
    ];

    public static function booted()
    {
        static::created(function ($educationBoard) {
            $educationBoard->created_by = Auth::user()->id;
        });

        static::updated(function ($educationBoard) {
            $educationBoard->updated_by = Auth::user()->id;
        });
    }

    // protected static function newFactory(): Setup\EducationBoardFactory
    // {
    //     // return Setup\EducationBoardFactory::new();
    // }
}
