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
        <div class="col-lg-6 col-md-8" style="margin:0px auto;">
            <form action="{{ route('hris.tools.shiftinglist.store') }}" id="applicantForm" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card alert-primary alert-top-border">
                    <div class="card-header d-flex align-items-center justify-content-between px-4 py-3">
                        <h6 class="my-0 text-primary d-flex align-items-center"><i data-feather="list" width="16" height="16" class="me-2"></i> Department</h6>

                    </div>
                    <div class="card-body" style="max-height:400px;min-height:400px; overflow-y: auto;">
                        <!-- Sample departments -->
                        <div class="row">
                            <div class="col-md-6">
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
                            <div class="col-md-6">
                                <table class="table table-sm" style="width: 100%">
                                    <tbody>
                                        <tr>
                                            <td width="40%">
                                                <input type="checkbox" name="all_organization" id="all_organization">
                                                <label class="m-0" for="all_organization">All Org</label>
                                            </td>
                                            <td width="60%" id="all_organization_section">
                                                <x-select-input name="organization_id" id="organization_id" class="select2" :options="$organizations" :selected="selected_org($organizations)" placeholder="Select Organization" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="40%">
                                                <label class="m-0" for="year">Year</label>
                                            </td>
                                            <td width="60%">
                                                <x-text-input name="year" class="form-control-sm" type="text" value="{{ date('Y') }}" required readonly />
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" id="progress-container" style="display:none;">
                        <div class="progress" style="height: 20px;">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: 0%;" id="progress-bar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                        </div>
                        <div class="text-center mt-1"><small id="progress-text">Initializing...</small></div>
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
        let allOrganization = $('#all_organization').is(':checked');
        if(allOrganization){
            $('#organization_id').prop('disabled', true);
            $('#all_organization_section').addClass('disabled-select');
        }
        handleToggle('#all_organization', '#organization_id', '#all_organization_section');

        $('#all_organization').on('change', function () {
            handleToggle('#all_organization', '#organization_id', '#all_organization_section');
        });

        function handleToggle(checkboxSelector, selectSelector, sectionSelector) {
            const isChecked = $(checkboxSelector).is(':checked');
            $(selectSelector)
                .prop('disabled', isChecked)
                .val(null).trigger('change');

            $(selectSelector).toggleClass('disabled-select', isChecked);
            $(sectionSelector).toggleClass('disabled-select', isChecked);
        }
        $('#organization_id').val(1).trigger('change');


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

        $('#applicantForm').on('submit', function (e) {
            e.preventDefault();
            e.stopPropagation();
            let formData = new FormData(this);
            let submitBtn = $('#submitBtn');
            
            submitBtn.prop('disabled', true);
            $('#progress-container').show();
            $('#progress-bar').css('width', '0%').attr('aria-valuenow', 0).text('0%');
            $('#progress-text').text('Starting...');

            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.success) {
                        toastr.success(response.message);
                        pollJobStatus(response.job_status_id);
                    } else {
                        toastr.error(response.message);
                        submitBtn.prop('disabled', false);
                        $('#progress-container').hide();
                    }
                },
                error: function (xhr) {
                    let errorMessage = 'An error occurred';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }
                    toastr.error(errorMessage);
                    submitBtn.prop('disabled', false);
                    $('#progress-container').hide();
                }
            });
        });

        function pollJobStatus(jobId) {
            let interval = setInterval(function () {
                $.ajax({
                    url: "{{ url('hris/tools/shiftinglist/status') }}/" + jobId,
                    type: 'GET',
                    success: function (response) {
                        if (response.success) {
                            let percentage = response.progress;
                            $('#progress-bar').css('width', percentage + '%').attr('aria-valuenow', percentage).text(percentage + '%');
                            $('#progress-text').text(response.message);

                            if (response.status === 'completed') {
                                clearInterval(interval);
                                toastr.success('Shifting list generated successfully!');
                                $('#submitBtn').prop('disabled', false);
                                setTimeout(function() {
                                    $('#progress-container').hide();
                                    $('#progress-bar').css('width', '0%').text('0%');
                                }, 3000);
                            } else if (response.status === 'failed') {
                                clearInterval(interval);
                                toastr.error('Job failed: ' + response.message);
                                $('#submitBtn').prop('disabled', false);
                            }
                        }
                    },
                    error: function () {
                        clearInterval(interval);
                        toastr.error('Error checking job status');
                        $('#submitBtn').prop('disabled', false);
                    }
                });
            }, 2000); // Poll every 2 seconds
        }
    });
</script>
@endpush
