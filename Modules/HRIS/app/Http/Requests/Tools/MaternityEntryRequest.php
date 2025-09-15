<?php

namespace Modules\HRIS\Http\Requests\Tools;

use Illuminate\Foundation\Http\FormRequest;

class MaternityEntryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'employee_id' => 'required',
            'notice_date' => 'required|date',
            'application_date' => 'required|date',
            'possible_delivery_date' => 'nullable|date',
            'leave_start_date' => 'required|date',
            'leave_end_date' => 'required|date',
            'leave_days' => 'required|numeric',
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
