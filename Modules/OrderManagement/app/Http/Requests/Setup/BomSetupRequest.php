<?php

namespace Modules\OrderManagement\Http\Requests\Setup;

use Illuminate\Foundation\Http\FormRequest;

class BomSetupRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'buyer_id' => ['required', 'integer', 'exists:inventory_setup_buyer,id'],
            'organization_id' => ['nullable', 'integer', 'exists:hris_setup_organizations,id'],
            'item_id' => ['required', 'integer', 'exists:inventory_setup_items,id'],
            'consumption' => ['required', 'numeric'],
            'consumption_pcs' => ['nullable', 'numeric'],
            'convert_ratio' => ['nullable', 'numeric'],
            'consumption_unit_id' => ['required', 'integer', 'exists:master_setup_units,id'],
            'unit_id' => ['required', 'integer', 'exists:master_setup_units,id'],
            'extra' => ['nullable', 'numeric'],
            'supplier_id' => ['nullable', 'integer', 'exists:inventory_setup_suppliers,id'],
            'breakdown_id' => ['nullable', 'integer'],
            'create_date' => ['nullable', 'date'],
            'remarks' => ['nullable', 'string'],
        ];
    }
}
