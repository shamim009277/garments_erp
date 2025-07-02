@extends('layouts.app')
@section('title', 'Permission')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'Authorization',
                'subtitle' => 'Permission',
                'breadcrumbs' => [
                    ['label' => 'Administration', 'url' => route('administration.index')],
                    ['label' => 'Authorization', 'url' => route('administration.index')],
                    ['label' => 'Permission'],
                ],
            ])
        </div>
        <div class="col-md-8 col-sm-12">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header py-2 px-3" style="padding: 12px 10px !important">
                    <div class="row w-100 align-items-center" style="margin:0 !important">
                        <!-- Title -->
                        <div class="col-12 col-md-4 mb-2 mb-md-0">
                            <h6 class="my-0 text-primary"><i class="mdi mdi-list"></i>Permission List</h6>
                        </div>

                        <!-- Filters -->
                        <div class="col-12 col-md-8 d-flex flex-wrap justify-content-md-end gap-2">
                            <div class="filter-select">
                                <select class="form-select form-select-sm" id="filter_module_id" style="min-width: 200px;">
                                    <option value="">All Modules</option>
                                    @foreach ($modules as $module)
                                        <option value="{{ $module->id }}">{{ $module->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="filter-select">
                                <select class="form-select form-select-sm" id="filter_menu_id" style="min-width: 200px;">
                                    <option value="">All Menu</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="card-body">
                    <table id="permissionTable" class="table table-striped table-bordered dt-responsive  nowrap w-100">
                        <thead>
                            <tr>
                                <th width="5%">SL</th>
                                <th width="20%">Module</th>
                                <th width="20%">Menu</th>
                                <th width="30%">Permission</th>
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
                    <h6 class="my-0 text-primary"> <i class="mdi mdi-list"></i> Input Parameters For New Permission ...</h6>
                </div>
                <div class="card-body">
                    <form id="permissionForm" action="{{ route('administration.authorization.permission.store') }}"
                        method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="module_id" class="form-label">Module</label>
                            <select class="form-control @error('module_id') is-invalid @enderror" data-trigger
                                name="module_id" id="module_id" placeholder="Select Module" required>
                                <option value="">Select Module</option>
                                @foreach ($modules as $module)
                                    <option value="{{ $module->id }}">{{ $module->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('module_id')" />
                        </div>
                        <div class="mb-3">
                            <label for="menu_id" class="form-label">Menu</label>
                            <select name="menu_id" id="menu_id" class="form-select @error('menu_id') is-invalid @enderror"
                                required placeholder="Select Menu">
                                <option value="">Select Menu</option>
                            </select>
                            <x-input-error :messages="$errors->get('menu_id')" />
                        </div>
                        <div class="mb-3">
                            <label for="permission" class="form-label">Permission</label>
                            <input class="form-control" id="permission" type="text" name="permission" required
                                value="View,Add,Edit,Delete" placeholder="Enter something" />
                        </div>
                        <div class="mb-3">
                            <label for="is_active" class="form-label">Is Active?</label>
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
                    <h6 class="modal-title" id="myModalLabel">Edit Permission</h6>
                    <button type="button" class="btn-close btn btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form id="editPermissionForm" action="#" method="POST">
                    <div class="modal-body">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Permission <span class="text-danger">*</span></label>
                            <input type="text"class="form-control @error('name') is-invalid @enderror" id="edit_name" name="name" required>
                            <x-input-error :messages="$errors->get('name')" />
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
            const table = $('#permissionTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('administration.authorization.permission.index') }}",
                    data: function(d) {
                        d.module_id = $('#filter_module_id').val();
                        d.menu_id = $('#filter_menu_id').val();
                    }
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
                        data: 'module_name',
                        name: 'module_name'
                    },
                    {
                        data: 'menu_name',
                        name: 'menu_name'
                    },
                    {
                        data: 'name',
                        name: 'name'
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

        $(document).on('click', '.edit-permission', function() {
            let id = $(this).data('id');

            let url = '{{ route('administration.authorization.permission.edit', ':id') }}';
            url = url.replace(':id', id);

            $.get(url, function(data) {
                console.log(data);
                $('#edit_name').val(data.name);
                $('#edit_is_active').val(data.is_active).change();
                $('#editModal').modal('show');
                $('#editPermissionForm').attr('action', "{{ route('administration.authorization.permission.update', ':id') }}".replace(':id', id));
            });
        });

        $(document).on('change', '.permission-toggle', function() {
            const id = $(this).data('id');
            const status = $(this).is(':checked') ? 1 : 0;
            $.ajax({
                url: '{{ route('administration.authorization.permission.toggle') }}',
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

        function loadChildMenus(moduleSelector, menuSelector) {
            const moduleId = $(moduleSelector).val();
            const menuSelect = $(menuSelector);

            if (moduleId) {
                $.ajax({
                    url: `/administration/menu/${moduleId}/childs`,
                    type: 'GET',
                    success: function(data) {
                        console.log(data);
                        menuSelect.empty().append('<option value="">Select Menu</option>');

                        if (data.length > 0) {
                            data.forEach(function(item) {
                                menuSelect.append(
                                    `<option value="${item.id}">${item.title}</option>`
                                );
                            });
                        }
                    },
                    error: function() {
                        toastr.error('Could not load menus');
                    }
                });
            } else {
                menuSelect.html('<option value="">Select Menu</option>');
            }
        }

        // Attach events
        $('#module_id').on('change', function() {
            loadChildMenus('#module_id', '#menu_id');
        });

        $('#filter_module_id').on('change', function() {
            loadChildMenus('#filter_module_id', '#filter_menu_id');
            $('#permissionTable').DataTable().ajax.reload();
        });

        $('#filter_menu_id').on('change', function() {
            $('#permissionTable').DataTable().ajax.reload();
        });

        $(document).on('click', '.delete-permission', function(e) {
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
                        url: '{{ route('administration.authorization.permission.delete') }}',
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
