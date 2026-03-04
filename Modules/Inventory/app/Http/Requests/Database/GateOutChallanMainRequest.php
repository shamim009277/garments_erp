<?php

namespace Modules\Inventory\Http\Requests\Database;

use Illuminate\Foundation\Http\FormRequest;

class GateOutChallanMainRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'challan_by_id' => 'required|exists:users,id',
            'org_id' => 'required|exists:hris_setup_organizations,id',
            'party_id' => 'required|exists:inventory_setup_suppliers,id',
            'store_id' => 'required|exists:inventory_setup_store_locations,id',
            'purpose_id' => 'required|exists:inventory_setup_challan_purposes,id',
            'challan_date' => 'required|date',
            'note' => 'nullable|string',
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
