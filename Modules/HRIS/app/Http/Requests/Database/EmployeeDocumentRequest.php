<?php

namespace Modules\HRIS\Http\Requests\Database;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeDocumentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'employee_id' => 'required|array|exists:hris_database_employee_basic,employee_id',
            'document_id' => 'required|array|exists:hris_setup_documents,id',
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
