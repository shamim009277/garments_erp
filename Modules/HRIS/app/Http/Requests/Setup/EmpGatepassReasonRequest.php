<?php

namespace Modules\HRIS\Http\Requests\Setup;

use Illuminate\Foundation\Http\FormRequest;

class EmpGatepassReasonRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $id = $this->route('gatepass_reason') ?? $this->input('id');
        return [
            'reason' => 'required|string|unique:hris_setup_emp_gatepass_reason,reason,' . $id,
            'purpose_id' => 'required|exists:hris_setup_emp_gatepass_purpose,id',
            'reason_for' => 'required|in:1,2,3',
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
