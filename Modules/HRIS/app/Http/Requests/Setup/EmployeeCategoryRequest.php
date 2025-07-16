<?php

namespace Modules\HRIS\Http\Requests\Setup;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class EmployeeCategoryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $employeeCategoryId = $this->route('employeecategory');

        return [
            'category' => ['required', 'string', 'max:30', Rule::unique('hris_setup_employee_categories', 'category')->ignore($employeeCategoryId)],
            'category_bn' => ['nullable', 'string', 'max:30'],
            'category_code' => ['required', 'string', 'max:10', Rule::unique('hris_setup_employee_categories', 'category_code')->ignore($employeeCategoryId)],
            'is_active' => ['required', 'boolean'],
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
