<?php

namespace Modules\OrderManagement\Http\Requests\Setup;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class WashTypeRequest extends FormRequest
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
        $washTypeId = $this->route('washtype'); 
        return [
            'wash_type_name' => ['required', 'string', 'max:100', Rule::unique('om_setup_wash_types', 'wash_type_name')->ignore($washTypeId)],
            'wash_type_description' => 'nullable|string',
            'is_active' => 'required|boolean',
        ];
    }
}
