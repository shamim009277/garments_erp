<?php

namespace App\Http\Requests\Master\Setup;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UnitRequest extends FormRequest
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
        $unitId = $this->route('unit');
        return [
            'name' => ['required', 'string', Rule::unique('master_setup_units', 'name')->ignore($unitId)],
            'code' => ['required', 'string', Rule::unique('master_setup_units', 'code')->ignore($unitId)],
            'conversion_rate' => ['required', 'numeric', 'min:0'],
            'root_id' => ['nullable', 'exists:master_setup_units,id'],
            'is_active' => ['required', 'boolean'],
        ];
    }
}
