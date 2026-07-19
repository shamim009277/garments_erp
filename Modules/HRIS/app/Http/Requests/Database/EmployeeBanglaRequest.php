<?php

namespace Modules\HRIS\Http\Requests\Database;

use Illuminate\Foundation\Http\FormRequest;
use Modules\HRIS\Models\Database\EmployeeBangla;

class EmployeeBanglaRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $employeeId = $this->input('employee_id');
        $existing = EmployeeBangla::where('employee_id', $employeeId)->first();

        $employeeIdRule = $existing
            ? 'required|integer|unique:hris_database_employee_bangla,employee_id,' . $existing->id
            : 'required|integer|unique:hris_database_employee_bangla,employee_id';
        return [
            'employee_id'            => $employeeIdRule,
            'org_id'                 => 'required|exists:hris_setup_organizations,id',
            'name_bangla'            => 'required|string|max:255',
            'fname_bangla'           => 'nullable|string|max:255',
            'mname_bangla'           => 'nullable|string|max:255',
            'nname_bangla'           => 'nullable|string|max:255',
            'nominee_relation'       => 'nullable|string|max:255',
            'nmobile_number'         => 'nullable|string|max:255',
            'national_id_bangla'     => 'nullable|string|max:255',
            'mdistrict_id_bangla'    => 'required|exists:hris_setup_districts,id',
            'mthana_id_bangla'       => 'required|exists:hris_setup_thanas,id',
            'mpost_office_bangla'    => 'required|string|max:255',
            'mvillage_bangla'        => 'required|string|max:255',
            'pdistrict_id_bangla'    => 'required|exists:hris_setup_districts,id',
            'pthana_id_bangla'       => 'required|exists:hris_setup_thanas,id',
            'ppost_office_bangla'    => 'required|string|max:255',
            'pvillage_bangla'        => 'required|string|max:255',
            'ndistrict_id_bangla'    => 'nullable|exists:hris_setup_districts,id',
            'nthana_id_bangla'       => 'nullable|exists:hris_setup_thanas,id',
            'npost_office_bangla'    => 'nullable|string|max:255',
            'nvillage_bangla'        => 'nullable|string|max:255',
            'identification'         => 'nullable|string|max:255',
            'conduct'                => 'nullable|string|max:255',
            'spouse_name_bangla'     => 'nullable|string|max:255',
            'emergency_name'         => 'nullable|string|max:255',
            'emergency_relation'     => 'nullable|string|max:255',
            'emergency_address'      => 'nullable|string|max:255',
            'emergency_mobile'       => 'nullable|string|max:255',
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
