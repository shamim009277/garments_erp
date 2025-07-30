<?php

namespace Modules\HRIS\Http\Requests\Setup;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class DegreeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $degreeId = $this->route('degree');
        return [
            'degree' => ['required', 'string', 'max:255', Rule::unique('hris_setup_degrees', 'degree')->ignore($degreeId)],
            'degree_bangla' => ['required', 'string', 'max:255', Rule::unique('hris_setup_degrees', 'degree_bangla')->ignore($degreeId)],
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
}
