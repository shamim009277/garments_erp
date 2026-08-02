<?php

use App\Http\Middleware\ModuleActive;
use Illuminate\Support\Facades\Route;
use Modules\HRIS\Http\Controllers\Database\ApplicantController;
use Modules\HRIS\Http\Controllers\Database\BulkIncrementController;
use Modules\HRIS\Http\Controllers\Database\ELCalculationController;
use Modules\HRIS\Http\Controllers\Database\ELPaymentController;
use Modules\HRIS\Http\Controllers\Database\EmpGatePassController;
use Modules\HRIS\Http\Controllers\Database\EmployeeController;
use Modules\HRIS\Http\Controllers\Database\EmployeeEducationController;
use Modules\HRIS\Http\Controllers\Database\EmployeeExperienceController;
use Modules\HRIS\Http\Controllers\Database\EmployeeIDAssignController;
use Modules\HRIS\Http\Controllers\Database\EmployeeIncrementController;
use Modules\HRIS\Http\Controllers\Database\EmployeeReferenceController;
use Modules\HRIS\Http\Controllers\Database\EmployeeServiceController;
use Modules\HRIS\Http\Controllers\Database\EmployeeTrainingController;
use Modules\HRIS\Http\Controllers\Database\IncrementEnforceController;
use Modules\HRIS\Http\Controllers\Database\IndividualIncrementController;
use Modules\HRIS\Http\Controllers\Database\LeaveAllController;
use Modules\HRIS\Http\Controllers\Database\LeaveApplicationController;
use Modules\HRIS\Http\Controllers\Database\LeaveApproveController;
use Modules\HRIS\Http\Controllers\Database\LeaveForwardController;
use Modules\HRIS\Http\Controllers\Database\PhotoSignController;
use Modules\HRIS\Http\Controllers\Database\ServiceBenefitController;
use Modules\HRIS\Http\Controllers\HRISController;
use Modules\HRIS\Http\Controllers\Report\ApplicantReportController;
use Modules\HRIS\Http\Controllers\Report\AutoGenerationReportController;
use Modules\HRIS\Http\Controllers\Report\EmployeeListingReportController;
use Modules\HRIS\Http\Controllers\Report\IncrementReportController;
use Modules\HRIS\Http\Controllers\Report\LeaveReportController;
use Modules\HRIS\Http\Controllers\Report\MovementPassReportController;
use Modules\HRIS\Http\Controllers\Report\ShiftingReportController;
use Modules\HRIS\Http\Controllers\Report\SummaryReportController;
use Modules\HRIS\Http\Controllers\Settings\ForwardApproveController;
use Modules\HRIS\Http\Controllers\Settings\SettingController;
use Modules\HRIS\Http\Controllers\Setup\CompanyUnitController;
use Modules\HRIS\Http\Controllers\Setup\CompanyWiseRamadanShiftController;
use Modules\HRIS\Http\Controllers\Setup\CompanyWiseShiftController;
use Modules\HRIS\Http\Controllers\Setup\DegreeController;
use Modules\HRIS\Http\Controllers\Setup\DepartmentController;
use Modules\HRIS\Http\Controllers\Setup\DepartureReasonController;
use Modules\HRIS\Http\Controllers\Setup\DesignationController;
use Modules\HRIS\Http\Controllers\Setup\DistrictController;
use Modules\HRIS\Http\Controllers\Setup\DivisionController;
use Modules\HRIS\Http\Controllers\Setup\DocumentController;
use Modules\HRIS\Http\Controllers\Setup\EducationBoardController;
use Modules\HRIS\Http\Controllers\Setup\EmpGatepassPurposeController;
use Modules\HRIS\Http\Controllers\Setup\EmpGatepassReasonController;
use Modules\HRIS\Http\Controllers\Setup\EmployeeCategoryController;
use Modules\HRIS\Http\Controllers\Setup\GradeController;
use Modules\HRIS\Http\Controllers\Setup\LeaveClassificationController;
use Modules\HRIS\Http\Controllers\Setup\LeaveReasonController;
use Modules\HRIS\Http\Controllers\Setup\LineController;
use Modules\HRIS\Http\Controllers\Setup\MaritalStatusController;
use Modules\HRIS\Http\Controllers\Setup\NationalitiesController;
use Modules\HRIS\Http\Controllers\Setup\OrganizationController;
use Modules\HRIS\Http\Controllers\Setup\ParentDepartmentController;
use Modules\HRIS\Http\Controllers\Setup\ParentDesignationController;
use Modules\HRIS\Http\Controllers\Setup\ReligionController;
use Modules\HRIS\Http\Controllers\Setup\SexController;
use Modules\HRIS\Http\Controllers\Setup\ShiftController;
use Modules\HRIS\Http\Controllers\Setup\SourceReferenceController;
use Modules\HRIS\Http\Controllers\Setup\ThanaController;
use Modules\HRIS\Http\Controllers\Setup\UnionController;
use Modules\HRIS\Http\Controllers\Setup\UnitController;
use Modules\HRIS\Http\Controllers\Tools\CalenderController;
use Modules\HRIS\Http\Controllers\Tools\DepartureController;
use Modules\HRIS\Http\Controllers\Tools\DesignationChangeController;
use Modules\HRIS\Http\Controllers\Tools\EditExceptionalHolidayController;
use Modules\HRIS\Http\Controllers\Tools\EditShiftingListController;
use Modules\HRIS\Http\Controllers\Tools\ExceptionalHolidayController;
use Modules\HRIS\Http\Controllers\Tools\MaternityEntryController;
use Modules\HRIS\Http\Controllers\Tools\NewEmployeeShiftingListController;
use Modules\HRIS\Http\Controllers\Tools\ShiftingListController;



Route::middleware(['auth', 'verified', ModuleActive::class . ':hris'])->group(function () {
    Route::get('/hris/dashboard-data', [HRISController::class, 'getDashboardAjax'])->name('hris.dashboard-data');
    Route::resource('hris', HRISController::class)->names('hris');
    //Route::get('/hris', [HRISController::class, 'index'])->name('hris.index');

    Route::prefix('hris')->name('hris.')->group(function () {
        //Setup
        Route::prefix('setup')->name('setup.')->group(function () {
            //Nationalities
            Route::post('/nationalities/toggle', [NationalitiesController::class, 'toggleStatus'])->name('nationalities.toggle');
            Route::post('/nationalities/delete', [NationalitiesController::class, 'destroy'])->name('nationalities.delete');
            Route::resource('nationalities', NationalitiesController::class)->names('nationalities');

            //Marital Status
            Route::post('/maritalstatus/toggle', [MaritalStatusController::class, 'toggleStatus'])->name('maritalstatus.toggle');
            Route::post('/maritalstatus/delete', [MaritalStatusController::class, 'destroy'])->name('maritalstatus.delete');
            Route::resource('maritalstatus', MaritalStatusController::class)->names('maritalstatus');

            //Sex
            Route::post('/sex/toggle', [SexController::class, 'toggleStatus'])->name('sex.toggle');
            Route::post('/sex/delete', [SexController::class, 'destroy'])->name('sex.delete');
            Route::resource('sex', SexController::class)->names('sex');

            //Religion
            Route::post('/religions/toggle', [ReligionController::class, 'toggleStatus'])->name('religions.toggle');
            Route::post('/religions/delete', [ReligionController::class, 'destroy'])->name('religions.delete');
            Route::resource('religions', ReligionController::class)->names('religions');

            //Division
            Route::post('/divisions/toggle', [DivisionController::class, 'toggleStatus'])->name('divisions.toggle');
            Route::post('/divisions/delete', [DivisionController::class, 'destroy'])->name('divisions.delete');
            Route::resource('divisions', DivisionController::class)->names('divisions');

            //District
            Route::post('/districts/toggle', [DistrictController::class, 'toggleStatus'])->name('districts.toggle');
            Route::post('/districts/delete', [DistrictController::class, 'destroy'])->name('districts.delete');
            Route::resource('districts', DistrictController::class)->names('districts');

            //Thana
            Route::post('/thanas/toggle', [ThanaController::class, 'toggleStatus'])->name('thanas.toggle');
            Route::post('/thanas/delete', [ThanaController::class, 'destroy'])->name('thanas.delete');
            Route::resource('thanas', ThanaController::class)->names('thanas');

            //Union
            Route::post('/unions/toggle', [UnionController::class, 'toggleStatus'])->name('unions.toggle');
            Route::post('/unions/delete', [UnionController::class, 'destroy'])->name('unions.delete');
            Route::resource('unions', UnionController::class)->names('unions');

            //Education Board
            Route::post('/educationboards/toggle', [EducationBoardController::class, 'toggleStatus'])->name('educationboards.toggle');
            Route::post('/educationboards/delete', [EducationBoardController::class, 'destroy'])->name('educationboards.delete');
            Route::resource('educationboards', EducationBoardController::class)->names('educationboards');

            //Document
            Route::post('/documents/toggle', [DocumentController::class, 'toggleStatus'])->name('documents.toggle');
            Route::post('/documents/delete', [DocumentController::class, 'destroy'])->name('documents.delete');
            Route::resource('documents', DocumentController::class)->names('documents');

            //Source Reference
            Route::post('/sourcereferences/toggle', [SourceReferenceController::class, 'toggleStatus'])->name('sourcereferences.toggle');
            Route::post('/sourcereferences/delete', [SourceReferenceController::class, 'destroy'])->name('sourcereferences.delete');
            Route::resource('sourcereferences', SourceReferenceController::class)->names('sourcereferences');

            //Employee Category
            Route::post('/employeecategories/toggle', [EmployeeCategoryController::class, 'toggleStatus'])->name('employeecategories.toggle');
            Route::post('/employeecategories/delete', [EmployeeCategoryController::class, 'destroy'])->name('employeecategories.delete');
            Route::resource('employeecategories', EmployeeCategoryController::class)->names('employeecategories');

            //Organization
            Route::post('/organizations/toggle', [OrganizationController::class, 'toggleStatus'])->name('organizations.toggle');
            Route::post('/organizations/delete', [OrganizationController::class, 'destroy'])->name('organizations.delete');
            Route::resource('organizations', OrganizationController::class)->names('organizations');

            //Shift
            Route::post('/shifts/toggle', [ShiftController::class, 'toggleStatus'])->name('shifts.toggle');
            Route::post('/shifts/delete', [ShiftController::class, 'destroy'])->name('shifts.delete');
            Route::resource('shifts', ShiftController::class)->names('shifts');

            //Company Wise Shift
            Route::post('/companywise-shifts/toggle', [CompanyWiseShiftController::class, 'toggleStatus'])->name('companywise-shifts.toggle');
            Route::post('/companywise-shifts/shift-details', [CompanyWiseShiftController::class, 'shiftDetails'])->name('companywise-shifts.shift-details');
            Route::post('/companywise-shifts/delete', [CompanyWiseShiftController::class, 'destroy'])->name('companywise-shifts.delete');
            Route::resource('companywise-shifts', CompanyWiseShiftController::class)->names('companywise-shifts');

            //Company Wise Ramadan Shift
            Route::post('/companywise-ramadan-shifts/toggle', [CompanyWiseRamadanShiftController::class, 'toggleStatus'])->name('companywise-ramadan-shifts.toggle');
            Route::post('/companywise-ramadan-shifts/shift-details', [CompanyWiseRamadanShiftController::class, 'shiftDetails'])->name('companywise-ramadan-shifts.shift-details');
            Route::post('/companywise-ramadan-shifts/delete', [CompanyWiseRamadanShiftController::class, 'destroy'])->name('companywise-ramadan-shifts.delete');
            Route::resource('companywise-ramadan-shifts', CompanyWiseRamadanShiftController::class)->names('companywise-ramadan-shifts');

            //Leave Classification
            Route::post('/leaveclassifications/toggle', [LeaveClassificationController::class, 'toggleStatus'])->name('leaveclassifications.toggle');
            Route::post('/leaveclassifications/delete', [LeaveClassificationController::class, 'destroy'])->name('leaveclassifications.delete');
            Route::resource('leaveclassifications', LeaveClassificationController::class)->names('leaveclassifications');

            //Parent Department
            Route::post('/parentdepartments/toggle', [ParentDepartmentController::class, 'toggleStatus'])->name('parentdepartments.toggle');
            Route::post('/parentdepartments/delete', [ParentDepartmentController::class, 'destroy'])->name('parentdepartments.delete');
            Route::resource('parentdepartments', ParentDepartmentController::class)->names('parentdepartments');

            //Parent Designation
            Route::post('/parentdesignations/toggle', [ParentDesignationController::class, 'toggleStatus'])->name('parentdesignations.toggle');
            Route::post('/parentdesignations/delete', [ParentDesignationController::class, 'destroy'])->name('parentdesignations.delete');
            Route::resource('parentdesignations', ParentDesignationController::class)->names('parentdesignations');

            //Department
            Route::post('/departments/toggle', [DepartmentController::class, 'toggleStatus'])->name('departments.toggle');
            Route::post('/departments/delete', [DepartmentController::class, 'destroy'])->name('departments.delete');
            Route::resource('departments', DepartmentController::class)->names('departments');

            //Designation
            Route::post('/designations/toggle', [DesignationController::class, 'toggleStatus'])->name('designations.toggle');
            Route::post('/designations/delete', [DesignationController::class, 'destroy'])->name('designations.delete');
            Route::resource('designations', DesignationController::class)->names('designations');

            //Degree
            Route::post('/degrees/toggle', [DegreeController::class, 'toggleStatus'])->name('degrees.toggle');
            Route::post('/degrees/delete', [DegreeController::class, 'destroy'])->name('degrees.delete');
            Route::resource('degrees', DegreeController::class)->names('degrees');

            //Departure Reason
            Route::post('/departurereasons/toggle', [DepartureReasonController::class, 'toggleStatus'])->name('departurereasons.toggle');
            Route::post('/departurereasons/delete', [DepartureReasonController::class, 'destroy'])->name('departurereasons.delete');
            Route::resource('departurereasons', DepartureReasonController::class)->names('departurereasons');
            //EmpGatepassPurpose
            Route::post('/gatepass_purpose/toggle', [EmpGatepassPurposeController::class, 'toggleStatus'])->name('gatepass_purpose.toggle');
            Route::post('/gatepass_purpose/delete', [EmpGatepassPurposeController::class, 'destroy'])->name('gatepass_purpose.delete');
            Route::resource('gatepass_purpose', EmpGatepassPurposeController::class)->names('gatepass_purpose');

            //EmpGatepassReason
            Route::post('/gatepass_reason/toggle', [EmpGatepassReasonController::class, 'toggleStatus'])->name('gatepass_reason.toggle');
            Route::post('/gatepass_reason/delete', [EmpGatepassReasonController::class, 'destroy'])->name('gatepass_reason.delete');
            Route::resource('gatepass_reason', EmpGatepassReasonController::class)->names('gatepass_reason');

            //Leave Reason
            Route::post('/leavereason/toggle', [LeaveReasonController::class, 'toggleStatus'])->name('leavereason.toggle');
            Route::post('/leavereason/delete', [LeaveReasonController::class, 'destroy'])->name('leavereason.delete');
            Route::resource('leavereason', LeaveReasonController::class)->names('leavereason');

            //Line
            Route::post('/lines/toggle', [LineController::class, 'toggleStatus'])->name('lines.toggle');
            Route::post('/lines/delete', [LineController::class, 'destroy'])->name('lines.delete');
            Route::resource('lines', LineController::class)->names('lines');

            //Unit
            Route::post('/units/toggle', [UnitController::class, 'toggleStatus'])->name('units.toggle');
            Route::post('/units/delete', [UnitController::class, 'destroy'])->name('units.delete');
            Route::resource('units', UnitController::class)->names('units');

             //Company Wise Unit
            Route::post('/companyunits/toggle', [CompanyUnitController::class, 'toggleStatus'])->name('companyunits.toggle');
            Route::post('/companyunits/delete', [CompanyUnitController::class, 'destroy'])->name('companyunits.delete');
            Route::resource('companyunits', CompanyUnitController::class)->names('companyunits');
        });

        //Database
        Route::prefix('database')->name('database.')->group(function () {
            Route::post('/new-applicants/search', [ApplicantController::class, 'getSearch'])->name('new-applicants.search');
            Route::post('/new-applicants/delete', [ApplicantController::class, 'destroy'])->name('new-applicants.delete');
            Route::resource('new-applicants', ApplicantController::class)->names('new-applicants');
            Route::resource('employee-idassign', EmployeeIDAssignController::class)->names('employee-idassign');

            Route::get('/unitline/{id}', [EmployeeController::class, 'getUnitLine'])->name('employee.getUnitLine');
            Route::get('/unit/{id}', [EmployeeController::class, 'getUnit'])->name('employee.getUnit');
            Route::get('/designation/{id}', [EmployeeController::class, 'getGrade'])->name('employee.getGrade');
            Route::get('/district/{district_id}', [EmployeeController::class, 'getThana'])->name('employee.getThana');
            Route::post('/search', [EmployeeController::class, 'getSearch'])->name('employee.search');
            Route::post('/employee/bangla', [EmployeeController::class, 'storeEmployeeBangla'])->name('employee.bangla');
            Route::post('/employee/salary', [EmployeeController::class, 'storeEmployeeSalary'])->name('employee.salary');
            Route::post('/employee/personal', [EmployeeController::class, 'storeEmployeePersonal'])->name('employee.personal');
            Route::post('/employee/permission', [EmployeeController::class, 'storeEmployeePermission'])->name('employee.permission');
            Route::post('/employee/document', [EmployeeController::class, 'storeEmployeeDocument'])->name('employee.document');
            Route::post('/employee-info', [EmployeeController::class, 'getEmployeeInfo'])->name('employee.info');
            Route::resource('employee', EmployeeController::class)->names('employee');

            Route::post('/employee-education/delete', [EmployeeEducationController::class, 'destroy'])->name('employee-education.delete');
            Route::resource('employee-education', EmployeeEducationController::class)->names('employee-education');
            Route::post('/employee-training/delete', [EmployeeTrainingController::class, 'destroy'])->name('employee-training.delete');
            Route::resource('employee-training', EmployeeTrainingController::class)->names('employee-training');
            Route::post('/employee-experience/delete', [EmployeeExperienceController::class, 'destroy'])->name('employee-experience.delete');
            Route::resource('employee-experience', EmployeeExperienceController::class)->names('employee-experience');
            Route::post('/employee-reference/delete', [EmployeeReferenceController::class, 'destroy'])->name('employee-reference.delete');
            Route::resource('employee-reference', EmployeeReferenceController::class)->names('employee-reference');
            Route::post('/employee-service/delete', [EmployeeServiceController::class, 'destroy'])->name('employee-service.delete');
            Route::resource('employee-service', EmployeeServiceController::class)->names('employee-service');

            Route::post('/employee-gatepass/reasons', [EmpGatePassController::class, 'getReasons'])->name('employee-gatepass.reasons');
            Route::get('/employee-gatepass/in', [EmpGatePassController::class, 'getEmployeeIn'])->name('employee-gatepass.in');
            Route::post('/employee-gatepass/in', [EmpGatePassController::class, 'getEmployeeInUpdate'])->name('employee-gatepass.in.update');
            Route::get('/employee-gatepass/out', [EmpGatePassController::class, 'getEmployeeOut'])->name('employee-gatepass.out');
            Route::post('/employee-gatepass/out', [EmpGatePassController::class, 'getEmployeeOutUpdate'])->name('employee-gatepass.out.update');
            Route::post('/employee-gatepass/employee-info', [EmpGatePassController::class, 'getEmployee'])->name('employee-gatepass.employee.info');
            Route::resource('employee-gatepass', EmpGatePassController::class)->names('employee-gatepass');

            Route::post('/leave-application/reasons', [LeaveApplicationController::class, 'getReasons'])->name('leave-application.reasons');
            Route::post('/leave/info', [LeaveApplicationController::class, 'getLeaveInfo'])->name('leave.info');
            Route::post('/getleavereason', [LeaveApplicationController::class, 'getLeaveReason'])->name('getleavereason');
            Route::resource('leave-application', LeaveApplicationController::class)->names('leave-application');
            Route::resource('leave-forward', LeaveForwardController::class)->names('leave-forward');
            Route::resource('leave-approve', LeaveApproveController::class)->names('leave-approve');

            Route::resource('leave-all', LeaveAllController::class)->names('leave-all');
            // photo sign
            Route::post('/photosign/delete', [PhotoSignController::class, 'destroy'])->name('photosign.delete');
            Route::post('/photosign/info', [PhotoSignController::class, 'info'])->name('photosign.info');
            Route::resource('photosign', PhotoSignController::class)->names('photosign');

            // Bulk Increment
            Route::post('/fetch-designation', [BulkIncrementController::class, 'fetchDesignation'])->name('fetch-designation');
            Route::resource('bulk-increment', BulkIncrementController::class)->names('bulk-increment');
            Route::get('/employee-increment/download-sample', [EmployeeIncrementController::class, 'downloadSample'])->name('employee-increment.download-sample');
            Route::resource('employee-increment', EmployeeIncrementController::class)->names('employee-increment');
            Route::resource('increment-enforce', IncrementEnforceController::class)->names('increment-enforce');

            Route::resource('elcalculation', ELCalculationController::class)->names('elcalculation');
            Route::resource('elpayment', ELPaymentController::class)->names('elpayment');

            Route::post('/servicebenefit/delete', [ServiceBenefitController::class, 'destroy'])->name('servicebenefit.delete');
            Route::post('/servicebenefit/confirm', [ServiceBenefitController::class, 'confirm'])->name('servicebenefit.confirm');
            Route::post('/servicebenefit/status/update', [ServiceBenefitController::class, 'statusUpdate'])->name('servicebenefit.status.update');
            Route::resource('servicebenefit', ServiceBenefitController::class)->names('servicebenefit');

            Route::post('/individual-increment/info', [IndividualIncrementController::class, 'getLeaveInfo'])->name('individual-increment.info');
            Route::resource('individual-increment', IndividualIncrementController::class)->names('individual-increment');
        });

        //Reports
        Route::prefix('report')->name('report.')->group(function () {
            //Employee Listing
            Route::get('/employee-listings/preview', [EmployeeListingReportController::class, 'previewData'])->name('employee-listings.form.preview');
            Route::post('/employee-listings/preview', [EmployeeListingReportController::class, 'preview'])->name('employee-listings.report.preview');
            Route::resource('employee-listings', EmployeeListingReportController::class)->names('employee-listings');
            //Leave Report
            Route::get('/leave-report/preview', [LeaveReportController::class, 'previewData'])->name('leave-report.form.preview');
            Route::post('/leave-report/preview', [LeaveReportController::class, 'preview'])->name('leave-report.report.preview');
            Route::resource('leave-report', LeaveReportController::class)->names('leave-report');
            //Movement Pass
            Route::get('/movement-pass/preview', [MovementPassReportController::class, 'previewData'])->name('movement-pass.form.preview');
            Route::post('/movement-pass/preview', [MovementPassReportController::class, 'preview'])->name('movement-pass.report.preview');
            Route::resource('movement-pass', MovementPassReportController::class)->names('movement-pass');

            //Shifting Report
            Route::get('/shifting-report/preview', [ShiftingReportController::class, 'previewData'])->name('shifting-report.form.preview');
            Route::post('/shifting-report/preview', [ShiftingReportController::class, 'preview'])->name('shifting-report.report.preview');
            Route::resource('shifting-report', ShiftingReportController::class)->names('shifting-report');

            //Applicant Report
            Route::get('/applicant-report/preview', [ApplicantReportController::class, 'previewData'])->name('applicant-report.form.preview');
            Route::post('/applicant-report/preview', [ApplicantReportController::class, 'preview'])->name('applicant-report.report.preview');
            Route::resource('applicant-report', ApplicantReportController::class)->names('applicant-report');
            Route::get('/test-bangla-pdf', [ApplicantReportController::class, 'generateBanglaPDF']);

            //Increment Report
            Route::get('/increment-report/preview', [IncrementReportController::class, 'previewData'])->name('increment-report.form.preview');
            Route::post('/increment-report/preview', [IncrementReportController::class, 'preview'])->name('increment-report.report.preview');
            Route::resource('increment-report', IncrementReportController::class)->names('increment-report');

            //Summary Report
            Route::get('/summary-report/preview', [SummaryReportController::class, 'previewData'])->name('summary-report.form.preview');
            Route::post('/summary-report/preview', [SummaryReportController::class, 'preview'])->name('summary-report.report.preview');
            Route::resource('summary-report', SummaryReportController::class)->names('summary-report');

            //autogeneration report
            Route::get('/autogeneration-report/preview', [AutoGenerationReportController::class, 'previewData'])->name('autogeneration-report.form.preview');
            Route::post('/autogeneration-report/preview', [AutoGenerationReportController::class, 'preview'])->name('autogeneration-report.report.preview');
            Route::resource('autogeneration-report', AutoGenerationReportController::class)->names('autogeneration-report');

        });

        //Settings
        Route::prefix('settings')->name('settings.')->group(function () {
            Route::post('/setting/schedule', [SettingController::class, 'schedule'])->name('setting.schedule');
            Route::resource('hr-settings', SettingController::class)->names('hr-settings');
            Route::post('/fetch-user', [ForwardApproveController::class, 'fetchUser'])->name('forward-approve.fetch-user');
            Route::post('/fetch-approved-data', [ForwardApproveController::class, 'fetchApprovedData'])->name('forward-approve.fetch-approved-data');
            Route::post('/fetch-forward-data', [ForwardApproveController::class, 'fetchForwardData'])->name('forward-approve.fetch-forward-data');
            Route::post('/delete-approved-user', [ForwardApproveController::class, 'deleteApprovedUser'])->name('forward-approve.delete-approved-user');
            Route::post('/replace-user', [ForwardApproveController::class, 'replaceUser'])->name('forward-approve.replace-user');
            Route::resource('forward-approve', ForwardApproveController::class)->names('forward-approve');
        });

        //tools
        Route::prefix('tools')->name('tools.')->group(function () {
            Route::resource('designationchange', DesignationChangeController::class)->names('designationchange');
            Route::post('/departure/info', [DepartureController::class, 'employeeInfo'])->name('departure.info');
            Route::resource('departure', DepartureController::class)->names('departure');
            Route::resource('calender', CalenderController::class)->names('calender');
            Route::get('/shiftinglist/status/{id}', [ShiftingListController::class, 'checkStatus'])->name('shiftinglist.status');
            Route::resource('shiftinglist', ShiftingListController::class)->names('shiftinglist');
            Route::resource('newshiftinglist', NewEmployeeShiftingListController::class)->names('newshiftinglist');

            Route::resource('edit-shiftinglist', EditShiftingListController::class)->names('edit-shiftinglist');
            Route::post('/edit-shiftinglist/getEmployee', [EditShiftingListController::class, 'getEmployee'])->name('edit-shiftinglist.getEmployee');

            Route::resource('exceptional-holidays', ExceptionalHolidayController::class)->names('exceptional-holidays');
            Route::post('/editexceptional-holidays/delete', [EditExceptionalHolidayController::class, 'destroy'])->name('editexceptional-holidays.delete');
            Route::resource('editexceptional-holidays', EditExceptionalHolidayController::class)->names('editexceptional-holidays');
            Route::post('/maternity-entry/delete', [MaternityEntryController::class, 'destroy'])->name('maternity-entry.delete');
            Route::resource('maternity-entry', MaternityEntryController::class)->names('maternity-entry');
        });
    });
});
