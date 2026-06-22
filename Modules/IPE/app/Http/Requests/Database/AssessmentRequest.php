<?php

namespace Modules\IPE\Http\Requests\Database;

use Illuminate\Foundation\Http\FormRequest;

class AssessmentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'applicant_id' => 'required|integer|exists:hris_database_new_applicant,id',
            'degree_id' => 'required|integer|exists:hris_setup_degrees,id',
            'name' => 'required|string|max:255',
            'name_bangla' => 'required|string|max:255',
            'mobile' => 'required|string|max:11',
            'line' => 'required|integer|between:1,10',
            'designation_id' => 'required|integer|exists:hris_setup_designations,id',
            'exp_year' => 'nullable|integer|between:0,20',
            'exp_month' => 'nullable|integer|between:0,12',
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
