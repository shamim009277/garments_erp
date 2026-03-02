<?php

namespace Modules\Payroll\Http\Requests\Database;

use Illuminate\Foundation\Http\FormRequest;

class AdvanceRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'employee_id' => 'required',
            'refund_start_date' => 'required|date',
            'advance_amount' => 'required|numeric',
            'installment_size' => 'required|numeric',
            'reason' => 'required|string|max:255',
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
