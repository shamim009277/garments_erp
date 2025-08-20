<?php

namespace Modules\HRIS\Http\Requests\Database;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        // Common rules
        $rules = [
            'salaried' => 'required|in:Y,N',
            'name' => 'required|string|max:50',
            'department_id' => 'required|exists:hris_setup_departments,id',
            'designation_id' => 'required|exists:hris_setup_designations,id',
            'org_id' => 'required|exists:hris_setup_organizations,id',
            'unit' => 'nullable|string|max:50',
            'line' => 'nullable|integer|min:0',
            'grade' => 'nullable|integer|min:0',
            'shifting_duty' => 'nullable|in:Y,N',

            'mdistrict_id' => 'required|exists:hris_setup_districts,id',
            'mthana_id' => 'required|exists:hris_setup_thanas,id',
            'mpost_office' => 'required|string|max:255',
            'mvillage' => 'required|string|max:255',

            'pdistrict_id' => 'required|exists:hris_setup_districts,id',
            'pthana_id' => 'required|exists:hris_setup_thanas,id',
            'ppost_office' => 'required|string|max:255',
            'pvillage' => 'required|string|max:255',

            'joining_date' => 'required|date',
            'confirmation_date' => 'required|date|after_or_equal:joining_date',
            'punch_category' => 'required|in:1,2,3',
            'refrerence_shift' => 'required|in:A,B,C,D,E,F,G,M,N',
            'refrerence_holiday' => 'required|in:Sunday,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday',
            'refrerence_date' => 'nullable|date',
            'mtreturn_date' => 'nullable|date',

            'father_name' => 'nullable|string|max:50',
            'mother_name' => 'nullable|string|max:50',
            'spouse_name' => 'nullable|string|max:50',

            'leaving_date' => 'nullable|date|after_or_equal:joining_date',
            'leaving_note' => 'nullable|string|max:500',
            'present_address_duration' => 'nullable|string|max:100',

            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'signature' => 'nullable|image|mimes:jpg,jpeg,png|max:1024',
        ];

        // Extra rule for POST (store)
        if ($this->isMethod('post')) {
            $rules['employee_id'] = 'required|string|unique:hris_database_employee_basic,employee_id';
        }

        // Extra rule for PUT/PATCH (update)
        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $id = $this->route('employee'); // route model binding or 'employee' param
            $rules['employee_id'] = 'required|string|unique:hris_database_employee_basic,employee_id,' . $id;
        }

        return $rules;
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
