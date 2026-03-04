<?php

namespace Modules\OrderManagement\Http\Requests\Setup;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class TeamRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        
        $teamId = $this->route('team');
        return [
            'team_name' => ['required', 'string', 'max:100', Rule::unique('om_setup_team', 'team_name')->ignore($teamId)],
            'organization_id' => 'nullable|exists:hris_setup_organizations,id',
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
    //messages
    public function messages(): array
    {
        return [
            'team_name.required' => 'Team name is required',
            'team_name.unique' => 'Team name already exists',
            'team_name.string' => 'Team name must be a string',
            'team_name.max' => 'Team name may not be greater than 100 characters',
            'organization_id.exists' => 'Selected organization does not exist',
            'is_active.required' => 'Is active is required',
            'is_active.boolean' => 'Is active must be a boolean',
        ];
    }
}
