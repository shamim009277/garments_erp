<?php

namespace Modules\HRIS\Http\Requests\Tools;

use Illuminate\Foundation\Http\FormRequest;

class DesignationChangeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'employee_id'       => ['required', 'integer', 'exists:hris_database_employee_basic,employee_id'],
            'designation_id'    => ['required', 'integer', 'exists:hris_setup_designations,id'],
            'org_id'            => ['required', 'integer', 'exists:hris_setup_organizations,id'],
            'department_id'     => ['required', 'integer', 'exists:hris_setup_departments,id'],
            'reason'            => ['nullable', 'string', 'max:255'],
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
