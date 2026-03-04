<?php

namespace Modules\OrderManagement\Http\Requests\Setup;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ColorRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        // dd('This is the rules method of ColorRequest');
        $colorId = $this->route('color');
        return [
            'color_name' => ['required', 'string', 'max:100', Rule::unique('inventory_setup_colors', 'color_name')->ignore($colorId)],
            'color_hex' => 'nullable|string|max:7',
            'color_group_id' => 'required|exists:inventory_setup_color_groups,id',
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

    public function messages()
    {
        return [
            'color_name.required' => 'Color Name is required',
            'color_group_id.required' => 'Color Group is required',
            'is_active.required' => 'Status is required',
        ];
    }
}
