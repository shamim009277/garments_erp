<?php

namespace Modules\Inventory\Http\Requests\Setup;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RackLocationRequest extends FormRequest
{
    
            // $table->string('rack_name', 100)->nullable();
            // $table->string('rack_code', 50)->unique();
            // $table->string('aisle', 50)->nullable();
            // $table->string('row', 20)->nullable();
            // $table->string('column', 20)->nullable();
            // $table->tinyInteger('floor_level')->nullable();
            // $table->unsignedBigInteger('store_line_id');
            // $table->text('description')->nullable();
            // $table->boolean('is_active')->default(true);
            // $table->unsignedBigInteger('created_by')->nullable();
            // $table->unsignedBigInteger('updated_by')->nullable();
            // $table->timestamps();
            // // foreign key
            // $table->foreign('store_line_id')
            //       ->references('id')->on('inventory_setup_store_line')
            //       ->onDelete('cascade');
    /**
     * Get the validation rules that apply to the request.
     */
    //declared the route name 

    
    public function rules(): array
    {
        $rackLocationId = $this->route('racklocation');
        return [
            'rack_name' => ['required', 'string', 'max:30', Rule::unique('inventory_setup_rack_locations', 'rack_name')->ignore($rackLocationId)],
            'aisle' => ['required', 'string', 'max:50'],
            'row' => ['required', 'string', 'max:20'],
            'column' => ['required', 'string', 'max:20'],
            'floor_level' => ['required', 'integer'],
            'store_line_id' => ['required', 'exists:inventory_setup_store_line,id'],
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
}
