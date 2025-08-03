<?php

namespace Modules\HRIS\Http\Requests\Setup;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class DistrictRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
{
        $districtId = $this->route('district');

        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('hris_setup_districts', 'name')->ignore($districtId)],
            'division_id' => 'required|exists:hris_setup_divisions,id',
            'bn_name' => ['required', 'string', 'max:255', Rule::unique('hris_setup_districts', 'bn_name')->ignore($districtId)],
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
