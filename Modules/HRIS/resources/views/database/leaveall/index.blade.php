@extends('layouts.app')
@section('title', 'HRIS')
@push('styles')
    <style>
        input[type="checkbox"] {
            display: inline-block !important;
            opacity: 1 !important;
        }
        .collapse {
            display: none;
            margin-left: 40px;
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
        table tr td{
            border: none !important;
        }
    </style>
@endpush
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'HRIS',
                'subtitle' => 'Leave All',
                'breadcrumbs' => [
                    ['label' => 'HRIS', 'url' => route('hris.index')],
                    ['label' => 'Database', 'url' => route('hris.index')],
                    ['label' => 'Leave All', 'url' => route('hris.database.leave-all.index')],
                ],
            ])
        </div>
        <div class="col-12 mb-3">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                <h4 class="text-center flex-grow-1 order-1 order-md-0 mb-2 mb-md-0">
                   Leave All
                </h4>
            </div>
        </div>
        <div class="col-lg-5 ps-lg-1" style="margin:0px auto;">
            <div class="card alert-primary alert-top-border">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Please Read Before Leave Assign</h6>
                </div>
                <div class="card-body">
                    <p>1. EL cannot be assigned if 1 year not completed on start date.</p>
                    <p>2. ML or LWP cannot be assigned.</p>
                    <p>3. LeaveID starts with BLV instead of LV to distinguish from usual leave.</p>
                </div>
            </div>
        </div>

        <div class="col-lg-7 ps-lg-1" style="margin:0px auto;">
            <form action="{{ route('hris.database.leave-all.store') }}" id="applicantForm" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card alert-primary alert-top-border">
                    <div class="card-header">
                        <h6 class="my-0 text-primary d-flex align-items-center"><i data-feather="list" width="16" height="16" class="me-2"></i> Department</h6>
                    </div>
                    <div class="card-body" style="max-height:400px;min-height:400px; overflow-y: auto;">
                        <!-- Sample departments -->
                        <div class="row">
                            <div class="col-lg-6">
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
                            <div class="col-lg-6">
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <th style="width: 30%">Leave Type</th>
                                            <td style="width: 70%">
                                                <x-select-input name="leave_type_id" id="leave_type_id" class="select2" :options="$leave_types" required />
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
                                            <th style="width: 30%">Start Date</th>
                                            <td style="width: 70%">
                                                <x-text-input name="start_date" type="date" id="start_date" label="" class="form-control-sm" value="{{ date('Y-m-d', strtotime($date)) }}" placeholder="Start Date" required/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="width: 30%">End Date</th>
                                            <td style="width: 70%">
                                                <x-text-input name="end_date" type="date" id="end_date" label="" class="form-control-sm" value="{{ date('Y-m-d', strtotime($date)) }}" placeholder="End Date" required/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="width: 30%">Days</th>
                                            <td style="width: 70%">
                                                <x-text-input name="days" id="days" label="" class="form-control-sm" value="1" placeholder="Days" required readonly/>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer" style="padding:10px 15px;">
                        <button type="button" class="btn btn-sm btn-outline-primary" id="check_all">Check All</button>
                        <button type="button" class="btn btn-sm btn-outline-danger" id="uncheck_all">Uncheck All</button>
                        <x-primary-button id="submitBtn" class="btn-sm  submitBtn" type="submit">Assign</x-primary-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('.parent-checkbox.departmentID, .form-check-input.departmentID').prop('checked', true)
        $('.toggle-btn').on('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            const target = $('#' + $(this).data('target'));
            const isOpen = target.is(':visible');
            target.toggle();
            $(this).text(isOpen ? '[+]' : '[-]');
        });

        $('.parent-checkbox').on('change', function () {
            const id = $(this).data('id');
            $(`.child-of-${id}`).prop('checked', this.checked);
        });

        $('.form-check-input').on('change', function () {
            const classList = $(this).attr('class').split(/\s+/);
            const childClass = classList.find(cls => cls.startsWith('child-of-'));
            const parentId = childClass.split('-').pop();
            const children = $(`.child-of-${parentId}`);
            const parent = $(`.parent-checkbox[data-id="${parentId}"]`);
            const anyChecked = children.is(':checked');
            parent.prop('checked', anyChecked);
        });

        $('#check_all').on('click', function () {
            $('.parent-checkbox.departmentID, .form-check-input.departmentID').prop('checked', true);
        });

        $('#uncheck_all').on('click', function () {
            $('.parent-checkbox.departmentID, .form-check-input.departmentID').prop('checked', false);
        });
    });

    $(document).ready(function () {
        let startPicker, endPicker;

        endPicker = flatpickr("#end_date", {
            dateFormat: "Y-m-d",
            onChange: function (selectedDates, dateStr) {
                if (dateStr) {
                    startPicker.set('maxDate', dateStr);
                }
                updateDays();
            }
        });

        startPicker = flatpickr("#start_date", {
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
                $("#end_date").val("");
                $("#days").val("");
                return "";
            }

            let diffTime = endDate - startDate;
            let diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
            return diffDays;
        }

        function updateDays() {
            let start = $("#start_date").val();
            let end = $("#end_date").val();
            let days = calculateDays(start, end);

            if (days) {
                $("#days").val(days);
            }
        }

        $('#start_date,#end_date').trigger('change');
    });
</script>
@endpush
