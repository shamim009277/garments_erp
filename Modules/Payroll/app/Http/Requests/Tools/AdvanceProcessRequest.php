<?php

namespace Modules\Payroll\Http\Requests\Tools;

use Illuminate\Foundation\Http\FormRequest;

class AdvanceProcessRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'title' => 'required',
            'org_id' => 'required',
            'month' => 'required',
            'year' => 'required',
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
