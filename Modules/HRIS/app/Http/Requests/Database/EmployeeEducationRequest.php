<?php

namespace Modules\HRIS\Http\Requests\Database;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeEducationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'employee_id' => 'required|exists:hris_database_employee_basic,employee_id',
            'degree_id' => 'required|exists:hris_setup_degrees,id',
            'passing_year' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'institute' => 'required|string|max:255',
            'institute_bangla' => 'nullable|string|max:255',
            'board' => 'required|string|max:100',
            'result_type' => 'required|in:D,C,G',
            'obtain_degree' => 'nullable|string|max:20',
            'obtain_cgpa' => 'nullable|string|max:20',
            'obtain_grade' => 'nullable|string|max:20',
            'is_active' => 'nullable|boolean',
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
