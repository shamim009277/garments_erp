<?php

namespace Modules\HRIS\Http\Requests\Setup;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class LeaveClassificationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $leaveId = $this->route('leaveclassification');

        return [
            'id' => ['nullable', 'exists:hris_setup_leaveclassifications,id'],
            'code' => ['required', 'string', 'max:10', Rule::unique('hris_setup_leaveclassifications', 'code')->ignore($leaveId)],
            'signification' => ['nullable', 'string', 'max:100', Rule::unique('hris_setup_leaveclassifications', 'signification')->ignore($leaveId)],
            'signification_bn' => ['nullable', 'string', 'max:100', Rule::unique('hris_setup_leaveclassifications', 'signification_bn')->ignore($leaveId)],
            'yearly_limit' => ['nullable', 'numeric', 'min:0'],
            'max_permission' => ['nullable', 'numeric', 'min:0'],
            //'pay_ratio' => ['nullable', 'numeric', 'between:0,1'],
            'is_active' => ['boolean'],
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
