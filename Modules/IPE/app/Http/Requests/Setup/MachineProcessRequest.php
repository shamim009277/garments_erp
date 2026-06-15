<?php

namespace Modules\IPE\Http\Requests\Setup;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MachineProcessRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $id = $this->route('id') ?? $this->route('machineprocess');

        return [
            'type_id' => ['required', 'integer'],
            'process_type' => ['required', 'integer'],
            'process' => ['required', 'string','max:255'],
            'process_code' => ['required', 'string','max:255',Rule::unique('ipe_setup_machine_processes', 'process_code')->ignore($id),],
            'process_name' => ['required', 'string','max:255',Rule::unique('ipe_setup_machine_processes', 'process_name')->ignore($id),],
            'process_name_bn' => ['required', 'string','max:255',Rule::unique('ipe_setup_machine_processes', 'process_name_bn')->ignore($id),],
            'item' => ['required', 'string','max:255'],
            'capacity' => ['required', 'numeric'],
            'time' => ['required', 'numeric'],
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
