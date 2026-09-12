<?php

namespace Modules\Commercial\Models\Setup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
// use Modules\Commercial\Database\Factories\Setup\PaymentMethodFactory;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $table = 'commercial_setup_payment_method';
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['name', 'description', 'is_active', 'created_by', 'updated_by'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public static function booted()
    {
        static::creating(function ($paymentMethod) {
            $paymentMethod->created_by = Auth::id();
            $paymentMethod->updated_by = Auth::id();
        });

        static::updating(function ($paymentMethod) {
            $paymentMethod->updated_by = Auth::id();
        });
    }

    public function scopeActive($query) {
        return $query->where('is_active', true);
    }

}
