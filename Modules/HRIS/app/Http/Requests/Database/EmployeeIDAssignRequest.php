<?php

namespace Modules\HRIS\Http\Requests\Database;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeIDAssignRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'applicant_id' => 'required|exists:hris_database_new_applicant,id',
            'final_designation_id' => 'required|exists:hris_setup_designations,id',
            'employee_id' => 'required|regex:/^[0-9]{6,8}$/|unique:hris_database_new_applicant,employee_id',
            'recruitment_type' => 'required|in:N,R',
            'replace_id' => 'nullable|regex:/^[0-9]{6,8}$/',
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
