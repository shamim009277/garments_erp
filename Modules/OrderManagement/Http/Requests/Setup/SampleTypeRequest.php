<?php

namespace Modules\OrderManagement\Http\Requests\Setup;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SampleTypeRequest extends FormRequest
{
    public function rules(): array
    {
        $sampleTypeId = $this->route('sampletype');
        return [
            'sample_type_name' => ['required', 'string', 'max:100', Rule::unique('om_setup_sample_types', 'sample_type_name')->ignore($sampleTypeId)],
            'sample_type_description' => 'nullable|string',
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
            'sample_type_name.required' => 'Sample Type Name is required.',
            'sample_type_name.string' => 'Sample Type Name must be a string.',
            'sample_type_name.max' => 'Sample Type Name must be less than 100 characters.',
            'sample_type_name.unique' => 'Sample Type Name must be unique.',
            'sample_type_description.string' => 'Sample Type Description must be a string.',
            'is_active.required' => 'Is active is required.',
            'is_active.boolean' => 'Is active must be a boolean.',
        ];
    }
}
