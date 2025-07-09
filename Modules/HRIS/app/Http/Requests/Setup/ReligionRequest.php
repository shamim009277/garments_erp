<?php

namespace Modules\HRIS\Http\Requests\Setup;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ReligionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $religionId = $this->route('religion');

        return [
            'religion' => ['required', 'string', 'max:30', Rule::unique('hris_setup_religions', 'religion')->ignore($religionId)],
            'religion_code'  => ['required', 'string', 'max:10', Rule::unique('hris_setup_religions', 'religion_code')->ignore($religionId)],
            'religion_bangla' => ['required', 'string', 'max:30', Rule::unique('hris_setup_religions', 'religion_bangla')->ignore($religionId)],
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
