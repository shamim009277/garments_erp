@extends('layouts.app')
@section('title', 'HRIS')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'HRIS',
                'subtitle' => 'Employee Gate Pass',
                'breadcrumbs' => [
                    ['label' => 'HRIS', 'url' => route('hris.index')],
                    ['label' => 'Database', 'url' => route('hris.index')],
                    ['label' => 'Employee Gate Pass', 'url' => route('hris.database.employee-gatepass.index')],
                ],
            ])
        </div>
        <div class="col-12 mb-3">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                <!-- Centered Title -->
                <h4 class="text-center flex-grow-1 order-1 order-md-0 mb-2 mb-md-0">
                    Employee Gate Pass
                </h4>
            </div>
        </div>
        <div class="col-lg-8 pe-lg-0" style="margin: auto;">
            <form action="{{ route('hris.database.employee-gatepass.store') }}" method="POST">
                @csrf
                <div class="card alert-primary alert-top-border padding-card">
                    <div class="card-header">
                        <h6 class="my-0 text-primary"> <i data-feather="list" width="18" height="18"></i> Input
                            Parameters For Emp Gate Pass
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-5 col-md-6 pe-lg-0 pe-md-0">
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <th style="width: 30%">Employee ID</th>
                                            <td style="width: 70%">
                                                <x-text-input name="employee_id" id="employee_id" label=""
                                                    class="form-control-sm" placeholder="Employee ID" autocomplete="off"
                                                    required />
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="width: 30%">Name</th>
                                            <td style="width: 70%">
                                                <x-text-input name="name" id="name" label=""
                                                    class="form-control-sm" placeholder="Employee Name" required readonly />
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="width: 30%">Designation</th>
                                            <td style="width: 70%">
                                                <input type="hidden" name="designation_id" id="designation_id"
                                                    class="form-control-sm" placeholder="Designation" />
                                                <x-text-input name="designation" id="designation" label=""
                                                    class="form-control-sm" placeholder="Designation" required readonly />
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="width: 30%">Department</th>
                                            <td style="width: 70%">
                                                <input type="hidden" name="department_id" id="department_id"
                                                    class="form-control-sm" placeholder="Department" />
                                                <x-text-input name="department" id="department" label=""
                                                    class="form-control-sm" placeholder="Department" required readonly />
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="width: 30%">Join Date</th>
                                            <td style="width: 70%">
                                                <x-text-input name="join_date" id="join_date" label=""
                                                    class="form-control-sm" placeholder="Join Date" required readonly />
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="width: 30%">Mobile</th>
                                            <td style="width: 70%">
                                                <x-text-input name="mobile" id="mobile" label=""
                                                    class="form-control-sm" placeholder="Mobile" required readonly />
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="width: 30%">NID/BC</th>
                                            <td style="width: 70%">
                                                <x-text-input name="nid_birth_certificate" id="nid_birth_certificate"
                                                    label="" class="form-control-sm"
                                                    placeholder="NID/Birth Certificate" required readonly />
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-lg-5 col-md-6 pe-lg-0 pe-md-0">
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <th style="width: 30%">Date</th>
                                            <td style="width: 70%">
                                                <x-text-input name="date" id="date" label=""
                                                    class="form-control-sm" value="{{ $date }}" placeholder="Date"
                                                    required readonly />
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="width: 30%">Purpose</th>
                                            <td style="width: 70%">
                                                <x-select-input name="purpose_id" id="purpose_id" class="select2"
                                                    :options="$purposes" required />
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="width: 30%">Reason</th>
                                            <td style="width: 70%">
                                                <x-select-input name="reason_id" id="reason_id" class="select2"
                                                    :options="[]" required />
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="width: 30%">Type</th>
                                            <td style="width: 70%">
                                                <x-select-input name="type_id" id="type_id" class="select2"
                                                    :options="['1' => 'Short Time', '2' => 'Full Day']" selected="1" required />
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="width: 30%">Start Time</th>
                                            <td style="width: 70%">
                                                <x-text-input name="start_time" type="time" id="start_time"
                                                    label="" class="form-control-sm" placeholder="Start Time"
                                                    required />
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="width: 30%">End Time</th>
                                            <td style="width: 70%">
                                                <x-text-input name="end_time" type="time" id="end_time"
                                                    label="" class="form-control-sm" placeholder="End Time" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="width: 30%">Duration</th>
                                            <td style="width: 70%">
                                                <x-text-input name="duration" id="duration" label=""
                                                    class="form-control-sm" placeholder="Duration" readonly />
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
                                                <img src="{{ asset('backend/assets/images/demo.png') }}" alt="Photo"
                                                    id="photo" class="img-fluid"
                                                    style="width: 160px; height: 220px; object-fit: cover; padding: 2px;">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer px-3 py-2">
                        <div class="d-flex align-items-center justify-content-between">
                            <p id="message" class="mb-0" style="color:#FF6C37;font-weight:semi-bold"></p>
                            <x-primary-button id="submitBtn" type="submit" class="btn btn-sm btn-primary submitBtn">Submit</x-primary-button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $("#type_id").change(function() {
                if ($(this).val() == 1) {
                    $("#end_time").prop('disabled', false);
                    $("#end_time").prop('required', true);
                    $("#duration").prop('disabled', true);
                } else {
                    $("#end_time").prop('disabled', true);
                    $("#duration").prop('disabled', true);
                    $("#end_time").prop('required', false);
                }
            });

            $("#purpose_id").on('change', function() {
                let purposeId = $(this).val();
                let departmentId = $("#department_id").val();
                if (departmentId) {
                    $.ajax({
                        url: "{{ route('hris.database.employee-gatepass.reasons') }}",
                        type: "POST",
                        data: {
                            purpose_id: purposeId,
                            department_id: departmentId
                        },
                        success: function(response) {
                            if (response) {
                                $('#reason_id').empty();
                                $('#reason_id').append(
                                    '<option value="">Select Reason</option>');
                                $.each(response, function(key, value) {
                                    $('#reason_id').append('<option value="' + key +
                                        '">' + value + '</option>');
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Failed to load reasons.',
                            });
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Please Input Employee ID First',
                    });
                }
            });

            function getDuration(start, end) {
                if (!start || !end) return "";

                let [sh, sm] = start.split(":").map(Number);
                let [eh, em] = end.split(":").map(Number);

                let startMinutes = sh * 60 + sm;
                let endMinutes = eh * 60 + em;

                if (endMinutes <= startMinutes) {
                    return "Invalid Time";
                }

                let diff = endMinutes - startMinutes;
                let hours = Math.floor(diff / 60);
                let minutes = diff % 60;

                return `${hours} hour ${minutes} minute`;
            }

            function updateDuration() {
                let start = $("#start_time").val();
                let end = $("#end_time").val();
                let duration = getDuration(start, end);

                if (duration === "Invalid Time") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Invalid Time!',
                        text: 'End time must be greater than Start time.',
                    });
                    $("#duration").val("");
                    $("#end_time").val("");
                } else {
                    $("#duration").val(duration);
                }
            }
            $("#start_time, #end_time").on("change", updateDuration);

            function employeeInfo() {
                let employeeId = $("#employee_id").val();
                if (employeeId.length >= 8) {
                    $.ajax({
                        url: "{{ route('hris.database.employee-gatepass.employee.info') }}",
                        type: "POST",
                        data: {
                            employee_id: employeeId
                        },
                        success: function(response) {
                            if (response.status === "error") {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Unauthorized!',
                                    text: response.message,
                                });
                                return;
                            }
                            $("#name, #designation, #department, #join_date, #mobile, #nid_birth_certificate, #designation_id, #department_id").val('');
                            let data = response.data ?? response;

                            if (data && Object.keys(data).length > 0) {
                                $("#message").text('');
                                $("#name").val(data.name || '');
                                $("#designation").val(data.designation?.designation || '');
                                $("#department").val(data.department?.department || '');
                                $("#join_date").val(data.joining_date || '');
                                $("#mobile").val(data.employee_personal?.mobile || '');

                                $("#nid_birth_certificate").val(data.employee_personal?.national_id ||data.employee_personal?.birth_certificate ||'' );

                                if (data.photo) {
                                    $('#photo').attr('src', '/storage/' + data.photo);
                                }
                                $("#designation_id").val(data.designation_id || '');
                                $("#department_id").val(data.department_id || '');
                            }
                        },
                        error: function() {
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
                    $("#photo").attr('src', "{{ asset('backend/assets/images/demo.png') }}");
                    $("#designation_id").val('');
                    $("#department_id").val('');
                    $("#message").text('Employee ID must be exactly 8 digits');
                }
            }

            employeeInfo();
            $("#employee_id").on("input", function() {
                employeeInfo();
            });
        });
    </script>
@endpush
