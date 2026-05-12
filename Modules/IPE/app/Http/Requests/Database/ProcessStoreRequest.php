<?php

namespace Modules\IPE\Http\Requests\Database;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProcessStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'process_id' => [
                'required',
                'integer',
                'exists:ipe_setup_process,id',

                Rule::unique('ipe_database_assessment_processes')
                    ->where(fn ($query) =>
                        $query->where('assessment_id', $this->assessment_id)
                    )
                    ->ignore($this->id)
            ],

            'assessment_id' => 'required|integer|exists:ipe_database_new_assessment,id',

            'declare'     => 'required|integer|min:0',
            'cycle_one'   => 'required|integer|min:0',
            'cycle_two'   => 'required|integer|min:0',
            'cycle_three' => 'required|integer|min:0',
            'cycle_four'  => 'required|integer|min:0',
            'cycle_five'  => 'required|integer|min:0',
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
