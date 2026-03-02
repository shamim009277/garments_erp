@extends('layouts.app')
@section('title', 'HRIS')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'HRIS',
                'subtitle' => 'Leave Reason',
                'breadcrumbs' => [
                    ['label' => 'HRIS', 'url' => route('hris.index')],
                    ['label' => 'Setup', 'url' => route('hris.index')],
                    ['label' => 'Leave Reason', 'url' => route('hris.setup.leavereason.index')],
                ],
            ])
        </div>
        <div class="col-lg-8 pe-lg-0">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Leave Reason List</h6>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100" width="100%">
                        <thead>
                            <tr>
                                <th width="5%">SL</th>
                                <th width="40%">Reason</th>
                                <th width="30%">Leave Type</th>
                                <th width="15%">Is Active</th>
                                <th width="10%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($leavereasons as $key => $leavereason)
                                <tr id="row-{{ $leavereason->id }}">
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $leavereason->reason }}</td>
                                    <td>{{ is_array($leavereason->classification_id) ? implode(', ', $leavereason->classification_id) : 'N/A' }}</td>
                                    <td>
                                        <div class="square-switch">
                                            <input type="checkbox" id="square-switch3{{ $leavereason->id }}" class="leavereason-toggle" data-id="{{ $leavereason->id }}" switch="bool" {{ $leavereason->is_active ? 'checked' : '' }} />
                                            <label for="square-switch3{{ $leavereason->id }}" data-on-label="Yes" data-off-label="No" style="margin: 0px; vertical-align: middle;"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-soft-success waves-effect waves-light" style="padding: 4px 6px;" data-bs-toggle="modal" data-bs-target="#editModal{{ $leavereason->id }}"><i class="fas fa-edit"></i></a>
                                        <a href="#" class="btn btn-soft-danger waves-effect waves-light delete-leavereason" data-id="{{ $leavereason->id }}" style="padding: 4px 6px;"><i class="fas fa-trash"></i></a>
                                    </td>

                                    <div id="editModal{{ $leavereason->id }}" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-bs-scroll="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title" id="myModalLabel">Edit Leave Classification</h6>
                                                    <button type="button" class="btn-close btn btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <form id="editForm{{ $leavereason->id }}" action="{{ route('hris.setup.leavereason.update', $leavereason->id) }}" method="POST">
                                                    <div class="modal-body">
                                                        @csrf
                                                        @method('PUT')
                                                        <x-input-group name="reason" label="Reason" type="text" placeholder="Enter reason" :value="$leavereason->reason" required />
                                                        <x-select-multiple-input
                                                            name="classification_id[]"
                                                            id="classification_id_edit_{{ $leavereason->id }}"
                                                            class="select2 multiselect mb-2"
                                                            :options="$types"
                                                            :selected="$leavereason->classification_id ?? []"
                                                            multiple
                                                            required
                                                        />
                                                        <x-select-input-group name="is_active" label="Is Active"  :options="['1' => 'Active', '0' => 'Inactive']" :selected="$leavereason->is_active" required />
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

        <div class="col-lg-4">
            <div class="card alert-info alert-top-border">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i class="mdi mdi-list"></i> Input Parameters For New Leave Reason ...</h6>
                </div>
                <div class="card-body">
                    <form id="moduleForm" action="{{ route('hris.setup.leavereason.store') }}" method="POST">
                        @csrf
                        <x-input-group name="reason" label="Leave Reason" type="text" placeholder="Enter leave reason" :value="old('reason')" required />
                        <label for="classification_id">Leave Classification <span class="text-danger">*</span></label>
                        <x-select-multiple-input
                            name="classification_id[]"
                            id="classification_id_add"
                            class="select2 multiselect mb-2"
                            :options="$types"
                            :selected="old('classification_id', [])"
                            multiple
                            required
                        />
                        <br><br>
                        <x-select-input-group
                            name="is_active"
                            class="mb-2"
                            label="Is Active?"
                            :options="['1' => 'Active', '0' => 'Inactive']"
                            :selected="old('is_active', '1')"
                            required
                        />

                        <x-primary-button class="float-start btn-sm submitBtn">Save</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#classification_id_add').select2({
                placeholder: 'Select Leave Classification',
                allowClear: true,
                multiple: true,
            });

            $('.select2.multiselect').each(function() {
                if (!$(this).hasClass('select2-hidden-accessible')) {
                    $(this).select2();
                }
            });

            $('.leavereason-toggle').on('change', function() {
                let id = $(this).data('id');
                let status = $(this).is(':checked') ? 1 : 0;
                $.ajax({
                    url: '{{ route('hris.setup.leavereason.toggle') }}',
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

        $(document).on('click', '.delete-leavereason', function(e) {
            e.preventDefault();
            let leavereasonId = $(this).data('id');
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
                        url: '{{ route('hris.setup.leavereason.delete') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: leavereasonId
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                'Leave Reason has been deleted.',
                                'success'
                            );
                            $('#row-' + leavereasonId).remove();
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
                        'Leave Reason has not been deleted.',
                        'error'
                    );
                }
            });
        });
    </script>
@endpush
