<?php

namespace Modules\IPE\Http\Requests\Setup;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class HelperQuestionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $id = $this->route('id') ?? $this->route('helper_question');

        return [
            'sl' => ['required', 'integer'],
            'question' => [
                'required',
                'string',
                'max:255',
                Rule::unique('helper_question', 'question')->ignore($id),
            ],

            'question_bn' => [
                'required',
                'string',
                'max:255',
                Rule::unique('helper_question', 'question_bn')->ignore($id),
            ],

            'answer' => [
                'required',
                'string',
                'max:255',
                Rule::unique('helper_question', 'answer')->ignore($id),
            ],

            'answer_bn' => [
                'required',
                'string',
                'max:255',
                Rule::unique('helper_question', 'answer_bn')->ignore($id),
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
