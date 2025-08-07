<?php

namespace Modules\Inventory\Http\Requests\Setup;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class FabricTreatmentsRequest extends FormRequest
{
    // $table->string('fabric_treatment_code', 20)->unique(); // Like FT001
    // $table->string('fabric_treatment_name', 100);
    // $table->string('fabric_treatment_description')->nullable();
    // $table->boolean('is_active')->default(true);
    public function rules(): array
    {
        $fabricTreatmentId = $this->route('fabictreatment');
        return [
            'fabric_treatment_name' => ['required', 'string', 'max:20', Rule::unique('inventory_setup_fabric_treatments', 'fabric_treatment_name')->ignore($fabricTreatmentId)],
            'fabric_treatment_description' => 'nullable',
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
            'fabric_treatment_name.required' => 'Fabric Treatment Name is required.',
            'fabric_treatment_description.required' => 'Fabric Treatment Description is required.',
        ];
    }
}
