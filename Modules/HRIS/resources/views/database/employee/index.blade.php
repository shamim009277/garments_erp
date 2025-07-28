@extends('layouts.app')
@section('title', 'HRIS')
@section('styles')
    <style>
        .table, tr, th, td {
            border: none !important;
            border-collapse: collapse;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            @include('components.breadcrumb', [
                'title' => 'HRIS',
                'subtitle' => 'Employee',
                'breadcrumbs' => [
                    ['label' => 'HRIS', 'url' => route('hris.index')],
                    ['label' => 'Database', 'url' => route('hris.index')],
                    ['label' => 'Employee', 'url' => route('hris.database.employee.index')],
                ],
            ])
        </div>

        <div class="col-lg-12 mb-3">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                <h4 class="text-center flex-grow-1 order-1 order-md-0 mb-2 mb-md-0">Employee</h4>
                <form class="d-flex order-0 order-md-1" style="max-width: 400px;" role="search">
                    <input class="form-control form-control-sm me-2" type="search" placeholder="Applicant Card No ..." aria-label="Search">
                    <button class="btn btn-sm btn-primary d-flex align-items-center" type="submit"> <i data-feather="search" width="14" height="14" class="me-1"></i> Search </button>
                </form>
            </div>
        </div>

        <div class="col-lg-3 pe-lg-0">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="18" height="18"></i> Pending Applicant List</h6>
                </div>
                <div class="card-body" style="min-height: 457px;max-height: 457px; overflow-y: auto;">
                    <ul class="nav-custom">
                        <li class="nav-custom-item">
                            <input type="checkbox" id="dept1">
                            <label class="nav-custom-link" for="dept1"><span class="nav-custom-caret"></span> HR Department (3)</label>
                            <ul class="nav-custom-content">
                                <li class="nav-custom-item">
                                    <input type="checkbox" id="dept1-date1">
                                    <label class="nav-custom-link" for="dept1-date1"><span class="nav-custom-caret"></span> 10-Jul-2025 (2)</label>
                                    <div class="nav-custom-content">
                                        <a href="#" class="employee-link">1625 : John Doe : 2025-07-10</a>
                                        <a href="#" class="employee-link">1626 : Jane Smith : 2025-07-10</a>
                                    </div>
                                </li>
                                <li class="nav-custom-item">
                                    <input type="checkbox" id="dept1-date2">
                                    <label class="nav-custom-link" for="dept1-date2"><span class="nav-custom-caret"></span> 12-Jul-2025 (1)</label>
                                    <div class="nav-custom-content">
                                        <a href="#" class="employee-link">103 : Mark Lee</a>
                                    </div>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-custom-item">
                            <input type="checkbox" id="dept2">
                            <label class="nav-custom-link" for="dept2"><span class="nav-custom-caret"></span> IT Department (1)</label>
                            <ul class="nav-custom-content">
                                <li class="nav-custom-item">
                                    <input type="checkbox" id="dept2-date1">
                                    <label class="nav-custom-link" for="dept2-date1"><span class="nav-custom-caret"></span> 11-Jul-2025 (1)</label>
                                    <div class="nav-custom-content">
                                        <a href="#" class="employee-link">104 : Alice Wong</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-lg-9">
            <div class="card alert-info alert-top-border">
                <div class="card-header d-flex justify-content-between align-items-center px-10 py-12">
                    <h6 class="my-0 text-primary"><i data-feather="list" width="18" height="18"></i> Input Parameters For New Employee ...</h6>
                </div>
                <div class="card-body" style="min-height: 400px;">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 pe-lg-0 pe-md-0">
                                    <table class="table table-striped mb-0" id="employeeTable" width="100%">
                                        <tr>
                                            <th width="30%" style="border: none;">Emp ID</th>
                                            <td width="70%" style="border: none;"><x-text-input name="employee_id" id="employee_id" class="form-control-sm" placeholder="Employee ID" required readonly /></td>
                                        </tr>
                                        <tr>
                                            <th width="30%" style="border: none;">Department</th>
                                            <td width="70%" style="border: none;"><x-select-input name="department_id" id="department_id" class="select2" :options="['1' => 'HR', '2' => 'IT']" required /></td>
                                        </tr>
                                        <tr>
                                            <th width="30%" style="border: none;">Designation</th>
                                            <td width="70%" style="border: none;"><x-select-input name="designation_id" id="designation_id" class="select2" :options="['1' => 'John Doe', '2' => 'Jane Smith']" required /></td>
                                        </tr>
                                        <tr>
                                            <th style="border: none;">Joining Date</th>
                                            <td style="border: none;">
                                                <x-text-input name="joining_date" id="joining_date" type="date" class="form-control-sm" placeholder="Joining Date" required />
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="border: none;">&nbsp; &nbsp;</th>
                                            <td style="border: none;">&nbsp; &nbsp;</td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="col-lg-6 col-md-6 pe-lg-0">
                                    <table class="table table-striped mb-0" id="presentAddressTable" width="100%">
                                        <tr>
                                            <th width="30%" style="border: none;">Line</th>
                                            <td width="70%" style="border: none;"><x-text-input name="line" id="line" type="text" class="form-control-sm" placeholder="Line" required /></td>
                                        </tr>
                                        <tr>
                                            <th width="30%" style="border: none;">Grade</th>
                                            <td width="70%" style="border: none;"><x-text-input name="grade" id="grade" type="text" class="form-control-sm" placeholder="Grade" required /></td>
                                        </tr>
                                        <tr>
                                            <th width="30%" style="border: none;">Salaried?</th>
                                            <td width="70%" style="border: none;"><x-select-input name="salaried" id="salaried" label="Salaried" class="select2" :options="['1' => 'Yes', '2' => 'No']" required /></td>
                                        </tr>
                                        <tr>
                                            <th width="30%" style="border: none;">Confirm Date</th>
                                            <td width="70%" style="border: none;"><x-text-input name="confirm_date" id="confirm_date" type="date" class="form-control-sm" placeholder="Confirm Date" required /></td>
                                        </tr>
                                        <tr>
                                            <th style="border: none;">&nbsp; &nbsp;</th>
                                            <td style="border: none;">&nbsp; &nbsp;</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-6 pe-lg-0">
                                    <table class="table table-striped mb-0" id="employeeTable" width="100%">
                                        <h6 class="text-primary font-weight-bold">Present Address</h6>
                                        <tr>
                                            <th width="30%" style="border: none;">District</th>
                                            <td width="70%" style="border: none;"><x-select-input name="pdistrict_id" id="pdistrict_id" class="select2" :options="['1' => 'HR', '2' => 'IT']" required /></td>
                                        </tr>
                                        <tr>
                                            <th width="30%" style="border: none;">Thana</th>
                                            <td width="70%" style="border: none;">
                                                <x-select-input name="pthana_id" id="pthana_id" class="select2" :options="['1' => 'HR', '2' => 'IT']" required />
                                            </td>
                                        </tr>
                                        <tr>
                                            <th width="30%" style="border: none;">Post Office</th>
                                            <td width="70%" style="border: none;">
                                                <x-text-input name="ppost_office" id="ppost_office" class="form-control-sm" placeholder="Post Office" required />
                                            </td>
                                        </tr>
                                        <tr>
                                            <th width="30%" style="border: none;">Address</th>
                                            <td width="70%" style="border: none;">
                                                <x-text-input name="pvillage" id="pvillage" class="form-control-sm" placeholder="House No/Road No/Village ..." required />
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-lg-6 col-md-6 pe-lg-0">
                                    <table class="table table-striped mb-0" id="presentAddressTable" width="100%">
                                        <h6 class="text-primary font-weight-bold">Mailing Address</h6>
                                        <tr>
                                            <th width="30%" style="border: none;">District</th>
                                            <td width="70%" style="border: none;"><x-select-input name="mdistrict_id" id="mdistrict_id" class="select2" :options="['1' => 'HR', '2' => 'IT']" required /></td>
                                        </tr>
                                        <tr>
                                            <th width="30%" style="border: none;">Thana</th>
                                            <td width="70%" style="border: none;">
                                                <x-select-input name="mthana_id" id="mthana_id" class="select2" :options="['1' => 'HR', '2' => 'IT']" required />
                                            </td>
                                        </tr>
                                        <tr>
                                            <th width="30%" style="border: none;">Post Office</th>
                                            <td width="70%" style="border: none;">
                                                <x-text-input name="mpost_office" id="mpost_office" class="form-control-sm" placeholder="Post Office" required />
                                            </td>
                                        </tr>
                                        <tr>
                                            <th width="30%" style="border: none;">Address</th>
                                            <td width="70%" style="border: none;">
                                                <x-text-input name="mvillage" id="mvillage" class="form-control-sm" placeholder="House No/Road No/Village ..." required />
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 pe-lg-0">
                            <table class="table table-striped" id="employeeTable" width="100%">
                                <tr>
                                    <th width="30%" style="border: none;">Punch Category</th>
                                    <td width="70%" style="border: none;"><x-select-input name="punch_category" id="punch_category" class="select2" :options="['1' => 'HR', '2' => 'IT']" required /></td>
                                </tr>
                                <tr>
                                    <th width="30%" style="border: none;">Shifting Duty?</th>
                                    <td width="70%" style="border: none;"><x-select-input name="shifting_duty" id="shifting_duty" class="select2" :options="['1' => 'HR', '2' => 'IT']" required /></td>
                                </tr>
                                <tr>
                                    <th width="30%" style="border: none;">Reference Shift?</th>
                                    <td width="70%" style="border: none;"><x-select-input name="reference_shift" id="reference_shift" class="select2" :options="['1' => 'HR', '2' => 'IT']" required /></td>
                                </tr>
                                <tr>
                                    <th width="30%" style="border: none;">Reference Date</th>
                                    <td width="70%" style="border: none;"><x-text-input name="reference_date" type="date" id="reference_date" class="form-control-sm" placeholder="Reference Date" required /></td>
                                </tr>
                                <tr>
                                    <th width="30%" style="border: none;">Name</th>
                                    <td width="70%" style="border: none;"><x-text-input name="name" class="form-control-sm" placeholder="Name" :value="old('name')" required /></td>
                                </tr>
                                <tr>
                                    <th width="30%" style="border: none;">Father Name</th>
                                    <td width="70%" style="border: none;"><x-text-input name="nameD" class="form-control-sm" placeholder="Father Name" :value="old('nameD')" required /></td>
                                </tr>
                                <tr>
                                    <th width="30%" style="border: none;">Mother Name</th>
                                    <td width="70%" style="border: none;"><x-text-input name="nameD" class="form-control-sm" placeholder="Mother Name" :value="old('nameD')" required /></td>
                                </tr>
                                <tr>
                                    <th width="30%" style="border: none;">Spouse Name</th>
                                    <td width="70%" style="border: none;"><x-text-input name="nameD" class="form-control-sm" placeholder="Spouse Name" :value="old('nameD')" /></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer" style="padding:14px 20px;">
                    <x-primary-button class="float-start btn-sm submitBtn">Save And Go</x-primary-button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Date restriction
            let today = new Date().toISOString().split('T')[0];
            $('#joining_date').attr('min', today);

            // Initialize Select2
            $('.select2').select2({
                placeholder: "Select an option",
                allowClear: true,
                width: '100%'
            });
        });
    </script>
@endpush
