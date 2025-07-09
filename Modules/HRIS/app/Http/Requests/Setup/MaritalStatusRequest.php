<?php

namespace Modules\HRIS\Http\Requests\Setup;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class MaritalStatusRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $maritalStatusId = $this->route('maritalstatus');
        return [
            'maritalstatus' => ['required', 'string', 'max:30', Rule::unique('hris_setup_maritalstatus', 'maritalstatus')->ignore($maritalStatusId)],
            'ms_code'  => ['required', 'string', 'max:10', Rule::unique('hris_setup_maritalstatus', 'ms_code')->ignore($maritalStatusId)],
            'maritalstatus_bangla' => ['required', 'string', 'max:30', Rule::unique('hris_setup_maritalstatus', 'maritalstatus_bangla')->ignore($maritalStatusId)],
            'is_active' => ['required', 'boolean'],
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
