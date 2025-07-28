<?php

namespace Modules\HRIS\Http\Requests\Setup;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ShiftRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $shiftId = $this->route('shift');

        return [
            //'id' => ['nullable', 'exists:hris_setup_shifts,id', Rule::unique('hris_setup_shifts', 'shift')->ignore($shiftId)],
            'shift' => [
                'required',
                'size:1',
                Rule::unique('hris_setup_shifts', 'shift')->ignore($shiftId),
            ],
            'shift_start' => ['nullable', 'regex:/^\d{2}:\d{2}(:\d{2})?$/', Rule::unique('hris_setup_shifts', 'shift_start')->ignore($shiftId)],
            'shift_end' => ['nullable', 'regex:/^\d{2}:\d{2}(:\d{2})?$/', Rule::unique('hris_setup_shifts', 'shift_end')->ignore($shiftId)],
            'break_start' => ['nullable', 'regex:/^\d{2}:\d{2}(:\d{2})?$/', Rule::unique('hris_setup_shifts', 'break_start')->ignore($shiftId)],
            'break_end' => ['nullable', 'regex:/^\d{2}:\d{2}(:\d{2})?$/', Rule::unique('hris_setup_shifts', 'break_end')->ignore($shiftId)],
            'break_duration' => ['nullable', 'string', 'max:10'],
            'break_duration_type' => ['nullable', 'in:1,2'],
            'late_after_minutes' => ['nullable', 'integer', 'min:0'],
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
