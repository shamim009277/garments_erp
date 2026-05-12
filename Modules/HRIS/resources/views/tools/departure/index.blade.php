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
                'subtitle' => 'Departure',
                'breadcrumbs' => [
                    ['label' => 'HRIS', 'url' => route('hris.index')],
                    ['label' => 'Tools', 'url' => route('hris.index')],
                    ['label' => 'Departure', 'url' => route('hris.tools.departure.index')],
                ],
            ])
        </div>
        <div class="col-lg-8 col-md-8 ps-lg-1 ps-md-1" style="margin:0px auto;">
            <div class="card alert-info alert-top-border">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Departure</h6>
                </div>
                <form action="{{ route('hris.tools.departure.store') }}" id="applicantForm" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="card border">
                        <div class="card-body" style="overflow-y: auto;">
                            <div class="row">
                                <div class="col-lg-7 pe-lg-0">
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
                                            <td><x-text-input name="join_date" id="join_date" type="text" class="form-control-sm" placeholder="Joining Date" readonly /></td>
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
                                        <tr>
                                            <th>Advance Amount</th>
                                            <td><x-text-input name="advance_amount" class="form-control-sm" placeholder="Advance Amount" readonly/></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-lg-5">
                                    <table class="table table-striped mb-0" width="100%">
                                        <tr>
                                            <th width="40%">Salaried?</th>
                                            <td width="60%"><x-select-input name="salaried" id="salaried" class="select2" :options="['Y' => 'Yes', 'N' => 'No']" selected="N" required /></td>
                                        </tr>
                                        <tr>
                                            <th>Reason</th>
                                            <td><x-select-input name="reason" id="reason" class="select2" :options="$departurereasons" :selected="old('reason')" required /></td>
                                        </tr>
                                        <tr>
                                            <th>Leaving Date</th>
                                            <td><x-text-input name="leaving_date" id="leaving_date" type="text" class="form-control-sm" placeholder="YYYY-MM-DD" required /></td>
                                        </tr>
                                        <tr>
                                            <th>Notes</th>
                                            <td><textarea name="leaving_note" id="leaving_note" class="form-control form-control-sm" rows="3" placeholder="Leaving Notes" required></textarea></td>
                                        </tr>
                                        <tr>
                                            <th>Maternity End Date</th>
                                            <td><x-text-input name="mtreturn_date" id="mtreturn_date" type="date" class="form-control-sm" placeholder="YYYY-MM-DD" /></td>
                                        </tr>
                                        <tr>
                                            <th>Document</th>
                                            <td>
                                                <input type="file" name="document" class="form-control form-control-sm" accept=".pdf,.doc,.docx" />
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer" style="padding:10px 16px;">
                            <x-primary-button class="float-start btn-sm submitBtn">Assign</x-primary-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // ✅ বাইরে declare করো যাতে সব জায়গায় access পাওয়া যায়
    let leavingDatePicker;
    let mtreturnDatePicker;

    $(document).ready(function () {
        $('.select2').select2({
            placeholder: "Select an option",
            allowClear: true,
            width: '100%'
        });

        $('#reason').on('change', function () {
            let reason = $(this).val();
            if (reason == 'Maternity Leave') {
                $('#mtreturn_date').prop('required', true);
            } else {
                $('#mtreturn_date').prop('required', false);
            }
        });

        // ✅ এখন globally accessible
        leavingDatePicker = flatpickr("#leaving_date", {
            dateFormat: "Y-m-d",
            allowInput: true,
        });

        mtreturnDatePicker = flatpickr("#mtreturn_date", {
            dateFormat: "Y-m-d",
            allowInput: true,
        });

        employeeInfo();
        $("#employee_id").on("blur", function () {
            employeeInfo();
        });
    });

    function employeeInfo() {
        let employeeId = $("#employee_id").val();

        if (employeeId.length >= 6) {
            $.ajax({
                url: "{{ route('hris.tools.departure.info') }}",
                type: "POST",
                data: { employee_id: employeeId },
                success: function (response) {
                    $("#name, #designation, #department, #join_date").val('');
                    leavingDatePicker.clear();
                    mtreturnDatePicker.clear();

                    if (response && Object.keys(response).length > 0) {
                        $("#name").val(response.name || '');
                        $("#designation").val(response.designation?.designation || '');
                        $("#department").val(response.department?.department || '');
                        $("#join_date").val(response.joining_date || '');

                        if (response.joining_date) {
                            let start = new Date(response.joining_date);
                            let today = new Date();
                            let years  = today.getFullYear() - start.getFullYear();
                            let months = today.getMonth() - start.getMonth();
                            let days   = today.getDate() - start.getDate();
                            if (days < 0)   days = 0;
                            if (months < 0) months = 0;
                            $("#year").val(years);
                            $("#month").val(months);
                            $("#day").val(days);
                        }

                        if (response.reason) {
                            $("#reason").val(response.reason).trigger('change');
                        }
                        if (response.salaried) {
                            $("#salaried").val(response.salaried).trigger('change');
                        }

                        // ✅ এখন error আসবে না
                        if (response.leaving_date) {
                            leavingDatePicker.setDate(
                                response.leaving_date.toString().substring(0, 10), true
                            );
                        }
                        if (response.mtreturn_date) {
                            mtreturnDatePicker.setDate(
                                response.mtreturn_date.toString().substring(0, 10), true
                            );
                        }

                        $("#leaving_note").val(response.leaving_note || '');

                    } else {
                        Swal.fire({ icon: 'error', title: 'Error!', text: 'Failed to load employee info.' });
                    }
                },
                error: function () {
                    Swal.fire({ icon: 'error', title: 'Error!', text: 'Failed to load employee info.' });
                }
            });
        }
    }
</script>
@endpush
