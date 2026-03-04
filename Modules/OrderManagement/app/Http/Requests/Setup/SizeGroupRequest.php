<?php

namespace Modules\OrderManagement\Http\Requests\Setup;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SizeGroupRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $sizeGroupId = $this->route('sizegroup');
        return [
            'size_group_name' => ['required', 'string', 'max:100', Rule::unique('inventory_setup_size_group', 'size_group_name')->ignore($sizeGroupId)],
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
    public function messages()
    {
        return [
            'size_group_name.required' => 'Size Group Name is required',
            'size_group_name.unique' => 'Size Group Name already exists',
            'is_active.required' => 'Status is required',
        ];
    }
}
