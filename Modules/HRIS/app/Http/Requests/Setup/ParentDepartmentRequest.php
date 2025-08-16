<?php

namespace Modules\HRIS\Http\Requests\Setup;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ParentDepartmentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $parentDepartmentId = $this->route('parentdepartment');

        return [
            'department' => ['required', 'string', 'max:100', Rule::unique('hris_setup_parent_departments', 'department')->ignore($parentDepartmentId)],
            'department_bn' => ['nullable', 'string', 'max:100', Rule::unique('hris_setup_parent_departments', 'department_bn')->ignore($parentDepartmentId)],
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
