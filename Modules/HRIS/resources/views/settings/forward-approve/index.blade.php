@extends('layouts.app')
@section('title', 'HRIS')
@push('styles')
    <style>
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
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'HRIS',
                'subtitle' => 'Forwarded Approve',
                'breadcrumbs' => [
                    ['label' => 'HRIS', 'url' => route('hris.index')],
                    ['label' => 'Settings', 'url' => route('hris.index')],
                    ['label' => 'Forwarded Approve'],
                ],
            ])
        </div>
        <div class="col-lg-8 pe-lg-0">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header py-2 px-3" style="padding: 12px 10px !important">
                    <div class="row w-100 align-items-center" style="margin:0 !important">
                        <!-- Title -->
                        <div class="col-12 col-md-4 mb-2 mb-md-0">
                            <h6 class="my-0 text-primary"><i data-feather="user-plus" width="16" height="16"></i>Input Parameters For Forward & Approve</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <table class="table table-sm" style="width: 100%">
                                <tbody>
                                    <tr>
                                        <td colspan="2" style="width: 100%">
                                            <x-select-input name="org_id" id="org_id" class="select2" :options="$organizations" :selected="old('org_id', '1')" placeholder="Select" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="width: 100%">
                                            <x-select-input name="blood_group" id="blood_group" class="select2" :options="['1' => 'Leave', '2' => 'Movement Pass']" :selected="old('blood_group', '2')" placeholder="Select" />
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
                                            <label class="m-0" for="all_category">Users</label>
                                        </td>
                                        <td width="60%" id="all_category_section">
                                            <x-select-input name="user_id" id="user_id" class="select2" :options="['1' => 'User 1', '2' => 'User 2']" placeholder="User ID" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="40%">
                                            <label class="m-0" for="all_category">Forward/Approve</label>
                                        </td>
                                        <td width="60%" id="all_category_section">
                                            <x-select-input name="category_id" id="category_id" class="select2" :options="['1' => 'Forward', '2' => 'Approve']" placeholder="Category ID" />
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-8 pe-lg-0 ps-lg-0">
                            <div class="card padding-card">
                                <div class="card-body" style="min-height: 350px;max-height: 350px;overflow-y: auto">
                                    <table class="table table-sm table-striped table-hover" style="width: 100%">
                                    <thead style="position: sticky;top: -20px;background-color: #4f85bc !important" class="table-light">
                                        <tr>
                                            <th width="25%">EmployeeID</th>
                                            <th width="25%">Name</th>
                                            <th width="25%">Department</th>
                                            <th width="25%">Category</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="employee_id[]" id="employee_id" class="add_user">
                                                <label class="m-0" for="employee_id">001</label>
                                            </td>
                                            <td>John Doe</td>
                                            <td>Department 1</td>
                                            <td>Category 1</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="employee_id[]" id="employee_id" class="add_user">
                                                <label class="m-0" for="employee_id">002</label>
                                            </td>
                                            <td>John Doe</td>
                                            <td>Department 1</td>
                                            <td>Category 1</td>
                                        </tr>
                                    </tbody>
                                    </table>
                                </div>
                                <div class="card-footer" style="padding: 12px 20px !important">
                                    <div class="d-flex flex-wrap gap-2">
                                        <button type="button" class="btn btn-sm btn-outline-success" id="check_all_add">
                                            <i data-feather="check-square" width="14" height="14"></i> Check All
                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-primary" id="uncheck_all_add">
                                            <i data-feather="x-square" width="14" height="14"></i> Uncheck All
                                        </button>
                                        <x-primary-button type="button" id="add_user_button" class="btn btn-sm btn-primary float-end" disabled>Add User</x-primary-button>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card alert-info alert-top-border">
                <div class="card-header" style="padding: 12px 10px !important">
                    <h6 class="my-0 text-primary"> <i class="mdi mdi-list"></i> Input Parameters For Replace User ...</h6>
                </div>
                <div class="card-body">
                    <table class="table table-sm" style="width: 100%">
                        <thead>
                            <tr>
                                <th width="40%">
                                    <label class="m-0" for="existing_user">Existing User</label>
                                </th>
                                <td width="60%">
                                    <x-select-input name="existing_user" id="existing_user" class="select2" :options="['1' => 'Leave', '2' => 'Movement Pass']" :selected="old('existing_user', '2')" placeholder="Select" />
                                </td>
                            </tr>
                            <tr>
                                <th width="40%">
                                    <label class="m-0" for="replace_user">Replace User</label>
                                </th>
                                <td width="60%">
                                    <x-select-input name="replace_user" id="replace_user" class="select2" :options="['1' => 'Leave', '2' => 'Movement Pass']" :selected="old('replace_user', '2')" placeholder="Select" />
                                </td>
                            </tr>
                            <tr>
                                <td width="40%">
                                    <label class="m-0" for="all_category">Forward/Approve</label>
                                </td>
                                <td width="60%" id="all_category_section">
                                    <x-select-input name="category_id" id="category_idd" class="select2" :options="['1' => 'Forward', '2' => 'Approve']" placeholder="Category ID" />
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="width: 100%">
                                    <button type="button" class="btn btn-sm btn-primary float-end">Replace</button>
                                </td>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-6 pe-lg-0">
            <div class="card alert-success alert-top-border padding-card">
                <div class="card-header py-2 px-3" style="padding: 12px 10px !important">
                    <div class="row w-100 align-items-center justify-content-between" style="margin: 0 !important">
                        <!-- Title -->
                        <div class="col-12 col-md-auto mb-2 mb-md-0">
                            <h6 class="my-0 text-primary">
                                <i data-feather="user-plus" width="16" height="16"></i> Forwarded User List
                            </h6>
                        </div>

                        <!-- Button -->
                        <div class="col-12 col-md-auto text-md-end">
                            <x-select-input name="user_id" class="select2" :options="['1'=>'User 1', '2'=>'User 2']" placeholder="User ID" width="100%" />
                        </div>
                    </div>
                </div>
                <div class="card-body" style="max-height: 300px; overflow-y: auto;">
                    <div style="overflow-x: auto;">
                        <table class="table table-sm" style="width: 100%">
                            <thead>
                                <tr class="table-light">
                                    <th width="20%">EmployeeID</th>
                                    <th width="25%">Name</th>
                                    <th width="25%">Department</th>
                                    <th width="25%">Category</th>
                                    <th width="10%" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <input type="checkbox" name="employee_id[]" id="employee_id" class="form-check-input forward_user">
                                        <label class="m-0" for="employee_id">002</label>
                                    </td>
                                    <td>John Doe</td>
                                    <td>Department 1</td>
                                    <td>Category 1</td>
                                    <td class="text-center">
                                        <a href="#" class="btn btn-soft-danger waves-effect waves-light delete-forward-user" style="padding: 4px 6px;"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="checkbox" name="employee_id[]" id="employee_id" class="form-check-input forward_user">
                                        <label class="m-0" for="employee_id">003</label>
                                    </td>
                                    <td>John Doe</td>
                                    <td>Department 1</td>
                                    <td>Category 1</td>
                                    <td class="text-center">
                                        <a href="#" class="btn btn-soft-danger waves-effect waves-light delete-forward-user" style="padding: 4px 6px;"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer" style="padding: 12px 20px !important">
                    <div class="d-flex flex-wrap gap-2">
                        <button type="button" class="btn btn-sm btn-outline-success" id="check_all_forward">
                            <i data-feather="check-square" width="14" height="14"></i> Check All
                        </button>

                        <button type="button" class="btn btn-sm btn-outline-primary" id="uncheck_all_forward">
                            <i data-feather="x-square" width="14" height="14"></i> Uncheck All
                        </button>

                        <button type="button" class="btn btn-sm btn-outline-danger" id="delete_all_forward" disabled>
                            <i data-feather="trash-2" width="14" height="14"></i> Delete All
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card alert-danger alert-top-border padding-card">
                <div class="card-header py-2 px-3" style="padding: 12px 10px !important">
                    <div class="row w-100 align-items-center justify-content-between" style="margin: 0 !important">
                        <!-- Title -->
                        <div class="col-12 col-md-auto mb-2 mb-md-0">
                            <h6 class="my-0 text-primary">
                                <i data-feather="user-plus" width="16" height="16"></i> Approved User List
                            </h6>
                        </div>

                        <!-- Button -->
                        <div class="col-12 col-md-auto text-md-end">
                            <x-select-input name="user_id" class="select2" :options="['1'=>'User 1', '2'=>'User 2']" placeholder="User ID" width="100%" />
                        </div>
                    </div>
                </div>
                <div class="card-body" style="max-height: 300px; overflow-y: auto;">
                    <div style="overflow-x: auto;">
                        <table class="table table-sm" style="width: 100%">
                            <thead class="table-light">
                                <tr>
                                    <th width="20%">EmployeeID</th>
                                    <th width="25%">Name</th>
                                    <th width="25%">Department</th>
                                    <th width="20%">Category</th>
                                    <th width="10%" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <td>
                                    <input type="checkbox" name="employee_id[]" id="employee_id" class="form-check-input approved_user">
                                    <label class="m-0" for="employee_id">002</label>
                                </td>
                                <td>John Doe</td>
                                <td>Department 1</td>
                                <td>Category 1</td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-soft-danger waves-effect waves-light delete-forward-user" style="padding: 4px 6px;"><i class="fas fa-trash"></i></a>
                                </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="checkbox" name="employee_id[]" id="employee_id" class="form-check-input approved_user">
                                        <label class="m-0" for="employee_id">003</label>
                                    </td>
                                    <td>John Doe</td>
                                    <td>Department 1</td>
                                    <td>Category 1</td>
                                    <td class="text-center">
                                        <a href="#" class="btn btn-soft-danger waves-effect waves-light delete-forward-user" style="padding: 4px 6px;"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer" style="padding: 12px 20px !important">
                    <div class="d-flex flex-wrap gap-2">
                        <button type="button" class="btn btn-sm btn-outline-success" id="check_all_approved">
                            <i data-feather="check-square" width="14" height="14"></i> Check All
                        </button>

                        <button type="button" class="btn btn-sm btn-outline-primary" id="uncheck_all_approved">
                            <i data-feather="x-square" width="14" height="14"></i> Uncheck All
                        </button>

                        <button type="button" class="btn btn-sm btn-outline-danger" id="delete_all_approved" disabled>
                            <i data-feather="trash-2" width="14" height="14"></i> Delete All
                        </button>
                    </div>
                </div>
            </div>
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

            $('#check_all_approved').on('click', function () {
                $('.approved_user').prop('checked', true);
                $('#check_all_approved').prop('disabled', true);
                $('#uncheck_all_approved').prop('disabled', false);
                handleApprovedUser();
            });

            $('#uncheck_all_approved').on('click', function () {
                $('.approved_user').prop('checked', false);
                $('#check_all_approved').prop('disabled', false);
                $('#uncheck_all_approved').prop('disabled', true);
                handleApprovedUser();
            });

            $('#check_all_forward').on('click', function () {
                $('.forward_user').prop('checked', true);
                $('#check_all_forward').prop('disabled', true);
                $('#uncheck_all_forward').prop('disabled', false);
                handleForwardUser();
            });

            $('#uncheck_all_forward').on('click', function () {
                $('.forward_user').prop('checked', false);
                $('#check_all_forward').prop('disabled', false);
                $('#uncheck_all_forward').prop('disabled', true);
                handleForwardUser();
            });

            $('#check_all_add').on('click', function () {
                $('.add_user').prop('checked', true);
                $('#check_all_add').prop('disabled', true);
                $('#uncheck_all_add').prop('disabled', false);
                handleAddUser();
            });

            $('#uncheck_all_add').on('click', function () {
                $('.add_user').prop('checked', false);
                $('#check_all_add').prop('disabled', false);
                $('#uncheck_all_add').prop('disabled', true);
                handleAddUser();
            });

            function handleAddUser() {
                let checkedCount = $('.add_user:checked').length;
                if (checkedCount > 0) {
                    $('#add_user_button').prop('disabled', false);
                } else {
                    $('#add_user_button').prop('disabled', true);
                }
            }

            function handleForwardUser() {
                let checkedCount = $('.forward_user:checked').length;
                if (checkedCount > 0) {
                    $('#delete_all_forward').prop('disabled', false);
                } else {
                    $('#delete_all_forward').prop('disabled', true);
                }
            }

            function handleApprovedUser() {
                let checkedCount = $('.approved_user:checked').length;
                if (checkedCount > 0) {
                    $('#delete_all_approved').prop('disabled', false);
                } else {
                    $('#delete_all_approved').prop('disabled', true);
                }
            }

            $('.add_user').on('change', function () {
                handleAddUser();
            });

            $('.forward_user').on('change', function () {
                handleForwardUser();
            });

            $('.approved_user').on('change', function () {
                handleApprovedUser();
            });

            $('#add_user_button').on('click', function () {
                let checkedCount = $('.add_user:checked').length;
                if (checkedCount > 0) {

                }else{
                    Swal.fire(
                        'Error!',
                        'Please select at least one user.',
                        'error'
                    );
                }
            });
        });
    </script>
@endpush

