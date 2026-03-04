<?php

namespace Modules\Inventory\Http\Requests\Database;

use Illuminate\Foundation\Http\FormRequest;

class GatePurMrrMainRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        // echo('Prottoy');
        return [
            'organization_id' => 'required|exists:hris_setup_organizations,id',
            'gate_entry_id' => 'required|exists:inventory_setup_store_locations,id',
            'received_by_id' => 'required|exists:users,id',
            'supplier_id' => 'required|exists:inventory_setup_suppliers,id',
            'vehicle_no' => 'nullable|string',
            'driver_name' => 'required|string',
            'act_challan_no' => 'required|string',
            'mrr_date' => 'required|date',
            'note' => 'nullable|string',
            'document' => 'nullable|file',
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
