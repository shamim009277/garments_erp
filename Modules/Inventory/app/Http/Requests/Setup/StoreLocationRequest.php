<?php

namespace Modules\Inventory\Http\Requests\Setup;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreLocationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    // $table->string('name', 100);
    // $table->string('store_code', 50)->unique();
    // $table->string('address_line_1');
    // $table->string('address_line_2')->nullable();
    // $table->string('city', 100);
    // $table->string('state', 100)->nullable();
    // $table->string('zip_code', 20)->nullable();
    // $table->string('country', 100);
    // $table->string('store_size', 20)->nullable();
    // $table->unsignedBigInteger('store_type_id');
    // $table->unsignedBigInteger('organization_id');
    // $table->string('owner_id', 50)->nullable();
    // $table->string('owner_name', 100)->nullable();
    // $table->decimal('latitude', 10, 8)->nullable();
    // $table->decimal('longitude', 11, 8)->nullable();
    // $table->string('contact_person', 100)->nullable();
    // $table->string('phone', 20)->nullable();
    // $table->string('email', 100)->nullable();
    // $table->boolean('is_active')->default(true);
    // $table->unsignedBigInteger('created_by')->nullable();
    // $table->unsignedBigInteger('updated_by')->nullable();
    // // foreign key
    // $table->foreign('store_type_id')
    //       ->references('id')->on('inventory_setup_storetype')
    //       ->onDelete('cascade');
    // $table->foreign('organization_id')
    //       ->references('id')->on('hris_setup_organizations')
    //       ->onDelete('cascade');            
    // $table->timestamps();
    public function rules(): array
    {
        $storeLocationId = $this->route('storelocations');
        return [
            'name' => ['required', 'string', 'max:30', Rule::unique('inventory_setup_store_locations', 'name')->ignore($storeLocationId)],
            'address_line_1' => 'required',
            'address_line_2' => 'nullable',
            'city' => 'required',
            'state' => 'nullable',
            'zip_code' => 'nullable',
            'country' => 'required',
            'store_size' => 'nullable',
            'store_type_id' => 'required',
            'organization_id' => 'required',
            'owner_id' => 'nullable',
            'owner_name' => 'nullable',
            'latitude' => 'nullable',
            'longitude' => 'nullable',
            'contact_person' => 'nullable',
            'phone' => 'nullable',
            'email' => 'nullable',
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
