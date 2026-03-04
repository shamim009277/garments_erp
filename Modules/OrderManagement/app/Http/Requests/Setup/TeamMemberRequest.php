<?php

namespace Modules\OrderManagement\Http\Requests\Setup;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class TeamMemberRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $teamMemberId = $this->route('teammember');
        return [
            'team_id' => 'required|exists:om_setup_team,id',
            'merchant_id' => 'required|exists:hris_database_employee_basic,id',
            'is_leader' => 'required|boolean',
            'is_assistant' => 'required|boolean',
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

    /**
     * Get custom error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'team_id.required' => 'Team is required',
            'team_id.exists' => 'Selected team does not exist',
            'merchant_id.required' => 'Merchant is required',
            'merchant_id.exists' => 'Selected merchant does not exist',
            'is_leader.required' => 'Is leader field is required',
            'is_leader.boolean' => 'Is leader must be a boolean',
            'is_assistant.required' => 'Is assistant field is required',
            'is_assistant.boolean' => 'Is assistant must be a boolean',
            'is_active.required' => 'Is active is required',
            'is_active.boolean' => 'Is active must be a boolean',
        ];
    }
}
