<?php

namespace Modules\Inventory\Http\Requests\Setup;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
{
    // $table->bigIncrements('id');
    // $table->string('supplier_code', 50)->unique();
    // $table->string('name', 150);
    // $table->unsignedBigInteger('supplier_type_id');
    // $table->string('contact_person', 100)->nullable();
    // $table->string('email', 100)->nullable();
    // $table->string('phone', 30)->nullable();
    // $table->string('mobile', 30)->nullable();
    // $table->string('address_line_1');
    // $table->string('address_line_2')->nullable();
    // $table->string('city', 100)->nullable();
    // $table->string('state', 100)->nullable();
    // $table->string('zip_code', 20)->nullable();
    // $table->string('country', 100)->nullable();
    // $table->string('tax_id', 50)->nullable();
    // $table->string('trade_license', 100)->nullable();
    // $table->string('bank_account', 100)->nullable();
    // $table->string('bank_name', 100)->nullable();
    // $table->string('swift_code', 50)->nullable();
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $supplierId = $this->route('suppliers');
        return [
            'name' => ['required', 'string', 'max:150', Rule::unique('inventory_setup_suppliers', 'name')->ignore($supplierId)],
            'supplier_type_id' => 'required|exists:inventory_setup_supplier_types,id',
            'contact_person' => 'nullable|string|max:100',
            'email' => 'nullable|email|max:100',
            'phone' => 'nullable|string|max:30',
            'mobile' => 'nullable|string|max:30',
            'address_line_1' => ['required', 'string', 'max:255'],
           
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
