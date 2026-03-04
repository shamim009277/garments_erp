<?php

namespace Modules\OrderManagement\Http\Requests\Setup;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class BuyerMerchantRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $buyerMerchantId = $this->route('buyermerchant');
        return [
            'buyer_id' => 'required|exists:inventory_setup_buyer,id',
            'merchant_id' => 'required|exists:hris_database_employee_basic,id',
            'organization_id' => 'nullable|exists:hris_setup_organizations,id',
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

    /**
     * Get custom error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'buyer_id.required' => 'Buyer is required',
            'buyer_id.exists' => 'Selected buyer does not exist',
            'merchant_id.required' => 'Merchant is required',
            'merchant_id.exists' => 'Selected merchant does not exist',
            'organization_id.exists' => 'Selected organization does not exist',
            'is_active.required' => 'Is active is required',
            'is_active.boolean' => 'Is active must be a boolean',
        ];
    }
}
