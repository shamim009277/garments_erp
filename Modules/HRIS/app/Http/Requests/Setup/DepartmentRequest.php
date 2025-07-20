<?php

namespace Modules\HRIS\Http\Requests\Setup;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'department' => 'required|string|max:100|unique:hris_setup_departments,department',
            'department_bn' => 'nullable|string|max:100|unique:hris_setup_departments,department_bn',
            'parent_department_id' => 'required|exists:hris_setup_parent_departments,id',
            'approved_mp' => 'nullable|numeric',
            'is_active' => 'nullable|boolean',
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
