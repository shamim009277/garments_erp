<?php

namespace Modules\Commercial\Models\Database;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
// use Modules\Commercial\Database\Factories\Database\SalesContactFactory;

class SalesContact extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'commercial_database_sales_contacts';

    protected $fillable = [
        'organization_id',
        'contact_no',
        'date',
        'is_active',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public static function booted()
    {
        static::creating(function ($contact) {
            $contact->created_by = Auth::id();
            $contact->updated_by = Auth::id();
        });

        static::updating(function ($contact) {
            $contact->updated_by = Auth::id();
        });
    }

    public function scopeActive($query) {
        return $query->where('is_active', true);
    }

    public function salesVersions() : HasMany
    {
        return $this->hasMany(SalesContactVersion::class);
    }

}
