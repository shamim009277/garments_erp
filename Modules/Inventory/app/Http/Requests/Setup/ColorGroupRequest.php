<?php

namespace Modules\Inventory\Http\Requests\Setup;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ColorGroupRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $colorGroupId = $this->route('colorgroup');
        return [
            
            'group_name' => ['required', 'string', 'max:100', Rule::unique('inventory_setup_color_groups', 'group_name')->ignore($colorGroupId)],
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
            'group_name.required' => 'Group Name is required',
            'is_active.required' => 'Status is required',
        ];
    }
    
}
