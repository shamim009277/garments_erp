<?php

namespace Modules\Inventory\Http\Requests\Database;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BasicOrderRequest extends FormRequest
{
    //   Basic Order Details
    //   $table->enum('order_type', ['Confirmed', 'Pending', 'Cancelled'])->default('Confirmed');
    //   $table->enum('compile_type', ['Always Barcode', 'Manual'])->nullable();


    //   $table->unsignedBigInteger('organization_id');    // Texeurop (BD) Ltd etc.
    //   $table->unsignedBigInteger('buyer_id'); // buyer_id


    //   $table->string('style_no')->unique();
    //   $table->string('style_description')->nullable();
    //   $table->string('order_no')->unique();
    //   $table->string('season')->nullable();
    //   $table->string('fitting_type')->nullable();

    //   // Basic Order Details
    //   $table->unsignedBigInteger('product_category_id');
    //   $table->unsignedBigInteger('merchandiser_id');

    //   $table->unsignedBigInteger('fabric_type_id');
    //   $table->unsignedBigInteger('composition_id');
    //   $table->unsignedBigInteger('fabric_treatment_id'); // All Over Print, Yarn Dyed
    //   $table->unsignedBigInteger('yarn_count_id');
    //   $table->unsignedBigInteger('yarn_category_id');


    //   $table->string('gsm')->nullable();
    //   $table->string('bw_gsm')->nullable();
    //   $table->decimal('finished_dia', 8, 2)->nullable();
    //   $table->string('finish_type')->nullable();

    //   // Print & Embroidery
    //   $table->string('print_type')->nullable();
    //   $table->decimal('print_price_per_dzn', 8, 2)->default(0);
    //   $table->string('embroidery_type')->nullable();
    //   $table->decimal('embroidery_price_per_dzn', 8, 2)->default(0);
    //   $table->string('wash_type')->nullable();

    //   // Pricing & Costing
    //   $table->decimal('garment_dye_price_per_dzn', 8, 2)->default(0);
    //   $table->date('order_date');
    //   $table->decimal('unit_price', 8, 2);
    //   $table->decimal('cm_price_per_dzn', 8, 2)->default(0);

    //   // Quantities
    //   $table->integer('order_quantity');
    //   $table->decimal('extra_cutting_percent', 5, 2)->default(0);
    //   $table->boolean('fabric_booking_needed')->default(false);

    //   // Consumption
    //   $table->decimal('fabric_consumption_kg_dz', 8, 3)->nullable();
    //   $table->decimal('kd_allowance_percent', 5, 2)->nullable();
    //   $table->decimal('cutting_consumption_yards_pcs', 8, 3)->nullable();
    //   $table->decimal('booking_consumption_yards_pcs', 8, 3)->nullable();

    //   // Delivery
    //   $table->string('delivery_mode')->nullable(); // By Sea / Air / Road
    //   $table->date('delivery_date')->nullable();
    //   $table->boolean('trims_required_approved')->default(false);
    //   $table->boolean('closed')->default(false);
    //   $table->boolean('fabric_from_stock')->default(false);

    //   // Extra
    //   $table->text('style_complexity_notes')->nullable();

    //   //foreign key
    //   $table->foreign('organization_id')->references('id')->on('hris_setup_organizations')->onDelete('restrict');
    //   $table->foreign('buyer_id')->references('id')->on('inventory_setup_buyer')->onDelete('restrict');
    //   $table->foreign('product_category_id')->references('id')->on('inventory_setup_product_categories')->onDelete('restrict');
    //   $table->foreign('merchandiser_id')->references('id')->on('users')->onDelete('restrict');
    //   $table->foreign('fabric_type_id')->references('id')->on('inventory_setup_fabric_types')->onDelete('restrict');
    //   $table->foreign('composition_id')->references('id')->on('inventory_setup_compositions')->onDelete('restrict');
    //   $table->foreign('fabric_treatment_id')->references('id')->on('inventory_setup_fabric_treatments')->onDelete('restrict');
    //   $table->foreign('yarn_count_id')->references('id')->on('inventory_setup_yarn_counts')->onDelete('restrict');
    //   $table->foreign('yarn_category_id')->references('id')->on('inventory_setup_yarn_categories')->onDelete('restrict');
    public function rules(): array
    {
        // $buyerId = $this->route('buyer');
        $basicOrderId = $this->route('basicorder');
        return [
            'order_type' => ['required', 'string', Rule::in(['Confirmed', 'Pending', 'Cancelled'])],
            'compile_type' => 'nullable|string',
            'organization_id' => 'nullable|exists:hris_setup_organizations,id',

            'style_description' => 'nullable|string',
            'season' => 'nullable|string',
            'fitting_type' => 'nullable|string',
            'product_category_id' => 'nullable|exists:inventory_setup_product_categories,id',
            'merchandiser_id' => 'nullable|exists:users,id',
            'fabric_type_id' => 'nullable|exists:inventory_setup_fabric_types,id',
            'composition_id' => 'nullable|exists:inventory_setup_compositions,id',
            'fabric_treatment_id' => 'nullable|exists:inventory_setup_fabric_treatments,id',
            'yarn_count_id' => 'nullable|exists:inventory_setup_yarn_counts,id',
            'yarn_category_id' => 'nullable|exists:inventory_setup_yarn_categories,id',
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
            'order_type.required' => 'Order type is required',
            'order_type.in' => 'Order type is invalid',
            'compile_type.string' => 'Compile type must be a string',
            'organization_id.exists' => 'Organization does not exist',

            'style_description.string' => 'Style description must be a string',
            'season.string' => 'Season must be a string',
            'fitting_type.string' => 'Fitting type must be a string',
            'product_category_id.exists' => 'Product category does not exist',
            'merchandiser_id.exists' => 'Merchandiser does not exist',
            'fabric_type_id.exists' => 'Fabric type does not exist',
            'composition_id.exists' => 'Composition does not exist',
            'fabric_treatment_id.exists' => 'Fabric treatment does not exist',
            'yarn_count_id.exists' => 'Yarn count does not exist',
            'yarn_category_id.exists' => 'Yarn category does not exist',
        ];
    }
}
