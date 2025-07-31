<?php

namespace Modules\HRIS\Http\Requests\Database;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class EmployeeServiceRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $today = Carbon::today()->toDateString();
        return [
            'employee_id'   => ['required', 'exists:hris_database_employee_basic,employee_id'],
            'designation'   => ['required', 'string', 'max:255'],
            'organization'  => ['required', 'string', 'max:255'],
            'join_date'     => ['required', 'date', "before:$today"],
            'leave_date'    => ['required', 'date', "before:$today", 'after_or_equal:join_date'],
            'leave_reason'  => ['nullable', 'string', 'max:255'],
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
