@extends('layouts.app')
@section('title', 'User')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'Authorization',
                'subtitle' => 'User',
                'breadcrumbs' => [
                    ['label' => 'Administration', 'url' => route('administration.index')],
                    ['label' => 'Authorization', 'url' => route('administration.index')],
                    ['label' => 'User'],
                ],
            ])
        </div>
        <div class="col-lg-8 col-sm-12 pe-lg-0">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header py-2 px-3" style="padding: 12px 10px !important">
                    <div class="row w-100 align-items-center" style="margin:0 !important">
                        <!-- Title -->
                        <div class="col-12 col-md-4 mb-2 mb-md-0">
                            <h6 class="my-0 text-primary"><i data-feather="user-plus" width="16" height="16"></i> User List</h6>
                        </div>
                    </div>
                </div>


                <div class="card-body">
                    <table id="userTable" class="table table-striped table-bordered dt-responsive  nowrap w-100">
                        <thead>
                            <tr>
                                <th width="5%">SL</th>
                                <th width="20%">Name</th>
                                <th width="15%">Employee ID</th>
                                <th width="25%">Email</th>
                                <th width="25%">Access Label</th>
                                <th width="25%">Role</th>
                                <th width="15%">Is Active</th>
                                <th width="10%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-12">
            <div class="card alert-info alert-top-border">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i class="mdi mdi-list"></i> Input Parameters For New User ...</h6>
                </div>
                <div class="card-body">
                    <form id="userForm" action="{{ route('administration.authorization.user.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" required value="{{ old('name') }}" placeholder="Enter name">
                            <x-input-error :messages="$errors->get('name')" />
                        </div>
                        <div class="mb-3">
                            <label for="employee_id" class="form-label">Employee ID</label>
                            <input type="text" class="form-control @error('employee_id') is-invalid @enderror" id="employee_id"
                                name="employee_id" value="{{ old('employee_id') }}" oninput="this.value = this.value.replace(/[^0-9]/g, '')" placeholder="Enter employee id">
                            <x-input-error :messages="$errors->get('employee_id')" />
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" required value="{{ old('email') }}" placeholder="Enter email">
                            <x-input-error :messages="$errors->get('email')" />
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password" required value="123456" placeholder="Enter password">
                            <x-input-error :messages="$errors->get('password')" />
                        </div>
                        <div class="mb-3">
                            <label for="role_id" class="form-label">Role <span class="text-danger">*</span></label>
                            <select class="form-control @error('role_id') is-invalid @enderror" data-trigger name="role_id"
                                id="role_id" placeholder="Select Role" required>
                                <option value="">Select Role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('role_id')" />
                        </div>
                        <div class="mb-3">
                            <label for="access_id" class="form-label">Access Label <span class="text-danger">*</span></label>
                            <select class="form-control @error('access_id') is-invalid @enderror" data-trigger name="access_id" id="access_id" placeholder="Select Organization" required>
                                <option value="">Select Organization</option>
                                <option value="0" selected>All Organization</option>
                                @foreach ($organizations as $organization)
                                    <option value="{{ $organization->id }}">
                                        {{ $organization->short_name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('access_id')" />
                        </div>
                        <div class="mb-3">
                            <label for="is_active" class="form-label">Is Active? <span class="text-danger">*</span></label>
                            <select name="is_active" class="form-select @error('is_active') is-invalid @enderror" required
                                value="{{ old('is_active') }}" id="is_active" placeholder="Select Is Active" required>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                            <x-input-error :messages="$errors->get('is_active')" />
                        </div>
                        <x-primary-button class="float-start btn-sm submitBtn">Save</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="editModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        data-bs-scroll="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="myModalLabel">Edit User</h6>
                    <button type="button" class="btn-close btn btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form id="editUserForm" action="#" method="POST">
                    <div class="modal-body">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text"class="form-control @error('name') is-invalid @enderror" id="edit_name" name="name" required>
                            <x-input-error :messages="$errors->get('name')" />
                        </div>
                        <div class="mb-3">
                            <label for="employee_id" class="form-label">Employee ID</label>
                            <input type="text" class="form-control @error('employee_id') is-invalid @enderror" id="edit_employee_id"
                                name="employee_id" value="{{ old('employee_id') }}" oninput="this.value = this.value.replace(/[^0-9]/g, '')" placeholder="Enter employee id">
                            <x-input-error :messages="$errors->get('employee_id')" />
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email"class="form-control @error('email') is-invalid @enderror" id="edit_email" name="email" required>
                            <x-input-error :messages="$errors->get('email')" />
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="edit_password" name="password" required value="{{ old('password') }}" placeholder="Enter password">
                            <x-input-error :messages="$errors->get('password')" />
                        </div>
                        <div class="mb-3">
                            <label for="role_id" class="form-label">Role <span class="text-danger">*</span></label>
                            <select name="role_id" class="form-control @error('role_id') is-invalid @enderror" required value="{{ old('role_id') }}" id="edit_role_id">
                                <option value="">Select Role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('role_id')" />
                        </div>
                        <div class="mb-3">
                            <label for="access_id" class="form-label">Access Label <span class="text-danger">*</span></label>
                            <select class="form-control @error('access_id') is-invalid @enderror" name="access_id" id="edit_access_id" placeholder="Select Organization" required>
                                <option value="">Select Organization</option>
                                <option value="0">All Organization</option>
                                @foreach ($organizations as $organization)
                                    <option value="{{ $organization->id }}">{{ $organization->short_name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('access_id')" />
                        </div>
                        <div class="mb-3">
                            <label for="is_active" class="form-label">Is Active? <span class="text-danger">*</span></label>
                            <select name="is_active" class="form-control @error('is_active') is-invalid @enderror" required value="{{ old('is_active') }}" id="edit_is_active">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                            <x-input-error :messages="$errors->get('is_active')" />
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect btn-sm" data-bs-dismiss="modal">Close</button>
                        <x-primary-button id="submitBtn" class="float-start btn-sm submitBtn">Save changes</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            const table = $('#userTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('administration.authorization.user.index') }}",
                },
                language: {
                    processing: `<div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>`
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'employee_id',
                        name: 'employee_id'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'access_label',
                        name: 'access_label'
                    },
                    {
                        data: 'role',
                        name: 'role'
                    },
                    {
                        data: 'is_active',
                        name: 'menus.is_active',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });

        $(document).on('click', '.edit-user', function() {
            let id = $(this).data('id');

            let url = '{{ route('administration.authorization.user.edit', ':id') }}';
            url = url.replace(':id', id);

            $.get(url, function(data) {
                console.log(data);
                $('#edit_name').val(data.name);
                $('#edit_employee_id').val(data.employee_id);
                $('#edit_email').val(data.email);
                $('#edit_role_id').val(data.role_id);
                $('#edit_access_id').val(data.access_id);
                $('#edit_is_active').val(data.is_active).change();
                $('#editModal').modal('show');
                $('#editUserForm').attr('action', "{{ route('administration.authorization.user.update', ':id') }}".replace(':id', id));
            });
        });

        $(document).on('change', '.user-toggle', function() {
            const id = $(this).data('id');
            const status = $(this).is(':checked') ? 1 : 0;
            $.ajax({
                url: '{{ route('administration.authorization.user.toggle') }}',
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

        $(document).on('click', '.delete-user', function(e) {
            e.preventDefault();
            let moduleId = $(this).data('id');
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
                        url: '{{ route('administration.authorization.user.delete') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: moduleId
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                'Module has been deleted.',
                                'success'
                            );
                            $('#row-' + moduleId).remove();
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
                        'Module has not been deleted.',
                        'error'
                    );
                }
            });
        });
    </script>
@endpush
