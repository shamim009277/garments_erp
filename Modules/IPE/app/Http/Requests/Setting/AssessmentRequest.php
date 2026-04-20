<?php

namespace Modules\IPE\Http\Requests\Setting;

use Illuminate\Foundation\Http\FormRequest;

class AssessmentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'org_id' => 'required|integer|exists:hris_setup_organizations,id',
            'user_id' => 'required|integer|exists:users,id',
            'department_id' => 'required|integer|exists:hris_setup_departments,id',
            'type' => 'required|integer|in:1,2',
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
