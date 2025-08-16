<?php

namespace Modules\HRIS\Http\Requests\Database;

use Illuminate\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Modules\HRIS\Models\Database\LeaveApplication;

class LeaveApplicationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'employee_id'    => 'required|integer|exists:hris_database_employee_basic,employee_id',
            'department_id'  => 'required|integer|exists:hris_setup_departments,id',
            'designation_id' => 'required|integer|exists:hris_setup_designations,id',
            'leave_type_id'  => 'required|in:SL,CL,EL,ML,SPL,LWOP',
            'reason_id'      => 'required|integer|exists:hris_setup_leavereason,id',
            'application_date' => 'required|date',
            'start_date'     => 'required|date|after_or_equal:application_date',
            'end_date'       => 'required|date|after_or_equal:start_date',
            'days'           => 'required|integer|min:1',
            'remarks'        => 'nullable|string',
        ];
    }

    public function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {

            $employeeId = $this->employee_id;
            $startDate  = $this->start_date;
            $endDate    = $this->end_date;

            if ($employeeId && $startDate && $endDate) {

                $query = LeaveApplication::where('employee_id', $employeeId)
                    ->where(function ($q) use ($startDate, $endDate) {
                        $q->whereBetween('start_date', [$startDate, $endDate])
                          ->orWhereBetween('end_date', [$startDate, $endDate])
                          ->orWhere(function ($q2) use ($startDate, $endDate) {
                              $q2->where('start_date', '<=', $startDate)
                                 ->where('end_date', '>=', $endDate);
                          });
                    });

                if ($this->route('leaveApplication')) {
                    $query->where('id', '!=', $this->route('leaveApplication')->id);
                }

                $exists = $query->exists();

                if ($exists) {
                    $message = 'Leave already exists for this employee in this period. Please check the dates.';
                    $validator->errors()->add('start_date', $message);
                    $validator->errors()->add('end_date', $message);
                }
            }
        });
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
