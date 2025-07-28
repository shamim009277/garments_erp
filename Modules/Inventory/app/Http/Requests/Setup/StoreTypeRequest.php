<?php

namespace Modules\Inventory\Http\Requests\Setup;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTypeRequest extends FormRequest
{
            // $table->string('type_code', 50)->unique();
            // $table->string('name', 100);
            // $table->text('description')->nullable();
            // $table->boolean('is_active')->default(true);
            // $table->unsignedBigInteger('created_by')->nullable();
            // $table->unsignedBigInteger('updated_by')->nullable();
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $storeTypeId = $this->route('storetypes');

        return [
            'name' => ['required', 'string', 'max:30', Rule::unique('inventory_setup_storetype', 'name')->ignore($storeTypeId)],
            'description'  => ['required', 'string', 'max:100'],
            
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
