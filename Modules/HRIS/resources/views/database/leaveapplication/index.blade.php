@extends('layouts.app')
@section('title', 'HRIS')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'HRIS',
                'subtitle' => 'Leave Application',
                'breadcrumbs' => [
                    ['label' => 'HRIS', 'url' => route('hris.index')],
                    ['label' => 'Database', 'url' => route('hris.index')],
                    ['label' => 'Leave Application', 'url' => route('hris.database.leave-application.index')],
                ],
            ])
        </div>
        <div class="col-12 mb-3">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                <!-- Centered Title -->
                <h4 class="text-center flex-grow-1 order-1 order-md-0 mb-2 mb-md-0">
                   Leave Application Form
                </h4>
            </div>
        </div>
        <div class="col-lg-8 pe-lg-0">
            <form action="{{ route('hris.database.leave-application.store') }}" method="POST">
                @csrf
                <div class="card alert-primary alert-top-border padding-card">
                    <div class="card-header">
                        <h6 class="my-0 text-primary"> <i data-feather="list" width="18" height="18"></i> Input Parameters For Leave Application</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-5 col-md-6 pe-lg-0 pe-md-0">
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <th style="width: 30%">Employee ID</th>
                                            <td style="width: 70%">
                                                <x-text-input name="employee_id" id="employee_id" label="" class="form-control-sm" placeholder="Employee ID" required />
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="width: 30%">Leave Type</th>
                                            <td style="width: 70%">
                                                <x-select-input name="leave_type_id" id="leave_type_id" class="select2" :options="$leave_types" required disabled />
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="width: 30%">Reason</th>
                                            <td style="width: 70%">
                                                <x-select-input name="reason_id" id="reason_id" class="select2" :options="[]" required />
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="width: 30%">Start Date</th>
                                            <td style="width: 70%">
                                                <x-text-input name="start_date" type="date" id="start_date" label="" class="form-control-sm" value="{{ date('Y-m-d', strtotime($date)) }}" placeholder="Start Date" required/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="width: 30%">End Date</th>
                                            <td style="width: 70%">
                                                <x-text-input name="end_date" type="date" id="end_date" label="" class="form-control-sm" value="{{ date('Y-m-d', strtotime($date)) }}" placeholder="End Date" required/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="width: 30%">Days</th>
                                            <td style="width: 70%">
                                                <x-text-input name="days" id="days" label="" class="form-control-sm" value="1" placeholder="Days" required readonly/>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-lg-5 col-md-6 pe-lg-0 pe-md-0">
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <th style="width: 30%">Name</th>
                                            <td style="width: 70%">
                                                <x-text-input name="name" id="name" label="" class="form-control-sm" placeholder="Name" required readonly/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="width: 30%">Designation</th>
                                            <td style="width: 70%">
                                                <input type="hidden" name="designation_id" id="designation_id" class="form-control-sm" placeholder="Designation" required readonly/>
                                                <x-text-input name="designation" id="designation" label="" class="form-control-sm" placeholder="Designation" required readonly/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="width: 30%">Department</th>
                                            <td style="width: 70%">
                                                <input type="hidden" name="department_id" id="department_id" class="form-control-sm" placeholder="Department" required readonly/>
                                                <x-text-input name="department" id="department" label="" class="form-control-sm" placeholder="Department" required readonly/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="width: 30%">Join Date</th>
                                            <td style="width: 70%">
                                                <x-text-input name="join_date" type="text" id="join_date" label="" class="form-control-sm" placeholder="Join Date" required readonly/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="width: 30%">Application Date</th>
                                            <td style="width: 70%">
                                                <x-text-input name="application_date" type="text" id="application_date" label="" class="form-control-sm" value="{{ date('Y-m-d', strtotime($date)) }}" placeholder="Application Date" required readonly/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="width: 30%">Remarks</th>
                                            <td style="width: 70%">
                                                <x-text-input name="remarks" id="remarks" label="" class="form-control-sm" placeholder="Remarks" />
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-lg-2" style="padding:0px;">
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <th style="width: 100%;text-align: center">Photo</th>
                                        </tr>
                                        <tr>
                                            <td style="display: flex; justify-content: center; align-items: center;">
                                                <img src="{{ asset('backend/assets/images/demo.png') }}" alt="Photo" id="photo" class="img-fluid" style="width: 160px; height: 180px; object-fit: cover; padding: 2px;">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer" style="padding:10px 20px;">
                        <x-primary-button id="submitBtn" type="submit" class="btn btn-sm btn-primary float-end submitBtn">Submit</x-primary-button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-4">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="18" height="18"></i> Leave Card Summary</h6>
                </div>
                <div class="card-body">
                    <table class="table table-striped" style="width: 100%;text-align: center">
                        <tbody>
                            <tr>
                                <th style="width: 40%">Leave Type</th>
                                <th style="width: 20%">Available</th>
                                <th style="width: 20%">Taken</th>
                                <th style="width: 20%">Balance</th>
                            </tr>
                            <tr>
                                <th style="width: 40%">Casual Leave</th>
                                <td style="width: 20%">
                                    <x-text-input name="CLA" id="CLA" label="" class="form-control-sm text-center" placeholder="0" readonly/>
                                </td>
                                <td style="width: 20%">
                                    <x-text-input name="CLT" id="CLT" label="" class="form-control-sm text-center" placeholder="0" readonly/>
                                </td>
                                <td style="width: 20%">
                                    <x-text-input name="CLB" id="CLB" label="" class="form-control-sm text-center" placeholder="0" readonly/>
                                </td>
                            </tr>
                            <tr>
                                <th style="width: 40%">Sick Leave</th>
                                <td style="width: 20%">
                                    <x-text-input name="SLA" id="SLA" label="" class="form-control-sm text-center" placeholder="0" readonly/>
                                </td>
                                <td style="width: 20%">
                                    <x-text-input name="SLT" id="SLT" label="" class="form-control-sm text-center" placeholder="0" readonly/>
                                </td>
                                <td style="width: 20%">
                                    <x-text-input name="SLB" id="SLB" label="" class="form-control-sm text-center" placeholder="0" readonly/>
                                </td>
                            </tr>
                            <tr>
                                <th style="width: 40%">Earned Leave</th>
                                <td style="width: 20%">
                                    <x-text-input name="ELA" id="ELA" label="" class="form-control-sm text-center" placeholder="0" readonly/>
                                </td>
                                <td style="width: 20%">
                                    <x-text-input name="ELT" id="ELT" label="" class="form-control-sm text-center" placeholder="0" readonly/>
                                </td>
                                <td style="width: 20%">
                                    <x-text-input name="ELB" id="ELB" label="" class="form-control-sm text-center" placeholder="0" readonly/>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            let startPicker, endPicker;

            endPicker = flatpickr("#end_date", {
                dateFormat: "Y-m-d",
                onChange: function (selectedDates, dateStr) {
                    if (dateStr) {
                        startPicker.set('maxDate', dateStr);
                    }
                    updateDays();
                }
            });

            startPicker = flatpickr("#start_date", {
                dateFormat: "Y-m-d",
                onChange: function (selectedDates, dateStr) {
                    if (dateStr) {
                        endPicker.set('minDate', dateStr);
                    }
                    updateDays();
                }
            });

            function calculateDays(start, end) {
                if (!start || !end) return "";

                let startDate = new Date(start);
                let endDate = new Date(end);

                if (startDate > endDate) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Invalid Date!',
                        text: 'End Date must be greater than or equal to Start Date.',
                    });
                    $("#end_date").val("");
                    $("#days").val("");
                    return "";
                }

                let diffTime = endDate - startDate;
                let diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
                return diffDays;
            }

            function updateDays() {
                let start = $("#start_date").val();
                let end = $("#end_date").val();
                let days = calculateDays(start, end);

                if (days) {
                    $("#days").val(days);
                }
            }

            $('#start_date,#end_date').trigger('change');

            function employeeInfo() {
                let employeeId = $("#employee_id").val();

                if (employeeId.length >= 6) {
                    $.ajax({
                        url: "{{ route('hris.database.leave.info') }}",
                        type: "POST",
                        data: {
                            employee_id: employeeId
                          },
                        success: function (response) {
                            $("#name").val('');
                            $("#designation").val('');
                            $("#department").val('');
                            $("#join_date").val('');
                            $("#mobile").val('');
                            $("#nid_birth_certificate").val('');
                            $("#designation_id").val('');
                            $("#department_id").val('');

                            if (response.employee && Object.keys(response.employee).length > 0) {

                            $("#name").val(response.employee.name || '');
                            $("#designation").val(response.employee.designation?.designation || '');
                            $("#department").val(response.employee.department?.department || '');
                            $("#join_date").val(response.employee.joining_date || '');
                            $("#mobile").val(response.employee.employee_personal?.mobile || '');

                            if (response.employee.employee_personal?.national_id) {
                                $("#nid_birth_certificate").val(response.employee.employee_personal.national_id);
                            }
                            if (response.employee.employee_personal?.birth_certificate) {
                                $("#nid_birth_certificate").val(response.employee.employee_personal.birth_certificate);
                            }
                            $("#designation_id").val(response.employee.designation_id || '');
                            $("#department_id").val(response.employee.department_id || '');

                            if (response.employee.photo) {
                                $('#photo').attr('src', '/storage/' + response.employee.photo);
                            }

                            if(response.employee.department){
                                $("#leave_type_id").prop('disabled', false);
                            }
                        } else {
                            $("#leave_type_id").prop('disabled', true);
                        }
                    },
                    error: function () {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Failed to load employee info.',
                        });
                    }
                    });
                }else{
                    $("#name").val('');
                    $("#designation").val('');
                    $("#department").val('');
                    $("#join_date").val('');
                    $("#mobile").val('');
                    $("#nid_birth_certificate").val('');
                    $("#designation_id").val('');
                    $("#department_id").val('');
                    $("#leave_type_id").prop('disabled', true);
                    $('#photo').attr('src', "{{ asset('backend/assets/images/demo.png') }}");
                }
            }


            employeeInfo();
            $("#employee_id").on("input", function () {
                employeeInfo();
            });

            $("#leave_type_id").on("change", function () {
                let leaveType = $(this).val();
                let departmentId = $("#department_id").val();
                if (departmentId) {
                    $.ajax({
                        url: "{{ route('hris.database.getleavereason') }}",
                        type: "POST",
                        data: {
                            leave_type: leaveType
                        },
                        success: function (response) {
                            $('#reason_id').empty();
                            $('#reason_id').append('<option value="">Select Reason</option>');
                            $.each(response, function(key, value) {
                                $('#reason_id').append('<option value="' + key + '">' + value + '</option>');
                            });
                        },
                        error: function () {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Failed to load leave type info.',
                            });
                        }
                    });
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Please Input Valid Employee ID First',
                    });
                }
            });
        });
    </script>
@endpush
