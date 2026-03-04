<?php

namespace Modules\OrderManagement\Http\Requests\Setup;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductCategoryRequest extends FormRequest
{
    // $table->string('product_category_code', 20)->unique(); // Like PC001
    // $table->string('product_category_name', 100);
    // $table->string('product_category_description')->nullable();
    // $table->boolean('is_active')->default(true);
    public function rules(): array
    {
        $productcategorie_id = $this->route('productcategorie');
        return [
            'product_category_name' => ['required', 'string', Rule::unique('inventory_setup_product_categories', 'product_category_name')->ignore($productcategorie_id)],
            // 'product_category_code' => ['required', 'string', Rule::unique('inventory_setup_product_categories', 'product_category_code')->ignore($productcategorie_id)],
            'product_category_description' => 'nullable|string|max:255',
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

    public function messages()
    {
        return [
            'product_category_name.required' => 'Product Category Name is required.',
            'product_category_name.unique' => 'Product Category Name already exists.',
            'product_category_code.required' => 'Product Category Code is required.',
            'product_category_code.unique' => 'Product Category Code already exists.',
        ];
    }
}
