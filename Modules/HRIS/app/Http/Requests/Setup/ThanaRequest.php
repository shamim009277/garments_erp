<?php

namespace Modules\HRIS\Http\Requests\Setup;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ThanaRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $thanaId = $this->route('thana');

        return [
            'district_id' => 'required|exists:hris_setup_districts,id',
            'name' => ['required', 'string', 'max:255', Rule::unique('hris_setup_thanas', 'name')->ignore($thanaId)],
            'bn_name' => ['required', 'string', 'max:255', Rule::unique('hris_setup_thanas', 'bn_name')->ignore($thanaId)],
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
