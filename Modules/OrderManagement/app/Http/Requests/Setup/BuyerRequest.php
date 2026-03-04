<?php

namespace Modules\OrderManagement\Http\Requests\Setup;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class BuyerRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        
        $buyerId = $this->route('buyer');
        return [
            'buyer_name' => ['required', 'string', 'max:100', Rule::unique('inventory_setup_buyer', 'buyer_name')->ignore($buyerId)],
            // 'buyer_type' => ['required', 'string', Rule::in(['Local', 'Foreign', 'Both', 'Buying House', 'Retail', 'Online Seller'])],
            'contact_person' => 'nullable|string',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'mobile' => 'nullable|string',
            'fax' => 'nullable|string',
            'address' => 'nullable|string',
            'country_id' => 'nullable|exists:inventory_setup_goods_setup_country,id',
            'website' => 'nullable|string',
            'is_active' => 'required|boolean',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    //messages
    public function messages(): array
    {
        return [
            'buyer_name.required' => 'Buyer name is required',
            'buyer_name.unique' => 'Buyer name already exists',
            // 'buyer_type.required' => 'Buyer type is required',
            'buyer_type.in' => 'Buyer type is invalid',
            'contact_person.string' => 'Contact person must be a string',
            'email.email' => 'Email must be a valid email address',
            'phone.string' => 'Phone must be a string',
            'mobile.string' => 'Mobile must be a string',
            'fax.string' => 'Fax must be a string',
            'address.string' => 'Address must be a string',
            'country_id.exists' => 'Country does not exist',
            'website.string' => 'Website must be a string',
            'is_active.required' => 'Is active is required',
            'is_active.boolean' => 'Is active must be a boolean',
        ];
    }
}
