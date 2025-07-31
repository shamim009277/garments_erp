<?php

namespace Modules\Inventory\Http\Requests\Setup;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BuyerRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        // dd('This is the rules method of BuyerRequest');
        $buyerId = $this->route('buyers');
            // $table->string('buyer_name')->unique();
            // $table->string('country')->nullable();
            // $table->string('email')->nullable();
            // $table->string('phone')->nullable();
            // $table->string('address')->nullable();
            // $table->string('status')->default('active');
            // $table->string('created_by')->nullable();
            // $table->string('updated_by')->nullable();
        return [
            'buyer_name' => ['required', 'string', 'max:30', Rule::unique('inventory_setup_buyer', 'buyer_name')->ignore($buyerId)],
            'country'  => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'max:60', Rule::unique('inventory_setup_buyer', 'email')->ignore($buyerId)],
            'phone' => ['required', 'string'],
            'address' => ['required', 'string'],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
