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
                'subtitle' => 'Edit Shifting List',
                'breadcrumbs' => [
                    ['label' => 'HRIS', 'url' => route('hris.index')],
                    ['label' => 'Tools', 'url' => route('hris.index')],
                    ['label' => 'Shifting List', 'url' => route('hris.tools.edit-shiftinglist.index')],
                ],
            ])
        </div>

        <div class="col-12 mb-3">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                <h4 class="text-center flex-grow-1 order-1 order-md-0 mb-2 mb-md-0">
                   Edit Shifting List
                </h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-1 ps-lg-0" style="margin:0px auto;"></div>
        <div class="col-lg-4 ps-lg-0" style="margin:0px auto;">
            <div class="card alert-primary alert-top-border">
                <div class="card-header" style="padding: 15px 16px;">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Display For Date</h6>
                </div>
                <div class="card-body" style="overflow-y: auto;">
                    <table class="table table-sm" style="width: 100%">
                        <tbody>
                            <tr>
                                <th width="20%" style="border: none;">Date</th>
                                <td width="50%" style="border: none;">
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

        <div class="col-lg-6 ps-lg-0" style="margin:0px auto;">
            <div class="card alert-primary alert-top-border">
                <div class="card-header" style="padding: 15px 16px;">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Display/Chage Shift For Employee</h6>
                </div>
                <div class="card-body" style="overflow-y: auto;">
                    <table class="table table-sm" style="width: 100%">
                        <tbody>
                            <tr>
                                <td width="80%" style="border: none;">
                                    <div class="row">
                                        <div class="col-4">
                                            <x-input-group name="emp_id" id="emp_id" class="form-control-sm" type="text" value="{{ old('emp_id') }}" placeholder="Employee ID" required />
                                        </div>
                                        <div class="col-4">
                                            <x-select-input name="shift" id="shift" class="select2" value="{{ old('shift') }}" placeholder="Shift" required :options="$shifts" />
                                        </div>
                                        <div class="col-4">
                                            <x-select-input name="to_shift" id="to_shift" class="select2" value="{{ old('to_shift') }}" placeholder="To Shift" required :options="$shifts" />
                                        </div>
                                    </div>
                                </td>
                                <td width="20%" style="border: none;">
                                    <x-primary-button id="submitBtn" class="btn-sm submitBtn float-end display-date" type="submit">Display</x-primary-button>
                                </td>
                            </tr>
                            <tr>
                                <td width="80%" style="border: none;">
                                    <div class="row">
                                        <div class="col-4">
                                            <x-text-input name="start_date" id="start_date" class="form-control-sm" type="date" value="{{ $startDate }}" required readonly />
                                        </div>
                                        <div class="col-4">
                                            <x-text-input name="end_date" id="end_date" class="form-control-sm" type="date" value="{{ $endDate }}" required readonly />
                                        </div>
                                        <div class="col-4">
                                            <x-select-input name="holiday" id="holiday" class="select2" value="{{ old('holiday') }}" placeholder="Holiday" required :options="['Saturday'=>'Saturday','Sunday'=>'Sunday','Monday'=>'Monday','Tuesday'=>'Tuesday','Wednesday'=>'Wednesday','Thursday'=>'Thursday','Friday'=>'Friday']" />
                                        </div>
                                    </div>
                                </td>
                                <td width="20%" style="border: none;">
                                    <x-primary-button id="submitBtn" class="btn-sm btn-danger submitBtn float-end re-generate" type="submit">Re-Generate</x-primary-button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-1 ps-lg-0" style="margin:0px auto;"></div>
    </div>
    <div class="row">
        <div class="col-lg-10 ps-lg-0" style="margin:0px auto;">
            <div class="card alert-primary alert-top-border" style="min-height: 400px;max-height: 400px;overflow-y: auto;">
                <div class="card-header" style="padding: 15px 16px;">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Display Employee Shift</h6>
                </div>
                <div class="card-body" style="overflow-y: auto;">
                    <div style="overflow-x: auto;">
                        <table class="table table-sm table-hover table-striped" style="width: 100%">
                            <thead class="table-light">
                                <tr>
                                    <th width="15%">Employee ID</th>
                                    <th width="25%">Name</th>
                                    <th width="25%">Date</th>
                                    <th width="25%">Joining Date</th>
                                    <th width="25%">Shift</th>
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
        $('#shift').select2({
            placeholder: "Shift",
            allowClear: true,
            width: '100%'
        });

        $('#to_shift').select2({
            placeholder: "To Shift",
            allowClear: true,
            width: '100%'
        });

        $(document).on('click', '.display', function(e) {
            e.preventDefault();
            let displayDate = $('#display_date').val();
            let form = 1;

            $.ajax({
                url: '{{ route('hris.tools.edit-shiftinglist.store') }}',
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
                    console.log(response);
                    if (response.success && response.data.length > 0) {
                        let row = ``;
                        response.data.forEach(emp => {
                            empId = emp.employee_id.toString().padStart(6, "0");
                            row += `
                                <tr id="row-${emp.id}">
                                    <td>${empId}</td>
                                    <td>${emp.employee_basic.name}</td>
                                    <td>${emp.date}</td>
                                    <td>${emp.employee_basic.joining_date}</td>
                                    <td><input type="text" name="shift" id="shift" data-id="${emp.id}" data-emp-id="${emp.employee_id}" class="form-control form-control-sm shift" value="${emp.shift}" /></td>
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


        // $(document).on('click', '.delete-Display', function(e) {
        //     let id = $(this).data('id');
        //     Swal.fire({
        //         title: 'Are you sure?',
        //         text: "You won't be able to revert this!",
        //         icon: 'warning',
        //         showCancelButton: true,
        //         confirmButtonColor: '#3085d6',
        //         cancelButtonColor: '#d33',
        //         confirmButtonText: 'Yes, delete it!'
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             $.ajax({
        //                 url: '{{ route('hris.tools.editexceptional-holidays.delete') }}',
        //                 type: 'POST',
        //                 data: {
        //                     id: id,
        //                     _token: '{{ csrf_token() }}'
        //                 },
        //                 success: function(response) {
        //                     if (response.success) {
        //                         Swal.fire(
        //                             'Deleted!',
        //                             'Holiday has been deleted.',
        //                             'success'
        //                         );
        //                         $('#row-' + id).remove();
        //                     } else {
        //                         Swal.fire(
        //                             'Error!',
        //                             'Holiday has not been deleted.',
        //                             'error'
        //                         );
        //                     }
        //                 }
        //             });
        //         }
        //     });
        // });

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
                url: '{{ route('hris.tools.edit-shiftinglist.store') }}',
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
                            empId = emp.employee_id.toString().padStart(6, "0");
                            row += `
                                <tr id="row-${emp.id}">
                                    <td>${empId}</td>
                                    <td>${emp.employee_basic.name}</td>
                                    <td>${emp.date}</td>
                                    <td>${emp.employee_basic.joining_date}</td>
                                    <td><input type="text" name="shift" id="shift" data-id="${emp.id}" data-emp-id="${emp.employee_id}" class="form-control form-control-sm shift" value="${emp.shift}" /></td>
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
            let shift = $('#shift').val();
            let to_shift = $('#to_shift').val();
            let form = 3;

            if(startDate == '' || endDate == '' || empId == '' || shift == ''){
                Swal.fire(
                    'Error!',
                    'Please fill all Employee ID, Start Date, End Date and Shift fields.',
                    'error'
                );
                return;
            }

            // if(to_shift == shift){
            //     Swal.fire(
            //         'Error!',
            //         'To Shift cannot be same as Shift.',
            //         'error'
            //     );
            //     return;
            // }

            if (shift !== '' && to_shift !== '' && holiday === '') {
                Swal.fire(
                    'Error!',
                    'If Shift and To Shift are filled, Holiday cannot be empty.',
                    'error'
                );
                return;
            }

            $.ajax({
                url: '{{ route('hris.tools.edit-shiftinglist.store') }}',
                type: 'POST',
                data: {
                    emp_id: empId,
                    start_date: startDate,
                    end_date: endDate,
                    holiday: holiday,
                    shift: shift,
                    to_shift: to_shift,
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

        $(document).on("blur", ".shift", function () {
            let shift = $(this).val();
            let id = $(this).data("id");
            let form = 1;

            $.ajax({
                url: "{{ url('hris/tools/edit-shiftinglist') }}/" + id,
                type: "PUT",
                data: {
                    shift: shift,
                    form: form,
                    _token: "{{ csrf_token() }}",

                },
                success: function (response) {
                    if(response.success){
                        toastr.success(response.message);
                    }else{
                        toastr.error(response.message);
                    }
                },
                error: function (xhr) {
                    toastr.error(xhr.responseJSON.message);
                }
            });
        });
    });
</script>
@endpush
