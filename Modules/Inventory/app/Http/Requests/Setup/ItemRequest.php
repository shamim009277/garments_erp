<?php

namespace Modules\Inventory\Http\Requests\Setup;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ItemRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $item_id = $this->route('item');
        return [
            'goods_category_id' => ['required|exists:inventory_setup_goods_setup_category,id', Rule::unique('inventory_setup_items', 'goods_category_id')->ignore($item_id)],
            'goods_subcategory_id' => ['required|exists:inventory_setup_goods_setup_subcategory,id', Rule::unique('inventory_setup_items', 'goods_subcategory_id')->ignore($item_id)],
            'unit_id' => ['required|exists:master_setup_units,id', Rule::unique('inventory_setup_items', 'unit_id')->ignore($item_id)],
            'item_name' => ['required|string', Rule::unique('inventory_setup_items', 'item_name')->ignore($item_id)],
            'item_description' => 'nullable|string',
            'item_barcode' => 'nullable|string',
            'item_image' => 'nullable|string',
            'is_active' => 'required|boolean',
            'varient' => 'nullable|array',
            'model' => 'nullable|string',
            'type' => 'nullable|string',
            'remarks' => 'nullable|string',
            'created_by' => 'nullable|exists:users,id',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    //messages
    public function messages(): array
    {
        return [
            'goods_category_id.required' => 'Goods category is required',
            'goods_category_id.exists' => 'Goods category does not exist',
            'goods_subcategory_id.required' => 'Goods subcategory is required',
            'goods_subcategory_id.exists' => 'Goods subcategory does not exist',
            'unit_id.required' => 'Unit is required',
            'unit_id.exists' => 'Unit does not exist',
            'item_name.required' => 'Item name is required',
           'item_name.unique' => 'Item name already exists',
            'item_description.string' => 'Item description must be a string',
            'model.string' => 'Model must be a string',
            'type.string' => 'Type must be a string',
            'remarks.string' => 'Remarks must be a string',
            'created_by.exists' => 'Created by does not exist',
        ];
    }
}
