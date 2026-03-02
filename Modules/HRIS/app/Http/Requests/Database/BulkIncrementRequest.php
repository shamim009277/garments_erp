<?php

namespace Modules\HRIS\Http\Requests\Database;

use Illuminate\Foundation\Http\FormRequest;

class BulkIncrementRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'org_id' => 'required',
            'department_id' => 'nullable|exists:hris_setup_departments,id',
            'employee_category_id' => 'nullable',
            'designation_id' => 'required|array|exists:hris_setup_designations,id',
            'joining_date_from' => 'required|date',
            'joining_date_to' => 'required|date',
            'increment_date' => 'required|date',
            'effective_date' => 'required|date',
            'arrear_upto_date' => 'nullable|date',
            'increment_source' => 'required',
            'increment_value_type' => 'required',
            'remarks' => 'nullable|string|max:255',
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
