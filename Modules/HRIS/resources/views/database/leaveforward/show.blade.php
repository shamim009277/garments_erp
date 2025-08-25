@extends('layouts.app')
@section('title', 'HRIS')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'HRIS',
                'subtitle' => 'Leave Forward Show',
                'breadcrumbs' => [
                    ['label' => 'HRIS', 'url' => route('hris.index')],
                    ['label' => 'Database', 'url' => route('hris.index')],
                    ['label' => 'Leave Forward', 'url' => route('hris.database.leave-forward.index')],
                ],
            ])
        </div>
        <div class="col-12 mb-3">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                <!-- Centered Title -->
                <h4 class="text-center flex-grow-1 order-1 order-md-0 mb-2 mb-md-0">
                   Leave Forward :: FormID - {{ $leaveApplication->form_id }}
                </h4>

                <!-- Right Side Back Button -->
                <a href="{{ route('hris.database.leave-forward.index') }}" class="btn btn-sm btn-primary order-2">
                    <i data-feather="arrow-left" width="14" height="14" class="me-1"></i> Back
                </a>
            </div>
        </div>
        <div class="col-lg-8 pe-lg-0">
            <form action="{{ route('hris.database.leave-application.store') }}" method="POST">
                @csrf
                <div class="card alert-primary alert-top-border padding-card">
                    <div class="card-header">
                        <h6 class="my-0 text-primary"> <i data-feather="list" width="18" height="18"></i>Leave Application Forward</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-5 col-md-6 pe-lg-0 pe-md-0">
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <th style="width: 30%">Employee ID</th>
                                            <td style="width: 70%">
                                                <x-text-input name="employee_id" id="employee_id" label="" class="form-control-sm" placeholder="Employee ID" value="{{ str_pad($leaveApplication->employee_id, 6, '0', STR_PAD_LEFT) }}" required readonly/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="width: 30%">Leave Type</th>
                                            <td style="width: 70%">
                                                <x-select-input name="leave_type_id" id="leave_type_id" class="select2" :options="$leave_types" selected="{{ $leaveApplication->leave_type_id }}" required disabled/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="width: 30%">Reason</th>
                                            <td style="width: 70%">
                                                <x-select-input name="reason_id" id="reason_id" class="select2" :options="$reasons" selected="{{ $leaveApplication->reason_id }}" required disabled/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="width: 30%">Start Date</th>
                                            <td style="width: 70%">
                                                <x-text-input name="start_date" type="date" id="start_date" label="" class="form-control-sm" value="{{ date('Y-m-d', strtotime($leaveApplication->start_date)) }}" placeholder="Start Date" required/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="width: 30%">End Date</th>
                                            <td style="width: 70%">
                                                <x-text-input name="end_date" type="date" id="end_date" label="" class="form-control-sm" value="{{ date('Y-m-d', strtotime($leaveApplication->end_date)) }}" placeholder="End Date" required/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="width: 30%">Days</th>
                                            <td style="width: 70%">
                                                <x-text-input name="days" id="days" label="" class="form-control-sm" value="{{ $leaveApplication->days }}" placeholder="Days" required readonly/>
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
                                                <x-text-input name="name" id="name" label="" class="form-control-sm" placeholder="Name" value="{{ $leaveApplication->employee->name }}" required readonly/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="width: 30%">Designation</th>
                                            <td style="width: 70%">
                                                <input type="hidden" name="designation_id" id="designation_id" class="form-control-sm" placeholder="Designation" value="{{ $leaveApplication->designation_id }}" required readonly/>
                                                <x-text-input name="designation" id="designation" label="" class="form-control-sm" placeholder="Designation" value="{{ $leaveApplication->designation->designation }}" required readonly/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="width: 30%">Department</th>
                                            <td style="width: 70%">
                                                <input type="hidden" name="department_id" id="department_id" class="form-control-sm" placeholder="Department" value="{{ $leaveApplication->department_id }}" required readonly/>
                                                <x-text-input name="department" id="department" label="" class="form-control-sm" placeholder="Department" value="{{ $leaveApplication->department->department }}" required readonly/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="width: 30%">Join Date</th>
                                            <td style="width: 70%">
                                                <x-text-input name="join_date" type="text" id="join_date" label="" class="form-control-sm" value="{{ date('Y-m-d', strtotime($leaveApplication->employee->joining_date)) }}" placeholder="Join Date" required readonly/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="width: 30%">Application Date</th>
                                            <td style="width: 70%">
                                                <x-text-input name="application_date" type="text" id="application_date" label="" class="form-control-sm" value="{{ date('Y-m-d', strtotime($leaveApplication->application_date)) }}" placeholder="Application Date" required readonly/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="width: 30%">Remarks</th>
                                            <td style="width: 70%">
                                                <x-text-input name="remarks" id="remarks" label="" class="form-control-sm" value="{{ $leaveApplication->remarks }}" placeholder="Remarks"  readonly/>
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
                                                @if ($leaveApplication->employee->photo)
                                                    <img src="{{ asset('storage/' . $leaveApplication->employee->photo) }}" alt="Photo" id="photo" class="img-fluid" style="width: 160px; height: 180px; object-fit: cover; padding: 2px;">
                                                @else
                                                    <img src="{{ asset('backend/assets/images/demo.png') }}" alt="Photo" id="photo" class="img-fluid" style="width: 160px; height: 180px; object-fit: cover; padding: 2px;">
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer" style="padding:10px 20px;">
                        <button id="submitBtn" type="button" class="btn btn-sm btn-primary float-end submitBtn"> <i data-feather="log-in" width="14" height="14"></i> Forward</button>
                        <button type="button" id="discardBtn" class="btn btn-sm btn-danger float-end submitBtn" style="margin-right: 10px;"> <i data-feather="log-out" width="14" height="14"></i> Discard</button>
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
                maxDate: "<?php echo e($leaveApplication->end_date); ?>",
                minDate: "<?php echo e($leaveApplication->start_date); ?>",
                onChange: function (selectedDates, dateStr) {
                    if (dateStr) {
                        startPicker.set('maxDate', dateStr);
                    }
                    updateDays();
                }
            });

            startPicker = flatpickr("#start_date", {
                dateFormat: "Y-m-d",
                maxDate: "<?php echo e($leaveApplication->end_date); ?>",
                minDate: "<?php echo e($leaveApplication->start_date); ?>",
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

            $(document).on('click', '#discardBtn', function() {
                let id = "{{ $leaveApplication->id }}";

                if (id === "") {
                    Swal.fire('Warning', 'Please Input Valid Data!', 'warning');
                    return;
                }

                Swal.fire({
                    title: 'Are you sure? ',
                    text: "This action cannot be undone!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Discard it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                        url: '{{ route('hris.database.leave-forward.store') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: id,
                            form: 3,
                        },
                        beforeSend: function() {
                            Swal.fire({
                                title: 'Please wait...',
                                text: 'Processing selected leave applications...',
                                allowOutsideClick: false,
                                didOpen: () => Swal.showLoading()
                            });
                        },
                        success: function(response) {
                            Swal.close();
                            if (response.status === 'success') {
                                Swal.fire('Success', response.message, 'success');

                                // Remove checked rows from table
                                location.href = '{{ route('hris.database.leave-forward.index') }}';
                            } else {
                                Swal.fire('Error', response.message, 'error');
                            }
                        },
                        error: function(xhr, status, error) {
                            Swal.close();
                            Swal.fire('Error', error, 'error');
                        }
                    });
                    } else {
                        Swal.fire(
                            'Cancelled!',
                            'Leave Application has not been discarded.',
                            'error'
                        );
                    }
                });
            });

            $(document).on('click', '#submitBtn', function() {
                let id = "{{ $leaveApplication->id }}";
                let start_date = $("#start_date").val();
                let end_date = $("#end_date").val();
                let days = $("#days").val();


                if (id === "" || start_date === "" || end_date === "" || days === "") {
                    Swal.fire('Warning', 'Please Input Valid Data!', 'warning');
                    return;
                }

                $.ajax({
                    url: '{{ route('hris.database.leave-forward.store') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: id,
                        form: 4,
                        start_date: start_date,
                        end_date: end_date,
                        days: days,
                    },
                    beforeSend: function() {
                        Swal.fire({
                            title: 'Please wait...',
                            text: 'Processing selected leave applications...',
                            allowOutsideClick: false,
                            didOpen: () => Swal.showLoading()
                        });
                    },
                    success: function(response) {
                        Swal.close();
                        if (response.status === 'success') {
                            Swal.fire('Success', response.message, 'success');

                            // Remove checked rows from table
                            location.href = '{{ route('hris.database.leave-forward.index') }}';
                        } else {
                            Swal.fire('Error', response.message, 'error');
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.close();
                        Swal.fire('Error', error, 'error');
                    }
                });
            });
        });
    </script>
@endpush
