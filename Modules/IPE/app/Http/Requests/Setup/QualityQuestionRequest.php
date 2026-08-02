<?php

namespace Modules\IPE\Http\Requests\Setup;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class QualityQuestionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $id = $this->route('id') ?? $this->route('qualityquestion');

        return [
            'sl' => ['required', 'integer'],
            'type' => ['required', 'integer'],
            'department_id' => [
                'nullable',
                'integer',
                'exists:hris_setup_departments,id',
            ],
            'question' => [
                'required',
                'string',
                'max:255',
                Rule::unique('ipe_setup_quality_questions', 'question')->ignore($id),
            ],

            'question_bn' => [
                'required',
                'string',
                'max:255',
                Rule::unique('ipe_setup_quality_questions', 'question_bn')->ignore($id),
            ],

            'answer' => [
                'required',
                'string',
                'max:255',
                // Rule::unique('ipe_setup_quality_questions', 'answer')->ignore($id),
            ],

            'answer_bn' => [
                'required',
                'string',
                'max:255',
                // Rule::unique('ipe_setup_quality_questions', 'answer_bn')->ignore($id),
            ],

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
