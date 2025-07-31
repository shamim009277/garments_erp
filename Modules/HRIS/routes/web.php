<?php

use App\Http\Middleware\ModuleActive;
use Illuminate\Support\Facades\Route;
use Modules\HRIS\Http\Controllers\HRISController;
use Modules\HRIS\Http\Controllers\SettingController;
use Modules\HRIS\Http\Controllers\Setup\SexController;
use Modules\HRIS\Http\Controllers\Setup\GradeController;
use Modules\HRIS\Http\Controllers\Setup\ShiftController;
use Modules\HRIS\Http\Controllers\Setup\ThanaController;
use Modules\HRIS\Http\Controllers\Setup\UnionController;
use Modules\HRIS\Http\Controllers\Setup\DegreeController;
use Modules\HRIS\Http\Controllers\Setup\DistrictController;
use Modules\HRIS\Http\Controllers\Setup\DivisionController;
use Modules\HRIS\Http\Controllers\Setup\DocumentController;
use Modules\HRIS\Http\Controllers\Setup\ReligionController;
use Modules\HRIS\Http\Controllers\Setup\DepartmentController;
use Modules\HRIS\Http\Controllers\Database\EmployeeController;
use Modules\HRIS\Http\Controllers\Setup\DesignationController;
use Modules\HRIS\Http\Controllers\Database\ApplicantController;
use Modules\HRIS\Http\Controllers\Setup\OrganizationController;
use Modules\HRIS\Http\Controllers\Setup\MaritalStatusController;
use Modules\HRIS\Http\Controllers\Setup\NationalitiesController;
use Modules\HRIS\Http\Controllers\Setup\EducationBoardController;
use Modules\HRIS\Http\Controllers\Setup\SourceReferenceController;
use Modules\HRIS\Http\Controllers\Setup\EmployeeCategoryController;
use Modules\HRIS\Http\Controllers\Setup\ParentDepartmentController;
use Modules\HRIS\Http\Controllers\Setup\ParentDesignationController;
use Modules\HRIS\Http\Controllers\Database\EmployeeServiceController;
use Modules\HRIS\Http\Controllers\Database\EmployeeIDAssignController;
use Modules\HRIS\Http\Controllers\Database\EmployeeTrainingController;
use Modules\HRIS\Http\Controllers\Setup\LeaveClassificationController;
use Modules\HRIS\Http\Controllers\Database\EmployeeEducationController;
use Modules\HRIS\Http\Controllers\Database\EmployeeReferenceController;
use Modules\HRIS\Http\Controllers\Database\EmployeeExperienceController;

Route::middleware(['auth', 'verified', ModuleActive::class . ':hris'])->group(function () {
    //Route::resource('hris', HRISController::class)->names('hris');
    Route::get('/hris', [HRISController::class, 'index'])->name('hris.index');

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
        });

        //Database

        Route::prefix('database')->name('database.')->group(function () {
            Route::post('/new-applicants/search', [ApplicantController::class, 'getSearch'])->name('new-applicants.search');
            Route::post('/new-applicants/delete', [ApplicantController::class, 'destroy'])->name('new-applicants.delete');
            Route::resource('new-applicants', ApplicantController::class)->names('new-applicants');

            Route::resource('employee-idassign', EmployeeIDAssignController::class)->names('employee-idassign');

            Route::get('/designation/{id}', [EmployeeController::class, 'getGrade'])->name('employee.getGrade');
            Route::get('/district/{district_id}', [EmployeeController::class, 'getThana'])->name('employee.getThana');
            Route::post('/search', [EmployeeController::class, 'getSearch'])->name('employee.search');
            Route::post('/employee/bangla', [EmployeeController::class, 'storeEmployeeBangla'])->name('employee.bangla');
            Route::post('/employee/salary', [EmployeeController::class, 'storeEmployeeSalary'])->name('employee.salary');
            Route::post('/employee/personal', [EmployeeController::class, 'storeEmployeePersonal'])->name('employee.personal');
            Route::post('/employee/document', [EmployeeController::class, 'storeEmployeeDocument'])->name('employee.document');
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
        });

        //Report
        Route::prefix('report')->name('report.')->group(function () {

        });

        //Settings
        Route::resource('settings', SettingController::class)->names('setting');
    });
});
