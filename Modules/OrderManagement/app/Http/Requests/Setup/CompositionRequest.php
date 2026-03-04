<?php

namespace Modules\OrderManagement\Http\Requests\Setup;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CompositionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $compositionId = $this->route('composition');
        return [
            'composition_name' => ['required', 'string', 'max:100', Rule::unique('inventory_setup_compositions', 'composition_name')->ignore($compositionId)],
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
            'composition_name.required' => 'Composition Name is required.',
            'composition_name.string' => 'Composition Name must be a string.',
            'composition_name.max' => 'Composition Name must be less than 100 characters.',
            'composition_name.unique' => 'Composition Name must be unique.',
            'description.string' => 'Description must be a string.',
            'is_active.required' => 'Is active is required.',
            'is_active.boolean' => 'Is active must be a boolean.',
        ];
    }
}
