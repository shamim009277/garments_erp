<?php

namespace Modules\Inventory\Http\Requests\Setup;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;



class GoodsSubCategoryRequest extends FormRequest
{
    // $table->id();
    // $table->unsignedBigInteger('goods_category_id');
    // $table->unsignedBigInteger('organization_id');
    // $table->string('name');
    // $table->string('bn_name')->nullable();
    // $table->boolean('is_active')->default(true);

    // $table->unsignedBigInteger('created_by')->nullable();
    // $table->unsignedBigInteger('updated_by')->nullable();
    // //foreign key
    // $table->foreign('goods_category_id')->references('id')->on('inventory_setup_goods_categories')->onDelete('cascade');
    // $table->foreign('organization_id')->references('id')->on('hris_setup_organizations')->onDelete('cascade');
    // $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
    // $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
    public function rules(): array
    {
        // dd('This is the rules method of GoodsSubCategoryRequest');
        $goodsSubCategoryId = $this->route('goodsSubCategorie');
        return [
            'name' => ['required', 'string', 'max:100', Rule::unique('inventory_setup_goods_subcategories', 'name')->ignore($goodsSubCategoryId)],
            'bn_name' => ['nullable', 'string', 'max:100'],
            
            'is_active' => ['required', 'boolean'],
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
