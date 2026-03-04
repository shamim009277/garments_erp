<?php

namespace Modules\OrderManagement\Http\Requests\Setup;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PartNameRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        
        $partNameId = $this->route('partname');
        return [
            'part_name' => ['required', 'string', 'max:100', Rule::unique('om_setup_part_name', 'part_name')->ignore($partNameId)],
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
            'part_name.required' => 'Part name is required',
            'part_name.unique' => 'Part name already exists',
            'part_name.string' => 'Part name must be a string',
            'part_name.max' => 'Part name may not be greater than 100 characters',
            'is_active.required' => 'Is active is required',
            'is_active.boolean' => 'Is active must be a boolean',
        ];
    }
}
