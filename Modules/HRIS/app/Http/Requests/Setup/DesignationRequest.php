<?php

namespace Modules\HRIS\Http\Requests\Setup;

use Illuminate\Foundation\Http\FormRequest;

class DesignationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $designationId = $this->route('designation');

        return [
            'designation' => 'required|string|max:100|unique:hris_setup_designations,designation' . ($designationId ? ',' . $designationId : ''),
            'designation_bn' => 'nullable|string|max:100',
            'parent_designation_id' => 'required|exists:hris_setup_parent_designations,id',
            'category_code' => 'required|string|size:1',
            'is_attn_bonus' => 'nullable|string|in:1,0',
            'attendance_bonus' => 'nullable|numeric|min:0',
            'tiffin_bill' => 'nullable|numeric|min:0',
            'night_bill1' => 'nullable|numeric|min:0',
            'night_bill2' => 'nullable|numeric|min:0',
            'night_bill3' => 'nullable|numeric|min:0',
            'min_gross' => 'nullable|numeric|min:0',
            'max_gross' => 'nullable|numeric|min:0',
            'grade' => 'nullable|integer|min:0',
            'approved_mp' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
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
