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
    $disabled = ($unique_applicant && $unique_applicant->is_done == 1) ? 'disabled' : '';
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
                    <input class="form-control form-control-sm me-2" type="search" name="search" placeholder="Applicant Card No ..." aria-label="Search">
                    <button class="btn btn-sm btn-primary d-flex align-items-center" type="submit"><i data-feather="search" width="14" height="14" class="me-1"></i> Search</button>
                </form>
                @if ($unique_applicant)
                    <!-- Back Button -->
                    <a href="{{ route('ipe.database.assessments.index') }}" class="btn btn-sm btn-info d-flex align-items-center order-2 order-md-2"><i data-feather="arrow-left" width="14" height="14" class="me-1"></i> Back </a>
                @endif
            </div>
        </div>
        <div class="col-lg-3 pe-lg-0">
            <x-ipe::database.assessment title="Running Assessment List" :pending-applicants="$pending_applicants" :unique-applicant="$unique_applicant" />
        </div>

        <div class="col-lg-9">
            <div class="card alert-info alert-top-border">
                <div class="card-header d-flex justify-content-between align-items-center flex-wrap px-10 py-12" style="padding: 16px 20px">
                    <h6 class="my-0 text-primary d-flex align-items-center gap-1"><i data-feather="list" width="18" height="18"></i>
                        {!! $unique_applicant ? 'New Assessment For: ' . $unique_applicant->designation->designation : 'Input Parameters For New Applicant ...' !!}
                        <a href="#" class="btn btn-soft-success btn-xs waves-effect waves-light {{ $unique_applicant->is_done ? 'disabled' : '' }}"
                            style="padding: 4px 6px; {{ $unique_applicant->is_done ? 'pointer-events: none; opacity: 0.5;' : '' }}"
                            data-bs-toggle="modal" data-bs-target="#editModal{{ $unique_applicant->id }}">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                    </h6>

                    <div class="d-flex gap-2 mt-2 mt-md-0">
                        @if ($unique_applicant)
                            <a href="{{ route('ipe.database.assessments.pdf', $unique_applicant->id) }}" target="_blank" class="btn btn-primary btn-sm d-flex align-items-center"><i data-feather="file-text" width="16" height="16" class="me-1"></i> PDF</a>
                            <a href="javascript:void(0);" data-id="{{ $unique_applicant->id }}" class="btn btn-danger btn-sm d-flex align-items-center delete-assessment"><i data-feather="trash-2" width="16" height="16" class="me-1"></i> Delete</a>

                            <a href="javascript:void(0);" data-id="{{ $unique_applicant->id }}" data-status="{{ $unique_applicant->is_done }}"
                                class="btn btn-sm d-flex align-items-center toggle-assessment text-white {{ $unique_applicant->is_done ? 'btn-danger' : 'btn-primary' }}">
                                    <i data-feather="{{ $unique_applicant->is_done ? 'corner-up-left' : 'key' }}" width="16" height="16" class="me-1"></i>
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

                                    <x-input-group name="exp_year" label="Experience Year" type="text" pattern="[0-9]"
                                        placeholder="Enter experience year" :value="old(
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
                                    <x-primary-button id="submitBtn" class="float-start btn-sm submitBtn"
                                        :disabled="$disabled">Save changes</x-primary-button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- General Section --}}
                <div class="card-body" style="min-height: 400px; overflow-y: auto;">
                    <form id="basicQuestion">
                        @csrf
                        <input type="hidden" name="assessment_id" value="{{ $unique_applicant->id }}">

                        <div class="card" style="padding:0px !importent;" id="basicQuestionWrapper">
                            <div class="card-header bg-primary d-flex justify-content-between align-items-center flex-wrap"
                                style="padding: 10px 10px">
                                <h6 class="my-0 text-white d-flex align-items-center gap-1">
                                    Basic Questions || <span>Marks: {{ $unique_applicant->details->count() * 5 }}</span>
                                </h6>

                                <div class="d-flex gap-2 mt-2 mt-md-0">
                                    <span class="p-1 text-white">Obtain Marks:
                                        {{ $unique_applicant->details->where('status', 1)->count() * 5 }}</span>
                                </div>
                            </div>


                            <div class="card-body" style="padding: 0px;">
                                <div class="row">
                                    {{-- LEFT COLUMN --}}
                                    <div class="col-md-6 pe-lg-0">
                                        <table class="table table-bordered table-hover table-striped mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th class="text-center" width="5%">SL</th>
                                                    <th width="50%">Question</th>
                                                    <th width="30%" class="text-center">Answer</th>
                                                    <th width="15%" class="text-center">Status</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach ($helper_questions->take(5) as $key => $questions)
                                                    @php
                                                        $options = $questions
                                                            ->mapWithKeys(
                                                                fn($item) => [$item->id => $item->question_bn],
                                                            )
                                                            ->toArray();
                                                        $answers = $questions
                                                            ->mapWithKeys(
                                                                fn($item) => [$item->answer_bn => $item->answer_bn],
                                                            )
                                                            ->toArray();
                                                        $questionAnswerMap = $questions
                                                            ->mapWithKeys(fn($item) => [$item->id => $item->answer_bn])
                                                            ->toArray();

                                                        $saved =
                                                            $unique_applicant->details->firstWhere('sl', $key) ?? null;

                                                        $selectedQuestion =
                                                            $saved->question_id ??
                                                            (count($options) == 1 ? array_key_first($options) : null);
                                                        $selectedAnswer =
                                                            $saved->answer ??
                                                            (count($answers) == 1 ? array_key_first($answers) : null);
                                                        $selectedStatus = $saved->status ?? null;
                                                    @endphp

                                                    <tr>
                                                        <td class="text-center">
                                                            {{ $key }}
                                                        </td>

                                                        <td>
                                                            <x-select-input name="question_id[{{ $key }}]"
                                                                class="mb-0 question-select"
                                                                data-row="{{ $key }}" :options="$options"
                                                                :selected="$selectedQuestion" required />

                                                            <input type="hidden" id="map_{{ $key }}"
                                                                value='@json($questionAnswerMap)'>
                                                        </td>

                                                        <td>
                                                            <x-select-input name="answer_id[{{ $key }}]"
                                                                class="mb-0 answer-select"
                                                                id="answer_{{ $key }}" :options="$answers"
                                                                :selected="$selectedAnswer" required />
                                                        </td>

                                                        <td>
                                                            <x-select-input name="status[{{ $key }}]"
                                                                class="mb-0" :options="['1' => 'Correct', '0' => 'Wrong']" :selected="$selectedStatus"
                                                                required />
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    {{-- RIGHT COLUMN --}}
                                    <div class="col-md-6">
                                        <table class="table table-bordered table-hover table-striped mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th class="text-center" width="5%">SL</th>
                                                    <th width="50%">Question</th>
                                                    <th width="30%" class="text-center">Answer</th>
                                                    <th width="15%" class="text-center">Status</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach ($helper_questions->slice(5) as $index => $questions)
                                                    @php
                                                        $key = $index;

                                                        $options = $questions
                                                            ->mapWithKeys(
                                                                fn($item) => [$item->id => $item->question_bn],
                                                            )
                                                            ->toArray();
                                                        $answers = $questions
                                                            ->mapWithKeys(
                                                                fn($item) => [$item->answer_bn => $item->answer_bn],
                                                            )
                                                            ->toArray();
                                                        $questionAnswerMap = $questions
                                                            ->mapWithKeys(fn($item) => [$item->id => $item->answer_bn])
                                                            ->toArray();

                                                        $saved =
                                                            $unique_applicant->details->firstWhere('sl', $key) ?? null;

                                                        $selectedQuestion =
                                                            $saved->question_id ??
                                                            (count($options) == 1 ? array_key_first($options) : null);
                                                        $selectedAnswer =
                                                            $saved->answer ??
                                                            (count($answers) == 1 ? array_key_first($answers) : null);
                                                        $selectedStatus = $saved->status ?? null;
                                                    @endphp

                                                    <tr>
                                                        <td class="text-center">{{ $key }}</td>

                                                        <td>
                                                            <x-select-input name="question_id[{{ $key }}]"
                                                                class="mb-0 question-select"
                                                                data-row="{{ $key }}" :options="$options"
                                                                :selected="$selectedQuestion" required />

                                                            <input type="hidden" id="map_{{ $key }}"
                                                                value='@json($questionAnswerMap)'>
                                                        </td>

                                                        <td>
                                                            <x-select-input name="answer_id[{{ $key }}]"
                                                                class="mb-0 answer-select"
                                                                id="answer_{{ $key }}" :options="$answers"
                                                                :selected="$selectedAnswer" required />
                                                        </td>

                                                        <td>
                                                            <x-select-input name="status[{{ $key }}]"
                                                                class="mb-0" :options="['1' => 'Correct', '0' => 'Wrong']" :selected="$selectedStatus"
                                                                required />
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            {{-- CARD FOOTER --}}
                            <div class="card-footer text-end" style="padding: 10px 10px">
                                <button type="button" class="btn btn-secondary me-2 btn-sm"
                                    @if ($disabled) disabled @endif>
                                    Cancel
                                </button>

                                <button type="submit" id="saveBtn" class="btn btn-primary btn-sm"
                                    @if ($disabled) disabled @endif>
                                    Save Data
                                </button>
                            </div>
                        </div>
                    </form>
                </div>


                {{-- Efficiency Section --}}
                <div class="card-body" style="min-height: 200px; overflow-y: auto;">
                    <form id="processQuestion">
                        @csrf
                        <input type="hidden" name="assessment_id" value="{{ $unique_applicant->id }}">
                        <div class="card" style="padding:0px !importent;">
                            <div class="card-header bg-primary d-flex justify-content-between align-items-center flex-wrap"
                                style="padding: 10px 10px">
                                <h6 class="my-0 text-white d-flex align-items-center gap-1">
                                    Efficiency Test || <span>Marks: 50</span>
                                </h6>

                                <div class="d-flex gap-2 mt-2 mt-md-0">
                                    <span class="p-1 text-white">Obtain Marks: 0</span>
                                </div>
                            </div>


                            <div class="card-body" style="padding: 0px;">
                                <div class="row">
                                    {{-- LEFT COLUMN --}}
                                    <div class="col-md-12">
                                        <table class="table table-bordered table-hover table-striped mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th style="width: 20%;">Process Code</th>
                                                    <th style="width: 12%;">Self Declare</th>
                                                    <th style="width: 12%;">1st Cycle</th>
                                                    <th style="width: 12%;">2nd Cycle</th>
                                                    <th style="width: 12%;">3rd Cycle</th>
                                                    <th style="width: 12%;">4th Cycle</th>
                                                    <th style="width: 12%;">5th Cycle</th>
                                                    <th style="width: 8%; text-align: right;">Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <x-select-input name="process_id" class="mb-0 question-select"
                                                            :options="$processlist" required />
                                                        @error('process_id')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <input type="text" name="declare"
                                                            class="form-control @error('declare') is-invalid @enderror"
                                                            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                            placeholder="i.e. declare" required>
                                                        @error('declare')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <input type="text" name="cycle_one"
                                                            class="form-control @error('cycle_one') is-invalid @enderror"
                                                            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                            placeholder="i.e. 1st cycle" required>
                                                        @error('cycle_one')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <input type="text" name="cycle_two"
                                                            class="form-control @error('cycle_two') is-invalid @enderror"
                                                            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                            placeholder="i.e. 2nd cycle" required>
                                                        @error('cycle_two')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <input type="text" name="cycle_three"
                                                            class="form-control @error('cycle_three') is-invalid @enderror"
                                                            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                            placeholder="i.e. 3rd cycle" required>
                                                        @error('cycle_three')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <input type="text" name="cycle_four"
                                                            class="form-control @error('cycle_four') is-invalid @enderror"
                                                            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                            placeholder="i.e. 4th cycle" required>
                                                        @error('cycle_four')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <input type="text" name="cycle_five"
                                                            class="form-control @error('cycle_five') is-invalid @enderror"
                                                            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                            placeholder="i.e. 5th cycle" required>
                                                        @error('cycle_five')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </td>
                                                    <td class="text-center">
                                                        <x-primary-button class="float-start btn-sm" :disabled="$unique_applicant->is_done == 1">Save</x-primary-button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>




                <div class="card-footer" style="padding:14px 20px;">

                </div>
            </div>
        </div>

        @if ($unique_applicant->processes->count() > 0)
            <div class="col-lg-12" id="efficiencyDetails">
                <div class="card-body" style="min-height: 200px;">
                    <form id="processQuestionDetails">
                        @csrf
                        <input type="hidden" name="assessment_id" value="{{ $unique_applicant->id }}">

                        <div class="card" style="padding:0px !importent;">
                            <div class="card-header bg-info d-flex justify-content-between align-items-center flex-wrap"
                                style="padding: 10px 10px">
                                <h6 class="my-0 text-white d-flex align-items-center gap-1">
                                    Efficiency Assessment Details
                                </h6>

                                <div class="d-flex gap-2 mt-2 mt-md-0">
                                    <span class="p-1 text-white">Efficiency:
                                        {{ number_format($unique_applicant->processes->sum('efficiency') / $unique_applicant->processes->count(), 2) }}%</span>
                                </div>
                            </div>


                            <div class="card-body" style="padding: 0px;">
                                <div class="row">
                                    {{-- LEFT COLUMN --}}
                                    <div class="col-md-12">
                                        <table class="table table-bordered table-hover table-striped mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Process</th>
                                                    <th>Process Name</th>
                                                    <th class="text-right">Self Declare</th>
                                                    <th class="text-right">1st Cycle</th>
                                                    <th class="text-right">2nd Cycle</th>
                                                    <th class="text-right">3rd Cycle</th>
                                                    <th class="text-right">4th Cycle</th>
                                                    <th class="text-right">5th Cycle</th>
                                                    <th class="text-right">Average</th>
                                                    <th class="text-right">Capacity</th>
                                                    <th class="text-right">SMV</th>
                                                    <th class="text-right">Target</th>
                                                    <th class="text-right">Efficiency</th>
                                                    <th class="text-right">Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach ($unique_applicant->processes as $process)
                                                    <tr id="row-{{ $process->id }}">
                                                        <td>{{ $process->processName->process }}</td>
                                                        <td>{{ $process->processName->process_name }}</td>
                                                        <td class="text-right">{{ $process->declare }}</td>
                                                        <td class="text-right">{{ $process->cycle_one }}</td>
                                                        <td class="text-right">{{ $process->cycle_two }}</td>
                                                        <td class="text-right">{{ $process->cycle_three }}</td>
                                                        <td class="text-right">{{ $process->cycle_four }}</td>
                                                        <td class="text-right">{{ $process->cycle_five }}</td>
                                                        <td class="text-right">{{ $process->average }}</td>
                                                        <td class="text-right">{{ $process->average }}</td>
                                                        <td class="text-right">{{ $process->smv }}</td>
                                                        <td class="text-right">{{ $process->target }}</td>
                                                        <td class="text-right">{{ $process->efficiency }}</td>
                                                        <td class="text-right">
                                                            {{-- <a href="#" class="btn btn-soft-success waves-effect waves-light" style="padding: 4px 6px;" data-bs-toggle="modal" data-bs-target="#editModal{{ $process->id }}"><i class="fas fa-edit"></i></a> --}}
                                                            <a href="#"
                                                                class="btn btn-soft-danger waves-effect waves-light delete-process"
                                                                data-id="{{ $process->id }}"
                                                                style="padding: 4px 6px;"><i class="fas fa-trash"></i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endif
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

        $('#processQuestion').on('submit', function(e) {
            e.preventDefault();

            let formData = $(this).serialize();

            $.ajax({
                url: "{{ route('ipe.database.assessment.process.store') }}",
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
                    location.reload();
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

        $(document).on('click', '.delete-process', function(e) {
            e.preventDefault();
            let processId = $(this).data('id');
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
                        url: '{{ route('ipe.database.assessment.process.delete') }}',
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
                                'Process has been deleted.',
                                'success'
                            );
                            $('#row-' + processId).remove();
                            $('#efficiencyDetails').load(location.href + ' #efficiencyDetails');
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

        $(document).on('click', '.toggle-assessment', function(e) {
            e.preventDefault();
            let processId = $(this).data('id');
            Swal.fire({
                title: 'Complete this assessment ?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, complete it!'
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
                            window.location.href = "{{ route('ipe.database.assessments.index') }}";
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
