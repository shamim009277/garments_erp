<?php

namespace Modules\Payroll\Http\Requests\Tools;

use Illuminate\Foundation\Http\FormRequest;

class ProcessBonusRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'org_id' => 'required|integer',
            'year' => 'required|integer',
            'bonus_type' => 'required|in:1,2',
            'base_date' => 'required|date',
            'title' => 'required|integer',
            'slab1_months' => 'nullable|integer|min:0|max:12',
            'slab1_percent' => 'nullable|numeric|min:0|max:100',
            'slab2_months' => 'nullable|integer|min:0',
            'slab2_percent' => 'nullable|numeric|min:0|max:100',
            'slab3_months' => 'nullable|integer|min:0',
            'slab3_percent' => 'nullable|numeric|min:0|max:100',
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
