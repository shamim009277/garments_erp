@extends('layouts.app')
@section('title', 'IPE')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'IPE',
                'subtitle' => 'Quality Questions',
                'breadcrumbs' => [
                    ['label' => 'IPE', 'url' => route('ipe.index')],
                    ['label' => 'Setup', 'url' => route('ipe.index')],
                    ['label' => 'Quality Questions', 'url' => route('ipe.setup.qualityquestions.index')],
                ],
            ])
        </div>
        <div class="col-lg-12">
            <div class="card alert-info alert-top-border">
                <div class="card-header" style="padding: 12px 10px !important">
                    <h6 class="my-0 text-primary"> <i class="mdi mdi-list"></i> Quality Questions List</h6>
                </div>
                <form id="moduleForm" action="{{ route('ipe.setup.qualityquestions.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100" width="100%">
                            <thead>
                                <tr>
                                    <th width="2%">SL</th>
                                    <th width="5%">Group</th>
                                    <th width="5%">Type</th>
                                    <th width="5%">Department</th>
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
                                        <select name="type" id="type" class="form-control form-control-sm">
                                            <option value="1">General</option>
                                            <option value="2">Practical</option>
                                        </select>
                                        @error('type')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </td>
                                    <td>
                                        <select name="department_id" id="department_id" class="form-control form-control-sm">
                                            @foreach ($departmnetlist as $department)
                                                <option value="{{ $department->id }}">{{ $department->department }}</option>
                                            @endforeach
                                        </select>
                                        @error('department_id')
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
                            </form>

                                @foreach($qualityquestions as $packingQuestion)
                                    <tr id="row-{{ $packingQuestion->id }}">
                                        <td>{{ $packingQuestion->sl }}</td>
                                        <td class="text-center">{{ $packingQuestion->sl }}</td>
                                        <td class="text-center">
                                            <span class="badge {{ $packingQuestion->type == 1 ? 'bg-primary' : 'bg-success' }}">{{ $packingQuestion->type == 1 ? 'General' : 'Practical' }}</span>
                                        </td>
                                        <td>{{ $packingQuestion->department->department }}</td>
                                        <td>{{ $packingQuestion->question }}</td>
                                        <td>{{ $packingQuestion->question_bn }}</td>
                                        <td>{{ $packingQuestion->answer }}</td>
                                        <td>{{ $packingQuestion->answer_bn }}</td>
                                        <td>
                                            <div class="square-switch">
                                                <input type="checkbox" id="square-switch3{{ $packingQuestion->id }}" class="quality-question-toggle" data-id="{{ $packingQuestion->id }}" switch="bool" {{ $packingQuestion->is_active ? 'checked' : '' }} />
                                                <label for="square-switch3{{ $packingQuestion->id }}" data-on-label="Yes" data-off-label="No" style="margin: 0px; vertical-align: middle;"></label>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <a href="#" class="btn btn-soft-success waves-effect waves-light" style="padding: 4px 6px;" data-bs-toggle="modal" data-bs-target="#editModal{{ $packingQuestion->id }}"><i class="fas fa-edit"></i></a>
                                            <a href="#" class="btn btn-soft-danger waves-effect waves-light delete-quality-question" data-id="{{ $packingQuestion->id }}" style="padding: 4px 6px;"><i class="fas fa-trash"></i></a>
                                        </td>

                                        <div id="editModal{{ $packingQuestion->id }}" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-bs-scroll="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h6 class="modal-title" id="myModalLabel">Edit Quality Question</h6>
                                                        <button type="button" class="btn-close btn btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>

                                                    <form id="editForm{{ $packingQuestion->id }}" action="{{ route('ipe.setup.qualityquestions.update', $packingQuestion->id) }}" method="POST">
                                                        <div class="modal-body">
                                                            @csrf
                                                            @method('PUT')
                                                            <x-input-group name="sl" label="Group" type="text" placeholder="Enter SL" :value="$packingQuestion->sl" required />
                                                            <x-select-input-group name="type" label="Type" :options="['1' => 'General', '2' => 'Practical']" :selected="$packingQuestion->type" required />
                                                            <x-select-input-group name="department_id" label="Department" :options="$lists" :selected="$packingQuestion->department_id" required />
                                                            <x-input-group name="question" label="Question" placeholder="Enter question" :value="$packingQuestion->question" required />
                                                            <x-input-group name="question_bn" label="Question Bangla" placeholder="Enter question bangla" :value="$packingQuestion->question_bn" required />
                                                            <x-input-group name="answer" label="Answer" placeholder="Enter answer" :value="$packingQuestion->answer" required />
                                                            <x-input-group name="answer_bn" label="Answer Bangla" placeholder="Enter answer bangla" :value="$packingQuestion->answer_bn" required />
                                                            <x-select-input-group name="is_active" label="Is Active" :options="['1' => 'Active', '0' => 'Inactive']" :selected="$packingQuestion->is_active" required />
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

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.quality-question-toggle').on('change', function() {
                let id = $(this).data('id');
                let status = $(this).is(':checked') ? 1 : 0;
                $.ajax({
                    url: '{{ route('ipe.setup.qualityquestions.toggle') }}',
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

        $(document).on('click', '.delete-quality-question', function(e) {
            e.preventDefault();
            let qualityQuestionId = $(this).data('id');
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
                        url: '{{ route('ipe.setup.qualityquestions.delete') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: qualityQuestionId
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                'Quality question has been deleted.',
                                'success'
                            );
                            $('#row-' + qualityQuestionId).remove();
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
                        'Quality question has not been deleted.',
                        'error'
                    );
                }
            });
        });
    </script>
@endpush



