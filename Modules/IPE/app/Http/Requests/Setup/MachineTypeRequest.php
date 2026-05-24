<?php

namespace Modules\IPE\Http\Requests\Setup;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MachineTypeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $id = $this->route('machine_type');

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('ipe_setup_machine_types', 'name')->ignore($id),
            ],

            'name_bn' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('ipe_setup_machine_types', 'name_bn')->ignore($id),
            ],
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
