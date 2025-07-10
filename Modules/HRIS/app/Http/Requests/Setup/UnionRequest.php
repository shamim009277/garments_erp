<?php

namespace Modules\HRIS\Http\Requests\Setup;

use Illuminate\Foundation\Http\FormRequest;

class UnionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'thana_id' => 'required|exists:hris_setup_thanas,id',
            'name' => 'required|string|max:255',
            'bn_name' => 'required|string|max:255',
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
}
