<?php

namespace Modules\Inventory\Http\Requests\Setup;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GoodsCategoryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    // $table->id();
    // $table->string('category_code', 20)->unique();  // e.g., RM01, FG02
    // $table->string('name', 100);                   // e.g., Raw Material, Finished Goods
    // $table->text('description')->nullable();       // Optional details
    // $table->unsignedBigInteger('parent_id')->nullable(); // For hierarchical categories
    // $table->boolean('is_active')->default(true);
    // $table->timestamps();
    // // Optional: Add foreign key if hierarchical
    // $table->foreign('parent_id')->references('id')->on('inventory_setup_goods_categories')->onDelete('set null');
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100', Rule::unique('inventory_setup_goods_categories', 'name')->ignore($this->id)],
            'description' => ['nullable', 'string'],
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

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Name is required',
            'name.string' => 'Name must be a string',
            'name.max' => 'Name must be less than 100 characters',
            'name.unique' => 'Name must be unique',
            'description.string' => 'Description must be a string',
            'is_active.required' => 'Is active is required',
            'is_active.boolean' => 'Is active must be a boolean',
        ];
    }
}
