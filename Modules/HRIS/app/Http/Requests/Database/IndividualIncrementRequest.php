<?php

namespace Modules\HRIS\Http\Requests\Database;

use Illuminate\Foundation\Http\FormRequest;

class IndividualIncrementRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'employee_id' => 'required|string|max:20',
            'increment_type_id' => 'required|integer|exists:hris_setup_increment_types,id',
            'increment_date' => 'required|date',
            'effective_date' => 'required|date',
            'arrear_upto_date' => 'nullable|date',
            'new_designation_id' => 'required|integer|exists:hris_setup_designations,id',
            'new_department_id' => 'required|integer|exists:hris_setup_departments,id',
            'increment_amount' => 'required|numeric|min:0',
            'current_salary' => 'required|numeric|min:0',
            'remarks' => 'nullable|string|max:500',
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
