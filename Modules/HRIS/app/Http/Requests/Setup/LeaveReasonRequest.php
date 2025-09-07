<?php

namespace Modules\HRIS\Http\Requests\Setup;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LeaveReasonRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $leavereasonId = $this->route('leavereason');
        return [
            'reason' => ['required', 'string', Rule::unique('hris_setup_leavereason', 'reason')->ignore($leavereasonId)],
            'classification_id' => ['required', 'array'],
            'classification_id.*' => ['required', 'exists:hris_setup_leaveclassifications,code'],
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
