<?php

namespace Modules\HRIS\Http\Requests\Database;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ApplicantRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $applicantId = $this->route('new_applicant')?->id ?? $this->route('new_applicant');
        return [
            'name' => ['required', 'string', 'max:255'],
            'org_id' => ['required', 'integer'],
            'name_bangla' => ['nullable', 'string', 'max:255'],
            'mobile' => ['required', 'string', 'max:15','regex:/^(?:\01)?(?:\d{11})$/',Rule::unique('hris_database_new_applicant', 'mobile')->ignore($applicantId)],
            'department_id' => ['required', 'integer'],
            'designation_id' => ['required', 'integer'],
            'district_id' => ['required', 'integer'],
            'line' => ['required', 'integer','min:0'],
            'identification_type' => ['required', 'integer'],
            'national_id' => ['nullable', 'string', 'max:17','regex:/[0-9]{10,17}/',Rule::unique('hris_database_new_applicant', 'national_id')->ignore($applicantId)],
            'birth_certificate_no' => ['nullable', 'string', 'max:30','regex:/[0-9]{10,30}/',Rule::unique('hris_database_new_applicant', 'birth_certificate_no')->ignore($applicantId)],
            'interviewer_employee_id' => ['nullable', 'integer'],
            'interview_status' => ['nullable', 'string', 'max:255'],
            'joining_date' => ['nullable', 'date'],
            'birth_date' => ['nullable', 'date'],
            'entry_date' => ['nullable', 'date'],
            'proposed_salary' => ['nullable', 'numeric'],
            'determined_salary' => ['nullable', 'numeric'],
            'final_designation_id' => ['nullable', 'integer'],
            'remarks' => ['nullable', 'string', 'max:255'],
            'recruitment_type' => ['nullable', 'string', 'max:255'],
            'replace_id' => ['nullable', 'integer'],
            'file_entry' => ['nullable', 'string', 'max:255'],
            'ipe_assessment_required' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
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
