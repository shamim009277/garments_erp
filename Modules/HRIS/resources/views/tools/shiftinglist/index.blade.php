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
                'subtitle' => 'Shifting List',
                'breadcrumbs' => [
                    ['label' => 'HRIS', 'url' => route('hris.index')],
                    ['label' => 'Tools', 'url' => route('hris.index')],
                    ['label' => 'Shifting List', 'url' => route('hris.tools.shiftinglist.index')],
                ],
            ])
        </div>
        <div class="col-12 mb-3">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                <h4 class="text-center flex-grow-1 order-1 order-md-0 mb-2 mb-md-0">
                   Shifting List
                </h4>
            </div>
        </div>
        <div class="col-lg-6 col-md-8 ps-lg-1 ps-md-1" style="margin:0px auto;">
            <form action="{{ route('hris.tools.shiftinglist.store') }}" id="applicantForm" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card alert-primary alert-top-border">
                    <div class="card-header d-flex align-items-center justify-content-between p-2">
                        <h6 class="my-0 text-primary d-flex align-items-center"><i data-feather="list" width="16" height="16" class="me-2"></i> Department</h6>
                        <x-text-input name="year" class="form-control-sm w-auto ms-2" type="text" value="{{ date('Y') }}" required readonly />
                    </div>
                    <div class="card-body" style="max-height:400px;min-height:400px; overflow-y: auto;">
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
                        <x-primary-button id="submitBtn" class="btn-sm  submitBtn" type="submit">Generate</x-primary-button>
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











</script>

@endpush
