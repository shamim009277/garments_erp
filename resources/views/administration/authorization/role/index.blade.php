@extends('layouts.app')
@section('title', 'Role')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'Authorization',
                'subtitle' => 'Role',
                'breadcrumbs' => [
                    ['label' => 'Administration', 'url' => route('administration.index')],
                    ['label' => 'Authorization', 'url' => route('administration.authorization.role.index')],
                    ['label' => 'Role'],
                ],
            ])
        </div>
        <div class="col-md-12">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2">
                    <h6 class="my-0 text-primary"> <i data-feather="list" style="width: 16px;"></i> Role List</h6>

                    <div class="action-btn">
                        <a href="{{ route('administration.authorization.role.create') }}" class="btn btn-primary btn-sm"><i data-feather="plus" style="width: 16px;"></i> Add New</a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                        <thead>
                            <tr>
                                <th width="5%">SL</th>
                                <th width="25%">Role</th>
                                <th width="50%">Users</th>
                                <th width="10%">Is Active</th>
                                <th width="10%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        <span class="badge bg-success">{{ $role->users->pluck('name')->implode(' | ') }}</span>
                                    </td>
                                    <td>
                                        <div class="square-switch">
                                            <input type="checkbox" id="square-switch3{{ $role->id }}"class="role-toggle" data-id="{{ $role->id }}" switch="bool" {{ $role->is_active ? 'checked' : '' }} />
                                            <label for="square-switch3{{ $role->id }}" data-on-label="Yes"data-off-label="No" style="margin: 0px; vertical-align: middle;"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ route('administration.authorization.role.edit', $role->id) }}" class="btn btn-soft-success waves-effect waves-light" style="padding: 4px 6px;"><i class="fas fa-edit"></i></a>
                                        <a href="#" class="btn btn-soft-danger waves-effect waves-light delete-role" data-id="{{ $role->id }}" style="padding: 4px 6px;"><i class="fas fa-trash"></i></a>
                                    </td>
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
        $(function() {
            $(document).on('change', '.role-toggle', function() {
                const id = $(this).data('id');
                const status = $(this).is(':checked') ? 1 : 0;
                $.ajax({
                    url: '{{ route('administration.authorization.role.toggle') }}',
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
                            toastr.error(response.message || 'Update failed!');
                        }
                    },
                    error: function() {
                        toastr.error('Something went wrong!');
                    }
                });
            });

            $(document).on('click', '.delete-role', function(e) {
                e.preventDefault();
                const roleId = $(this).data('id');
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
                            url: '{{ route('administration.authorization.role.delete') }}',
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                id: roleId
                            },
                            success: function(response) {
                                Swal.fire('Deleted!', response.message ?? 'Role deleted.', 'success');
                            },
                            error: function() {
                                Swal.fire('Error!', 'Something went wrong.', 'error');
                            }
                        });
                    }
                });
            });
        });
    </script>
@endpush
