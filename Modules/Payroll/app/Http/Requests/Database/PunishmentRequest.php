<?php

namespace Modules\Payroll\Http\Requests\Database;

use Illuminate\Foundation\Http\FormRequest;

class PunishmentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'employee_id' => 'required',
            'punishment_date' => 'required|array',
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
