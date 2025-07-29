<?php

namespace Modules\Inventory\Http\Requests\Setup;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ChallanPurposeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $challanPurposeId = $this->route('challanpurposes');
        return [
            'purpose_name' => ['required', 'string', 'max:100', Rule::unique('inventory_setup_challan_purposes', 'purpose_name')->ignore($challanPurposeId)],
            'description' => 'nullable|string',
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
