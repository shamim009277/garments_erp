<?php

namespace Modules\OrderManagement\Http\Requests\Setup;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AccessoriesRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $accessoriesId = $this->route('accessories');
        return [
            'accessories_name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('om_setup_accessories', 'accessories_name')->ignore($accessoriesId),
            ],
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
            'accessories_name.required' => 'Accessories name is required',
            'accessories_name.string' => 'Accessories name must be a string',
            'accessories_name.max' => 'Accessories name may not be greater than 255 characters',
            'accessories_name.unique' => 'Accessories name already exists',
            'organization_id.exists' => 'Selected organization does not exist',
            'is_active.required' => 'Is active is required',
            'is_active.boolean' => 'Is active must be a boolean',
        ];
    }
}
