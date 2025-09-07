<?php

namespace Modules\HRIS\Http\Requests\Setup;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UnitRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $unitId = $this->route('unit');
        return [
            'unit' => ['required', 'string', Rule::unique('hris_setup_units', 'unit')->ignore($unitId)],
            'code' => ['required', 'string', Rule::unique('hris_setup_units', 'code')->ignore($unitId)],
            'line_id' => ['required', 'array', 'exists:hris_setup_lines,id'],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
