<?php

namespace Modules\Inventory\Http\Requests\Setup;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FabricTypeRequest extends FormRequest
{
    // $table->string('fabric_type_code', 20)->unique(); // Like FT001
    // $table->string('fabric_type_name', 100);
    // $table->string('fabric_type_description')->nullable();
    // $table->boolean('is_active')->default(true);
    public function rules(): array
    {
        $fabricTypeId = $this->route('fabricType');
        return [
            'fabric_type_name' => ['required', 'string', 'max:20', Rule::unique('inventory_setup_fabric_types', 'fabric_type_name')->ignore($fabricTypeId)],
            'fabric_type_description' => 'nullable',
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
    // public function messages()
    // {
    //     return [
    //         'fabric_type_code.required' => 'Fabric Type Code is required.',
    //         'fabric_type_name.required' => 'Fabric Type Name is required.',
    //     ];
    // }
    public function messages(): array
    {
        return [
            'fabric_type_name.required' => 'Fabric Type Name is required.',
            'fabric_type_name.string' => 'Fabric Type Name must be a string.',
            'fabric_type_name.max' => 'Fabric Type Name must be less than 20 characters.',
            'fabric_type_name.unique' => 'Fabric Type Name must be unique.',
            'fabric_type_description.string' => 'Fabric Type Description must be a string.',
            'is_active.required' => 'Is active is required.',
            'is_active.boolean' => 'Is active must be a boolean.',
        ];
    }
}
