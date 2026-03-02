<?php

namespace Modules\HRIS\Http\Requests\Setup;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CompanyShiftRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'org_id' => ['required', 'exists:hris_setup_organizations,id'],
            'shift' => ['required', 'size:1'],
            'shift_start' => ['nullable', 'regex:/^\d{2}:\d{2}(:\d{2})?$/'],
            'shift_end' => ['nullable', 'regex:/^\d{2}:\d{2}(:\d{2})?$/'],
            'break_start' => ['nullable', 'regex:/^\d{2}:\d{2}(:\d{2})?$/'],
            'break_end' => ['nullable', 'regex:/^\d{2}:\d{2}(:\d{2})?$/'],
            'break_duration' => ['nullable', 'string', 'max:10'],
            'break_duration_type' => ['nullable', 'in:1,2'],
            'late_after_minutes' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['boolean'],
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
