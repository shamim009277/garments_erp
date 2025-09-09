<?php

namespace Modules\HRIS\Http\Requests\Database;

use Illuminate\Foundation\Http\FormRequest;
use Modules\HRIS\Models\Database\EmployeePersonal;

class EmployeePersonalRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules() : array
{
        $validatedEmployeeId = $this->input('employee_id');
        $existing = EmployeePersonal::where('employee_id', $validatedEmployeeId)->first();
        $employeeIdRule = $existing
            ? 'required|integer|unique:hris_database_employee_personal,employee_id,' . $existing->id
            : 'required|integer|unique:hris_database_employee_personal,employee_id';

        return [
            'employee_id'             => $employeeIdRule,
            'org_id'                  => 'required|exists:hris_setup_organizations,id',
            'assestment_id'           => 'nullable|string|max:255',
            'mobile'                  => 'nullable|string|max:20',
            'phone'                   => 'nullable|string|max:20',
            'email'                   => 'nullable|email|max:255',
            'birth_date'              => 'nullable|date',
            'birth_district_id'       => 'nullable|exists:hris_setup_districts,id',
            'degree_id'               => 'nullable|exists:hris_setup_degrees,id',
            'blood_group'             => 'nullable|string|max:10',
            'nationality_code'        => 'nullable|string|max:10',
            'religion_code'           => 'nullable|string|max:10',
            'marital_status'          => 'nullable|string|max:20',
            'sex_code'                => 'nullable|string|max:10',
            'height'                  => 'nullable|string|max:10',
            'weight'                  => 'nullable|string|max:10',
            'national_id'             => 'nullable|string|max:20',
            'birth_certificate'       => 'nullable|string|max:20',
            'no_of_son'               => 'nullable|integer|min:0',
            'no_of_daughter'          => 'nullable|integer|min:0',
            'childern_under_5_years'  => 'nullable|integer|min:0',
            'service_book_no'         => 'nullable|string|max:50',
            'service_book_date'       => 'nullable|date',
            'nominee_nid'             => 'nullable|string|max:20',
            'nominee_name'            => 'nullable|string|max:255',
            'nominee_mobile'          => 'nullable|string|max:20',
            'relation'                => 'nullable|string|max:50',
            'ndistrict_id'            => 'nullable|exists:hris_setup_districts,id',
            'nthana_id'               => 'nullable|exists:hris_setup_thanas,id',
            'npost_office'            => 'nullable|string|max:255',
            'nvillage'                => 'nullable|string|max:255',
            'emergency_name'          => 'nullable|string|max:100',
            'emergency_relation'      => 'nullable|string|max:50',
            'emergency_address'       => 'nullable|string|max:255',
            'emergency_mobile'        => 'nullable|string|max:20',
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
