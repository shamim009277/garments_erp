<?php

namespace Modules\HRIS\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'medical_allowance' => ['required', 'numeric', 'min:0'],
            'food_allowance' => ['required', 'numeric', 'min:0'],
            'conveyance' => ['required', 'numeric', 'min:0'],
            'house_rant_percent_basic' => ['required', 'numeric', 'min:0'],
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
