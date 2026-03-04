<?php

namespace Modules\Inventory\Http\Requests\Database;

use Illuminate\Foundation\Http\FormRequest;

class GatePurMrrDetailsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'mrr_id' => 'required|exists:inventory_database_gate_pur_mrr_mains,id',
            'item_id' => 'required|exists:inventory_setup_items,id',
            'req_main_id' => 'required|exists:inventory_database_pur_requisition_mains,id',
            'req_detail_id' => 'required|exists:inventory_database_pur_requisition_details,id',
            'received_qty' => 'required|numeric|min:0',
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
