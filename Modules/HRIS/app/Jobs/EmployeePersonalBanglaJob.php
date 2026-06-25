<?php

namespace Modules\HRIS\Jobs;

use App\Services\TextTranslateService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Modules\HRIS\Models\Database\EmployeePersonal;
use Modules\HRIS\Models\Database\EmployeeBangla;

class EmployeePersonalBanglaJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Queue Config
     */
    public int $tries = 3;
    public int $backoff = 2;
    public int $timeout = 120;

    /**
     * Payload
     */
    public object $employee;
    public int $userId;

    /**
     * Create Job
     */
    public function __construct(object $employee, int $userId)
    {
        $this->employee = $employee;
        $this->userId     = $userId;
    }

    /**
     * Execute Job
     */
    public function handle(TextTranslateService $translator): void
    {
        try {

            /**
             * Employee Fetch
             */
            // $employee = EmployeePersonal::where('employee_id', $this->employeeId)->first();

            // if (!$employee) {

            //     Log::warning('Employee not found for bangla translation', [
            //         'employee_id' => $this->employeeId,
            //     ]);

            //     return;
            // }

            /**
             * Existing Bangla Record
             */
            $existing = EmployeeBangla::firstOrNew([
                'employee_id' => $this->employee->employee_id,
            ]);

            /**
             * Prepare Data
             */
            $data = [
                'national_id_bangla' => $this->employee->nominee_nid,
                'nmobile_number' => $this->employee->nominee_mobile,

                'ndistrict_id_bangla' => $this->employee->ndistrict_id,
                'nthana_id_bangla' => $this->employee->nthana_id,
                'emergency_mobile' => $this->employee->emergency_mobile,
                /**
                 * Employee Name
                 */
                'nname_bangla' => $this->translateField(
                    english: $this->employee->nominee_name,
                    existing: $existing->nname_bangla ?? null,
                    translator: $translator
                ),

                'relation_bangla' => $this->translateField(
                    english: $this->employee->relation,
                    existing: $existing->relation_bangla ?? null,
                    translator: $translator
                ),

                'ppost_office_bangla' => $this->translateField(
                    english: $this->employee->npost_office,
                    existing: $existing->ppost_office_bangla ?? null,
                    translator: $translator
                ),

                'pvillage_bangla' => $this->translateField(
                    english: $this->employee->nvillage,
                    existing: $existing->pvillage_bangla ?? null,
                    translator: $translator
                ),

                'emergency_name' => $this->translateField(
                    english: $this->employee->emergency_name,
                    existing: $existing->emergency_name ?? null,
                    translator: $translator
                ),

                'emergency_relation' => $this->translateField(
                    english: $this->employee->emergency_relation,
                    existing: $existing->emergency_relation ?? null,
                    translator: $translator
                ),

                'emergency_address' => $this->translateField(
                    english: $this->employee->emergency_address,
                    existing: $existing->emergency_address ?? null,
                    translator: $translator
                ),

                /**
                 * Father Name
                 */
                // 'fname_bangla' => $this->translateField(
                //     english: $employee->father_name,
                //     existing: $existing->fname_bangla ?? null,
                //     translator: $translator
                // ),

                /**
                 * Mother Name
                 */
                // 'mname_bangla' => $this->translateField(
                //     english: $employee->mother_name,
                //     existing: $existing->mname_bangla ?? null,
                //     translator: $translator
                // ),

                /**
                 * Permanent Address
                 */
                // 'ppost_office_bangla' => $this->translateField(
                //     english: $employee->ppost_office,
                //     existing: $existing->ppost_office_bangla ?? null,
                //     translator: $translator
                // ),

                // 'pvillage_bangla' => $this->translateField(
                //     english: $employee->pvillage,
                //     existing: $existing->pvillage_bangla ?? null,
                //     translator: $translator
                // ),

                /**
                 * Present Address
                 */
                'npost_office_bangla' => $this->translateField(
                    english: $this->employee->npost_office,
                    existing: $existing->npost_office_bangla ?? null,
                    translator: $translator
                ),

                'nvillage_bangla' => $this->translateField(
                    english: $this->employee->nvillage,
                    existing: $existing->nvillage_bangla ?? null,
                    translator: $translator
                ),

                /**
                 * Audit
                 */
                'created_by' => $existing->exists
                    ? $existing->created_by
                    : $this->userId,

                'updated_by' => $this->userId,
            ];

            /**
             * Insert or Update
             */
            EmployeeBangla::updateOrCreate(
                [
                    'employee_id' => $this->employee->employee_id,
                ],
                $data
            );

            /**
             * Success Log
             */
            Log::info('Employee Personal Bangla Translation Completed', [
                'employee_id' => $this->employee->employee_id,
            ]);
        } catch (\Throwable $e) {

            Log::error('EmployeePersonalBanglaJob Failed', [
                'employee_id' => $this->employee->employee_id,
                'message'     => $e->getMessage(),
                'line'        => $e->getLine(),
                'file'        => $e->getFile(),

            ]);

            throw $e;
        }
    }

    /**
     * Smart Translation
     */
    private function translateField(
        ?string $english,
        ?string $existing,
        TextTranslateService $translator
    ): ?string {

        /**
         * Existing Translation Found
         */
        if (!empty($existing)) {
            return $existing;
        }

        /**
         * Empty English Value
         */
        if (empty($english)) {
            return null;
        }

        /**
         * Normalize
         */
        $english = trim($english);

        if ($english === '') {
            return null;
        }

        /**
         * Direct Translation (NO CACHE)
         */
        try {
            $result = $translator->translate($english);

            if (is_string($result) && $result !== '') {
                return $result;
            }
        } catch (\Throwable $e) {

            Log::warning('Translation API Failed', [
                'text'  => $english,
                'error' => $e->getMessage(),
            ]);
        }

        return null;
    }

    /**
     * Permanent Failure
     */
    public function failed(\Throwable $e): void
    {
        Log::critical('EmployeePersonalBanglaJob Permanently Failed', [

            'employee_id' => $this->employee->employee_id,
            'message'     => $e->getMessage(),

        ]);
    }
}
