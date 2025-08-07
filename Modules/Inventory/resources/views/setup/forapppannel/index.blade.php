@extends('layouts.app')
@section('title', 'INVENTORY')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'INVENTORY',
                'subtitle' => 'Forward Approve Pannel',
                'breadcrumbs' => [
                    ['label' => 'INVENTORY', 'url' => route('inventory.index')],
                    ['label' => 'Setup', 'url' => route('inventory.index')],
                    ['label' => 'Forward Approve Pannel', 'url' => route('inventory.setup.forapppannel.index')],
                ],
            ])
        </div>
        <div class="col-md-8">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Forward Approve Pannel List
                    </h6>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100" width="100%">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th width="25%">User</th>
                                <th width="25%">Organization</th>
                                <th width="25%">Access Type</th>
                                <th width="10%">Is Active</th>
                                <th width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $access_levels = collect($access_types);
                            @endphp
                            @foreach ($forapppannels as $key => $item)
                                <tr id="row-{{ $item->id }}">
                                    <td width="5%">{{ $key + 1 }}</td>
                                    <td width="25%">{{ $item->user->name }}</td>
                                    <td width="25%">
                                        @if ($item->organization)
                                            {{ $item->organization->name }}
                                        @endif
                                    </td>
                                    <td width="25%">{{ $access_levels->get($item->access_level, 'Unknown') }}</td>
                                    <td width="10%">
                                        <div class="square-switch">
                                            <input type="checkbox" id="square-switch3{{ $item->id }}" class="forapppannel-toggle" data-id="{{ $item->id }}" switch="bool" {{ $item->is_active ? 'checked' : '' }} />
                                            <label for="square-switch3{{ $item->id }}" data-on-label="Yes" data-off-label="No" style="margin: 0px; vertical-align: middle;"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-soft-success waves-effect waves-light" data-toggle="tooltip" data-placement="left" title="Edit"
                                            style="padding: 4px 6px;" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $item->id }}"><i class="fas fa-edit"></i>
                                        </a>
                                        <a href="#" class="btn btn-soft-danger waves-effect waves-light delete-forapppannel" data-toggle="tooltip" data-placement="left" title="Delete"
                                            style="padding: 4px 6px;" data-id="{{ $item->id }}"><i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                {{-- load edit modal --}}
                                <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel{{ $item->id }}">Edit Forward Approve Pannel
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form id="editForm{{ $item->id }}" action="{{ route('inventory.setup.forapppannel.update', $item->id) }}" method="POST">
                                                <div class="modal-body">
                                                    @csrf
                                                    @method('PUT')
                                                    <x-select-input-group name="organization_id" label="Organization" :options="$organizations->pluck('name', 'id')" :selected="old('organization_id', $item->organization_id)" required />
                                                    <x-select-input-group name="user_id" label="User" :options="$users->pluck('name', 'id')" :selected="old('user_id', $item->user_id)" required />
                                                    <x-select-input-group name="access_level" label="Access Level" :options="$access_types" :selected="old('access_level', $item->access_level)" required />
                                                    <x-select-input-group name="is_active" label="Is Active" :options="['1' => 'Active', '0' => 'Inactive']" :selected="old('is_active', $item->is_active)" required />
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary waves-effect btn-sm" data-bs-dismiss="modal">Close</button>
                                                    <x-primary-button class="float-start btn-sm submitBtn">Save Changes</x-primary-button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card alert-info alert-top-border">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i class="mdi mdi-list"></i> Input Parameters For New Forward Approve Pannel ...
                    </h6>
                </div>
                <div class="card-body">
                    <form id="moduleForm" action="{{ route('inventory.setup.forapppannel.store') }}" method="POST">
                        @csrf
                        <x-select-input-group name="organization_id" label="Organization" :options="$organizations->pluck('name', 'id')" :selected="old('organization_id')"
                            required />
                        <x-select-input-group name="user_id" label="User" :options="$users->pluck('name', 'id')" :selected="old('user_id')"
                            required />
                        <x-select-input-group name="access_level" label="Access Level" :options="$access_types" :selected="old('access_level')"
                            required />
                        <x-select-input-group name="is_active" label="Is Active?" :options="['1' => 'Active', '0' => 'Inactive']" :selected="old('is_active', '1')"
                            required />
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

            $('[data-toggle="tooltip"]').tooltip()

            $('.forapppannel-toggle').on('change', function() {
                let id = $(this).data('id');
                let status = $(this).is(':checked') ? 1 : 0;
                $.ajax({
                    url: '{{ route('inventory.setup.forapppannel.toggle') }}',
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

        $(document).on('click', '.delete-forapppannel', function(e) {
            e.preventDefault();
            let forapppannelId = $(this).data('id');
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
                        url: '{{ route('inventory.setup.forapppannel.delete') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: forapppannelId
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                'Forward Approve Pannel has been deleted.',
                                'success'
                            );
                            $('#row-' + forapppannelId).remove();
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
                        'Forward Approve Pannel has not been deleted.',
                        'error'
                    );
                }
            });
        });
    </script>
@endpush
