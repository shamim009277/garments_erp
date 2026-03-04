<?php

namespace Modules\Inventory\Http\Requests\Database;

use Illuminate\Foundation\Http\FormRequest;

class GateOutChallanDetailRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'item_id' => 'required|exists:inventory_setup_items,id',
            'challan_no' => 'required|string',
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
