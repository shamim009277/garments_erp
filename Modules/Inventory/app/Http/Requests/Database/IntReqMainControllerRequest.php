<?php

namespace Modules\Inventory\Http\Requests\Database;

use Illuminate\Foundation\Http\FormRequest;

class IntReqMainControllerRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'organization_id' => 'required|exists:hris_setup_organizations,id',
            'store_id' => 'required|exists:inventory_setup_store_locations,id',
            'purpose' => 'required|string',
            'note' => 'string|nullable',
            'required_by_id' => 'required|exists:users,id',
            'req_date' => 'required|date',
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
