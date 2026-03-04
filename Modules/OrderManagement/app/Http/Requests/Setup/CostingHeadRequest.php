<?php

namespace Modules\OrderManagement\Http\Requests\Setup;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CostingHeadRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $costingHeadId = $this->route('costingheads');
        return [
            'costing_head_name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('om_setup_costing_head', 'costing_head_name')->ignore($costingHeadId),
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
            'costing_head_name.required' => 'Costing head name is required',
            'costing_head_name.string' => 'Costing head name must be a string',
            'costing_head_name.max' => 'Costing head name may not be greater than 255 characters',
            'costing_head_name.unique' => 'Costing head name already exists',
            'organization_id.exists' => 'Selected organization does not exist',
            'is_active.required' => 'Is active is required',
            'is_active.boolean' => 'Is active must be a boolean',
        ];
    }
}
