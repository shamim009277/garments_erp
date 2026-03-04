<?php

namespace Modules\SM\Http\Requests\Setup;

use Illuminate\Foundation\Http\FormRequest;

class SewingGroupRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'group_id' => 'required|exists:sm_setup_groups,id',
            'is_active' => 'required|boolean',
            'employee_ids' => 'nullable|array',
            'employee_ids.*' => 'exists:hris_database_employee_basic,employee_id',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
