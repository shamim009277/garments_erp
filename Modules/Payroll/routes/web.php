<?php

use App\Http\Middleware\ModuleActive;
use Illuminate\Support\Facades\Route;
use Modules\Payroll\Http\Controllers\PayrollController;
use Modules\Payroll\Http\Controllers\Database\AdvanceController;
use Modules\Payroll\Http\Controllers\Tools\ProcessBonusController;
use Modules\Payroll\Http\Controllers\Database\PunishmentController;
use Modules\Payroll\Http\Controllers\Tools\ProcessSalaryController;
use Modules\Payroll\Http\Controllers\Tools\AdvanceProcessController;
use Modules\Payroll\Http\Controllers\Tools\EditAttendenceController;
use Modules\Payroll\Http\Controllers\Tools\ReadMachineDataController;
use Modules\Payroll\Http\Controllers\Tools\ProcessAttendenceController;
use Modules\Payroll\Http\Controllers\Tools\ProcessHalfSalaryController;

Route::middleware(['auth', 'verified',ModuleActive::class.':payroll'])->group(function () {
    Route::resource('payroll', PayrollController::class)->names('payroll');

    Route::prefix('payroll')->name('payroll.')->group(function () {
        //Setup
        Route::prefix('setup')->name('setup.')->group(function () {

        });

        //Database
        Route::prefix('database')->name('database.')->group(function () {
            Route::post('/employee/info', [AdvanceController::class, 'employeeInfo'])->name('advance.employee.info');
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
        });

        //Report
        Route::prefix('report')->name('report.')->group(function () {

        });
    });
});
