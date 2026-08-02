@extends('layouts.app')
@section('title', 'IPE')
@push('styles')
    <style>
        .select2-selection {
            height: 35px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            height: 32px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 32px !important;
        }

        .employee-active {
            background-color: #4549A2;
            color: #FFFFFF;
        }

        .employee-active:hover {
            color: #000000;
        }
    </style>
@endpush
@php
    $disabled = $unique_applicant && $unique_applicant->is_done == 1 ? 'disabled' : '';
@endphp
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'IPE',
                'subtitle' => 'Assessment',
                'breadcrumbs' => [
                    ['label' => 'IPE', 'url' => route('ipe.index')],
                    ['label' => 'Database', 'url' => route('ipe.index')],
                    ['label' => 'Assessment', 'url' => route('ipe.database.assessments.index')],
                ],
            ])
        </div>
        <div class="col-12 mb-3">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                <!-- Centered Title -->
                <h4 class="text-center flex-grow-1 order-1 order-md-0 mb-2 mb-md-0">
                    {{ $unique_applicant ? "Assessment || Assessment ID : $unique_applicant->id" : 'Assessment' }}
                </h4>

                <!-- Search Input + Button in One Line -->
                <form action="{{ route('ipe.database.assessments.search') }}" method="POST"
                    class="d-flex order-0 order-md-1 mb-2 mb-md-0 me-md-2" style="max-width: 400px;" role="search">
                    @csrf
                    <input class="form-control form-control-sm me-2" type="search" name="search"
                        placeholder="Applicant Card No ..." aria-label="Search">
                    <button class="btn btn-sm btn-primary d-flex align-items-center" type="submit"><i data-feather="search"
                            width="14" height="14" class="me-1"></i> Search</button>
                </form>
                @if ($unique_applicant)
                    <!-- Back Button -->
                    <a href="{{ route('ipe.database.assessments.index') }}"
                        class="btn btn-sm btn-info d-flex align-items-center order-2 order-md-2"><i
                            data-feather="arrow-left" width="14" height="14" class="me-1"></i> Back </a>
                @endif
            </div>
        </div>
        <div class="col-lg-3 pe-lg-0">
            <x-ipe::database.assessment title="Running Assessment List" :pending-applicants="$pending_applicants" :unique-applicant="$unique_applicant" />
        </div>

        <div class="col-lg-9">
            <div class="card alert-info alert-top-border">
                <div class="card-header d-flex justify-content-between align-items-center flex-wrap px-10 py-12"
                    style="padding: 16px 20px">
                    <h6 class="my-0 text-primary d-flex align-items-center gap-1"><i data-feather="list" width="18"
                            height="18"></i>
                        {!! $unique_applicant
                            ? 'New Assessment For: ' . $unique_applicant->designation->designation
                            : 'Input Parameters For New Applicant ...' !!}
                        <a href="#"
                            class="btn btn-soft-success btn-xs waves-effect waves-light {{ $unique_applicant->is_done ? 'disabled' : '' }}"
                            style="padding: 4px 6px; {{ $unique_applicant->is_done ? 'pointer-events: none; opacity: 0.5;' : '' }}"
                            data-bs-toggle="modal" data-bs-target="#editModal{{ $unique_applicant->id }}">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="#"
                            class="btn btn-soft-info btn-xs waves-effect waves-light {{ $unique_applicant->is_done ? '' : 'disabled' }}"
                            style="padding: 4px 6px; {{ $unique_applicant->is_done ? '' : 'pointer-events: none; opacity: 0.5;' }}"
                            data-bs-toggle="modal" data-bs-target="#statusModal{{ $unique_applicant->id }}">
                            <i class="fas fa-rocket"></i> Status
                        </a>
                    </h6>

                    <div class="d-flex gap-2 mt-2 mt-md-0">
                        @if ($unique_applicant)
                            <a href="{{ route('ipe.database.assessments.pdf', $unique_applicant->id) }}" target="_blank"
                                class="btn btn-primary btn-sm d-flex align-items-center {{ $unique_applicant->is_done ? '' : 'disabled' }}"><i
                                    data-feather="file-text" width="16" height="16" class="me-1"></i> PDF</a>
                            <a href="javascript:void(0);" data-id="{{ $unique_applicant->id }}"
                                class="btn btn-danger btn-sm d-flex align-items-center delete-assessment"><i
                                    data-feather="trash-2" width="16" height="16" class="me-1"></i> Delete</a>

                            <a href="javascript:void(0);" data-id="{{ $unique_applicant->id }}"
                                data-status="{{ $unique_applicant->is_done }}"
                                class="btn btn-sm d-flex align-items-center toggle-assessment text-white {{ $unique_applicant->is_done ? 'btn-danger' : 'btn-primary' }}">
                                <i data-feather="{{ $unique_applicant->is_done ? 'corner-up-left' : 'key' }}"
                                    width="16" height="16" class="me-1"></i>
                                {{ $unique_applicant->is_done ? 'Revert' : 'Complete' }}
                            </a>
                        @else
                            <a href="javascript:void(0);" id="resetForm"
                                class="btn btn-secondary btn-sm d-flex align-items-center">
                                <i data-feather="rotate-ccw" width="16" height="16" class="me-1"></i> Reset
                            </a>
                        @endif
                    </div>
                </div>

                <div id="editModal{{ $unique_applicant->id }}" class="modal fade" tabindex="-1"
                    aria-labelledby="myModalLabel" aria-hidden="true" data-bs-scroll="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h6 class="modal-title" id="myModalLabel">Edit Assessment</h6>
                                <button type="button" class="btn-close btn btn-sm" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <form id="editForm{{ $unique_applicant->id }}"
                                action="{{ route('ipe.database.assessments.update', $unique_applicant->id) }}"
                                method="POST">
                                <div class="modal-body">
                                    @csrf
                                    @method('PUT')
                                    <x-select-search-input name="degree_id" label="Degree" :options="$degrees"
                                        :selected="old(
                                            'degree_id',
                                            $unique_applicant ? $unique_applicant->degree_id : null,
                                        )" required />

                                    <x-input-group name="exp_year" label="Experience Year" type="text"
                                        pattern="[0-9]" placeholder="Enter experience year" :value="old(
                                            'exp_year',
                                            $unique_applicant ? $unique_applicant->exp_year : null,
                                        )" />


                                    <x-input-group name="exp_month" label="Experience Month" type="text"
                                        pattern="[0-9]" placeholder="Enter experience month" :value="old(
                                            'exp_month',
                                            $unique_applicant ? $unique_applicant->exp_month : null,
                                        )" />

                                    <x-select-input-group name="is_active" label="Is Active" :options="['1' => 'Active', '0' => 'Inactive']"
                                        :selected="$unique_applicant->is_active" required />
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary waves-effect btn-sm"
                                        data-bs-dismiss="modal">Close</button>
                                    <x-primary-button id="submitBtn" class="float-start btn-sm submitBtn">Save
                                        changes</x-primary-button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div id="statusModal{{ $unique_applicant->id }}" class="modal fade" tabindex="-1"
                    aria-labelledby="myModalLabel" aria-hidden="true" data-bs-scroll="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h6 class="modal-title" id="myModalLabel">Update Applicant Status</h6>
                                <button type="button" class="btn-close btn btn-sm" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <form id="editForm{{ $unique_applicant->id }}"
                                action="{{ route('ipe.database.assessments.update', $unique_applicant->id) }}"
                                method="POST">
                                <div class="modal-body">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="status">
                                    <x-select-search-input name="final_designation_id" id="final_designation_id"
                                        label="Final Designation" :options="$designations" :selected="old(
                                            'final_designation_id',
                                            $unique_applicant ? $unique_applicant->designation_id : null,
                                        )" required />

                                    <x-select-input-group name="interview_status" id="interview_status"
                                        label="Interview Status" :options="[
                                            'Pending' => 'Pending',
                                            'Selected' => 'Selected',
                                            'Disqualify' => 'Disqualify',
                                            'Not Recruit' => 'Not Recruit',
                                        ]" :selected="old(
                                            'interview_status',
                                            $unique_applicant?->applicant?->interview_status ?? 'Pending',
                                        )" />

                                    <x-input-group name="determined_salary"
                                        label="Determined Salary (Grade: {{ $assessment->designation->grade ?? 'N/A' }})"
                                        id="determined_salary" type="number" pattern="[0-9]{10,30}"
                                        placeholder="Enter determined salary" :value="old(
                                            'determined_salary',
                                            $unique_applicant ? $unique_applicant->applicant->determined_salary : null,
                                        )" />

                                    <x-input-group name="joining_date" label="Joining Date" id="joining_date"
                                        class="holiday-date" type="date" placeholder="Enter joining date"
                                        :value="old(
                                            'joining_date',
                                            $unique_applicant && $unique_applicant->applicant->joining_date
                                                ? \Carbon\Carbon::parse(
                                                    $unique_applicant->applicant->joining_date,
                                                )->format('Y-m-d')
                                                : now()->format('Y-m-d'),
                                        )" />

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary waves-effect btn-sm"
                                        data-bs-dismiss="modal">Close</button>
                                    <x-primary-button id="submitBtn" class="float-start btn-sm submitBtn"
                                        :disabled="!$disabled">Save changes</x-primary-button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- General Section --}}
                <x-ipe::question :title="'General Questions'" :helperQuestions="$helper_questions" :uniqueApplicant="$unique_applicant" :perMark="3" :disabled="$disabled" />

                <x-ipe::question2 :title="'Practical Questions'" :helperQuestions="$quality_questions" :uniqueApplicant="$unique_applicant" :perMark="7" :disabled="$disabled" />
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).on('click', '.employee-show', function(e) {
            e.preventDefault();
            $('.employee-show').removeClass('employee-active');
            $(this).addClass('employee-active');

            let orgId = $(this).data('org_id');

            $('#applicant_id').val($(this).data('id'));
            $('#name').val($(this).data('name'));
            $('#name_bangla').val($(this).data('name_bn'));

            $('#entry_date').val($(this).data('entry_date'));
            $('#mobile').val($(this).data('mobile'));
            $('#line').val($(this).data('line'));
            $('#org_id').val(orgId).change();
            $('#designation_id').val($(this).data('designation_id')).change();
        });

        document.addEventListener('change', function(e) {
            if (e.target.classList.contains('question-select')) {
                let row = e.target.dataset.row;
                let questionId = e.target.value;
                let map = JSON.parse(document.getElementById('map_' + row).value);
                let answer = map[questionId] ?? '';
                let answerSelect = document.getElementById('answer_' + row);

                if (answerSelect) {
                    answerSelect.value = answer;
                    answerSelect.dispatchEvent(new Event('change'));
                }
            }
        });

        document.addEventListener('change', function(e) {
            if (e.target.classList.contains('question-select2')) {
                let row = e.target.dataset.row;
                let questionId = e.target.value;
                let map = JSON.parse(document.getElementById('map2_' + row).value);
                let answer = map[questionId] ?? '';
                let answerSelect = document.getElementById('answer2_' + row);

                if (answerSelect) {
                    answerSelect.value = answer;
                    answerSelect.dispatchEvent(new Event('change'));
                }
            }
        });

        $('#basicQuestion').on('submit', function(e) {
            e.preventDefault();

            let isValid = true;
            $('.answer-select').removeClass('is-invalid');

            // validation
            $('.answer-select').each(function() {
                if (!$(this).val()) {
                    isValid = false;
                    $(this).addClass('is-invalid');
                }
            });

            if (!isValid) {
                toastr.error('সবগুলো Answer select করা বাধ্যতামূলক');
                return;
            }

            let formData = $(this).serialize();

            $.ajax({
                url: "{{ route('ipe.database.assessment.question.store') }}",
                type: "POST",
                data: formData,

                beforeSend: function() {
                    $('#saveBtn').prop('disabled', true);

                    $('#saveBtn').html(`
                        <span class="spinner-border spinner-border-sm me-1"></span>
                        Saving...
                    `);
                },

                success: function(res) {
                    toastr.success(res.message || 'Data saved successfully');
                    $('#basicQuestionWrapper').load(location.href + ' #basicQuestionWrapper');
                },

                error: function(xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            toastr.error(value[0]);
                        });
                    } else {
                        toastr.error('Something went wrong');
                    }
                },
                complete: function() {
                    $('#saveBtn').prop('disabled', false);
                    $('#saveBtn').html('Save Data');
                }
            });
        });

        $('#practicalQuestion').on('submit', function(e) {
            e.preventDefault();

            let isValid = true;
            $('.answer-select2').removeClass('is-invalid');

            // validation
            $('.answer-select2').each(function() {
                if (!$(this).val()) {
                    isValid = false;
                    $(this).addClass('is-invalid');
                }
            });

            if (!isValid) {
                toastr.error('সবগুলো Answer select করা বাধ্যতামূলক');
                return;
            }

            let formData = $(this).serialize();

            $.ajax({
                url: "{{ route('ipe.database.assessment.qualityquestion.store') }}",
                type: "POST",
                data: formData,

                beforeSend: function() {
                    $('#saveBtn').prop('disabled', true);

                    $('#saveBtn').html(`
                        <span class="spinner-border spinner-border-sm me-1"></span>
                        Saving...
                    `);
                },

                success: function(res) {
                    toastr.success(res.message || 'Data saved successfully');
                    $('#practicalQuestionWrapper').load(location.href + ' #practicalQuestionWrapper');
                },

                error: function(xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            toastr.error(value[0]);
                        });
                    } else {
                        toastr.error('Something went wrong');
                    }
                },
                complete: function() {
                    $('#saveBtn').prop('disabled', false);
                    $('#saveBtn').html('Save Data');
                }
            });
        });

        $(document).on('click', '.toggle-assessment', function(e) {
            e.preventDefault();
            let processId = $(this).data('id');
            let status = $(this).data('status');

            const swalConfig = {
                0: {
                    title: 'Complete this assessment?',
                    text: "Once completed, you won't be able to modify this assessment.",
                    icon: 'warning',
                    confirmButtonText: 'Yes, complete it!'
                },

                1: {
                    title: 'Revert this assessment?',
                    text: 'This assessment will be reverted to pending and can be edited again.',
                    icon: 'question',
                    confirmButtonText: 'Yes, revert it!'
                }
            };
            const config = swalConfig[status];

            Swal.fire({
                title: config.title,
                text: config.text,
                icon: config.icon,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: config.confirmButtonText
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('ipe.database.assessments.complete') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: processId
                        },
                        success: function(response) {
                            console.log(response);
                            Swal.fire(
                                'Completed!',
                                'Assessment has been completed.',
                                'success'
                            );
                            window.location.reload();
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
                        'Process has not been deleted.',
                        'error'
                    );
                }
            });
        });

        $(document).on('click', '.delete-assessment', function(e) {
            e.preventDefault();
            let processId = $(this).data('id');
            Swal.fire({
                title: 'Delete this assessment ?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('ipe.database.assessment.delete') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: processId
                        },
                        success: function(response) {
                            if (!response.success) {
                                Swal.fire(
                                    'Error!',
                                    response.message,
                                    'error'
                                );
                                return;
                            }
                            Swal.fire(
                                'Deleted!',
                                'Assessment has been deleted.',
                                'success'
                            );
                            window.location.href =
                                "{{ route('ipe.database.assessments.index') }}";
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
                        'Process has not been deleted.',
                        'error'
                    );
                }
            });
        });
    </script>
@endpush
