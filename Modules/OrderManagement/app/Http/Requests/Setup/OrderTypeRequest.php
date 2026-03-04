<?php

namespace Modules\OrderManagement\Http\Requests\Setup;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class OrderTypeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        
        $orderTypeId = $this->route('ordertype');
        return [
            'order_type' => ['required', 'string', 'max:100', Rule::unique('om_setup_order_type', 'order_type')->ignore($orderTypeId)],
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
            'order_type.required' => 'Order type is required',
            'order_type.unique' => 'Order type already exists',
            'order_type.string' => 'Order type must be a string',
            'order_type.max' => 'Order type may not be greater than 100 characters',
            'is_active.required' => 'Is active is required',
            'is_active.boolean' => 'Is active must be a boolean',
        ];
    }
}
