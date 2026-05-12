<?php

namespace Modules\IPE\Http\Requests\Setup;

use Illuminate\Foundation\Http\FormRequest;

class ProcessRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $id = $this->route('id') ?? $this->route('process');

        return [
            'process' => 'required|string|max:255',
            'process_code' => 'required|string|max:100|unique:ipe_setup_process,process_code,' . $id,
            'process_name' => 'required|string|max:255',
            'process_name_bn' => 'nullable|string|max:255',
            'item' => 'required|string|max:255',
            'capacity' => 'required|numeric|min:0',
            'time' => 'required|numeric|min:0',
            'is_active' => 'boolean'
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
