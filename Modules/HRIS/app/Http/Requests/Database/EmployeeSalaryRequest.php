<?php

namespace Modules\HRIS\Http\Requests\Database;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeSalaryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'employee_id'        => 'required|exists:hris_database_employee_basic,employee_id',
            'org_id'             => 'required|exists:hris_setup_organizations,id',
            'gross_salary'       => 'required|numeric|min:0',
            'basic'              => 'required|numeric|min:0',
            'home_allowance'     => 'nullable|numeric|min:0',
            'medical_allowance'  => 'nullable|numeric|min:0',
            'food_allowance'     => 'nullable|numeric|min:0',
            'other_allowance'    => 'nullable|numeric|min:0',
            'conveyance'         => 'nullable|numeric|min:0',
            'attendance_bonus'   => 'nullable|numeric|min:0',
            'ot_payable'         => 'required|in:Y,N',
            'ot_rate'            => 'nullable|numeric|min:0',
            'holiday_allowance'  => 'required|in:Y,N',
            'salary_from_bank'   => 'required|in:Y,N',
            'account_no'         => 'nullable|string|max:255',
            'mobile_banking'     => 'nullable|string|max:255',
            'bank_name'          => 'nullable|string|max:255',
            'pf_member_date'     => 'nullable|date|required_if:pf_member,Y',
            'pf_close_date'      => 'nullable|date|after_or_equal:pf_member_date',
            'tin_no'             => 'nullable|string|max:100',
            'tax'                => 'nullable|numeric|min:0',
            'pf'                 => 'nullable|numeric|min:0',
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
