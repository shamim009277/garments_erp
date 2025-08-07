<?php

namespace Modules\Inventory\Http\Requests\Setup;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class YarnCountRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $yarnCountId = $this->route('yarnCount');
        return [
            'yarn_count' => ['required', 'string', 'max:100', Rule::unique('inventory_setup_yarn_counts', 'yarn_count')->ignore($yarnCountId)],
            'description' => ['nullable', 'string'],
            'is_active' => ['required', 'boolean'],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    public function messages(): array
    {
        return [
            'yarn_count.required' => 'Yarn Count is required.',
            'yarn_count.string' => 'Yarn Count must be a string.',
            'yarn_count.max' => 'Yarn Count must be less than 100 characters.',
            'yarn_count.unique' => 'Yarn Count must be unique.',
            'description.string' => 'Description must be a string.',
            'is_active.required' => 'Is active is required.',
            'is_active.boolean' => 'Is active must be a boolean.',
        ];
    }
}
