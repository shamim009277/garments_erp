@extends('layouts.app')
@section('title', 'IPE')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'IPE',
                'subtitle' => 'Helper Questions',
                'breadcrumbs' => [
                    ['label' => 'IPE', 'url' => route('ipe.index')],
                    ['label' => 'Setup', 'url' => route('ipe.index')],
                    ['label' => 'Helper Questions', 'url' => route('ipe.setup.helperquestions.index')],
                ],
            ])
        </div>
        <div class="col-lg-12">
            <div class="card alert-info alert-top-border">
                <div class="card-header" style="padding: 12px 10px !important">
                    <h6 class="my-0 text-primary"> <i class="mdi mdi-list"></i> Helper Questions List</h6>
                </div>
                <form id="moduleForm" action="{{ route('ipe.setup.helperquestions.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100" width="100%">
                            <thead>
                                <tr>
                                    <th width="2%">SL</th>
                                    <th width="5%">Group</th>
                                    <th width="20%">Question</th>
                                    <th width="20%">Question Bangla</th>
                                    <th width="15%">Answer</th>
                                    <th width="15%">Answer Bangla</th>
                                    <th width="5%">Status</th>
                                    <th width="5%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#</td>
                                    <td>
                                        <input type="text" name="sl" class="form-control form-control-sm @error('sl') is-invalid @enderror" placeholder="i.e. 1" required>
                                        @error('sl')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </td>
                                    <td>
                                        <input type="text" name="question" class="form-control form-control-sm @error('question') is-invalid @enderror" placeholder="i.e. Question  English" required>
                                        @error('question')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </td>
                                    <td>
                                        <input type="text" name="question_bn" class="form-control form-control-sm @error('question_bn') is-invalid @enderror" placeholder="i.e. Question  Bangla" required>
                                        @error('question_bn')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </td>
                                    <td>
                                        <input type="text" name="answer" class="form-control form-control-sm @error('answer') is-invalid @enderror" placeholder="i.e. Answer  English" required>
                                        @error('answer')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </td>
                                    <td>
                                        <input type="text" name="answer_bn" class="form-control form-control-sm @error('answer_bn') is-invalid @enderror" placeholder="i.e. Answer  Bangla" required>
                                        @error('answer_bn')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </td>
                                    <td>
                                        <select name="is_active" id="is_active" class="form-control form-control-sm">
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </td>
                                    <td class="text-center">
                                        <x-primary-button class="float-start btn-sm submitBtn">Save</x-primary-button>
                                    </td>
                                </tr>

                                @foreach($helperQuestions as $helperQuestion)
                                    <tr id="row-{{ $helperQuestion->id }}">
                                        <td>{{ $helperQuestion->sl }}</td>
                                        <td class="text-center">{{ $helperQuestion->sl }}</td>
                                        <td>{{ $helperQuestion->question }}</td>
                                        <td>{{ $helperQuestion->question_bn }}</td>
                                        <td>{{ $helperQuestion->answer }}</td>
                                        <td>{{ $helperQuestion->answer_bn }}</td>
                                        <td>
                                            <div class="square-switch">
                                                <input type="checkbox" id="square-switch3{{ $helperQuestion->id }}" class="helper-question-toggle" data-id="{{ $helperQuestion->id }}" switch="bool" {{ $helperQuestion->is_active ? 'checked' : '' }} />
                                                <label for="square-switch3{{ $helperQuestion->id }}" data-on-label="Yes" data-off-label="No" style="margin: 0px; vertical-align: middle;"></label>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <a href="#" class="btn btn-soft-success waves-effect waves-light" style="padding: 4px 6px;" data-bs-toggle="modal" data-bs-target="#editModal{{ $helperQuestion->id }}"><i class="fas fa-edit"></i></a>
                                            <a href="#" class="btn btn-soft-danger waves-effect waves-light delete-helper-question" data-id="{{ $helperQuestion->id }}" style="padding: 4px 6px;"><i class="fas fa-trash"></i></a>
                                        </td>

                                        <div id="editModal{{ $helperQuestion->id }}" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-bs-scroll="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h6 class="modal-title" id="myModalLabel">Edit Helper Question</h6>
                                                        <button type="button" class="btn-close btn btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>

                                                    <form id="editForm{{ $helperQuestion->id }}" action="{{ route('ipe.setup.helperquestions.update', $helperQuestion->id) }}" method="POST">
                                                        <div class="modal-body">
                                                            @csrf
                                                            @method('PUT')
                                                            <x-input-group name="sl" label="SL" type="text" placeholder="Enter SL" :value="$helperQuestion->sl" required />
                                                            <x-input-group name="question" label="Question" placeholder="Enter question" :value="$helperQuestion->question" required />
                                                            <x-input-group name="question_bn" label="Question Bangla" placeholder="Enter question bangla" :value="$helperQuestion->question_bn" required />
                                                            <x-input-group name="answer" label="Answer" placeholder="Enter answer" :value="$helperQuestion->answer" required />
                                                            <x-input-group name="answer_bn" label="Answer Bangla" placeholder="Enter answer bangla" :value="$helperQuestion->answer_bn" required />
                                                            <x-select-input-group name="is_active" label="Is Active" :options="['1' => 'Active', '0' => 'Inactive']" :selected="$helperQuestion->is_active" required />
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary waves-effect btn-sm" data-bs-dismiss="modal">Close</button>
                                                            <x-primary-button id="submitBtn" class="float-start btn-sm submitBtn">Save changes</x-primary-button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.helper-question-toggle').on('change', function() {
                let id = $(this).data('id');
                let status = $(this).is(':checked') ? 1 : 0;
                $.ajax({
                    url: '{{ route('ipe.setup.helperquestions.toggle') }}',
                    type: 'POST',
                    data: {
                        id: id,
                        status: status,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.message);
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        toastr.error('Something went wrong!');
                    }
                });
            });
        });

        $(document).on('click', '.delete-helper-question', function(e) {
            e.preventDefault();
            let helperQuestionId = $(this).data('id');
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
                        url: '{{ route('ipe.setup.helperquestions.delete') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: helperQuestionId
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                'Helper question has been deleted.',
                                'success'
                            );
                            $('#row-' + helperQuestionId).remove();
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
                        'Helper question has not been deleted.',
                        'error'
                    );
                }
            });
        });
    </script>
@endpush



