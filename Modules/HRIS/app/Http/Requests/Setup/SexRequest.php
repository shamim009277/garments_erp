<?php

namespace Modules\HRIS\Http\Requests\Setup;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class SexRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $sexId = $this->route('sex');

        return [
            'sex' => ['required', 'string', 'max:30', Rule::unique('hris_setup_sex', 'sex')->ignore($sexId)],
            'sx_code'  => ['required', 'string', 'max:10', Rule::unique('hris_setup_sex', 'sx_code')->ignore($sexId)],
            'sex_bangla' => ['required', 'string', 'max:30', Rule::unique('hris_setup_sex', 'sex_bangla')->ignore($sexId)],
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
