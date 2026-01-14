<?php

namespace Modules\Payroll\Http\Requests\Tools;

use Illuminate\Foundation\Http\FormRequest;

class AttendenceAdjustmentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'title' => 'required',
            'organization_id' => 'required|integer',
            'employee_id' => 'nullable|integer',
            'month' => 'required|integer',
            'year' => 'required|integer',
            'adjust_type' => 'required|integer',
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
