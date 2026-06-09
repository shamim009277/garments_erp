@extends('layouts.app')
@section('title', 'Payroll')
@section('content')
    @push('styles')
        <style>
            .table,
            tr,
            th,
            td {
                border: none !important;
                border-collapse: collapse;
            }
        </style>
    @endpush
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'Payroll',
                'subtitle' => 'Edit Attendence',
                'breadcrumbs' => [
                    ['label' => 'Payroll', 'url' => route('payroll.index')],
                    ['label' => 'Tools', 'url' => route('payroll.tools.edit-attendence.index')],
                    ['label' => 'Edit Attendence', 'url' => route('payroll.tools.edit-attendence.index')],
                ],
            ])
        </div>
        <div class="col-12 mb-3">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                <h4 class="text-center flex-grow-1 order-1 order-md-0 mb-2 mb-md-0">
                    Edit Attendence
                </h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 ps-lg-0" style="margin:0px auto;">
            <div class="card alert-primary alert-top-border">
                <div class="card-header" style="padding: 15px 16px;">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Display For
                        Employee ID</h6>
                </div>
                <div class="card-body" style="overflow-y: auto;">
                    <div class="col">
                        <div class="row">
                            <div class="col-md-6 pe-md-0">
                                <table class="table table-sm table-hover table-striped" style="width: 100%">
                                    <tbody>
                                        <tr>
                                            <td style="border: none;">
                                                <x-select-input name="organization_id" id="organization_id"
                                                    class="form-control-sm select2" :options="$organizations"
                                                    selected="{{ old('organization_id', 1) }}" placeholder="Organization" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="border: none;">
                                                <x-text-input name="emp_id" id="employee_id" class="form-control-sm"
                                                    type="text" value="{{ old('employee_id') }}"
                                                    placeholder="Employee ID" required />
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-sm table-hover table-striped" style="width: 100%">
                                    <tbody>
                                        <tr>
                                            <td style="border: none;">
                                                <x-text-input name="start_date" id="start_date" class="form-control-sm"
                                                    type="date" value="{{ date('d-m-Y') }}" required readonly />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="border: none;">
                                                <x-text-input name="end_date" id="end_date" class="form-control-sm"
                                                    type="date" value="{{ date('d-m-Y') }}" required readonly />
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="flex justify-end items-center gap-2" style="border: none;">
                                                <x-primary-button id="displayBtn" class="btn-sm submitBtn display-date"
                                                    type="button" style="margin-left: 8px;">
                                                    Display
                                                </x-primary-button>

                                                <x-primary-button id="addManuallyBtn" class="btn-sm submitBtn display-date"
                                                    type="button" style="margin-left: 8px;">
                                                    Add Manually
                                                </x-primary-button>
                                            </th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 ps-lg-0" style="margin:0px auto;">
            <div class="card alert-primary alert-top-border" style="min-height: 400px;max-height: 400px;overflow-y: auto;">
                <div class="card-header" style="padding: 15px 16px;">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Display
                        Employee Attendence</h6>
                </div>
                <div class="card-body" style="overflow-y: auto;">
                    <div style="overflow-x: auto;">
                        <form id="attnData">
                            <table class="table table-sm table-hover table-striped" style="width: 100%">
                                <thead class="table-light">
                                    <tr>
                                        <th>EmpID</th>
                                        <th>Work Date</th>
                                        <th width="8%">Shift</th>
                                        <th>Start Punch</th>
                                        <th>End Punch</th>
                                        <th width="8%">RWH</th>
                                        <th width="8%">OTH</th>
                                        <th width="8%">Is Late</th>
                                        <th width="8%">Attn Status</th>
                                    </tr>
                                </thead>
                                <tbody id="employeedata"></tbody>
                            </table>
                            <tfoot>
                                <x-primary-button id="submitBtn" class="btn-sm submitBtn" type="button"
                                    style="margin-left: 8px;" style="display: none;">
                                    Save Changes
                                </x-primary-button>
                            </tfoot>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $(document).on('click', '#displayBtn', function(e) {
                e.preventDefault();
                let startDate = $('#start_date').val();
                let endDate = $('#end_date').val();
                let empId = $('#employee_id').val();
                let organizationId = $('#organization_id').val();
                let form = 1;

                if (startDate == '' || endDate == '' || empId == '' || organizationId == '') {
                    Swal.fire(
                        'Error!',
                        'Please fill Employee ID, Start Date and End Date fields.',
                        'error'
                    );
                    return;
                }

                $.ajax({
                    url: '{{ route('payroll.tools.edit-attendence.store') }}',
                    type: 'POST',
                    data: {
                        start_date: startDate,
                        end_date: endDate,
                        employee_id: empId,
                        organization_id: organizationId,
                        form: form,
                        _token: '{{ csrf_token() }}'
                    },
                    beforeSend: function() {
                        Swal.fire({
                            title: 'Please wait...',
                            text: 'Loading employee attendence data...',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                    },
                    success: function(response) {
                        $('#employeedata').empty();
                        $('#submitBtn').css('display', 'none');
                        $('#submitBtn').prop('disabled', true);

                        if (response.success && response.data.length > 0) {
                            let row = ``;
                            response.data.forEach(emp => {
                                let startPunch = emp.start_punch || '0000-00-00 00:00';
                                let endPunch = emp.end_punch || '0000-00-00 00:00';
                                let empId = String(emp.employee_id).padStart(8, '0');

                                row += `
                            <tr id="row-${emp.id}">
                                <td>${empId}</td>
                                <td>${emp.work_date}</td>
                                <td>${emp.shift}</td>
                                <td><input type="text" id="start_punch_${emp.id}" name="start_punch" class="form-control form-control-sm" value="${startPunch}" /></td>
                                <td><input type="text" id="end_punch_${emp.id}" name="end_punch" class="form-control form-control-sm" value="${endPunch}" /></td>
                                <td><input type="text" id="rwh_${emp.id}" name="rwh" class="form-control form-control-sm" value="${emp.rwh}" /></td>
                                <td><input type="text" id="ot_hours_${emp.id}" name="ot_hours" class="form-control form-control-sm" value="${emp.ot_hours}" /></td>
                                <td><input type="text" id="is_late_${emp.id}" name="is_late" class="form-control form-control-sm" value="${emp.is_late}" /></td>
                                <td><input type="text" onblur="updateAttendence(${emp.id})" id="attn_type_${emp.id}" name="attn_type" class="form-control form-control-sm" value="${emp.attn_type}" /></td>
                            </tr>`;
                            });
                            $('#employeedata').html(row);
                            Swal.close();
                        } else {
                            Swal.fire('Info!', 'No data found!', 'info');
                        }
                    },
                    error: function() {
                        Swal.fire('Error!', 'Something went wrong while fetching data.',
                            'error');
                    }
                });
            });
        });

        $(document).ready(function() {
            $(document).on('click', '#addManuallyBtn', function(e) {
                e.preventDefault();

                let startDate = $('#start_date').val();
                let endDate = $('#end_date').val();
                let empId = $('#employee_id').val();
                let organizationId = $('#organization_id').val();
                let form = 2;

                if (startDate === '' || endDate === '' || empId === '' || organizationId === '') {
                    Swal.fire(
                        'Error!',
                        'Please fill Employee ID, Start Date and End Date fields.',
                        'error'
                    );
                    return;
                }

                $.ajax({
                    url: '{{ route('payroll.tools.edit-attendence.store') }}',
                    type: 'POST',
                    data: {
                        start_date: startDate,
                        end_date: endDate,
                        employee_id: empId,
                        organization_id: organizationId,
                        form: form,
                        _token: '{{ csrf_token() }}'
                    },

                    beforeSend: function() {
                        Swal.fire({
                            title: 'Please wait...',
                            text: 'Loading employee attendance data...',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                    },

                    success: function(response) {
                        $('#employeedata').empty();

                        console.log(response);

                        if (response.success && response.data.length > 0) {

                            $('#submitBtn')
                                .css('display', 'inline-block')
                                .prop('disabled', false);

                            let row = '';

                            response.data.forEach((emp, index) => {

                                let startPunch = emp.start_punch || '';
                                let endPunch = emp.end_punch || '';

                                let empCode = String(emp.employee_id).padStart(8, '0');

                                row += `
                            <tr id="row-${emp.id}">
                                <td>${empCode}</td>

                                <td>
                                    ${emp.work_date}
                                    <input type="hidden" name="rows[${index}][employee_id]" value="${emp.employee_id}">
                                    <input type="hidden" name="rows[${index}][organization_id]" value="${emp.organization_id}">
                                    <input type="hidden" name="rows[${index}][work_date]" value="${emp.work_date}">
                                </td>

                                <td>
                                    <input type="text" id="shift_${emp.id}" name="rows[${index}][shift]" class="form-control form-control-sm" value="${emp.shift}">
                                </td>

                                <td>
                                    <input type="text" id="start_punch_${emp.id}" name="rows[${index}][start_punch]" class="form-control form-control-sm" value="${startPunch}">
                                </td>

                                <td>
                                    <input type="text" id="end_punch_${emp.id}" name="rows[${index}][end_punch]" class="form-control form-control-sm" value="${endPunch}">
                                </td>

                                <td>
                                    <input type="text" id="rwh_${emp.id}" name="rows[${index}][rwh]" class="form-control form-control-sm" value="${emp.rwh}">
                                </td>

                                <td>
                                    <input type="text" id="ot_hours_${emp.id}" name="rows[${index}][ot_hours]" class="form-control form-control-sm" value="${emp.ot_hours}">
                                </td>

                                <td>
                                    <input type="text" id="is_late_${emp.id}" name="rows[${index}][is_late]" class="form-control form-control-sm" value="${emp.is_late || ''}">
                                </td>

                                <td>
                                    <select id="attn_type_${emp.id}"
                                        name="rows[${index}][attn_type]"
                                        class="form-control form-control-sm">

                                        <option value="">Select</option>
                                        <option value="PR" ${emp.attn_type === 'PR' ? 'selected' : ''}>PR</option>
                                        <option value="HD" ${emp.attn_type === 'HD' ? 'selected' : ''}>HD</option>
                                        <option value="AB" ${emp.attn_type === 'AB' ? 'selected' : ''}>AB</option>
                                        <option value="CL" ${emp.attn_type === 'CL' ? 'selected' : ''}>CL</option>
                                        <option value="SL" ${emp.attn_type === 'SL' ? 'selected' : ''}>SL</option>
                                        <option value="EL" ${emp.attn_type === 'EL' ? 'selected' : ''}>EL</option>
                                    </select>
                                </td>
                            </tr>
                        `;
                            });

                            $('#employeedata').html(row);
                            Swal.close();

                        } else {
                            $('#submitBtn')
                                .css('display', 'none')
                                .prop('disabled', true);

                            Swal.fire('Info!', 'No data found!', 'info');
                        }
                    },

                    error: function() {
                        Swal.fire('Error!', 'Something went wrong while fetching data.',
                            'error');
                    }
                });
            });
        });

        $(document).on('click', '#submitBtn', function(e) {
            e.preventDefault();
            let form = $('#attnData');

            $.ajax({
                url: '{{ route('payroll.tools.edit-attendence.manual-store') }}',
                type: 'POST',
                data: $('#attnData').serialize(),
                success: function(response) {
                    console.log(response);

                    Swal.fire('Success!', response.message, 'success');
                    if (response.data) {
                        renderFromResponse(response.data);
                    }
                },
                error: function(xhr) {
                    let res = xhr.responseJSON;
                    if (xhr.status === 422) {
                        console.log(res.errors);
                        Swal.fire('Validation Error!', res.message, 'warning');
                    } else {
                        Swal.fire('Error!', res.message || 'Server error', 'error');
                    }
                }
            });
        });

        // ✅ Make this global
        function updateAttendence(id) {
            var start_punch = $('#start_punch_' + id).val();
            var end_punch = $('#end_punch_' + id).val();
            var rwh = $('#rwh_' + id).val();
            var ot_hours = $('#ot_hours_' + id).val();
            var is_late = $('#is_late_' + id).val();
            var attn_type = $('#attn_type_' + id).val();

            let attendanceType = $('#attn_type_' + id).val().trim().toUpperCase();
            if (!['PR', 'HD', 'AB', 'CL', 'SL', 'EL'].includes(attendanceType)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Attendance Type must be PR, HD, AB, CL, SL & EL'
                }).then(() => {
                    $('#attn_type_' + id).focus();
                });
                return;
            }

            let isLate = $('#is_late_' + id).val().trim().toUpperCase();
            if (!['Y', 'N'].includes(isLate)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Is Late must be Y or N'
                }).then(() => {
                    $('#is_late_' + id).focus();
                });
                return;
            }

            let rwhvalue = $('#rwh_' + id).val().trim();
            if (rwhvalue === '' || isNaN(rwhvalue) || Number(rwhvalue) < 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'RWH must be a valid positive number'
                }).then(() => {
                    $('#rwh_' + id).focus();
                });
                return;
            }

            let othoursvalue = $('#ot_hours_' + id).val().trim();
            if (othoursvalue === '' || isNaN(othoursvalue) || Number(othoursvalue) < 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'OT Hours must be a valid positive number'
                }).then(() => {
                    $('#ot_hours_' + id).focus();
                });
                return;
            }

            $.ajax({
                url: '{{ route('payroll.tools.edit-attendence.update', ':id') }}'.replace(':id', id),
                type: 'PUT',
                data: {
                    _token: '{{ csrf_token() }}',
                    start_punch: start_punch,
                    end_punch: end_punch,
                    rwh: rwh,
                    ot_hours: ot_hours,
                    is_late: is_late,
                    attn_type: attn_type
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message,
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to update',
                        });
                    }
                },
                error: function(xhr) {
                    let res = xhr.responseJSON;
                    if (xhr.status === 422) {
                        console.log(res.errors);
                        Swal.fire('Validation Error!', res.message, 'warning');
                    }
                    else {
                        Swal.fire('Error!', res.message || 'Server error', 'error');
                    }
                }
            });
        }
    </script>
@endpush
