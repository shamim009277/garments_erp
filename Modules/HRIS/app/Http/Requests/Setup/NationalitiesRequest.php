<?php

namespace Modules\HRIS\Http\Requests\Setup;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class NationalitiesRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $nationalitiesId = $this->route('nationality');
        return [
            'nationality' => ['required', 'string', 'max:30', Rule::unique('hris_setup_nationalities', 'nationality')->ignore($nationalitiesId)],
            'nl_code'  => ['required', 'string', 'max:10', Rule::unique('hris_setup_nationalities', 'nl_code')->ignore($nationalitiesId)],
            'nationality_bangla' => ['required', 'string', 'max:30', Rule::unique('hris_setup_nationalities', 'nationality_bangla')->ignore($nationalitiesId)],
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
