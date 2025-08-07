<?php

namespace Modules\Inventory\Http\Requests\Setup;

use Illuminate\Foundation\Http\FormRequest;

class ForwardApprovePannelRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'organization_id' => 'required|exists:hris_setup_organizations,id',
            'user_id' => 'required|exists:users,id',
            'access_level' => 'required|in:1,2,3,4,5',
            'is_active' => 'required|string'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    //messages
    public function messages(): array
    {
        return [
            'organization_id.required' => 'Organization is required',
            'organization_id.exists' => 'Organization does not exist',
            'user_id.required' => 'User is required',
            'user_id.exists' => 'User does not exist',
            'access_type.required' => 'Access type is required',
            'is_active.required' => 'Is active is required',
            'is_active.boolean' => 'Is active must be a boolean',
        ];
    }
}
