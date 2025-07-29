<?php

namespace Modules\Inventory\Http\Requests\Setup;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SupplierTypeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    // $table->bigIncrements('id');
    //         $table->string('type_code', 50)->unique();
    //         $table->string('name', 100);
    //         $table->text('description')->nullable();
    //         $table->boolean('is_active')->default(true);
    // protected $table = 'inventory_setup_supplier_types';

    public function rules(): array
    {
        $supplierTypeId = $this->route('suppliertypes');
        return [
            'name' => ['required', 'string', 'max:100', Rule::unique('inventory_setup_supplier_types', 'name')->ignore($supplierTypeId)],
            'description' => 'nullable',
            'is_active' => 'required',
            'created_by' => 'nullable',
            'updated_by' => 'nullable',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    //booted function
    public function authorize(): bool
    {
        return true;
    }
}
