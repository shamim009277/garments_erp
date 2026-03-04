<?php

namespace Modules\SM\Models\Setup;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class Line extends Model
{
    use HasFactory;

    protected $table = 'sm_setup_lines';

    protected $fillable = [
        'line_code',
        'name',
        'description',
        'is_active',
        'created_by',
        'updated_by',
    ];

    public static function booted()
    {
        static::created(function ($line) {
            $line->created_by = Auth::id();
            $line->saveQuietly();
        });

        static::updated(function ($line) {
            $line->updated_by = Auth::id();
            $line->saveQuietly();
        });
    }

    public function sewingLine()
    {
        return $this->hasOne(SewingLine::class, 'line_id');
    }
}
