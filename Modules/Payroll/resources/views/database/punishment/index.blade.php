@extends('layouts.app')
@section('title', 'Payroll')
@section('content')
@push('styles')
<style>
    .table, tr, th, td {
        border: none !important;
        border-collapse: collapse;
    }
    input[type="checkbox"] {
        display: inline-block !important;
        opacity: 1 !important;
    }
    .disabled-select {
        cursor: not-allowed !important;
        background-color: #dad9d9 !important;
    }
    .form-check-input:checked:disabled {
        background-color: #b7bbf5 !important;
        border: 1px solid #b7bbf5 !important;
    }
</style>
@endpush
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'Payroll',
                'subtitle' => 'Punishment',
                'breadcrumbs' => [
                    ['label' => 'Payroll', 'url' => route('payroll.index')],
                    ['label' => 'Database', 'url' => route('payroll.index')],
                    ['label' => 'Punishment', 'url' => route('payroll.database.punishment.index')],
                ],
            ])
        </div>
        <div class="col-12 mb-3">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                <h4 class="text-center flex-grow-1 order-1 order-md-0 mb-2 mb-md-0">
                    Employee Punishment
                </h4>
            </div>
        </div>
        <div class="col-lg-7 pe-lg-0" style="margin:0px auto;">
            <div class="card alert-primary alert-top-border">
                <div class="card-header" style="padding: 15px 16px;">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Input Parameter For Punishment</h6>
                </div>
                <div class="card-body" style="overflow-y: auto;" id="parameterTableBody">
                    <div class="row">
                        <div class="col-md-4">
                            <table class="table table-sm" style="width: 100%">
                                <tbody>
                                    <tr>
                                        <td colspan="2">
                                            <x-select-input name="org_id" id="org_id" class="select2" :options="$organizations" :selected="old('org_id', '1')" placeholder="Select" />
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-4">
                            <table class="table table-sm" style="width: 100%">
                                <tbody>
                                    <tr>
                                        <td width="40%">
                                            <input type="checkbox" name="all_department" id="all_department">
                                            <label class="m-0" for="all_department">All Depart.</label>
                                        </td>
                                        <td width="60%" id="all_department_section">
                                            <x-select-input name="department_id" id="department_id" class="select2" :options="$departments" placeholder="Department ID" />
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-4">
                            <table class="table table-sm" style="width: 100%">
                                <tbody>
                                    <tr>
                                        <td width="40%">
                                            <input type="checkbox" name="all_category" id="all_category" checked>
                                            <label class="m-0" for="all_category">All Category</label>
                                        </td>
                                        <td width="60%" id="all_category_section">
                                            <x-select-input name="employee_category_id" id="employee_category_id" class="select2" :options="$categories" placeholder="Category ID" />
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-9 pe-lg-0" style="overflow-y: auto;min-height: 400px;max-height: 400px;">
                            <table class="table table-sm table-bordered table-striped" style="width: 100%">
                                <thead class="table-light" style="position: sticky; top: 0;">
                                    <tr>
                                        <th>EmployeeID</th>
                                        <th>Name</th>
                                        <th>Department</th>
                                        <th>Category</th>
                                    </tr>
                                </thead>
                                <tbody id="user_table_body">

                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-3 ps-lg-0" style="overflow-y: auto;min-height: 400px;max-height: 400px;">
                            <table class="table table-sm table-bordered table-striped" style="width: 100%">
                                <thead class="table-light" style="position: sticky; top: 0;">
                                    <tr>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($period as $date)
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="punishment_date[]" id="date" value="{{ date('Y-m-d', strtotime($date)) }}">
                                            <label class="m-0" for="date">{{ date('Y-m-d', strtotime($date)) }}</label>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card-footer" style="padding:15px 16px;">
                    <x-primary-button id="submitBtn" class="btn-sm submitBtn float-end" type="submit">Submit</x-primary-button>
                </div>
            </div>
        </div>

        <div class="col-lg-5" style="margin:0px auto;">
            <form action="{{ route('payroll.database.advance.store') }}" id="applicantForm" method="POST">
                @csrf
                <div class="card alert-primary alert-top-border">
                    <div class="card-header" style="padding: 15px 16px;">
                        <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Punishment List</h6>
                    </div>
                    <div class="card-body" style="overflow-y: auto;" id="punishmentTableBody">
                        <table id="punishmentTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>EmpID</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($punishments as $punishment)
                                    <tr id="row-{{ $punishment->id }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ str_pad($punishment->employee->employee_id, 6, '0', STR_PAD_LEFT) }}</td>
                                        <td>{{ $punishment->employee->name }}</td>
                                        <td>{{ $punishment->punishment_date }}</td>
                                        <td>
                                            <a href="#" class="btn btn-soft-danger waves-effect waves-light delete-punishment" data-id="{{ $punishment->id }}" style="padding: 4px 6px;"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{-- <div class="card-footer" style="padding:15px 16px;">
                        <x-primary-button id="submitBtn" class="btn-sm submitBtn float-end" type="submit">Submit</x-primary-button>
                    </div> --}}
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        let allCategory = $('#all_category').is(':checked');
        if(allCategory){
            $('#employee_category_id').prop('disabled', true);
            $('#all_category_section').addClass('disabled-select');
        }

        handleToggle('#all_category', '#employee_category_id', '#all_category_section');
        handleToggle('#all_line', '#line', '#all_line_section');

        $('#all_category').on('change', function () {
            handleToggle('#all_category', '#employee_category_id', '#all_category_section');
        });

        $('#all_department').on('change', function () {
            handleToggle('#all_department', '#department_id', '#all_department_section');
        });

        function handleToggle(checkboxSelector, selectSelector, sectionSelector) {
            const isChecked = $(checkboxSelector).is(':checked');

            $(selectSelector)
                .prop('disabled', isChecked)
                .val(null).trigger('change');

            $(selectSelector).toggleClass('disabled-select', isChecked);
            $(sectionSelector).toggleClass('disabled-select', isChecked);
        }

        //Fetch user
        $('#org_id,#department_id,#employee_category_id').on('change', function () {
            fetchUser();
        });

        function fetchUser() {
            let org_id = $('#org_id').val();
            let department_id = $('#department_id').val();
            let employee_category_id = $('#employee_category_id').val();

            let all_department = $('#all_department').is(':checked');
            let all_category = $('#all_category').is(':checked');

            if((all_department || (department_id !== null && department_id !== '')) && (all_category || (employee_category_id !== null && employee_category_id !== '')) && (org_id !== null && org_id !== '')){
                $.ajax({
                    url: "{{ route('payroll.database.punishment.employee.info') }}",
                    type: "POST",
                    data: {
                        org_id: org_id,
                        department_id: department_id,
                        employee_category_id: employee_category_id,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (response) {
                        $('#user_table_body').html('');
                        response.forEach(emp => {
                            $('#user_table_body').append(`
                                <tr>
                                    <td>
                                        <input type="radio" name="employee_id[]" id="employee_${emp.id}" class="add_user" value="${emp.employee_id}">
                                        <label class="m-0" for="employee_${emp.id}">${emp.employee_id.toString().padStart(6, '0')}</label>
                                    </td>
                                    <td>${emp.name ?? ''}</td>
                                    <td>${emp.department?.department ?? ''}</td>
                                    <td>${emp.designation?.category_code ?? ''}</td>
                                </tr>
                            `);
                        });
                    },
                    error: function (xhr, status, error) {
                        console.log(error);
                    }
                });
            }else{
                $('#user_table_body').html('');
            }
        };

        $('#submitBtn').on('click', function () {
            let punishmentDates = [];
            $('input[name="punishment_date[]"]:checked').each(function() {
                punishmentDates.push($(this).val());
            });
            let selectedEmployee = $('input[name="employee_id[]"]:checked').val();

            if (punishmentDates.length === 0 || !selectedEmployee) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Please select at least one punishment date and an employee',
                });
                return;
            }

            $.ajax({
                url: "{{ route('payroll.database.punishment.store') }}",
                type: "POST",
                data: {
                    punishment_date: punishmentDates,
                    employee_id: selectedEmployee,
                    _token: "{{ csrf_token() }}"
                },
                success: function (response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Punishment added successfully',
                        });
                        $('#parameterTableBody').load(location.href + ' #parameterTableBody');
                        $('#punishmentTableBody').load(location.href + ' #punishmentTableBody');
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Something went wrong',
                        });
                    }
                },
                error: function (xhr, status, error) {
                    console.log(error);
                }
            });
        });

        $(document).on('click', '.delete-punishment', function(e) {
            e.preventDefault();
            let punishmentId = $(this).data('id');
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
                        url: '{{ route('payroll.database.punishment.delete') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: punishmentId
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                'Punishment has been deleted.',
                                'success'
                            );
                            $('#row-' + punishmentId).remove();
                        },
                        error: function() {
                            Swal.fire(
                                'Error!',
                                'Something went wrong.',
                                'error'
                            );
                        }
                    });
                } else {
                    Swal.fire(
                        'Cancelled!',
                        'Punishment has not been deleted.',
                        'error'
                    );
                }
            });
        });
    });
</script>
@endpush

