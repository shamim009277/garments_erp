<?php

namespace Modules\Inventory\Http\Requests\Setup;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SizeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $sizeId = $this->route('size');    
        return [
            'size_name' => ['required', 'string', 'max:100', Rule::unique('inventory_setup_size', 'size_name')->ignore($sizeId)],
            'size_rank' => 'required|integer',
            'is_active' => 'required|boolean',
            'size_group_id' => 'required|exists:inventory_setup_size_group,id',
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
