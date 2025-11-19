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
