@extends('layouts.app')
@section('title', 'HRIS')
@push('styles')
    <style>
        input[type="checkbox"] {
            display: inline-block !important;
            opacity: 1 !important;
        }
    </style>
@endpush
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'HRIS',
                'subtitle' => 'Employee Bulk Increment',
                'breadcrumbs' => [
                    ['label' => 'HRIS', 'url' => route('hris.index')],
                    ['label' => 'Database', 'url' => route('hris.index')],
                    ['label' => 'Employee Bulk Increment', 'url' => route('hris.database.bulk-increment.index')],
                ],
            ])
        </div>
        <div class="col-12 mb-3">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                <!-- Centered Title -->
                <h4 class="text-center flex-grow-1 order-1 order-md-0 mb-2 mb-md-0">
                   Employee Bulk Increment
                </h4>
            </div>
        </div>
        <div class="col-lg-10" style="margin:0px auto">
            <form action="{{ route('hris.database.bulk-increment.store') }}" method="POST">
                @csrf
                <div class="card alert-primary alert-top-border padding-card">
                    <div class="card-header">
                        <h6 class="my-0 text-primary"> <i data-feather="list" width="18" height="18"></i> Employee Bulk Increment</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4 pe-lg-0">
                                <table class="table table-sm" style="width: 100%">
                                    <tbody>
                                        <tr>
                                            <td colspan="2" style="width: 100%">
                                                <x-select-input name="org_id" id="org_id" class="select2" :options="$organizations" :selected="old('org_id', '1')" placeholder="Select" required />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="40%">
                                                <input type="checkbox" name="all_department" id="all_department">
                                                <label class="m-0" for="all_department">All Department</label>
                                            </td>
                                            <td width="60%" id="all_department_section">
                                                <x-select-input name="department_id" id="department_id" class="select2" :options="$departments" placeholder="Department ID" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="40%">
                                                <input type="checkbox" name="all_category" id="all_category" checked>
                                                <label class="m-0" for="all_category">All Category</label>
                                            </td>
                                            <td width="60%" id="all_category_section">
                                                <x-select-input name="employee_category_id" id="employee_category_id" class="select2" :options="$employeeCategories" placeholder="Category ID" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="40%">
                                                <label class="m-0" for="joining_date_from">Joining Date From</label>
                                            </td>
                                            <td width="60%">
                                                <x-text-input type="date" name="joining_date_from" id="joining_date_from" class="form-control form-control-sm" value="{{ $lastMonthStart }}" placeholder="Joining Date From" required />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="40%">
                                                <label class="m-0" for="joining_date_to">Joining Date To</label>
                                            </td>
                                            <td width="60%" id="category_section">
                                                <x-text-input type="date" name="joining_date_to" id="joining_date_to" class="form-control form-control-sm" value="{{ $lastMonthEnd }}" placeholder="Joining Date To" required />
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-lg-4 pe-lg-0">
                                <div style="max-height: 370px; min-height: 370px; overflow: auto;">
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th>Designation</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="tabledata">
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="btn-toolbar">
                                    &nbsp;&nbsp;<button type="button" class="btn btn-sm btn-success" id='check_all'>Check All</button> &nbsp;&nbsp;<button type="button" class="btn btn-sm btn-danger" id='uncheck_all'>Uncheck All</button>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <table class="table table-sm table-striped table-hover" style="width: 100%">
                                    <tr>
                                        <td width="40%">
                                            <label class="m-0" for="joining_date_to">Increment Date</label>
                                        </td>
                                        <td width="60%" id="category_section">
                                            <x-text-input type="date" name="joining_date_to" id="joining_date_to" class="form-control form-control-sm" value="{{ $lastMonthStart }}" placeholder="Joining Date To" required />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="40%">
                                            <label class="m-0" for="joining_date_to">Effective Date</label>
                                        </td>
                                        <td width="60%" id="category_section">
                                            <x-text-input type="date" name="joining_date_to" id="joining_date_to" class="form-control form-control-sm" value="{{ $lastMonthStart }}" placeholder="Joining Date To" required />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="40%">
                                            <label class="m-0" for="joining_date_to">Arrear Upto Date</label>
                                        </td>
                                        <td width="60%" id="category_section">
                                            <x-text-input type="date" name="joining_date_to" id="joining_date_to" class="form-control form-control-sm" value="{{ $lastMonthEnd }}" placeholder="Joining Date To" required />
                                        </td>
                                    </tr>

                                    <tr>
                                        <td width="40%">
                                            <label class="m-0" for="increment_source">Increment Source</label>
                                        </td>
                                        <td width="60%" id="category_section">
                                            <x-select-input name="increment_source" id="increment_source" class="select2" :options="['B' => 'From Basic', 'G' => 'From Gross']" placeholder="Increment Source" required />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="40%">
                                            <label class="m-0" for="increment_source">Increment Value</label>
                                        </td>
                                        <td width="60%" id="category_section">
                                            <x-select-input name="increment_value" id="increment_value" class="select2" :options="['P' => 'Percentage', 'F' => 'Flat']" placeholder="Increment Value" required />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="40%">
                                            <label class="m-0" for="joining_date_to">Amount (P/F)</label>
                                        </td>
                                        <td width="60%" id="category_section">
                                            <input type="number" name="increment_on_gross_amount" id="increment_on_gross_amount" min="0" class="form-control form-control-sm" placeholder="Flat/Percentage Amount" required />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="40%">
                                            <label class="m-0" for="house_rent_basic">HR % Basic</label>
                                        </td>
                                        <td width="60%" id="category_section">
                                            <input type="text" name="house_rent_basic" id="house_rent_basic" class="form-control form-control-sm" value="{{ (int)$hroption->house_rant_percent_basic }} %"  placeholder="House Rant % Basic" required readonly/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="40%">
                                            <label class="m-0" for="remarks">Remarks</label>
                                        </td>
                                        <td width="60%" id="category_section">
                                            <textarea name="remarks" id="remarks" class="form-control form-control-sm" placeholder="Remarks"></textarea>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer" style="padding:10px 20px;">
                        <button type="button" id="submitBtn" class="btn btn-sm btn-danger float-end" style="margin-right: 10px;"> <i data-feather="log-out" width="14" height="14"></i> Submit</button>
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
