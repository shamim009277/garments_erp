<?php

namespace Modules\Inventory\Http\Requests\Setup;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CountryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $countryId = $this->route('countries');
        return [
            'country_name' => ['required', 'string', 'max:100', Rule::unique('inventory_setup_goods_setup_country', 'country_name')->ignore($countryId)],
            'is_active' => ['required', 'boolean'],
            'currency' => 'nullable',
            'currency_code' => 'nullable',
            'currency_symbol' => 'nullable',
            'exchange_rate' => 'nullable',
            'description' => 'nullable',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    public function messages()
    {
        return [
            'country_name.required' => 'Country name is required',
            'is_active.required' => 'Is active is required',
        ];
    }
}
