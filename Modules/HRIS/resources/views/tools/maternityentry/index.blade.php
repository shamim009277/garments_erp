@extends('layouts.app')
@section('title', 'HRIS')
@section('content')
@push('styles')
<style>
.table, tr, th, td {
    border: none !important;
    border-collapse: collapse;
}
</style>
@endpush
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'HRIS',
                'subtitle' => 'Maternity Entry',
                'breadcrumbs' => [
                    ['label' => 'HRIS', 'url' => route('hris.index')],
                    ['label' => 'Tools', 'url' => route('hris.index')],
                    ['label' => 'Maternity Entry', 'url' => route('hris.tools.maternity-entry.index')],
                ],
            ])
        </div>
        <div class="col-12 mb-3">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                <h4 class="text-center flex-grow-1 order-1 order-md-0 mb-2 mb-md-0">
                   Maternity Entry
                </h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12" style="margin:0px auto;">
            <div class="card alert-primary alert-top-border" style="min-height: 400px;max-height: 400px;overflow-y: auto;">
                <div class="card-header d-flex justify-content-between align-items-center" style="padding: 15px 16px;">
                    <h6 class="my-0 text-primary">
                        <i data-feather="list" width="16" height="16"></i> Maternity Entry List
                    </h6>
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                        + Add New
                    </button>
                </div>
                <div class="card-body" style="overflow-y: auto;">
                    <div style="overflow-x: auto;">
                        <table class="table table-sm table-hover table-striped" style="width: 100%">
                            <thead class="table-light">
                                <tr>
                                    <th>Sl</th>
                                    <th>EmpID</th>
                                    <th>Name</th>
                                    <th>Department</th>
                                    <th>Designation</th>
                                    <th>Notice Date</th>
                                    <th>Application Date</th>
                                    <th>Leave Start Date</th>
                                    <th>Leave End Date</th>
                                    <th>PD Date</th>
                                    <th>Leave Day</th>
                                    <th>Payment</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="employeedata"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- sample modal content -->
    <div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-bs-scroll="true">
        <div class="modal-dialog modal-xl">
            <form action="{{ route('hris.tools.maternity-entry.store') }}" method="POST">
                @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">New Maternity Entry</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6 pe-lg-0">
                            <table class="table table-striped mb-0" width="100%">
                                <tr>
                                    <th width="35%">Employee ID</th>
                                    <td width="65%"><x-text-input name="employee_id" id="employee_id" class="form-control-sm" placeholder="Employee ID" /></td>
                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <td><x-text-input name="name" id="name" class="form-control-sm" placeholder="Employee Name" readonly /></td>
                                </tr>
                                <tr>
                                    <th>Designation</th>
                                    <td><x-text-input name="designation" id="designation" class="form-control-sm" placeholder="Designation" readonly /></td>
                                </tr>
                                <tr>
                                    <th>Department</th>
                                    <td><x-text-input name="department" id="department" class="form-control-sm" placeholder="Department" readonly /></td>
                                </tr>
                                <tr>
                                    <th>Joining Date</th>
                                    <td><x-text-input name="joining_date" id="joining_date" type="text" class="form-control-sm" placeholder="Joining Date" readonly /></td>
                                </tr>
                                <tr>
                                    <th>Tenure (Y/M/D)</th>
                                    <td>
                                        <div class="d-flex">
                                            <x-text-input name="year" id="year" class="form-control-sm me-1" placeholder="Year" width="22%" readonly/>
                                            <x-text-input name="month" id="month" class="form-control-sm me-1" placeholder="Month" width="21%" readonly/>
                                            <x-text-input name="day" id="day" class="form-control-sm" placeholder="Day" width="22%" readonly/>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-lg-6">
                            <table class="table table-striped mb-0" width="100%">
                                <tr>
                                    <th width="40%">Notice Date</th>
                                    <td width="60%"><x-text-input name="notice_date" id="notice_date" type="date" class="form-control-sm" placeholder="YYYY-MM-DD" required /></td>
                                </tr>
                                <tr>
                                    <th>Application Date</th>
                                    <td><x-text-input name="application_date" id="application_date" type="date" class="form-control-sm" placeholder="YYYY-MM-DD" required /></td>
                                </tr>
                                <tr>
                                    <th>PD Date</th>
                                    <td><x-text-input name="possible_delivery_date" id="possible_delivery_date" type="date" class="form-control-sm" placeholder="YYYY-MM-DD" /></td>
                                </tr>
                                <tr>
                                    <th>Leave Start Date</th>
                                    <td><x-text-input name="leave_start_date" id="leave_start_date" type="date" class="form-control-sm" placeholder="YYYY-MM-DD" required /></td>
                                </tr>
                                <tr>
                                    <th>Leave End Date</th>
                                    <td><x-text-input name="leave_end_date" id="leave_end_date" type="date" class="form-control-sm" placeholder="YYYY-MM-DD" /></td>
                                </tr>
                                <tr>
                                    <th>Leave Days</th>
                                    <td><x-text-input name="leave_days" id="leave_days" class="form-control-sm" placeholder="Leave Days" readonly /></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect btn-sm" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="submitBtn" class="btn btn-primary waves-effect waves-light btn-sm submitBtn">Save Changes</button>
                </div>
            </div>
            </form>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        let startPicker, endPicker;

        endPicker = flatpickr("#leave_end_date", {
            dateFormat: "Y-m-d",
            onChange: function (selectedDates, dateStr) {
                if (dateStr) {
                    startPicker.set('maxDate', dateStr);
                }
                updateDays();
            }
        });

        startPicker = flatpickr("#leave_start_date", {
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
                $("#leave_end_date").val("");
                $("#leave_days").val("");
                return "";
            }

            let diffTime = endDate - startDate;
            let diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
            return diffDays;
        }

        function updateDays() {
            let start = $("#leave_start_date").val();
            let end = $("#leave_end_date").val();
            let days = calculateDays(start, end);

            if (days) {
                $("#leave_days").val(days);
            }
        }

        $('#leave_start_date,#leave_end_date').trigger('change');

        function employeeInfo() {
            let employeeId = $("#employee_id").val();

            if (employeeId.length >= 6) {
                $.ajax({
                    url: "{{ route('hris.tools.departure.info') }}",
                    type: "POST",
                data: {
                    employee_id: employeeId
                },
                success: function (response) {
                    $("#name").val('');
                    $("#designation").val('');
                    $("#department").val('');
                    $("#joining_date").val('');
                    $("#designation_id").val('');
                    $("#department_id").val('');

                    if (response && Object.keys(response).length > 0) {
                        $("#name").val(response.name || '');
                        $("#designation").val(response.designation?.designation || '');
                        $("#department").val(response.department?.department || '');
                        $("#joining_date").val(response.joining_date || '');

                        if(response.joining_date){
                            let start = new Date(response.joining_date);
                            let today = new Date();

                            let years = today.getFullYear() - start.getFullYear();
                            let months = today.getMonth() - start.getMonth();
                            let days = today.getDate() - start.getDate();

                            if (days < 0) {
                                days = 0;
                            }
                            if (months < 0) {
                                months = 0;
                            }

                            $("#year").val(years);
                            $("#month").val(months);
                            $("#day").val(days);
                        }
                        $("#designation_id").val(response.designation_id || '');
                        $("#department_id").val(response.department_id || '');
                        if(response.reason){
                            $("#reason").val(response.reason).trigger('change');
                        }
                        if(response.salaried){
                            $("#salaried").val(response.salaried).trigger('change');
                        }
                        $("#leaving_date").val(response.leaving_date || '');
                        $("#notes").val(response.leaving_note || '');
                        $("#mtreturn_date").val(response.mtreturn_date || '');
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Failed to load employee info.',
                        });
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
            }
        }


        employeeInfo();
        $("#employee_id").on("blur", function () {
            employeeInfo();
        });
    });
</script>
@endpush
