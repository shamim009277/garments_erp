<?php

namespace Modules\HRIS\Http\Requests\Setup;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class OrganizationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $organizationId = $this->route('organization');
        return [
            'name' => ['required', 'string', 'max:200', Rule::unique('hris_setup_organizations', 'name')->ignore($organizationId)],
            'bn_name' => ['nullable', 'string', 'max:200'],
            'short_name' => ['required', 'string', 'max:30', Rule::unique('hris_setup_organizations', 'short_name')->ignore($organizationId)],
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
