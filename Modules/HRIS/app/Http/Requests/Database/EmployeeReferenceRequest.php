<?php

namespace Modules\HRIS\Http\Requests\Database;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeReferenceRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'employee_id' => 'required|exists:hris_database_employee_basic,employee_id',
            'name' => 'required|string|max:255',
            'mobile' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'know_about_company' => 'required|string|max:255',
            'reference_id' => 'nullable|exists:hris_database_employee_basic,employee_id',
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
