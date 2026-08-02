<div class="card-body" style="min-height: 400px; overflow-y: auto;">
    <form id="practicalQuestion">
        @csrf
        <input type="hidden" name="assessment_id" value="{{ $uniqueApplicant->id }}">

        <div class="card" style="padding:0px !important;" id="practicalQuestionWrapper">


            {{-- HEADER --}}
            <div class="card-header bg-primary d-flex justify-content-between align-items-center flex-wrap" style="padding: 10px;">
                <h6 class="my-0 text-white d-flex align-items-center gap-1">
                    {{ $title }} ||
                    <span>Marks : {{ $helperQuestions->count() * $perMark }}</span>
                </h6>

                <div class="d-flex gap-2 mt-2 mt-md-0">
                    <span class="p-1 text-white">
                        Obtain Marks :
                        {{ $uniqueApplicant->detailsQuality->where('status', 1)->count() * $perMark }}
                    </span>
                </div>
            </div>

            {{-- BODY --}}
            <div class="card-body" style="padding: 0px;">
                <div class="row">

                    @php
                        $total = $helperQuestions->count();
                        $leftCount = (int) ceil($total / 2);
                    @endphp

                    {{-- LEFT --}}
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
                                @foreach ($helperQuestions->take($leftCount) as $key => $questions)
                                    @include('ipe::components.table-column2', [
                                        'questions' => $questions,
                                        'key' => $key,
                                        'uniqueApplicant' => $uniqueApplicant
                                    ])

                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- RIGHT --}}
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
                                @foreach ($helperQuestions->slice($leftCount) as $index => $questions)
                                    @include('ipe::components.table-column2', [
                                        'questions' => $questions,
                                        'key' => $index,
                                        'uniqueApplicant' => $uniqueApplicant
                                    ])
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- FOOTER --}}
            <div class="card-footer text-end" style="padding: 10px;">
                <button type="button" class="btn btn-secondary btn-sm me-2" @if($disabled) disabled @endif>
                    Cancel
                </button>

                <button type="submit" class="btn btn-primary btn-sm" @if($disabled) disabled @endif>
                    Save Data
                </button>
            </div>
        </div>
    </form>
</div>
