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
                        <h6 class="my-0 text-primary"> <i data-feather="list" width="18" height="18"></i> Employee
                            Bulk Increment</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4 pe-lg-0">
                                <table class="table table-sm" style="width: 100%">
                                    <tbody>
                                        <tr>
                                            <td colspan="2" style="width: 100%">
                                                <x-select-input name="org_id" id="org_id" class="select2"
                                                    :options="$organizations" :selected="selected_org($organizations)" placeholder="Select" required />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="40%">
                                                <input type="checkbox" name="all_department" id="all_department">
                                                <label class="m-0" for="all_department">All Department</label>
                                            </td>
                                            <td width="60%" id="all_department_section">
                                                <x-select-input name="department_id" id="department_id" class="select2"
                                                    :options="$departments" placeholder="Department ID" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="40%">
                                                <input type="checkbox" name="all_category" id="all_category" checked>
                                                <label class="m-0" for="all_category">All Category</label>
                                            </td>
                                            <td width="60%" id="all_category_section">
                                                <x-select-input name="employee_category_id" id="employee_category_id"
                                                    class="select2" :options="$employeeCategories" placeholder="Category ID" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="40%">
                                                <label class="m-0" for="joining_date_from">Joining Date From</label>
                                            </td>
                                            <td width="60%">
                                                <x-text-input type="date" name="joining_date_from" id="joining_date_from"
                                                    class="form-control form-control-sm" value="{{ $lastMonthStart }}"
                                                    placeholder="Joining Date From" required />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="40%">
                                                <label class="m-0" for="joining_date_to">Joining Date To</label>
                                            </td>
                                            <td width="60%" id="category_section">
                                                <x-text-input type="date" name="joining_date_to" id="joining_date_to"
                                                    class="form-control form-control-sm" value="{{ $lastMonthEnd }}"
                                                    placeholder="Joining Date To" required />
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
                                        <tbody id="tabledata"></tbody>
                                    </table>
                                </div>
                                <div class="btn-toolbar">
                                    &nbsp;&nbsp;<button type="button" class="btn btn-sm btn-success" id='check_all'>Check
                                        All</button> &nbsp;&nbsp;<button type="button" class="btn btn-sm btn-danger"
                                        id='uncheck_all'>Uncheck All</button>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <table class="table table-sm table-striped table-hover" style="width: 100%">
                                    <tr>
                                        <td width="40%">
                                            <label class="m-0" for="increment_type_id">Increment Type</label>
                                        </td>
                                        <td width="60%" id="category_section">
                                            <x-select-input name="increment_type_id" id="increment_type_id" class="select2" :options="$incrementTypes" :selected="old('increment_type_id', '1')" placeholder="Select" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="40%">
                                            <label class="m-0" for="increment_date">Increment Date</label>
                                        </td>
                                        <td width="60%" id="category_section">
                                            <x-text-input type="date" name="increment_date" id="increment_date"
                                                class="form-control form-control-sm" value="{{ $lastMonthStart }}"
                                                placeholder="Joining Date To" required />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="40%">
                                            <label class="m-0" for="effective_date">Effective Date</label>
                                        </td>
                                        <td width="60%" id="category_section">
                                            <x-text-input type="date" name="effective_date" id="effective_date"
                                                class="form-control form-control-sm" value="{{ $lastMonthStart }}"
                                                placeholder="Joining Date To" required />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="40%">
                                            <label class="m-0" for="arrear_upto_date">Arrear Upto Date</label>
                                        </td>
                                        <td width="60%" id="category_section">
                                            <x-text-input type="date" name="arrear_upto_date" id="arrear_upto_date"
                                                class="form-control form-control-sm" value=""
                                                placeholder="Arrear Upto Date" />
                                        </td>
                                    </tr>

                                    <tr>
                                        <td width="40%">
                                            <label class="m-0" for="increment_source">Increment Source</label>
                                        </td>
                                        <td width="60%" id="category_section">
                                            <x-select-input name="increment_source" id="increment_source" class="select2"
                                                :options="['B' => 'From Basic', 'G' => 'From Gross']" placeholder="Increment Source" required />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="40%">
                                            <label class="m-0" for="increment_value_type">Value Type</label>
                                        </td>
                                        <td width="60%" id="increment_value">
                                            <x-select-input name="increment_value_type" id="increment_value_type"
                                                class="select2" :options="['P' => 'Percentage', 'F' => 'Flat']" placeholder="Increment Value"
                                                required />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="40%">
                                            <label class="m-0" for="amount">Amount (P/F)</label>
                                        </td>
                                        <td width="60%" id="category_section">
                                            <input type="number" name="amount" id="amount" step="any"
                                                min="0" class="form-control form-control-sm"
                                                placeholder="Flat/Percentage Amount" required />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="40%">
                                            <label class="m-0" for="house_rent_basic">HR % Basic</label>
                                        </td>
                                        <td width="60%" id="category_section">
                                            <input type="text" name="house_rent_basic" id="house_rent_basic"
                                                class="form-control form-control-sm"
                                                value="{{ (int) $hroption->house_rant_percent_basic }}"
                                                placeholder="House Rant % Basic" required readonly />
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
                        <button type="submit" id="submitBtn" class="btn btn-sm btn-danger float-end add_user_button"
                            style="margin-right: 10px;" disabled> <i data-feather="log-out" width="14"
                                height="14"></i> Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            let allCategory = $('#all_category').is(':checked');
            if (allCategory) {
                $('#employee_category_id').prop('disabled', true);
                $('#all_category_section').addClass('disabled-select');
            }
            handleToggle('#all_category', '#employee_category_id', '#all_category_section');

            $('#all_category').on('change', function() {
                handleToggle('#all_category', '#employee_category_id', '#all_category_section');
            });

            $('#all_department').on('change', function() {
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


            $('#check_all').on('click', function() {
                let checkboxes = $('.add_user');

                if (checkboxes.length > 0) {
                    checkboxes.prop('checked', true);
                    $('#check_all').prop('disabled', true);
                    $('#uncheck_all').prop('disabled', false);
                    handleAddUser();
                } else {
                    toastr.error('No found to check all');
                }
            });

            $('#uncheck_all').on('click', function() {
                let checkboxes = $('.add_user');

                if (checkboxes.length > 0) {
                    checkboxes.prop('checked', false);
                    $('#check_all').prop('disabled', false);
                    $('#uncheck_all').prop('disabled', true);
                    handleAddUser();
                } else {
                    toastr.error('No found to uncheck all');
                }
            });

            $(document).on('change', '.add_user', function() {
                handleAddUser();
            });

            function handleAddUser() {
                let checkedCount = $('.add_user:checked').length;
                if (checkedCount > 0) {
                    $('.add_user_button').prop('disabled', false);
                } else {
                    $('.add_user_button').prop('disabled', true);
                }
            }

            //Fetch user
            $('#org_id,#department_id,#employee_category_id,#category_id').on('change', function() {
                fetchDesignation();
            });

            function fetchDesignation() {
                let org_id = $('#org_id').val();
                let category_id = $('#category_id').val();
                let department_id = $('#department_id').val();
                let employee_category_id = $('#employee_category_id').val();

                let all_department = $('#all_department').is(':checked');
                let all_category = $('#all_category').is(':checked');

                if ((all_department || (department_id !== null && department_id !== '')) && (all_category || (
                        employee_category_id !== null && employee_category_id !== '')) && (org_id !== null &&
                        org_id !== '') && (category_id !== null && category_id !== '')) {
                    $.ajax({
                        url: "{{ route('hris.database.fetch-designation') }}",
                        type: "POST",
                        data: {
                            org_id: org_id,
                            category_id: category_id,
                            department_id: department_id,
                            employee_category_id: employee_category_id,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            $('#tabledata').html('');
                            response.forEach(designation => {
                                $('#tabledata').append(`
                                <tr>
                                    <td>
                                        <input type="checkbox" name="designation_id[]" id="designation_${designation.designation.id}" class="add_user" value="${designation.designation.id}">
                                        <label class="m-0" for="designation_${designation.designation.id}">${designation.designation.designation}</label>
                                    </td>
                                </tr>
                            `);
                            });
                        },
                        error: function(xhr, status, error) {
                            toastr.error(error);
                        }
                    });
                } else {
                    toastr.error('Please select all necessary parameters');
                    $('#tabledata').html('');
                }
            };
        });
    </script>
@endpush
