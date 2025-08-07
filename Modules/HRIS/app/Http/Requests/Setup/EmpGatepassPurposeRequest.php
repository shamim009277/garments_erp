<?php

namespace Modules\HRIS\Http\Requests\Setup;

use Illuminate\Foundation\Http\FormRequest;

class EmpGatepassPurposeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $id = $this->route('gatepass_purpose') ?? $this->input('id');
        return [
            'purpose' => 'required|string|unique:hris_setup_emp_gatepass_purpose,purpose,' . $id,
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
