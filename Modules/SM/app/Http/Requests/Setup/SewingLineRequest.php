<?php

namespace Modules\SM\Http\Requests\Setup;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SewingLineRequest extends FormRequest
{
    public function rules(): array
    {
        $rules = [
            'line_id' => [
                'required',
                'exists:sm_setup_lines,id',
            ],
            'line_incharge_id' => 'required|exists:hris_database_employee_basic,employee_id',
            'total_machine' => 'required|integer|min:0',
            'is_active' => 'required|boolean',
            'group_ids' => 'nullable|array',
            'group_ids.*' => 'exists:sm_setup_groups,id',
        ];

        // If creating, line_id must be unique in sewing_lines table
        if ($this->isMethod('post')) {
            $rules['line_id'][] = 'unique:sm_setup_sewing_lines,line_id';
        }

        // If updating, ignore current record
        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $sewingLineId = $this->route('sewing_line'); // Assuming route parameter is 'sewing_line'
            // We can't easily use unique ignore on line_id because it's a foreign key, but logic holds.
            // Actually, if we are updating, we might not even allow changing the line_id.
            // But if we do, we need to ignore the current record's line_id.
            $rules['line_id'][] = Rule::unique('sm_setup_sewing_lines', 'line_id')->ignore($sewingLineId);
        }

        return $rules;
    }

    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'line_id.unique' => 'This Line is already configured. Please edit the existing configuration.',
        ];
    }
}
