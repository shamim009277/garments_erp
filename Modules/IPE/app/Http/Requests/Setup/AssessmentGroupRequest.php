<?php

namespace Modules\IPE\Http\Requests\Setup;

use Illuminate\Foundation\Http\FormRequest;

class AssessmentGroupRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $id = $this->route('id') ?? $this->route('assessment_group');

        return [
            'name' => 'required|string|max:100',
            'code' => 'required|string|max:100',
            'designation_id' => 'required|array',
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
