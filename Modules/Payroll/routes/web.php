<?php

use App\Http\Middleware\ModuleActive;
use Illuminate\Support\Facades\Route;
use Modules\Payroll\Http\Controllers\PayrollController;
use Modules\Payroll\Http\Controllers\Database\AdvanceController;
use Modules\Payroll\Http\Controllers\Report\PunchReportController;
use Modules\Payroll\Http\Controllers\Tools\OTAdjustmentController;
use Modules\Payroll\Http\Controllers\Tools\ProcessBonusController;
use Modules\Payroll\Http\Controllers\Database\PunishmentController;
use Modules\Payroll\Http\Controllers\Report\AbsentReportController;
use Modules\Payroll\Http\Controllers\Report\SalaryReportController;
use Modules\Payroll\Http\Controllers\Tools\EditPunchDataController;
use Modules\Payroll\Http\Controllers\Tools\ProcessSalaryController;
use Modules\Payroll\Http\Controllers\Tools\AdvanceProcessController;
use Modules\Payroll\Http\Controllers\Tools\EditAttendenceController;
use Modules\Payroll\Http\Controllers\Report\OvertimeReportController;
use Modules\Payroll\Http\Controllers\Tools\PunchAdjustmentController;
use Modules\Payroll\Http\Controllers\Tools\ReadMachineDataController;
use Modules\Payroll\Http\Controllers\Report\AttendenceReportController;
use Modules\Payroll\Http\Controllers\Tools\ProcessAttendenceController;
use Modules\Payroll\Http\Controllers\Tools\ProcessHalfSalaryController;
use Modules\Payroll\Http\Controllers\Tools\AttendenceAdjustmentController;

Route::middleware(['auth', 'verified',ModuleActive::class.':payroll'])->group(function () {
    Route::resource('payroll', PayrollController::class)->names('payroll');

    Route::prefix('payroll')->name('payroll.')->group(function () {
        //Setup
        Route::prefix('setup')->name('setup.')->group(function () {

        });

        //Database
        Route::prefix('database')->name('database.')->group(function () {
            Route::post('/employee/info', [AdvanceController::class, 'employeeInfo'])->name('advance.employee.info');
            Route::post('/advance/delete', [AdvanceController::class, 'destroy'])->name('advance.delete');
            Route::resource('advance', AdvanceController::class)->names('advance');

            Route::post('/punishment/employee/info', [PunishmentController::class, 'employeeInfo'])->name('punishment.employee.info');
            Route::post('/punishment/delete', [PunishmentController::class, 'destroy'])->name('punishment.delete');
            Route::resource('punishment', PunishmentController::class)->names('punishment');
        });

        //Tools
        Route::prefix('tools')->name('tools.')->group(function () {
             Route::resource('advance-process', AdvanceProcessController::class)->names('advance-process');
             Route::resource('read-machinedata', ReadMachineDataController::class)->names('read-machinedata');
             Route::resource('process-attendence', ProcessAttendenceController::class)->names('process-attendence');
             Route::resource('process-salary', ProcessSalaryController::class)->names('process-salary');
             Route::resource('process-bonus', ProcessBonusController::class)->names('process-bonus');
             Route::resource('process-halfsalary', ProcessHalfSalaryController::class)->names('process-halfsalary');
             Route::resource('edit-attendence', EditAttendenceController::class)->names('edit-attendence');
             Route::resource('edit-punchdata', EditPunchDataController::class)->names('edit-punchdata');
             Route::resource('ot-adjustment', OTAdjustmentController::class)->names('ot-adjustment');
             Route::resource('attendence-adjustment', AttendenceAdjustmentController::class)->names('attendence-adjustment');
        });

        //Report
        Route::prefix('report')->name('report.')->group(function () {
            Route::get('/punch-report/preview', [PunchReportController::class, 'previewData'])->name('punch-report.form.preview');
            Route::post('/punch-report/preview', [PunchReportController::class, 'preview'])->name('punch-report.report.preview');
            Route::resource('punch-report', PunchReportController::class)->names('punch-report');

            Route::get('/attendence-report/preview', [AttendenceReportController::class, 'previewData'])->name('attendence-report.form.preview');
            Route::post('/attendence-report/preview', [AttendenceReportController::class, 'preview'])->name('attendence-report.report.preview');
            Route::resource('attendence-report', AttendenceReportController::class)->names('attendence-report');

            Route::get('/absent-report/preview', [AbsentReportController::class, 'previewData'])->name('absent-report.form.preview');
            Route::post('/absent-report/preview', [AbsentReportController::class, 'preview'])->name('absent-report.report.preview');
            Route::resource('absent-report', AbsentReportController::class)->names('absent-report');

            Route::get('/overtime-report/preview', [OvertimeReportController::class, 'previewData'])->name('overtime-report.form.preview');
            Route::post('/overtime-report/preview', [OvertimeReportController::class, 'preview'])->name('overtime-report.report.preview');
            Route::resource('overtime-report', OvertimeReportController::class)->names('overtime-report');


            Route::get('/salary-report/preview', [SalaryReportController::class, 'previewData'])->name('salary-report.form.preview');
            Route::post('/salary-report/preview', [SalaryReportController::class, 'preview'])->name('salary-report.report.preview');
            Route::resource('salary-report', SalaryReportController::class)->names('salary-report');
        });
    });
});
