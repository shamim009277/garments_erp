<?php

namespace Modules\OrderManagement\Http\Requests\Setup;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SampleTypeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $sampleTypeId = $this->route('sampletype'); 
        return [
            'sample_type_name' => ['required', 'string', 'max:100', Rule::unique('om_setup_sample_types', 'sample_type_name')->ignore($sampleTypeId)],
            'sample_type_description' => 'nullable|string',
            'is_active' => 'required|boolean',
        ];
    }
}
