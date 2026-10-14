<?php

namespace Modules\Commercial\Http\Requests\Database;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SalesContactRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $contactId = $this->route('contact')?->id ?? $this->route('id'); 
        
        return [ 
            'contact_no' => [ 'required', 'string', 'max:30', Rule::unique('commercial_database_sales_contacts', 'contact_no') ->where('organization_id', $this->input('organization_id')) ->ignore($contactId), ], 
            'date' => ['required', 'date'], 
            'revised_date' => ['nullable', 'date', 'after_or_equal:date'], 
            'supplier_id' => ['required', 'integer', 'exists:hris_setup_organizations,id'], 
            'supplier_address' => ['nullable', 'string'], 
            'supplier_bank' => ['nullable', 'string'], 
            'quantity' => ['required', 'numeric', 'min:0'], 
            'unit_id' => ['required', 'integer', 'exists:master_setup_units,id'], 
            'value' => ['required', 'numeric', 'min:0'], 
            'currency_id' => ['required', 'integer',], 
            'buyer_id' => ['required', 'integer', 'exists:hris_setup_buyers,id'], 
            'tolerance' => ['required', 'numeric', 'between:0,999.99'], 
            'agent_commission' => ['required', 'numeric', 'between:0,9999.9999'], 
            'shipment_mode_id' => [ 'nullable', 'integer', 'exists:hris_setup_shipment_modes,id', ], 
            'payment_terms_id' => [ 'nullable', 'integer', 'exists:hris_setup_payment_terms,id', ], 
            'delivery_terms_id' => [ 'nullable', 'integer', 'exists:hris_setup_delivery_terms,id', ], 
            'buyer_address' => ['nullable', 'string', 'max:200'], 
            'buyer_bank' => ['nullable', 'string', 'max:300'], 
            'consignee_id' => [ 'nullable', 'integer', 'exists:hris_setup_buyers,id', ], 
            'payment_method_id' => [ 'nullable', 'integer', 'exists:hris_setup_payment_methods,id', ], 
            'additional_terms' => ['nullable', 'string'],
            'expiry_date' => ['nullable', 'date'], 
            'consignee_address' => ['nullable', 'string'], 
            'consignee_bank' => ['nullable', 'string'], 
            'remarks' => ['nullable', 'string'],
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
