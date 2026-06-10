@extends('layouts.app')
@section('title', 'Payroll')
@section('content')
@push('styles')
    <style>
        input[type="checkbox"] {
            display: inline-block !important;
            opacity: 1 !important;
        }

        .collapse {
            display: none;
            margin-left: 35px;
        }

        .toggle-btn {
            cursor: pointer;
            color: #5156be;
            margin-left: 5px;
        }
        .parent-label {
            font-weight: bold;
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
                'subtitle' => 'Overtime',
                'breadcrumbs' => [
                    ['label' => 'Payroll', 'url' => route('payroll.index')],
                    ['label' => 'Report', 'url' => route('payroll.index')],
                    ['label' => 'Overtime', 'url' => route('payroll.report.overtime-report.index')],
                ],
            ])
        </div>
        <div class="col-lg-12 pr-0">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Employee Overtime Report</h6>
                </div>
                <form id="employeeListingForm" action="{{ route('payroll.report.overtime-report.report.preview') }}" method="POST" target="_blank">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <!-- Titles -->
                            <div class="col-lg-3 mb-3 pe-lg-0">
                                <div class="card alert-info alert-top-border">
                                    <div class="card-header">
                                        <h6 class="my-0 text-primary"> <i data-feather="list" width="16"height="16"></i>Preview Title's</h6>
                                    </div>
                                    <div class="card-body" style="max-height:400px;min-height:400px; overflow-y: auto;">
                                        <div class="form-check">
                                            <input type="radio" id="title1" name="title" value="1"class="form-check-input titles" checked>
                                            <label class="form-check-label" for="title1">Department-wise Daily Basis Monthly Overtime</label>
                                        </div>
                                        <br>
                                        <div class="form-check">
                                            <input type="radio" id="title2" name="title" value="2"class="form-check-input titles">
                                            <label class="form-check-label" for="title2">Department-wise Daily Overtime</label>
                                        </div>
                                        <br>
                                        <div class="form-check">
                                            <input type="radio" id="title3" name="title" value="3"class="form-check-input titles">
                                            <label class="form-check-label" for="title3">Department-wise Monthly Total Overtime</label>
                                        </div>
                                       </br>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6 mb-3 pe-lg-0">
                                <div class="card alert-info alert-top-border">
                                    <div class="card-header">
                                        <h6 class="my-0 text-primary"> <i data-feather="list" width="16"height="16"></i> Department</h6>
                                    </div>
                                    <div class="card-body" style="max-height:350px;min-height:350px; overflow-y: auto;">
                                        <!-- Sample departments -->
                                        <div class="department-list">
                                            <!-- Parent 1 -->
                                            @foreach ($parentDepartments as $parentDepartment)
                                            <div class="parent-wrapper">
                                                <label class="parent-label">
                                                    <span class="toggle-btn" data-target="children-{{ $parentDepartment->id }}">[+]</span>
                                                    <input type="checkbox" class="parent-checkbox departmentID" data-id="{{ $parentDepartment->id }}" name="parent_department_id[]" value="{{ $parentDepartment->id }}"> {{ $parentDepartment->department }}
                                                </label>
                                                <div class="collapse" id="children-{{ $parentDepartment->id }}">
                                                    @foreach ($parentDepartment->departments as $department)
                                                    <label><input type="checkbox" class="form-check-input child-of-{{ $parentDepartment->id }} departmentID" name="department_id[]" value="{{ $department->id }}"> {{ $department->department }}</label><br>
                                                    @endforeach
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="card-footer" style="padding:10px 15px;">
                                        <button type="button" class="btn btn-sm btn-outline-primary" id="check_all">Check All</button>
                                        <button type="button" class="btn btn-sm btn-outline-danger" id="uncheck_all">Uncheck All</button>
                                    </div>
                                </div>

                            </div>

                            <div class="col-lg-3 col-md-6 mb-3 pe-lg-0">
                                <div class="card alert-info alert-top-border">
                                    <div class="card-header">
                                        <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Designation</h6>
                                    </div>
                                    <div class="card-body" style="max-height:350px;min-height:350px; overflow-y: auto;">
                                        @foreach ($designations as $designation)
                                            <div class="form-check">
                                                <input type="checkbox" name="designation_id[]" class="form-check-input designationID" id="desg{{ $designation['id'] }}" value="{{ $designation['id'] }}" checked>
                                                <label class="form-check-label" for="desg{{ $designation['id'] }}">{{ $designation['designation'] }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="card-footer" style="padding:10px 15px;">
                                        <button type="button" class="btn btn-sm btn-outline-primary" id="check_all2">Check All</button>
                                        <button type="button" class="btn btn-sm btn-outline-danger" id="uncheck_all2">Uncheck All</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Department & Designation -->
                            <div class="col-lg-3 mb-3 pe-lg-0">
                                <div class="card alert-info alert-top-border">
                                    <div class="card-body" style="max-height:410px;min-height:410px; overflow-y: auto;">
                                        <table class="table table-sm" width="100%">
                                            <tbody>
                                                <tr>
                                                    <th width="40%"> Employee ID</th>
                                                    <td width="60%">
                                                        <x-text-input name="employee_id" id="employee_id" label="" class="form-control-sm" placeholder="Employee ID" />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        <input type="checkbox" name="all_category" id="all_category" checked>
                                                        <label class="m-0" for="all_category">All Category</label>
                                                    </th>
                                                    <td id="all_category_section">
                                                        <x-select-input name="category_id" id="category_id" class="select2" :options="$employeeCategories" placeholder="Category ID" disabled />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        <input type="checkbox" name="all_line" id="all_line" checked>
                                                        <label class="m-0" for="all_line">All Line</label>
                                                    </th>
                                                    <td id="all_line_section">
                                                        <x-text-input name="line" id="line" label="" class="form-control-sm" placeholder="Line" disabled />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th width="40%">
                                                        <input type="checkbox" id="all_reason" checked>
                                                        <label class="m-0 font-bold" for="all_reason">All Reason</label>
                                                    </th>
                                                    <td width="60%" id="all_reason_section">
                                                        <x-select-input name="reason_id" id="reason_id" class="select2" :options="$employeeCategories" placeholder="Reason ID" />
                                                    </td>
                                                </tr>
                                                {{-- <tr>
                                                    <th>Start Date</th>
                                                    <td width="60%">
                                                        <x-text-input name="start_date" type="date" id="start_date" class="form-control-sm" value="{{ old('start_date', $startDate) }}" placeholder="Start Date" disabled />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th width="40%">End Date</th>
                                                    <td width="60%">
                                                        <x-text-input name="end_date" type="date" id="end_date" class="form-control-sm" value="{{ old('end_date', $endDate) }}" placeholder="End Date" disabled />
                                                    </td>
                                                </tr> --}}
                                                <tr>
                                                    <th>Month</th>
                                                    <td width="60%">
                                                        <x-select-input name="month" id="month" class="select2" :options="$months" selected="{{ old('month', date('m')) }}" placeholder="Month" />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Year</th>
                                                    <td width="60%" id="year_section">
                                                        <x-text-input name="year" type="text" id="year" class="form-control-sm" value="{{ date('Y') }}" placeholder="Year"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th width="40%">Organization</th>
                                                    <td width="60%">
                                                        <x-select-input name="organization_id" id="organization_id" class="select2" :options="$organizations" selected="{{ old('organization_id', 1) }}" placeholder="Organization" />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Date</th>
                                                    <td width="60%">
                                                        <x-text-input name="date" type="date" id="date" class="form-control-sm" value="{{ $startDate }}" placeholder="Date" disabled />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th width="40%">View Mode</th>
                                                    <td width="60%">
                                                        <x-select-input name="view_mode" id="view_mode" class="select2" :options="['1' => 'Normal View', '2' => 'PDF View']" selected="{{ old('view_mode', 2) }}" placeholder="View Mode" />
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="card-footer" style="padding:10px 15px;">
                                        <button type="submit" class="btn btn-sm btn-primary float-end">Preview</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
$(document).ready(function () {
    $('.parent-checkbox.departmentID, .form-check-input.departmentID').prop('checked', true);
    $('.designationID').prop('checked', true);

    $('.titles').prop('checked', false);
    $('#title1').prop('checked', true);

    // =========================
    // Toggle Section Button
    // =========================
    $('.toggle-btn').on('click', function (e) {
        e.preventDefault();
        e.stopPropagation();

        const target = $('#' + $(this).data('target'));
        const isOpen = target.is(':visible');

        target.toggle();
        $(this).text(isOpen ? '[+]' : '[-]');
    });

    // =========================
    // Parent → Child Checkbox
    // =========================
    $('.parent-checkbox').on('change', function () {
        const id = $(this).data('id');
        $(`.child-of-${id}`).prop('checked', this.checked);
    });

    // =========================
    // Child → Parent Checkbox (SAFE)
    // =========================
    $(document).on('change', '.form-check-input', function () {
        const classAttr = $(this).attr('class');
        if (!classAttr) return;

        const classList = classAttr.split(/\s+/);
        const childClass = classList.find(cls => cls.startsWith('child-of-'));

        if (!childClass) return;
        const parentId = childClass.split('-').pop();
        const children = $(`.child-of-${parentId}`);
        const parent = $(`.parent-checkbox[data-id="${parentId}"]`);

        parent.prop('checked', children.is(':checked'));
    });

    // =========================
    // Check / Uncheck All
    // =========================
    function toggleAll(selector, status) {
        $(selector).prop('checked', status);
    }

    $('#check_all').on('click', () => toggleAll('.parent-checkbox.departmentID, .form-check-input.departmentID', true));
    $('#uncheck_all').on('click', () => toggleAll('.parent-checkbox.departmentID, .form-check-input.departmentID', false));

    $('#check_all2').on('click', () => toggleAll('.designationID', true));
    $('#uncheck_all2').on('click', () => toggleAll('.designationID', false));

    // =========================
    // Toggle Handler (Reusable)
    // =========================
    function handleToggle(checkboxSelector, selectSelector, sectionSelector) {
        const isChecked = $(checkboxSelector).is(':checked');

        $(selectSelector)
            .prop('disabled', isChecked)
            .val(null).trigger('change');

        $(selectSelector).toggleClass('disabled-select', isChecked);
        $(sectionSelector).toggleClass('disabled-select', isChecked);
    }

    // =========================
    // Toggle Config
    // =========================
    const toggleConfigs = [
        ['#all_category', '#category_id', '#all_category_section'],
        ['#all_line', '#line', '#all_line_section'],
    ];

    toggleConfigs.forEach(([checkbox, select, section]) => {
        handleToggle(checkbox, select, section);

        $(checkbox).on('change', function () {
            handleToggle(checkbox, select, section);
        });
    });

    // =========================
    // Flatpickr Init
    // =========================
    const datePicker = flatpickr("#date", {
        dateFormat: "Y-m-d",
        altInput: true,
        altFormat: "d-m-Y",
        allowInput: true,
    });

    // =========================
    // Title Based Control
    // =========================
    handleTitleSelection();

    $('input[name="title"]').on('change', function () {
        handleTitleSelection();
    });

    function handleTitleSelection() {

        let selectedValue = $('input[name="title"]:checked').val();

        const $singleDate = $('#date');
        const $departments = $('.departmentID');
        const $designations = $('.designationID');
        const $month = $('#month');
        const $year = $('#year');

        // Reset All
        $departments.prop('disabled', false);
        $designations.prop('disabled', false);

        $singleDate.prop('disabled', false).prop('readonly', false).removeClass('disabled-select');

        // Enable Flatpickr
        enablePicker(datePicker);

        if (selectedValue == '1') {
            // Joining (Range)
            $month.prop('disabled', false);
            $year.prop('disabled', false);
            disableSingleDate();
        }
        else if (selectedValue == '2') {
            // Single Date
            $month.prop('disabled', true);
            $year.prop('disabled', true);

        }
        else if (selectedValue == '3') {
            $month.prop('disabled', false);
            $year.prop('disabled', false);

            disableSingleDate();
        }

        // =========================
        // Helper Functions
        // =========================
        function disableSingleDate() {
            disablePicker(datePicker, $singleDate);
        }

        function disablePicker(picker, $el) {
            $el.prop('disabled', true).prop('readonly', true).addClass('disabled-select');

            if (picker) {
                picker.set('clickOpens', false);
                $(picker.altInput).prop('disabled', true).addClass('disabled-select');
            }
        }

        function enablePicker(picker) {
            if (picker) {
                picker.set('clickOpens', true);
                $(picker.altInput).prop('disabled', false).removeClass('disabled-select');
            }
        }
    }
});
</script>
@endpush
