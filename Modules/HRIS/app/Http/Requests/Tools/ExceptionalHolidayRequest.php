<?php

namespace Modules\HRIS\Http\Requests\Tools;

use Illuminate\Foundation\Http\FormRequest;

class ExceptionalHolidayRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'year' => 'required|numeric|digits:4',
            'organization_id' => 'required|integer',
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
