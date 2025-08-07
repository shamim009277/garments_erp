@extends('layouts.app')
@section('title', 'HRIS')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'HRIS',
                'subtitle' => 'Gate Pass Reason',
                'breadcrumbs' => [
                    ['label' => 'HRIS', 'url' => route('hris.index')],
                    ['label' => 'Setup', 'url' => route('hris.index')],
                    ['label' => 'Gate Pass Reason', 'url' => route('hris.setup.gatepass_reason.index')],
                ],
            ])
        </div>
        <div class="col-lg-8 pe-lg-0">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Gate Pass Reason List</h6>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100" width="100%">
                        <thead>
                            <tr>
                                <th width="5%">SL</th>
                                <th width="15%">Purpose</th>
                                <th width="40%">Reason</th>
                                <th width="15%">Reason For?</th>
                                <th width="15%">Is Active</th>
                                <th width="10%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reasons as $reason)
                                <tr id="row-{{ $reason->id }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $reason->purpose->purpose }}</td>
                                    <td>{{ $reason->reason }}</td>
                                    <td>{{ $reason->reason_for_text }}</td>
                                    <td>
                                        <div class="square-switch">
                                            <input type="checkbox" id="square-switch3{{ $reason->id }}" class="reason-toggle" data-id="{{ $reason->id }}" switch="bool" {{ $reason->is_active ? 'checked' : '' }} />
                                            <label for="square-switch3{{ $reason->id }}" data-on-label="Yes" data-off-label="No" style="margin: 0px; vertical-align: middle;"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-soft-success waves-effect waves-light" style="padding: 4px 6px;" data-bs-toggle="modal" data-bs-target="#editModal{{ $reason->id }}"><i class="fas fa-edit"></i></a>
                                        <a href="#" class="btn btn-soft-danger waves-effect waves-light delete-reason" data-id="{{ $reason->id }}" style="padding: 4px 6px;"><i class="fas fa-trash"></i></a>
                                    </td>

                                    <div id="editModal{{ $reason->id }}" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-bs-scroll="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title" id="myModalLabel">Edit Gate Pass Reason</h6>
                                                    <button type="button" class="btn-close btn btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <form id="editForm{{ $reason->id }}" action="{{ route('hris.setup.gatepass_reason.update', $reason->id) }}" method="POST">
                                                    <div class="modal-body">
                                                        @csrf
                                                        @method('PUT')
                                                        <x-input-group name="reason" label="Reason" type="text" placeholder="Enter reason" :value="$reason->reason" required />
                                                        <x-select-search-input name="reason_for" label="Reason For?" :options="['1' => 'Gate Pass', '2' => 'Late Entry', '3' => 'Gate Pass & Late Entry']" :selected="$reason->reason_for" required />
                                                        <x-select-search-input name="purpose_id" label="Purpose" :options="$purposes" :selected="$reason->purpose_id" required />
                                                        <x-select-input-group name="is_active" label="Is Active" :options="['1' => 'Active', '0' => 'Inactive']" :selected="$reason->is_active" required />
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
                    <h6 class="my-0 text-primary"> <i class="mdi mdi-list"></i> Input Parameters For New Reason ...</h6>
                </div>
                <div class="card-body">
                    <form id="moduleForm" action="{{ route('hris.setup.gatepass_reason.store') }}" method="POST">
                        @csrf
                        <x-select-search-input
                            name="purpose_id"
                            label="Purpose"
                            :options="$purposes"
                            class="form-select"
                            :selected="old('purpose_id')"
                            :value="old('purpose_id')"
                            required
                        />
                        <x-input-group name="reason" label="Reason" type="text" placeholder="Enter reason" :value="old('reason')" required />

                        <x-select-search-input
                            name="reason_for"
                            label="Reason For?"
                            :options="['1' => 'Gate Pass', '2' => 'Late Entry', '3' => 'Gate Pass & Late Entry']"
                            class="form-select"
                            :selected="old('reason_for', '1')"
                            :value="old('reason_for', '1')"
                            required
                        />

                        <x-select-input-group
                            name="is_active"
                            label="Is Active?"
                            :options="['1' => 'Active', '0' => 'Inactive']"
                            class="form-select"
                            :selected="old('is_active', '1')"
                            :value="old('is_active', '1')"
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
            $('.reason-toggle').on('change', function() {
                let id = $(this).data('id');
                let status = $(this).is(':checked') ? 1 : 0;
                $.ajax({
                    url: '{{ route('hris.setup.gatepass_reason.toggle') }}',
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

        $(document).on('click', '.delete-reason', function(e) {
            e.preventDefault();
            let reasonId = $(this).data('id');
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
                        url: '{{ route('hris.setup.gatepass_reason.delete') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: reasonId
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                'Gate Pass Reason has been deleted.',
                                'success'
                            );
                            $('#row-' + reasonId).remove();
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
                        'Gate Pass Reason has not been deleted.',
                        'error'
                    );
                }
            });
        });
    </script>
@endpush
