<?php

namespace Modules\HRIS\Http\Requests\Database;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeTrainingRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'employee_id' => 'required|exists:hris_database_employee_basic,employee_id',
            'training_name' => 'required|string|max:255',
            'organization' => 'required|string|max:255',
            'duration' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
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
