<?php

namespace Modules\OrderManagement\Http\Requests\Setup;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FabricSourceRequest extends FormRequest
{
    public function rules(): array
    {
        // Adjust 'fabricsource' based on the route parameter name
        $fabricSourceId = $this->route('fabricsource'); 

        return [
            'fabric_source_name' => ['required', 'string', 'max:100', Rule::unique('om_setup_fabric_sources', 'fabric_source_name')->ignore($fabricSourceId)],
            'fabric_source_description' => 'nullable|string',
            'is_active' => 'required|boolean',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'fabric_source_name.required' => 'Fabric Source Name is required.',
            'fabric_source_name.string' => 'Fabric Source Name must be a string.',
            'fabric_source_name.max' => 'Fabric Source Name must be less than 100 characters.',
            'fabric_source_name.unique' => 'Fabric Source Name must be unique.',
            'fabric_source_description.string' => 'Fabric Source Description must be a string.',
            'is_active.required' => 'Is active is required.',
            'is_active.boolean' => 'Is active must be a boolean.',
        ];
    }
}
