<?php

namespace App\Http\Requests\Administration;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ModuleRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $moduleId = $this->route('module');
        return [
            'name' => ['required', 'string', Rule::unique('modules', 'name')->ignore($moduleId)],
            'url'  => ['required', 'string', Rule::unique('modules', 'url')->ignore($moduleId)],
            'image' => ['nullable', 'string'],
            'is_active' => ['required', 'boolean'],
        ];
    }
}
