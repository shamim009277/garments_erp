<?php

namespace Modules\HRIS\Http\Requests\Database;

use Illuminate\Foundation\Http\FormRequest;

class EmpGatePassRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'employee_id'   => ['required'],
            'department_id' => ['required', 'integer', 'exists:hris_setup_departments,id'],
            'designation_id'=> ['required', 'integer', 'exists:hris_setup_designations,id'],
            'date'          => ['required', 'date', 'after_or_equal:today'],
            'purpose_id'    => ['required', 'integer', 'exists:hris_setup_emp_gatepass_purpose,id'],
            'reason_id'     => ['required', 'integer', 'exists:hris_setup_emp_gatepass_reason,id'],
            'type_id'       => ['required', 'integer', 'in:1,2'], // 1=Short Time, 2=Full Day
            'start_time'    => ['required', 'date_format:H:i'],
            'end_time'      => ['nullable', 'date_format:H:i', 'after:start_time'],
            'actual_in'     => ['nullable', 'date_format:H:i'],
            'actual_out'    => ['nullable', 'date_format:H:i'],
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
