<?php

namespace Modules\HRIS\Http\Requests\Setup;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class DivisionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $divisionId = $this->route('division');

        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('hris_setup_divisions', 'name')->ignore($divisionId)],
            'bn_name' => ['required', 'string', 'max:255', Rule::unique('hris_setup_divisions', 'bn_name')->ignore($divisionId)],
            'is_active' => 'required|boolean',
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
