@extends('layouts.app')
@section('title', 'HRIS')
@section('styles')
    <style>
        .table,
        tr,
        th,
        td {
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
                <form action="{{ route('hris.database.employee.search') }}" method="POST" class="d-flex order-0 order-md-1"
                    style="max-width: 400px;" role="search">
                    @csrf
                    <input class="form-control form-control-sm me-2" type="search" name="search"
                        placeholder="Applicant Card No ..." aria-label="Search">
                    <button class="btn btn-sm btn-primary d-flex align-items-center" type="submit"> <i
                            data-feather="search" width="14" height="14" class="me-1"></i> Search </button>
                </form>
            </div>
        </div>

        <div class="col-lg-3 pe-lg-0">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="18" height="18"></i> Pending
                        Applicant List</h6>
                </div>
                <div class="card-body" style="min-height: 477px;max-height: 477px; overflow-y: auto;">
                    @php
                        $companyWise = collect($applicants)->groupBy('org_id');
                    @endphp

                    <ul class="nav-custom">
                        @foreach ($companyWise as $companyId => $companyApplicants)
                            @php
                                $companyName = $companyApplicants->first()->Organization->short_name ?? 'N/A';
                                $departmentWise = $companyApplicants->groupBy('department_id');
                            @endphp

                            <li class="nav-custom-item">
                                <input type="checkbox" id="company{{ $companyId }}">
                                <label class="nav-custom-link" for="company{{ $companyId }}">
                                    <span class="nav-custom-caret"></span>
                                    {{ $companyName }} ({{ $companyApplicants->count() }})
                                </label>

                                <ul class="nav-custom-content">
                                    @foreach ($departmentWise as $departmentId => $deptApplicants)
                                        @php
                                            $departmentName = $deptApplicants->first()->department->department ?? 'N/A';
                                            $dateWise = $deptApplicants->groupBy('entry_date');
                                        @endphp

                                        <li class="nav-custom-item">
                                            <input type="checkbox" id="dept{{ $companyId }}-{{ $departmentId }}">
                                            <label class="nav-custom-link"
                                                for="dept{{ $companyId }}-{{ $departmentId }}">
                                                <span class="nav-custom-caret"></span>
                                                {{ $departmentName }} ({{ $deptApplicants->count() }})
                                            </label>

                                            <ul class="nav-custom-content">
                                                @foreach ($dateWise as $entryDate => $dateApplicants)
                                                    @php
                                                        $dateLabel = \Carbon\Carbon::parse($entryDate)->format('d-M-Y');
                                                    @endphp
                                                    <li class="nav-custom-item">
                                                        <input type="checkbox"
                                                            id="date{{ $companyId }}-{{ $departmentId }}-{{ $entryDate }}">
                                                        <label class="nav-custom-link"
                                                            for="date{{ $companyId }}-{{ $departmentId }}-{{ $entryDate }}">
                                                            <span class="nav-custom-caret"></span>
                                                            {{ $dateLabel }} ({{ $dateApplicants->count() }})
                                                        </label>

                                                        <div class="nav-custom-content">
                                                            @foreach ($dateApplicants as $applicant)
                                                                <a href="javascript:void(0);" class="employee-link"
                                                                    data-line="{{ $applicant->line }}"
                                                                    data-unit="{{ $applicant->unit }}"
                                                                    data-org_id="{{ $applicant->org_id }}"
                                                                    data-id="{{ $applicant->employee_id }}"
                                                                    data-applicant_id="{{ $applicant->id }}"
                                                                    data-department_id="{{ $applicant->department_id }}"
                                                                    data-final_designation_id="{{ $applicant->designation_id }}"
                                                                    data-district_id="{{ $applicant->district_id }}"
                                                                    data-joining_date="{{ $applicant->joining_date }}"
                                                                    data-name="{{ $applicant->name }}">
                                                                    {{ $applicant->id }} :: {{ $applicant->employee_id }}
                                                                    :: {{ strtoupper($applicant->name) }}
                                                                </a>
                                                            @endforeach
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-lg-9">
            <form action="{{ route('hris.database.employee.store') }}" id="employeeForm" method="POST">
                @csrf
                <div class="card alert-info alert-top-border">
                    <div class="card-header d-flex justify-content-between align-items-center px-10 py-12">
                        <h6 class="my-0 text-primary"><i data-feather="list" width="18" height="18"></i> Input
                            Parameters For New Employee ...</h6>
                    </div>
                    <div class="card-body" style="min-height: 400px;">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 pe-lg-0 pe-md-0">
                                        <table class="table table-striped mb-0" id="employeeTable" width="100%">
                                            <tr>
                                                <th width="30%" style="border: none;">Applicant ID</th>
                                                <td width="70%" style="border: none;"><x-text-input name="applicant_id"
                                                        id="applicant_id" class="form-control-sm" placeholder="Applicant ID"
                                                        required readonly /></td>
                                            </tr>
                                            <tr>
                                                <th width="30%" style="border: none;">Emp ID</th>
                                                <td width="70%" style="border: none;"><x-text-input name="employee_id"
                                                        id="employee_id" class="form-control-sm" placeholder="Employee ID"
                                                        required readonly /></td>
                                            </tr>
                                            <tr>
                                                <th width="30%" style="border: none;">Department </th>
                                                <td width="70%" style="border: none;"><x-select-input
                                                        name="department_id" id="department_id" class="select2"
                                                        :options="$departments" required /></td>
                                            </tr>
                                            <tr>
                                                <th width="30%" style="border: none;">Designation </th>
                                                <td width="70%" style="border: none;"><x-select-input
                                                        name="designation_id" id="designation_id" class="select2"
                                                        :options="$designations" required /></td>
                                            </tr>
                                            <tr>
                                                <th style="border: none;">Joining Date </th>
                                                <td style="border: none;">
                                                    <x-text-input name="joining_date" id="joining_date" type="date"
                                                        class="form-control-sm" placeholder="Joining Date" required />
                                                </td>
                                            </tr>
                                        </table>
                                    </div>

                                    <div class="col-lg-6 col-md-6 pe-lg-0">
                                        <table class="table table-striped mb-0" id="presentAddressTable" width="100%">
                                            <tr>
                                                <th width="30%" style="border: none;">Unit </th>
                                                <td width="70%" style="border: none;"><x-select-input name="unit"
                                                        id="unit" class="select2" :options="[]" /></td>
                                            </tr>
                                            <tr>
                                                <th width="30%" style="border: none;">Line </th>
                                                <td width="70%" style="border: none;"><x-select-input name="line"
                                                        id="line" class="select2" :options="[]" /></td>
                                            </tr>
                                            <tr>
                                                <th width="30%" style="border: none;">Grade </th>
                                                <td width="70%" style="border: none;"><x-text-input name="grade"
                                                        id="grade" type="text" class="form-control-sm"
                                                        placeholder="Grade" required /></td>
                                            </tr>
                                            <tr>
                                                <th width="30%" style="border: none;">Salaried? </th>
                                                <td width="70%" style="border: none;"><x-select-input name="salaried"
                                                        id="salaried" label="Salaried" class="select2" :options="['Y' => 'Yes', 'N' => 'No']"
                                                        selected="Y" required /></td>
                                            </tr>
                                            <tr>
                                                <th width="30%" style="border: none;">Confirm Date </th>
                                                <td width="70%" style="border: none;"><x-text-input
                                                        name="confirmation_date" id="confirmation_date" type="date"
                                                        class="form-control-sm" placeholder="Confirm Date" required
                                                        readonly /></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-md-6 pe-lg-0">
                                        <table class="table table-striped mb-0" id="employeeTable" width="100%">
                                            <tr>
                                                <th colspan="2" style="border: none;"><span
                                                        class="text-primary">Present Address</span> </th>
                                            </tr>
                                            <tr>
                                                <th width="30%" style="border: none;">District </th>
                                                <td width="70%" style="border: none;"><x-select-input
                                                        name="pdistrict_id" id="pdistrict_id" class="select2"
                                                        :options="$districts" required /></td>
                                            </tr>
                                            <tr>
                                                <th width="30%" style="border: none;">Thana </th>
                                                <td width="70%" style="border: none;">
                                                    <x-select-input name="pthana_id" id="pthana_id" class="select2"
                                                        :options="[]" required />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th width="30%" style="border: none;">Post Office </th>
                                                <td width="70%" style="border: none;">
                                                    <x-text-input name="ppost_office" id="ppost_office"
                                                        class="form-control-sm" placeholder="Post Office" required />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th width="30%" style="border: none;">Address </th>
                                                <td width="70%" style="border: none;">
                                                    <x-text-input name="pvillage" id="pvillage" class="form-control-sm"
                                                        placeholder="House No/Road No/Village ..." required />
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-lg-6 col-md-6 pe-lg-0">
                                        <table class="table table-striped mb-0" id="presentAddressTable" width="100%">
                                            <tr>
                                                <th colspan="2" style="border: none;"><span
                                                        class="text-primary">Mailing Address</span> </th>
                                            </tr>
                                            <tr>
                                                <th width="30%" style="border: none;">District </th>
                                                <td width="70%" style="border: none;"><x-select-input
                                                        name="mdistrict_id" id="mdistrict_id" class="select2"
                                                        :options="$districts" required /></td>
                                            </tr>
                                            <tr>
                                                <th width="30%" style="border: none;">Thana </th>
                                                <td width="70%" style="border: none;">
                                                    <x-select-input name="mthana_id" id="mthana_id" class="select2"
                                                        :options="[]" required />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th width="30%" style="border: none;">Post Office </th>
                                                <td width="70%" style="border: none;">
                                                    <x-text-input name="mpost_office" id="mpost_office"
                                                        class="form-control-sm" placeholder="Post Office" required />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th width="30%" style="border: none;">Address </th>
                                                <td width="70%" style="border: none;">
                                                    <x-text-input name="mvillage" id="mvillage" class="form-control-sm"
                                                        placeholder="House No/Road No/Village ..." required />
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 pe-lg-0">
                                <table class="table table-striped" id="employeeTable" width="100%">
                                    <tr>
                                        <th width="30%" style="border: none;">Organization </th>
                                        <td width="70%" style="border: none;"><x-select-input name="org_id"
                                                id="org_id" class="select2" :options="$organizations" :selected="selected_org($organizations)"
                                                required /></td>
                                    </tr>
                                    <tr>
                                        <th width="30%" style="border: none;">Punch Category </th>
                                        <td width="70%" style="border: none;"><x-select-input name="punch_category"
                                                id="punch_category" class="select2" :options="[
                                                    '1' => 'Single Punch',
                                                    '2' => 'Double Punch',
                                                    '3' => 'No Punch',
                                                ]" selected="2"
                                                required /></td>
                                    </tr>
                                    <tr>
                                        <th width="30%" style="border: none;">Shifting Duty? </th>
                                        <td width="70%" style="border: none;"><x-select-input name="shifting_duty"
                                                id="shifting_duty" class="select2" :options="['Y' => 'Yes', 'N' => 'No']" selected="N"
                                                required /></td>
                                    </tr>
                                    <tr>
                                        <th width="30%" style="border: none;">Ref. Shift? </th>
                                        <td width="70%" style="border: none;"><x-select-input name="refrerence_shift"
                                                id="refrerence_shift" class="select2" :options="$shifts" selected="G"
                                                required /></td>
                                    </tr>
                                    <tr>
                                        <th width="30%" style="border: none;">Ref. Holiday? </th>
                                        <td width="70%" style="border: none;"><x-select-input
                                                name="refrerence_holiday" id="refrerence_holiday" class="select2"
                                                :options="[
                                                    'Sunday' => 'Sunday',
                                                    'Monday' => 'Monday',
                                                    'Tuesday' => 'Tuesday',
                                                    'Wednesday' => 'Wednesday',
                                                    'Thursday' => 'Thursday',
                                                    'Friday' => 'Friday',
                                                    'Saturday' => 'Saturday',
                                                ]" selected="Friday" required /></td>
                                    </tr>
                                    <tr>
                                        <th width="30%" style="border: none;">Ref. Date </th>
                                        <td width="70%" style="border: none;"><x-text-input name="refrerence_date"
                                                type="date" id="refrerence_date" class="form-control-sm"
                                                placeholder="Reference Date" autocomplete="off" required /></td>
                                    </tr>
                                    <tr>
                                        <th width="30%" style="border: none;">Name </th>
                                        <td width="70%" style="border: none;"><x-text-input name="name"
                                                class="form-control-sm" id="name" placeholder="Name"
                                                value="{{ old('name') }}" autocomplete="off" required /></td>
                                    </tr>
                                    <tr>
                                        <th width="30%" style="border: none;">Father Name </th>
                                        <td width="70%" style="border: none;"><x-text-input name="father_name"
                                                class="form-control-sm" id="father_name" placeholder="Father Name"
                                                value="{{ old('father_name') }}" required /></td>
                                    </tr>
                                    <tr>
                                        <th width="30%" style="border: none;">Mother Name </th>
                                        <td width="70%" style="border: none;"><x-text-input name="mother_name"
                                                class="form-control-sm" id="mother_name" placeholder="Mother Name"
                                                value="{{ old('mother_name') }}" required /></td>
                                    </tr>
                                    <tr>
                                        <th width="30%" style="border: none;">Spouse Name </th>
                                        <td width="70%" style="border: none;"><x-text-input name="spouse_name"
                                                class="form-control-sm" id="spouse_name" placeholder="Spouse Name"
                                                value="{{ old('spouse_name') }}" /></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer" style="padding:14px 20px;">
                        <x-primary-button class="float-start btn-sm submitBtn">Save And Go</x-primary-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Date restriction
            let today = new Date().toISOString().split('T')[0];
            $('#joining_date,#refrerence_date').attr('min', today);

            // Initialize Select2
            $('.select2').select2({
                placeholder: "Select an option",
                allowClear: true,
                width: '100%'
            });

            $('#pdistrict_id').on('change', function() {
                $('#pthana_id').empty();
                let districtId = $(this).val();
                if (districtId) {
                    $.ajax({
                        url: '/hris/database/district/' + districtId,
                        type: 'GET',
                        success: function(data) {
                            $('#pthana_id').empty();
                            $('#pthana_id').append('<option value="">Select Thana</option>');
                            $.each(data, function(key, value) {
                                $('#pthana_id').append('<option value="' + key + '">' +
                                    value + '</option>');
                            });
                        }
                    });
                }
            });

            $('#designation_id').on('change', function() {
                let designationId = $(this).val();
                if (designationId) {
                    $.ajax({
                        url: '/hris/database/designation/' + designationId,
                        type: 'GET',
                        success: function(data) {
                            $('#grade').val(data.grade);
                        }
                    });
                }
            });

            $('#mdistrict_id').on('change', function() {
                $('#mthana_id').empty();
                let districtId = $(this).val();
                if (districtId) {
                    $.ajax({
                        url: '/hris/database/district/' + districtId,
                        type: 'GET',
                        success: function(data) {
                            $('#mthana_id').empty();
                            $('#mthana_id').append('<option value="">Select Thana</option>');
                            $.each(data, function(key, value) {
                                $('#mthana_id').append('<option value="' + key + '">' +
                                    value + '</option>');
                            });
                        }
                    });
                }
            });

            let orgid = $('#org_id').val();
            if (orgid) {
                getUnitLine(orgid);
            }

            // $('#unit').on('change', function() {
            //     $('#line').empty();
            //     let unitcode = $(this).val();
            //     if (unitcode) {
            //         $.ajax({
            //             url: '/hris/database/unit/' + unitcode,
            //             type: 'GET',
            //             success: function(data) {
            //                 $('#line').empty();
            //                 $('#line').append('<option value="">Select Line</option>');
            //                 $.each(data, function(key, value) {
            //                     $('#line').append('<option value="' + key + '">' +
            //                         value + '</option>');
            //                 });
            //             }
            //         });
            //     }
            // });

            let isEmployeeClick = false;

            $('#org_id').on('change', function() {
                if (isEmployeeClick) {
                    return;
                }
                let orgid = $(this).val();
                if (orgid) {
                    getUnitLine(orgid);
                }
            });


            $('#joining_date').on('change', function() {
                const joiningDateVal = $(this).val();
                const joiningDate = new Date(joiningDateVal);

                $('#refrerence_date').val(joiningDateVal);

                if (!isNaN(joiningDate.getTime())) {
                    joiningDate.setMonth(joiningDate.getMonth() + 3);
                    const year = joiningDate.getFullYear();
                    const month = String(joiningDate.getMonth() + 1).padStart(2, '0');
                    const day = String(joiningDate.getDate()).padStart(2, '0');
                    const formattedDate = `${year}-${month}-${day}`;

                    $('#confirmation_date').val(formattedDate);
                }
            });

            function getUnitLine(empid) {
                if (empid) {
                    $.ajax({
                        url: '/hris/database/unitline/' + empid,
                        type: 'GET',
                        success: function(data) {
                            // Unit Dropdown
                            if (data.unitlists && Object.keys(data.unitlists).length > 0) {
                                $('#unit').empty();
                                $('#unit').append('<option value="">Select Unit</option>');

                                $.each(data.unitlists, function(key, value) {
                                    $('#unit').append(
                                        `<option value="${value}">${key}</option>`
                                    );
                                });
                            }else{
                                $('#unit').empty();
                            }

                            // Line Dropdown
                            if (data.linelists && Object.keys(data.linelists).length > 0) {
                                $('#line').empty();
                                $('#line').append('<option value="">Select Line</option>');

                                $.each(data.linelists, function(key, value) {
                                    $('#line').append(
                                        `<option value="${value}">${key}</option>`
                                    );
                                });
                            }else{
                                $('#line').empty();
                            }
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                        }
                    });
                }
            }

            $(document).ready(function() {
                $('#joining_date').trigger('change');
                $('#pdistrict_id').trigger('change');
                $('#mdistrict_id').trigger('change');
                $('#designation_id').trigger('change');
                $('#unit').trigger('change');
            });


            $('.employee-link').on('click', function() {
                isEmployeeClick = true;

                const id = $(this).data('id');
                const applicantId = $(this).data('applicant_id');
                const departmentId = $(this).data('department_id');
                const orgId = $(this).data('org_id') ?? 1;
                const line = $(this).data('line');
                const unit = $(this).data('unit');
                const finalDesignationId = $(this).data('final_designation_id');
                const districtId = $(this).data('district_id');
                const thanaId = $(this).data('thana_id');
                const joiningDate = $(this).data('joining_date');
                const name = $(this).data('name');

                const joiningDatePicker = flatpickr("#joining_date", {
                    dateFormat: "Y-m-d",
                });
                const confirmDatePicker = flatpickr("#confirmation_date", {
                    dateFormat: "Y-m-d",
                });
                const referenceDatePicker = flatpickr("#refrerence_date", {
                    dateFormat: "Y-m-d",
                });
                let joining_date = joiningDate;
                let confirm_date = joiningDate;

                // Set date
                joiningDatePicker.setDate(joining_date);
                confirmDatePicker.setDate(confirm_date);
                referenceDatePicker.setDate(joining_date);

                $('#org_id').val(orgId).change();
                isEmployeeClick = false;


                $('#employee_id').val(id);
                $('#applicant_id').val(applicantId);
                $('#department_id').val(departmentId).change();
                $('#designation_id').val(finalDesignationId).change();
                $('#pdistrict_id').val(districtId).change();
                $('#mdistrict_id').val(districtId).change();
                $('#pthana_id').val(thanaId).change();
                $('#joining_date').val(joiningDate).trigger('change');
                $("#name").val(name);

                $('#line').val(line).change();
                $('#unit').val(unit).change();
            });
        });
    </script>
@endpush
