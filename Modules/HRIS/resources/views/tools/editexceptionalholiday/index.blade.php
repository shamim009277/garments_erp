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
                'subtitle' => 'Edit Exceptional Holiday',
                'breadcrumbs' => [
                    ['label' => 'HRIS', 'url' => route('hris.index')],
                    ['label' => 'Tools', 'url' => route('hris.index')],
                    ['label' => 'Exceptional Holiday', 'url' => route('hris.tools.editexceptional-holidays.index')],
                ],
            ])
        </div>
    </div>
    <div class="row">
        <div class="col-lg-2 ps-lg-0" style="margin:0px auto;"></div>
        <div class="col-lg-4 ps-lg-0" style="margin:0px auto;">
            <div class="card alert-primary alert-top-border">
                <div class="card-header" style="padding: 15px 16px;">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Display For Date</h6>
                </div>
                <div class="card-body" style="overflow-y: auto;">
                    <table class="table table-sm" style="width: 100%">
                        <tbody>
                            <tr>
                                <td width="70%" style="border: none;">
                                    <x-text-input name="display_date" id="display_date" class="form-control-sm" type="date" value="{{ date('Y-m-d') }}" required readonly />
                                </td>
                                <td width="30%" style="border: none;">
                                    <x-primary-button id="submitBtn" class="btn-sm submitBtn float-end display" type="submit">Display</x-primary-button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-4 ps-lg-0" style="margin:0px auto;">
            <div class="card alert-primary alert-top-border">
                <div class="card-header" style="padding: 15px 16px;">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Display For Employee ID</h6>
                </div>
                <div class="card-body" style="overflow-y: auto;">
                    <table class="table table-sm" style="width: 100%">
                        <tbody>
                            <tr>
                                <th width="30%" style="border: none;">EmpID</th>
                                <td width="70%" style="border: none;">
                                    <x-text-input name="emp_id" id="emp_id" class="form-control-sm" type="text" value="{{ old('emp_id') }}" required />
                                </td>
                            </tr>
                            <tr>
                                <th width="30%" style="border: none;">Start Date</th>
                                <td width="70%" style="border: none;">
                                    <x-text-input name="display_date" id="start_date" class="form-control-sm" type="date" value="{{ date('Y-m-d') }}" required readonly />
                                </td>
                            </tr>
                            <tr>
                                <th width="30%" style="border: none;">End Date</th>
                                <td width="70%" style="border: none;">
                                    <x-text-input name="display_date" id="end_date" class="form-control-sm" type="date" value="{{ date('Y-m-d') }}" required readonly />
                                </td>
                            </tr>
                            <tr>
                                <th width="30%" style="border: none;">Holiday</th>
                                <td width="70%" style="border: none;">
                                    <x-select-input name="holiday" id="holiday" class="select2" :options="['Sunday'=>'Sunday','Monday'=>'Monday','Tuesday'=>'Tuesday','Wednesday'=>'Wednesday','Thursday'=>'Thursday','Friday'=>'Friday','Saturday'=>'Saturday']" selected="{{ old('holiday') }}" required />
                                </td>
                            </tr>
                            <tr>
                                <th colspan="3" class="flex justify-end items-center gap-2" style="border: none;">
                                    <x-primary-button id="displayBtn" class="btn-sm submitBtn display-date" type="button" style="margin-left: 8px;">
                                        Display
                                    </x-primary-button>

                                    <x-primary-button id="regenBtn" class="btn-sm btn-info submitBtn re-generate" type="button">
                                        Re-Generate
                                    </x-primary-button>
                                </th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-2 ps-lg-0" style="margin:0px auto;"></div>
    </div>
    <div class="row">
        <div class="col-lg-8 ps-lg-0" style="margin:0px auto;">
            <div class="card alert-primary alert-top-border" style="min-height: 400px;max-height: 400px;overflow-y: auto;">
                <div class="card-header" style="padding: 15px 16px;">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Display Employee</h6>
                </div>
                <div class="card-body" style="overflow-y: auto;">
                    <div style="overflow-x: auto;">
                        <table class="table table-sm table-hover table-striped" style="width: 100%">
                            <thead class="table-light">
                                <tr>
                                    <th width="15%">Employee ID</th>
                                    <th width="25%">Name</th>
                                    <th width="25%">Holiday Date</th>
                                    <th width="25%">Day</th>
                                    <th width="10%">Action</th>
                                </tr>
                            </thead>
                            <tbody id="employeedata"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $(document).on('click', '.display', function(e) {
            e.preventDefault();
            let displayDate = $('#display_date').val();
            let form = 1;

            $.ajax({
                url: '{{ route('hris.tools.editexceptional-holidays.store') }}',
                type: 'POST',
                data: {
                    date: displayDate,
                    form: form,
                    _token: '{{ csrf_token() }}'
                },
                beforeSend: function() {
                    Swal.fire({
                        title: 'Please wait...',
                        text: 'Loading employee holiday data...',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                },
                success: function(response) {
                    $('#employeedata').empty();

                    if (response.success && response.data.length > 0) {
                        let row = ``;
                        response.data.forEach(emp => {
                            const date = new Date(emp.holiday_date);
                            const dayName = date.toLocaleDateString("en-US", { weekday: "long" });

                            row += `
                                <tr id="row-${emp.id}">
                                    <td>${emp.employee_id}</td>
                                    <td>${emp.employee_basic.name}</td>
                                    <td>${emp.holiday_date}</td>
                                    <td>${dayName}</td>
                                    <td>
                                        <a href="#" class="btn btn-soft-danger waves-effect waves-light delete-Display"
                                        data-id="${emp.id}" style="padding: 4px 6px;">
                                        <i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            `;
                        });
                        $('#employeedata').html(row);
                        Swal.close();
                    } else {
                        Swal.fire(
                            'Info!',
                            'No data found!',
                            'info'
                        );
                    }
                },
                error: function() {
                    Swal.fire('Error!', 'Something went wrong while fetching data.', 'error');
                }
            });
        });


        $(document).on('click', '.delete-Display', function(e) {
            let id = $(this).data('id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('hris.tools.editexceptional-holidays.delete') }}',
                        type: 'POST',
                        data: {
                            id: id,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire(
                                    'Deleted!',
                                    'Holiday has been deleted.',
                                    'success'
                                );
                                $('#row-' + id).remove();
                            } else {
                                Swal.fire(
                                    'Error!',
                                    'Holiday has not been deleted.',
                                    'error'
                                );
                            }
                        }
                    });
                }
            });
        });

        $(document).on('click', '.display-date', function(e) {
            e.preventDefault();
            let startDate = $('#start_date').val();
            let endDate = $('#end_date').val();
            let empId = $('#emp_id').val();
            let form = 2;

            if(startDate == '' || endDate == '' || empId == ''){
                Swal.fire(
                    'Error!',
                    'Please fill Employee ID, Start Date and End Date fields.',
                    'error'
                );
                return;
            }

            $.ajax({
                url: '{{ route('hris.tools.editexceptional-holidays.store') }}',
                type: 'POST',
                data: {
                    emp_id: empId,
                    start_date: startDate,
                    end_date: endDate,
                    form: form,
                    _token: '{{ csrf_token() }}'
                },
                beforeSend: function() {
                    Swal.fire({
                        title: 'Please wait...',
                        text: 'Loading employee holiday data...',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                },
                success: function(response) {
                    $('#employeedata').empty();

                    if (response.success && response.data.length > 0) {
                        let row = ``;
                        response.data.forEach(emp => {
                            const date = new Date(emp.holiday_date);
                            const dayName = date.toLocaleDateString("en-US", { weekday: "long" });

                            row += `
                                <tr id="row-${emp.id}">
                                    <td>${emp.employee_id}</td>
                                    <td>${emp.employee_basic.name}</td>
                                    <td>${emp.holiday_date}</td>
                                    <td>${dayName}</td>
                                    <td>
                                        <a href="#" class="btn btn-soft-danger waves-effect waves-light delete-Display"
                                        data-id="${emp.id}" style="padding: 4px 6px;">
                                        <i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            `;
                        });
                        $('#employeedata').html(row);
                        Swal.close();
                    } else {
                        Swal.fire(
                            'Info!',
                            'No data found!',
                            'info'
                        );
                    }
                }
            });
        });

        $(document).on('click', '.re-generate', function(e) {
            e.preventDefault();
            let startDate = $('#start_date').val();
            let endDate = $('#end_date').val();
            let empId = $('#emp_id').val();
            let holiday = $('#holiday').val();
            let form = 3;

            if(startDate == '' || endDate == '' || empId == '' || holiday == ''){
                Swal.fire(
                    'Error!',
                    'Please fill all Employee ID, Start Date, End Date and Holiday fields.',
                    'error'
                );
                return;
            }

            $.ajax({
                url: '{{ route('hris.tools.editexceptional-holidays.store') }}',
                type: 'POST',
                data: {
                    emp_id: empId,
                    start_date: startDate,
                    end_date: endDate,
                    holiday: holiday,
                    form: form,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#employeedata').empty();

                    if (response.success && response.data.length > 0) {
                        Swal.fire(
                            'Success!',
                            'Holiday has been generated successfully.',
                            'success'
                        );
                        let row = ``;
                        response.data.forEach(emp => {
                            const date = new Date(emp.holiday_date);
                            const dayName = date.toLocaleDateString("en-US", { weekday: "long" });

                            row += `
                                <tr id="row-${emp.id}">
                                    <td>${emp.employee_id}</td>
                                    <td>${emp.employee_basic.name}</td>
                                    <td>${emp.holiday_date}</td>
                                    <td>${dayName}</td>
                                    <td>
                                        <a href="#" class="btn btn-soft-danger waves-effect waves-light delete-Display"
                                        data-id="${emp.id}" style="padding: 4px 6px;">
                                        <i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            `;
                        });
                        $('#employeedata').html(row);

                    } else {
                        Swal.fire(
                            'Info!',
                            'No data found!',
                            'info'
                        );
                    }
                }
            });
        });
    });
</script>
@endpush
