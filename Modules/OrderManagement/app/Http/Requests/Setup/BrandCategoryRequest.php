<?php

namespace Modules\OrderManagement\Http\Requests\Setup;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class BrandCategoryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $brandCategoryId = $this->route('brandcategory');
        return [
            'category_name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('om_setup_brand_category', 'category_name')->ignore($brandCategoryId),
            ],
            'category_code' => 'nullable|string|max:255',
            'organization_id' => 'nullable|exists:hris_setup_organizations,id',
            'is_active' => 'required|boolean',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get custom error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'category_name.required' => 'Category name is required',
            'category_name.string' => 'Category name must be a string',
            'category_name.max' => 'Category name may not be greater than 255 characters',
            'category_name.unique' => 'Category name already exists',
            'category_code.string' => 'Category code must be a string',
            'category_code.max' => 'Category code may not be greater than 255 characters',
            'organization_id.exists' => 'Selected organization does not exist',
            'is_active.required' => 'Is active is required',
            'is_active.boolean' => 'Is active must be a boolean',
        ];
    }
}
