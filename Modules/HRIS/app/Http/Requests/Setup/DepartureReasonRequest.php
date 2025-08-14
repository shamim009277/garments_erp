<?php

namespace Modules\HRIS\Http\Requests\Setup;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DepartureReasonRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     * both create and update
     */
    public function rules(): array
    {   
        $departurereasonId = $this->route('departurereason');

        return [
            'reason' => ['required', 'string', 'max:30', Rule::unique('hris_setup_departurereasons', 'reason')->ignore($departurereasonId)],
            'reason_short_name' => ['required', 'string', 'max:10', Rule::unique('hris_setup_departurereasons', 'reason_short_name')->ignore($departurereasonId)],
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
