<?php

namespace Modules\OrderManagement\Http\Requests\Setup;

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
            'yarn_count_name' => ['required', 'string', 'max:100', Rule::unique('inventory_setup_yarn_counts', 'yarn_count_name')->ignore($yarnCountId)],
            'yarn_count_description' => ['nullable', 'string'],
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
            'yarn_count_name.required' => 'Yarn Count Name is required.',
            'yarn_count_name.string' => 'Yarn Count Name must be a string.',
            'yarn_count_name.max' => 'Yarn Count Name must be less than 100 characters.',
            'yarn_count_name.unique' => 'Yarn Count Name must be unique.',
            'yarn_count_description.string' => 'Yarn Count Description must be a string.',
            'is_active.required' => 'Is active is required.',
            'is_active.boolean' => 'Is active must be a boolean.',
        ];
    }
}
