<?php

namespace Modules\HRIS\Http\Requests\Setup;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ParentDesignationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $parentDesignationId = $this->route('parentdesignation');

        return [
            'parent_designation' => ['required', 'string', 'max:100', Rule::unique('hris_setup_parentdesignation', 'parent_designation')->ignore($parentDesignationId)],
            'parent_designation_bn' => ['nullable', 'string', 'max:100', Rule::unique('hris_setup_parentdesignation', 'parent_designation_bn')->ignore($parentDesignationId)],
            'approved_mp' => ['nullable', 'integer'],
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
