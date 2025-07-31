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
                <form action="{{ route('hris.database.employee.search') }}" method="POST" class="d-flex order-0 order-md-1" style="max-width: 400px;" role="search">
                    @csrf
                    <input class="form-control form-control-sm me-2" type="search" name="search" placeholder="Applicant Card No ..." aria-label="Search">
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
                        @foreach ($unique_department as $department)
                            @php
                                $applicant_department_wises = collect($applicants)
                                    ->where('department_id', $department->department_id)
                                    ->groupBy('entry_date')
                                    ->all();
                                $applicant_count = collect($applicants)->where('department_id', $department->department_id)->count();
                            @endphp

                            <li class="nav-custom-item">
                                <input type="checkbox" id="dept{{ $department->department_id }}">
                                <label class="nav-custom-link" for="dept{{ $department->department_id }}"><span class="nav-custom-caret"></span> {{ $department->department->department }} ({{ $applicant_count }})</label>
                                <ul class="nav-custom-content">
                                    @foreach ($applicant_department_wises as $key => $department_wises)
                                        @php
                                            $applicants_date_wises = collect($applicants)
                                                ->where('department_id', $department->department_id)
                                                ->where('entry_date', $key)
                                                ->all();
                                        @endphp
                                        <li class="nav-custom-item">
                                            <input type="checkbox" id="dept{{ $department->department_id }}-{{ $key }}">
                                            <label class="nav-custom-link" for="dept{{ $department->department_id }}-{{ $key }}"><span class="nav-custom-caret"></span> {{ Carbon\Carbon::parse($key)->format('d-M-Y') }} ({{ collect($applicants)->where('department_id', $department->department_id)->where('entry_date', $key)->count() }})</label>
                                            <div class="nav-custom-content">
                                                @foreach ($applicants_date_wises as $applicant)
                                                    <a href="javascript:void(0);" data-id="{{ $applicant->employee_id }}" data-department_id="{{ $applicant->department_id }}" data-final_designation_id="{{ $applicant->designation_id }}" data-district_id="{{ $applicant->district_id }}" data-joining_date="{{ $applicant->joining_date }}" data-name="{{ $applicant->name }}" class="employee-link">{{ $applicant->id }} :: {{ $applicant->employee_id }} :: {{ strtoupper($applicant->name) }}</a>
                                                @endforeach
                                            </div>
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
                                                <th width="30%" style="border: none;">Department </th>
                                                <td width="70%" style="border: none;"><x-select-input name="department_id" id="department_id" class="select2" :options="$departments" required /></td>
                                            </tr>
                                            <tr>
                                                <th width="30%" style="border: none;">Designation </th>
                                                <td width="70%" style="border: none;"><x-select-input name="designation_id" id="designation_id" class="select2" :options="$designations" required /></td>
                                            </tr>
                                            <tr>
                                                <th style="border: none;">Joining Date </th>
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
                                                <td width="70%" style="border: none;"><x-text-input name="line" id="line" type="text" class="form-control-sm" placeholder="Line" /></td>
                                            </tr>
                                            <tr>
                                                <th width="30%" style="border: none;">Grade </th>
                                                <td width="70%" style="border: none;"><x-text-input name="grade" id="grade" type="text" class="form-control-sm" placeholder="Grade" required /></td>
                                            </tr>
                                            <tr>
                                                <th width="30%" style="border: none;">Salaried? </th>
                                                <td width="70%" style="border: none;"><x-select-input name="salaried" id="salaried" label="Salaried" class="select2" :options="['Y' => 'Yes', 'N' => 'No']" selected="Y" required /></td>
                                            </tr>
                                            <tr>
                                                <th width="30%" style="border: none;">Confirm Date </th>
                                                <td width="70%" style="border: none;"><x-text-input name="confirmation_date" id="confirmation_date" type="date" class="form-control-sm" placeholder="Confirm Date" required readonly /></td>
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
                                                <th width="30%" style="border: none;">District </th>
                                                <td width="70%" style="border: none;"><x-select-input name="pdistrict_id" id="pdistrict_id" class="select2" :options="$districts" required /></td>
                                            </tr>
                                            <tr>
                                                <th width="30%" style="border: none;">Thana </th>
                                                <td width="70%" style="border: none;">
                                                    <x-select-input name="pthana_id" id="pthana_id" class="select2" :options="[]" required />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th width="30%" style="border: none;">Post Office </th>
                                                <td width="70%" style="border: none;">
                                                    <x-text-input name="ppost_office" id="ppost_office" class="form-control-sm" placeholder="Post Office" required />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th width="30%" style="border: none;">Address </th>
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
                                                <th width="30%" style="border: none;">District </th>
                                                <td width="70%" style="border: none;"><x-select-input name="mdistrict_id" id="mdistrict_id" class="select2" :options="$districts" required /></td>
                                            </tr>
                                            <tr>
                                                <th width="30%" style="border: none;">Thana </th>
                                                <td width="70%" style="border: none;">
                                                    <x-select-input name="mthana_id" id="mthana_id" class="select2" :options="[]" required />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th width="30%" style="border: none;">Post Office </th>
                                                <td width="70%" style="border: none;">
                                                    <x-text-input name="mpost_office" id="mpost_office" class="form-control-sm" placeholder="Post Office" required />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th width="30%" style="border: none;">Address </th>
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
                                        <th width="30%" style="border: none;">Organization </th>
                                        <td width="70%" style="border: none;"><x-select-input name="org_id" id="org_id" class="select2" :options="$organizations" selected="1" required /></td>
                                    </tr>
                                    <tr>
                                        <th width="30%" style="border: none;">Punch Category </th>
                                        <td width="70%" style="border: none;"><x-select-input name="punch_category" id="punch_category" class="select2" :options="['1' => 'Single Punch', '2' => 'Double Punch', '3' => 'No Punch']" selected="2" required /></td>
                                    </tr>
                                    <tr>
                                        <th width="30%" style="border: none;">Shifting Duty? </th>
                                        <td width="70%" style="border: none;"><x-select-input name="shifting_duty" id="shifting_duty" class="select2" :options="['Y' => 'Yes', 'N' => 'No']" selected="Y" required /></td>
                                    </tr>
                                    <tr>
                                        <th width="30%" style="border: none;">Reference Shift? </th>
                                        <td width="70%" style="border: none;"><x-select-input name="refrerence_shift" id="refrerence_shift" class="select2" :options="$shifts" selected="G" required /></td>
                                    </tr>
                                    <tr>
                                        <th width="30%" style="border: none;">Reference Date </th>
                                        <td width="70%" style="border: none;"><x-text-input name="refrerence_date" type="date" id="refrerence_date" class="form-control-sm" placeholder="Reference Date" required /></td>
                                    </tr>
                                    <tr>
                                        <th width="30%" style="border: none;">Name </th>
                                        <td width="70%" style="border: none;"><x-text-input name="name" class="form-control-sm" id="name" placeholder="Name" value="{{ old('name') }}" required /></td>
                                    </tr>
                                    <tr>
                                        <th width="30%" style="border: none;">Father Name </th>
                                        <td width="70%" style="border: none;"><x-text-input name="father_name" class="form-control-sm" id="father_name" placeholder="Father Name" value="{{ old('father_name') }}" required /></td>
                                    </tr>
                                    <tr>
                                        <th width="30%" style="border: none;">Mother Name </th>
                                        <td width="70%" style="border: none;"><x-text-input name="mother_name" class="form-control-sm" id="mother_name" placeholder="Mother Name" value="{{ old('mother_name') }}" required /></td>
                                    </tr>
                                    <tr>
                                        <th width="30%" style="border: none;">Spouse Name </th>
                                        <td width="70%" style="border: none;"><x-text-input name="spouse_name" class="form-control-sm" id="spouse_name" placeholder="Spouse Name" value="{{ old('spouse_name') }}" /></td>
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
                                $('#pthana_id').append('<option value="' + key + '">' + value + '</option>');
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
                                $('#mthana_id').append('<option value="' + key + '">' + value + '</option>');
                            });
                        }
                    });
                }
            });


            $('#joining_date').on('change', function () {
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

            $(document).ready(function() {
                $('#joining_date').trigger('change');
                $('#pdistrict_id').trigger('change');
                $('#mdistrict_id').trigger('change');
                $('#designation_id').trigger('change');
            });


            $('.employee-link').on('click', function() {
                const id = $(this).data('id');
                const departmentId = $(this).data('department_id');
                const finalDesignationId = $(this).data('final_designation_id');
                const districtId = $(this).data('district_id');
                const thanaId = $(this).data('thana_id');
                const joiningDate = $(this).data('joining_date');
                const name = $(this).data('name');

                $('#employee_id').val(id);
                $('#department_id').val(departmentId).change();
                $('#designation_id').val(finalDesignationId).change();
                $('#pdistrict_id').val(districtId).change();
                $('#pthana_id').val(thanaId).change();
                $('#joining_date').val(joiningDate).trigger('change');
                $("#name").val(name);
            });
        });
    </script>
@endpush
