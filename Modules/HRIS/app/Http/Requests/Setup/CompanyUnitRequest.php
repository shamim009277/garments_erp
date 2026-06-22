<?php

namespace Modules\HRIS\Http\Requests\Setup;

use Illuminate\Foundation\Http\FormRequest;
use Modules\HRIS\Models\Setup\CompanyUnit;

class CompanyUnitRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $id = $this->route('companyunit')?->id;

        return [
            'org_id' => [
                'required',
                'integer',
            ],

            'code' => [
                'required',
                'integer',
            ],

            'line_id' => [
                'required',
                'array',
                'min:1',
            ],

            'line_id.*' => [
                'required',
                'integer',
                'distinct',
            ],

            'is_active' => [
                'required',
                'boolean',
            ],
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {

            // Same Organization + Unit check
            $unitExists = CompanyUnit::query()
                ->where('org_id', $this->org_id)
                ->where('code', $this->code)
                ->when(
                    $this->route('companyunit'),
                    fn($q) => $q->where('id', '!=', $this->route('companyunit')->id)
                )
                ->exists();

            if ($unitExists) {
                $validator->errors()->add(
                    'unit',
                    'This unit already exists under the selected organization.'
                );
            }

            // Same Organization + Line check
            $records = CompanyUnit::where('org_id', $this->org_id)
                ->when(
                    $this->route('companyunit'),
                    fn($q) => $q->where('id', '!=', $this->route('companyunit')->id)
                )
                ->get();

            $requestLines = collect($this->line_id)
                ->map(fn($item) => (string) $item)
                ->toArray();

            foreach ($records as $record) {

                $existingLines = collect($record->line_id ?? [])
                    ->map(fn($item) => (string) $item)
                    ->toArray();

                $duplicates = array_intersect($existingLines, $requestLines);

                if (count($duplicates) > 0) {

                    $validator->errors()->add(
                        'line_id',
                        'Line already assigned for this organization. Duplicate line: ' . implode(', ', $duplicates)
                    );

                    break;
                }
            }
        });
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
