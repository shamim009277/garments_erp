<?php

namespace Modules\OrderManagement\Http\Requests\Database;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class InitialOrderRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $orderId = $this->route('initialorder');
        return [
            'buyer_id' => 'required|exists:inventory_setup_buyer,id',
            'description' => 'nullable|string',
            'organization_id' => 'nullable|exists:hris_setup_organizations,id',
            'order_quantity' => 'nullable|integer|min:0',
            'style' => 'nullable|string|max:100',
            'gsm' => 'nullable|string|max:50',
            'po' => 'nullable|string|max:100',
            'seasson' => 'nullable|string|max:100',
            'fabrication' => 'nullable|string|max:100',
            'finish_type' => 'nullable|string|max:100',
            'instructions' => 'nullable|string',
            'color_id[].*' => 'nullable|exists:inventory_setup_colors,id',
            'size_id[].*' => 'nullable|exists:inventory_setup_size,id',
            'order_type_id' => 'nullable|exists:om_setup_order_type,id',
            'merchant_id' => 'nullable|exists:hris_database_employee_basic,id',
            'yarn_count_id' => 'nullable|exists:inventory_setup_yarn_counts,id',
            'product_category_id' => 'nullable|exists:inventory_setup_product_categories,id',
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
            'organization_id.exists' => 'Selected organization does not exist',
            'order_quantity.integer' => 'Order quantity must be a number',
            'order_quantity.min' => 'Order quantity must be at least 0',
            'style.max' => 'Style must not exceed 100 characters',
            'gsm.max' => 'GSM must not exceed 50 characters',
            'po.max' => 'PO must not exceed 100 characters',
            'seasson.max' => 'Season must not exceed 100 characters',
            'fabrication.max' => 'Fabrication must not exceed 100 characters',
            'finish_type.max' => 'Finish type must not exceed 100 characters',
            'color_id.exists' => 'Selected color does not exist',
            'size_id.exists' => 'Selected size does not exist',
            'order_type_id.exists' => 'Selected order type does not exist',
            'merchant_id.exists' => 'Selected merchant does not exist',
            'yarn_count_id.exists' => 'Selected yarn count does not exist',
            'product_category_id.exists' => 'Selected product category does not exist',
        ];
    }
}
