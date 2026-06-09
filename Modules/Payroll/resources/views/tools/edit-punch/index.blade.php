@extends('layouts.app')
@section('title', 'Payroll')
@section('content')
    @push('styles')
        <style>
            .table,tr,th,td {
                border: none !important;
                border-collapse: collapse;
            }
        </style>
    @endpush
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'Payroll',
                'subtitle' => 'Edit Punch Data',
                'breadcrumbs' => [
                    ['label' => 'Payroll', 'url' => route('payroll.index')],
                    ['label' => 'Tools', 'url' => route('payroll.tools.edit-punchdata.index')],
                    ['label' => 'Edit Punch', 'url' => route('payroll.tools.edit-punchdata.index')],
                ],
            ])
        </div>
        <div class="col-12 mb-3">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                <h4 class="text-center flex-grow-1 order-1 order-md-0 mb-2 mb-md-0">
                    Edit Punch Data
                </h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 ps-lg-0" style="margin:0px auto;">
            <div class="card alert-primary alert-top-border">
                <div class="card-header" style="padding: 15px 16px;">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Display For Employee ID</h6>
                </div>
                <div class="card-body" style="overflow-y: auto;">
                    <div class="col">
                        <div class="row">
                            <div class="col-md-6 pe-md-0">
                                <table class="table table-sm table-hover table-striped" style="width: 100%">
                                    <tbody>
                                        <tr>
                                            <td style="border: none;">
                                                <x-select-input name="organization_id" id="organization_id" class="form-control-sm select2" :options="$organizations" selected="{{ old('organization_id', 1) }}" placeholder="Organization" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="border: none;">
                                                <x-text-input name="emp_id" id="employee_id" class="form-control-sm" type="text" value="{{ old('employee_id') }}" placeholder="Employee ID" required />
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
                                                <x-text-input name="start_date" id="start_date" class="form-control-sm" type="date" value="{{ date('d-m-Y') }}" required readonly />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="border: none;">
                                                <x-text-input name="end_date" id="end_date" class="form-control-sm" type="date" value="{{ date('d-m-Y') }}" required readonly />
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="flex justify-end items-center gap-2" style="border: none;">
                                                <x-primary-button id="displayBtn" class="btn-sm submitBtn display-date" type="button" style="margin-left: 8px;">
                                                    Display
                                                </x-primary-button>

                                                <x-primary-button id="addManuallyBtn" class="btn-sm submitBtn display-date" type="button" style="margin-left: 8px;">
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
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Display Employee Attendence</h6>
                </div>
                <div class="card-body" style="overflow-y: auto;">
                    <div style="overflow-x: auto;">
                        <form id="punchForm">
                            <table class="table table-sm table-hover table-striped" style="width: 100%">
                                <thead class="table-light">
                                    <tr>
                                        <th width="">Employee ID</th>
                                        <th width="">Work Date</th>
                                        <th width="">Day</th>
                                        <th width="">Shift</th>
                                        <th width="">Start Punch</th>
                                        <th width="">End Punch</th>
                                    </tr>
                                </thead>
                                <tbody id="employeedata"></tbody>
                            </table>
                            <tfoot>
                                <x-primary-button id="submitBtn" class="btn-sm submitBtn" type="button" style="margin-left: 8px;" style="display: none;">
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
                    url: '{{ route('payroll.tools.edit-punchdata.store') }}',
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
                            text: 'Loading employee punch data...',
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
                                let empId = String(emp.employee_id).padStart(6, '0');

                                const date = new Date(emp.work_date);

                                const dayName = date.toLocaleDateString('en-US', {
                                    weekday: 'long'
                                });

                                row += `
                            <tr id="row-${emp.id}">
                                <td>${empId}</td>
                                <td>${emp.work_date}</td>
                                <td>${dayName}</td>
                                <td>${emp.shift}</td>
                                <td><input type="text" onblur="updatePunch(${emp.id})" id="start_punch_${emp.id}" name="start_punch" class="form-control form-control-sm" value="${startPunch}" /></td>
                                <td><input type="text" onblur="updatePunch(${emp.id})" id="end_punch_${emp.id}" name="end_punch" class="form-control form-control-sm" value="${endPunch}" /></td>
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

                if (startDate == '' || endDate == '' || empId == '' || organizationId == '') {
                    Swal.fire(
                        'Error!',
                        'Please fill Employee ID, Start Date and End Date fields.',
                        'error'
                    );
                    return;
                }

                $.ajax({
                    url: '{{ route('payroll.tools.edit-punchdata.store') }}',
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
                            text: 'Loading employee punch data...',
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
                            $('#submitBtn').css('display', 'inline-block');
                            $('#submitBtn').prop('disabled', false);

                            let row = '';

                            response.data.forEach((emp, index) => {

                                let startPunch = emp.start_punch || '';
                                let endPunch = emp.end_punch || '';
                                let empId = String(emp.employee_id).padStart(6, '0');

                                const date = new Date(emp.work_date);

                                const dayName = date.toLocaleDateString('en-US', {
                                    weekday: 'long'
                                });

                                row += `
                                <tr>
                                    <td>
                                        ${empId}
                                        <input type="hidden" name="rows[${index}][employee_id]" value="${emp.employee_id}">
                                        <input type="hidden" name="rows[${index}][organization_id]" value="${emp.organization_id}">
                                    </td>

                                    <td>
                                        ${emp.work_date}
                                        <input type="hidden" name="rows[${index}][work_date]" value="${emp.work_date}">
                                    </td>

                                    <td>${dayName}</td>

                                    <td>
                                        ${emp.shift}
                                        <input type="hidden" name="rows[${index}][shift]" value="${emp.shift}">
                                    </td>

                                    <td>
                                        <input type="text"
                                            class="form-control form-control-sm"
                                            name="rows[${index}][start_punch]"
                                            value="${startPunch}">
                                    </td>

                                    <td>
                                        <input type="text"
                                            class="form-control form-control-sm"
                                            name="rows[${index}][end_punch]"
                                            value="${endPunch}">
                                    </td>
                                </tr>`;
                            });

                            $('#employeedata').html(row);
                            Swal.close();

                        } else {
                            $('#submitBtn').css('display', 'none');
                            $('#submitBtn').prop('disabled', true);
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
            let form = $('#punchForm');

            $.ajax({
                url: '{{ route('payroll.tools.edit-punchdata.manual-store') }}',
                type: 'POST',
                data: $('#punchForm').serialize(),
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
                    }
                    else {
                        Swal.fire('Error!', res.message || 'Server error', 'error');
                    }
                }
            });
        });

        // ✅ Make this global
        function updatePunch(id) {
            var start_punch = $('#start_punch_' + id).val();
            var end_punch = $('#end_punch_' + id).val();

            $.ajax({
                url: '{{ route('payroll.tools.edit-punchdata.update', ':id') }}'.replace(':id', id),
                type: 'PUT',
                data: {
                    _token: '{{ csrf_token() }}',
                    start_punch: start_punch,
                    end_punch: end_punch,
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
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }
    </script>
@endpush
