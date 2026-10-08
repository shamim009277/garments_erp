<?php

namespace Modules\Commercial\Http\Requests\Setup;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PaymentMethodRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $id = $this->route('id') ?? $this->route('payment_method');

        return [
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('commercial_setup_payment_method', 'name')->ignore($id),
            ],
            'description' => 'nullable|string|max:255',
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
