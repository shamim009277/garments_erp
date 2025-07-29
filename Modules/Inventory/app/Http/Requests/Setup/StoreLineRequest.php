<?php

namespace Modules\Inventory\Http\Requests\Setup;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreLineRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $storeLineId = $this->route('storelines');
        // $table->bigIncrements('id');
        // $table->string('line_code', 50)->unique();
        // $table->string('name', 100);
        // $table->text('description')->nullable();
        // $table->boolean('is_active')->default(true);
        // $table->unsignedBigInteger('created_by')->nullable();
        // $table->unsignedBigInteger('updated_by')->nullable();
        return [
            'name' => ['required', 'string', 'max:30', Rule::unique('inventory_setup_store_line', 'name')->ignore($storeLineId)],
            'description' => 'nullable',
            'is_active' => 'required',
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
