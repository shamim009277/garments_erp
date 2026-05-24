<?php

namespace Modules\HRIS\Jobs;

use App\Services\TextTranslateService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Modules\HRIS\Models\Database\EmployeeBangla;

class EmployeeBanglaJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public object $employee;
    public int $userId;

    // retry config
    public $tries = 3;
    public $backoff = 2; // seconds

    public function __construct($employee, $userId)
    {
        $this->employee = $employee;
        $this->userId = $userId;
    }

    public function handle(TextTranslateService $translator): void
    {
        try {
            $employee = $this->employee;
            $data = [
                'employee_id'         => $employee->employee_id,
                'org_id'              => $employee->org_id,
                'name_bangla'         => $translator->translate($employee->name),
                'fname_bangla'        => $translator->translate($employee->father_name),
                'mname_bangla'        => $translator->translate($employee->mother_name),
                'pdistrict_id_bangla' => $employee->pdistrict_id,
                'pthana_id_bangla'    => $employee->pthana_id,
                'ppost_office_bangla' => $translator->translate($employee->ppost_office),
                'pvillage_bangla'     => $translator->translate($employee->pvillage),
                'mdistrict_id_bangla' => $employee->mdistrict_id,
                'mthana_id_bangla'    => $employee->mthana_id,
                'mpost_office_bangla' => $translator->translate($employee->mpost_office),
                'mvillage_bangla'     => $translator->translate($employee->mvillage),
                'created_by'          => $this->userId,
                'updated_by'          => $this->userId
            ];
            EmployeeBangla::updateOrCreate(
                ['employee_id' => $employee->employee_id],
                $data
            );
        } catch (\Exception $e) {
            Log::error('EmployeeBanglaJob Failed', [
                'employee_id' => $this->employee->employee_id,
                'error'       => $e->getMessage(),
            ]);
            throw $e; // important for retry system
        }
    }

    public function failed(\Throwable $e)
    {
        Log::error('EmployeeBanglaJob permanently failed', [
            'employee_id' => $this->employee->employee_id,
            'error'       => $e->getMessage(),
        ]);
    }
}
