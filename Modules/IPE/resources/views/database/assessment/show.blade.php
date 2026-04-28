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
                <div class="card-header d-flex justify-content-between align-items-center flex-wrap px-10 py-12" style="padding: 16px 20px">
                    <h6 class="my-0 text-primary d-flex align-items-center gap-1"><i data-feather="list" width="18" height="18"></i>
                        {{ $unique_applicant ? 'Edit Applicant Information' : 'Input Parameters For New Applicant ...' }}
                    </h6>

                    <div class="d-flex gap-2 mt-2 mt-md-0">
                        @if ($unique_applicant)
                            <a href="javascript:void(0);" data-id="{{ $unique_applicant->id }}" class="btn btn-danger btn-sm d-flex align-items-center delete-applicant" data-id="{{ $unique_applicant->id }}"><i data-feather="trash-2" width="16" height="16" class="me-1"></i> Delete</a>
                            <button class="btn btn-warning btn-sm d-flex align-items-center text-white"><i data-feather="star" width="16" height="16" class="me-1"></i> Sticker</button>
                        @else
                            <a href="javascript:void(0);" id="resetForm" class="btn btn-secondary btn-sm d-flex align-items-center"><i data-feather="rotate-ccw" width="16" height="16" class="me-1"></i> Reset</a>
                        @endif
                    </div>
                </div>

                <div class="card-body" style="min-height: 400px;max-height: 400px; overflow-y: auto;">
                    <div class="row">
                        {{-- LEFT COLUMN --}}
                        <div class="col-md-6 pe-lg-0">
                            <table class="table table-bordered table-hover table-striped" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="5%">SL</th>
                                        <th width="50%">Question</th>
                                        <th width="30%" style="text-align:center">Answer</th>
                                        <th width="15%" style="text-align:center">Status</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($helper_questions->take(5) as $key => $questions)
                                        @php
                                            $options = $questions
                                                ->mapWithKeys(function ($item) {
                                                    return [$item->id => $item->question_bn];
                                                })
                                                ->toArray();

                                            $answers = $questions
                                                ->mapWithKeys(function ($item) {
                                                    return [$item->answer_bn => $item->answer_bn];
                                                })
                                                ->toArray();

                                            $questionAnswerMap = $questions
                                                ->mapWithKeys(function ($item) {
                                                    return [$item->id => $item->answer_bn];
                                                })
                                                ->toArray();

                                            $selectedQuestion = count($options) == 1 ? array_key_first($options) : null;
                                            $selectedAnswer = count($answers) == 1 ? array_key_first($answers) : null;
                                        @endphp

                                        <tr>
                                            <td class="text-center">{{ $key }}</td>
                                            <td>
                                                <x-select-input name="question_id[{{ $key }}]" label=""
                                                    class="mb-0 question-select" data-row="{{ $key }}"
                                                    :options="$options" :selected="$selectedQuestion" required />

                                                <input type="hidden" id="map_{{ $key }}"
                                                    value='@json($questionAnswerMap)'>
                                            </td>
                                            <td>
                                                <x-select-input name="answer_id[{{ $key }}]" label=""
                                                    class="mb-0 answer-select" id="answer_{{ $key }}"
                                                    :options="$answers" :selected="$selectedAnswer" required />
                                            </td>
                                            <td>
                                                <x-select-input name="status[{{ $key }}]" label=""
                                                    class="mb-0" :options="['1' => 'Correct', '0' => 'Wrong']" required />
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{-- RIGHT COLUMN --}}
                        <div class="col-md-6">
                            <table class="table table-bordered table-hover table-striped" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="5%">SL</th>
                                        <th width="50%">Question</th>
                                        <th width="30%" style="text-align:center">Answer</th>
                                        <th width="15%" style="text-align:center">Status</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($helper_questions->slice(5) as $index => $questions)
                                        @php
                                            $key = $index;

                                            $options = $questions
                                                ->mapWithKeys(function ($item) {
                                                    return [$item->id => $item->question_bn];
                                                })
                                                ->toArray();

                                            $answers = $questions
                                                ->mapWithKeys(function ($item) {
                                                    return [$item->answer_bn => $item->answer_bn];
                                                })
                                                ->toArray();

                                            $questionAnswerMap = $questions
                                                ->mapWithKeys(function ($item) {
                                                    return [$item->id => $item->answer_bn];
                                                })
                                                ->toArray();

                                            $selectedQuestion = count($options) == 1 ? array_key_first($options) : null;
                                            $selectedAnswer = count($answers) == 1 ? array_key_first($answers) : null;
                                        @endphp

                                        <tr>
                                            <td class="text-center">{{ $key }}</td>
                                            <td>
                                                <x-select-input name="question_id[{{ $key }}]" label=""
                                                    class="mb-0 question-select" data-row="{{ $key }}"
                                                    :options="$options" :selected="$selectedQuestion" required />

                                                <input type="hidden" id="map_{{ $key }}"
                                                    value='@json($questionAnswerMap)'>
                                            </td>

                                            <td>
                                                <x-select-input name="answer_id[{{ $key }}]" label=""
                                                    class="mb-0 answer-select" id="answer_{{ $key }}"
                                                    :options="$answers" :selected="$selectedAnswer" required />
                                            </td>

                                            <td>
                                                <x-select-input name="status[{{ $key }}]" label=""
                                                    class="mb-0" :options="['1' => 'Correct', '0' => 'Wrong']" required />
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer" style="padding:14px 20px;">

                </div>
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
    </script>
@endpush
