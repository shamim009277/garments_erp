@extends('layouts.app')
@section('title', 'HRIS')
@push('styles')
    <style>
        input[type="checkbox"] {
            display: inline-block !important;
            opacity: 1 !important;
        }
        input.start_date,
        input.end_date {
            min-width: 140px;
            max-width: 180px;
            width: 100%;
        }

        td input.start_date,
        td input.end_date {
            box-sizing: border-box;
        }

        @media (max-width: 576px) {
            input.start_date,
            input.end_date {
                min-width: 120px;
            }
        }
    </style>
@endpush
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'HRIS',
                'subtitle' => 'Leave Application Approve',
                'breadcrumbs' => [
                    ['label' => 'HRIS', 'url' => route('hris.index')],
                    ['label' => 'Database', 'url' => route('hris.index')],
                    ['label' => 'Leave Application Approve', 'url' => route('hris.database.leave-approve.index')],
                ],
            ])
        </div>
        <div class="col-12 mb-3">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                <!-- Centered Title -->
                <h4 class="text-center flex-grow-1 order-1 order-md-0 mb-2 mb-md-0">
                   Leave Application Approve
                </h4>
            </div>
        </div>
        <div class="col-lg-12">
            <form action="{{ route('hris.database.leave-application.store') }}" method="POST">
                @csrf
                <div class="card alert-primary alert-top-border padding-card">
                    <div class="card-header">
                        <h6 class="my-0 text-primary"> <i data-feather="list" width="18" height="18"></i>Leave Application Approve</h6>
                    </div>
                    <div style="overflow-x: auto;">
                        <div class="card-body">
                            <table class="table table-sm table-bordered table-hover table-striped" width="100%">
                                <thead>
                                    <tr>
                                        <th style="width: 100px; white-space: nowrap;">Emp ID#</th>
                                        <th style="white-space: nowrap;">Name</th>
                                        <th style="white-space: nowrap;">Designation</th>
                                        <th style="white-space: nowrap;">Department</th>
                                        <th style="white-space: nowrap;">Join Date</th>
                                        <th style="width: 200px; white-space: nowrap;">Start Date</th>
                                        <th style="width: 200px; white-space: nowrap;">End Date</th>
                                        <th style="width: 80px; text-align: center; white-space: nowrap;">Days</th>
                                        <th style="text-align: center; white-space: nowrap;">Balance</th>
                                        <th style="text-align: center; white-space: nowrap;">Type</th>
                                        <th style="width: 200px; white-space: nowrap;">Reason</th>
                                        <th style="width: 100px; white-space: nowrap;">Input Date</th>
                                    </tr>
                                </thead>

                                <tbody id="leave_forward_table_body">
                                    @foreach ($leaveApplications as $leaveApplication)
                                        <tr>
                                            <td style="white-space: nowrap;">
                                                <input type="checkbox" class="row_checkbox" id="form_id" name="form_id[]" value="{{ $leaveApplication->form_id }}"{{ $leaveApplication->is_writable ? 'checked' : '' }}>
                                                <a href="{{ route('hris.database.leave-approve.show', $leaveApplication->id) }}" style="font-weight: bold; white-space: nowrap;">
                                                    {{ str_pad($leaveApplication->employee_id, 6, '0', STR_PAD_LEFT) }}
                                                </a>
                                            </td>
                                            <td style="white-space: nowrap;">{{ $leaveApplication->employee->name }}</td>
                                            <td style="white-space: nowrap;">{{ $leaveApplication->designation->designation }}</td>
                                            <td style="white-space: nowrap;">{{ $leaveApplication->department->department }}</td>
                                            <td style="white-space: nowrap;">{{ $leaveApplication->employee->joining_date }}</td>
                                            <td style="white-space: nowrap;">
                                                <input type="text" id="start_date{{ $leaveApplication->form_id }}" class="form-control form-control-sm start_date"
                                                    name="start_date[]" value="{{ $leaveApplication->start_date }}"
                                                    {{ $leaveApplication->is_writable ? '' : 'readonly' }}>
                                            </td>

                                            <td style="white-space: nowrap;">
                                                <input type="text" id="end_date{{ $leaveApplication->form_id }}" class="form-control form-control-sm end_date"
                                                    name="end_date[]" value="{{ $leaveApplication->end_date }}"
                                                    {{ $leaveApplication->is_writable ? '' : 'readonly' }}>
                                            </td>

                                            <td style="text-align: center; white-space: nowrap;">
                                                <input type="text" id="days{{ $leaveApplication->form_id }}" class="form-control form-control-sm days"
                                                    name="days[]" value="{{ $leaveApplication->days }}"
                                                    {{ $leaveApplication->is_writable ? '' : 'readonly' }} style="text-align: center;">
                                            </td>
                                            <td style="text-align: center; white-space: nowrap;">{{ $leaveApplication->balance??0 }}</td>
                                            <td style="text-align: center; white-space: nowrap;">{{ $leaveApplication->leave_type_id }}</td>
                                            <td style="white-space: nowrap;">{{ $leaveApplication->leaveReason->reason }}</td>
                                            <td style="white-space: nowrap;">{{ $leaveApplication->application_date }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card-footer" style="padding:10px 20px;">
                        <div class="d-flex justify-content-between flex-wrap gap-2">
                            <!-- Left Side Buttons -->
                            <div class="d-flex gap-2">
                                Total: {!! count($leaveApplications) !!} &nbsp;&nbsp;
                                <button type="button" class="btn btn-sm btn-outline-success" id="check_all_forward">
                                    <i data-feather="check-square" width="14" height="14"></i> Check All
                                </button>

                                <button type="button" class="btn btn-sm btn-outline-primary" id="uncheck_all_forward">
                                    <i data-feather="x-square" width="14" height="14"></i> Uncheck All
                                </button>
                            </div>

                            <!-- Right Side Buttons -->
                            <div class="d-flex gap-2">
                                <button type="button" class="btn btn-sm btn-danger" id="discardBtn" disabled>
                                    <i data-feather="log-out" width="14" height="14"></i> Discart
                                </button>

                                <x-primary-button id="submitBtn" type="button" class="btn btn-sm btn-primary submitBtn" disabled>
                                    Approve
                                </x-primary-button>
                            </div>
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
    function calculateDays(start, end) {
        let startDate = new Date(start);
        let endDate = new Date(end);

        if (isNaN(startDate) || isNaN(endDate)) return 0;

        let diffTime = endDate - startDate;
        let diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1; // +1 inclusive
        return diffDays > 0 ? diffDays : 0;
    }

    function toggleButtons() {
        let anyChecked = $('.row_checkbox:checked').length > 0;
        $('#discardBtn, #submitBtn').prop('disabled', !anyChecked);
    }

    // Check all checkboxes
    $('#check_all_forward').click(function() {
        $('.row_checkbox').prop('checked', true).trigger('change');
    });

    // Uncheck all checkboxes
    $('#uncheck_all_forward').click(function() {
        $('.row_checkbox').prop('checked', false).trigger('change');
    });

    // On single checkbox change
    $(document).on('change', '.row_checkbox', function() {
        let row = $(this).closest('tr'); // get current row
        let isChecked = $(this).is(':checked');
        row.find('.start_date, .end_date').prop('readonly', !isChecked);
        toggleButtons();
    });

    // Initial check on page load
    toggleButtons();

    // Trigger change on page load to set initial readonly status
    $('.row_checkbox').each(function() {
        $(this).trigger('change');
    });

    // Store previous valid value
    let previousValues = {};

    // Save previous value on focus
    $(document).on('focus', '.start_date, .end_date', function() {
        previousValues[$(this).attr('id')] = $(this).val();
    });

    // On date change, update days column
    $(document).on('blur', '.start_date, .end_date', function() {
        let row = $(this).closest('tr');
        let startInput = row.find('.start_date');
        let endInput = row.find('.end_date');

        let start = startInput.val();
        let end = endInput.val();

        if (!start || !end) {
            row.find('span[id^="days"]').text(0);
            return;
        }

        let startDate = new Date(start);
        let endDate = new Date(end);

        // Validation: start date cannot be after end date
        if (startDate > endDate) {
           Swal.fire({
                title: 'Error!',
                text: 'Start Date cannot be after End Date! Or End Date cannot be before Start Date! please check the dates.',
                icon: 'error',
                confirmButtonText: 'OK'
            });

            // Restore previous values
            if (previousValues[startInput.attr('id')]) {
                startInput.val(previousValues[startInput.attr('id')]);
            }
            if (previousValues[endInput.attr('id')]) {
                endInput.val(previousValues[endInput.attr('id')]);
            }

            // Recalculate days with previous values
            let prevDays = calculateDays(startInput.val(), endInput.val());
            row.find('span[id^="days"]').text(prevDays);
            return;
        }

        // If valid, update days
        let days = calculateDays(start, end);
        row.find('span[id^="days"]').text(days);
    });

    $('.start_date, .end_date').each(function() {
        previousValues[$(this).attr('id')] = $(this).val();
    });

    //leave discard
    $('#discardBtn').click(function() {
        let form_id = [];
        let start_date = [];
        let end_date = [];
        let days = [];

        $('.row_checkbox:checked').each(function() {
            let row = $(this).closest('tr');
            let id = $(this).val();
            let start = row.find('.start_date').val();
            let end = row.find('.end_date').val();
            let day = row.find('.days').val();
            form_id.push(id);
            start_date.push(start);
            end_date.push(end);
            days.push(day);
        });

        if (form_id.length === 0) {
            Swal.fire('Warning', 'No row selected!', 'warning');
            return;
        }

        Swal.fire({
            title: 'Are you sure?',
            text: "This action cannot be undone!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, discard it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ route('hris.database.leave-approve.store') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        form_id: form_id,
                        form: 1,
                        start_date: start_date,
                        end_date: end_date,
                        days: days
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
                            $('.row_checkbox:checked').each(function() {
                                $(this).closest('tr').fadeOut(300, function() {
                                    $(this).remove();
                                });
                            });
                        } else {
                            Swal.fire('Error', response.message, 'error');
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.close();
                        Swal.fire('Error', error, 'error');
                    }
                });
            }
        });
    });

    //leave discard
    $('#submitBtn').click(function() {
        let form_id = [];
        let start_date = [];
        let end_date = [];
        let days = [];

        $('.row_checkbox:checked').each(function() {
            let row = $(this).closest('tr');
            let id = $(this).val();
            let start = row.find('.start_date').val();
            let end = row.find('.end_date').val();
            let day = row.find('.days').val();
            form_id.push(id);
            start_date.push(start);
            end_date.push(end);
            days.push(day);
        });

        if (form_id.length === 0) {
            Swal.fire('Warning', 'No row selected!', 'warning');
            return;
        }

        $.ajax({
            url: '{{ route('hris.database.leave-approve.store') }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                form_id: form_id,
                form: 2,
                start_date: start_date,
                end_date: end_date,
                days: days
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
                    $('.row_checkbox:checked').each(function() {
                        $(this).closest('tr').fadeOut(300, function() {
                            $(this).remove();
                        });
                    });
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
