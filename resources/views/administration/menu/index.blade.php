@extends('layouts.app')
@section('title', 'Administration')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'Administration',
                'subtitle' => 'Menu',
                'breadcrumbs' => [
                    ['label' => 'Administration', 'url' => route('administration.index')],
                    ['label' => 'Menu'],
                ],
            ])
        </div>
        <div class="col-md-8">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2"
                    style="padding: 14px 10px !important">
                    <h6 class="my-0 text-primary"><i class="mdi mdi-list"></i>Menu List</h6>

                    <div class="filter-select">
                        <select class="form-select form-select-sm" id="filter_module_id" style="min-width: 200px;">
                            <option value="">All Modules</option>
                            @foreach ($modules as $module)
                                <option value="{{ $module->id }}">{{ $module->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="card-body">
                    <table id="menuTable" class="table table-bordered dt-responsive  nowrap w-100">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Slug</th>
                                <th>Module</th>
                                <th>Parent</th>
                                <th>URL</th>
                                <th>Is Active</th>
                                <th>Has Child</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card alert-info alert-top-border">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i class="mdi mdi-list"></i> Input Parameters For New Menu ...</h6>
                </div>
                <div class="card-body">
                    <form id="menuForm" action="{{ route('administration.menu.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                                name="title" value="{{ old('title') }}" placeholder="Enter menu title" required>
                            <x-input-error :messages="$errors->get('title')" />
                        </div>
                        <div class="mb-3">
                            <label for="module_id" class="form-label">Module <span class="text-danger">*</span></label>
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
                            <label for="menu_type" class="form-label">Menu Type <span class="text-danger">*</span></label>
                            <select name="menu_type" class="form-select @error('menu_type') is-invalid @enderror" required
                                value="{{ old('menu_type') }}" id="menu_type" placeholder="Select Menu Type" required>
                                <option value="">Select Menu Type</option>
                                <option value="1">Main Menu</option>
                                <option value="2">Sub Menu</option>
                            </select>
                            <x-input-error :messages="$errors->get('menu_type')" />
                        </div>

                        <div class="mb-3">
                            <label for="parent_id" class="form-label">Parent Menu</label>
                            <select name="parent_id" class="form-select @error('parent_id') is-invalid @enderror" required id="parent_id" placeholder="Select Parent Menu">
                                <option value="">Select Parent Menu</option>
                            </select>
                            <x-input-error :messages="$errors->get('parent_id')" />
                        </div>

                        <div class="mb-3">
                            <label for="url" class="form-label">URL <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('url') is-invalid @enderror" id="url"
                                name="url" value="{{ old('url') }}" placeholder="Enter menu url" required>
                            <x-input-error :messages="$errors->get('url')" />
                        </div>

                        <div class="mb-3">
                            <label for="icon" class="form-label">Icon (Feather Icon) <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('icon') is-invalid @enderror" id="icon"
                                name="icon" value="{{ old('icon') }}" placeholder="i.e chrome" required>
                            <x-input-error :messages="$errors->get('icon')" />
                        </div>

                        <div class="mb-3">
                            <label for="has_child" class="form-label">Has Child <span class="text-danger">*</span></label>
                            <select name="has_child" class="form-select @error('has_child') is-invalid @enderror" required
                                value="{{ old('has_child') }}" id="has_child" placeholder="Select Has Child" required>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                            <x-input-error :messages="$errors->get('has_child')" />
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
                        <x-primary-button class="float-start btn-md submitBtn">Save</x-primary-button>
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
                    <h6 class="modal-title" id="myModalLabel">Edit Menu</h6>
                    <button type="button" class="btn-close btn btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form id="editMenuForm" action="#" method="POST">
                    <div class="modal-body">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                            <input type="text"class="form-control @error('title') is-invalid @enderror" id="edit_title" name="title" required>
                            <x-input-error :messages="$errors->get('title')" />
                        </div>
                        <div class="mb-3">
                            <label for="module_id" class="form-label">Module <span class="text-danger">*</span></label>
                            <select name="module_id" class="form-select @error('module_id') is-invalid @enderror" value="{{ old('module_id') }}" id="edit_module_id" placeholder="Select Module" required disabled>
                                <option value="">Select Module</option>
                                @foreach ($modules as $module)
                                    <option value="{{ $module->id }}">{{ $module->name }}</option>
                                @endforeach
                            </select>
                            <input type="hidden" name="module_id" id="hidden_edit_module_id">
                            <x-input-error :messages="$errors->get('module_id')" />
                        </div>
                        <div class="mb-3">
                            <label for="menu_type" class="form-label">Menu Type <span class="text-danger">*</span></label>
                            <select name="menu_type" class="form-select @error('menu_type') is-invalid @enderror" value="{{ old('menu_type') }}" id="edit_menu_type" placeholder="Select Menu Type" required>
                                <option value="">Select Menu Type</option>
                                <option value="1">Main Menu</option>
                                <option value="2">Sub Menu</option>
                            </select>
                            <x-input-error :messages="$errors->get('menu_type')" />
                        </div>
                        <div class="mb-3">
                            <label for="parent_id" class="form-label">Parent</label>
                            <select name="parent_id" class="form-select @error('parent_id') is-invalid @enderror" value="{{ old('parent_id') }}" id="edit_parent_id" placeholder="Select Parent">
                                <option value="">Select Parent</option>
                            </select>
                            <x-input-error :messages="$errors->get('parent_id')" />
                        </div>
                        <div class="mb-3">
                            <label for="url" class="form-label">URL <span class="text-danger">*</span></label>
                            <input type="text"class="form-control @error('url') is-invalid @enderror" id="edit_url"
                                name="url" required>
                            <x-input-error :messages="$errors->get('url')" />
                        </div>
                        <div class="mb-3">
                            <label for="icon" class="form-label">Icon <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('icon') is-invalid @enderror"
                                id="edit_icon" name="icon" required value="{{ old('icon') }}"
                                placeholder="Enter icon">
                            <x-input-error :messages="$errors->get('icon')" />
                        </div>
                        <div class="mb-3">
                            <label for="has_child" class="form-label">Has Child <span class="text-danger">*</span></label>
                            <select name="has_child" id="edit_has_child" class="form-select @error('has_child') is-invalid @enderror" value="{{ old('has_child') }}" id="edit_has_child" placeholder="Select Has Child" required>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                            <x-input-error :messages="$errors->get('has_child')" />
                        </div>
                        <div class="mb-3">
                            <label for="is_active" class="form-label">Is Active? <span class="text-danger">*</span></label>
                            <select name="is_active" id="edit_is_active" class="form-select @error('is_active') is-invalid @enderror" value="{{ old('is_active') }}" id="edit_is_active" required>
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
        $(function() {
            const table = $('#menuTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('administration.menu.index') }}",
                    data: function(d) {
                        d.module_id = $('#filter_module_id').val();
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
                        data: 'title',
                        name: 'menus.title'
                    },
                    {
                        data: 'slug',
                        name: 'menus.slug'
                    },
                    {
                        data: 'module_name',
                        name: 'module_name'
                    },
                    {
                        data: 'parent_name',
                        name: 'parent_name'
                    },
                    {
                        data: 'url',
                        name: 'menus.url'
                    },
                    {
                        data: 'is_active',
                        name: 'menus.is_active',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'has_child',
                        name: 'menus.has_child'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            // Filter action
            $('#filter_module_id').on('change', function() {
                table.ajax.reload();
            });

            $(document).on('click', '.edit-menu', function() {
                let id = $(this).data('id');
                let url = '{{ route('administration.menu.edit', ':id') }}';
                url = url.replace(':id', id);

                $.get(url, function(data) {
                    if(data.parent){
                        const parentSelect = $('#edit_parent_id');
                        parentSelect.empty();
                        parentSelect.append('<option value="">Select Parent Menu</option>');
                        parentSelect.append(`<option value="${data.parent.id}" selected>${data.parent.title}</option>`);
                    }

                    $('#edit_title').val(data.menu.title);
                    $('#hidden_edit_module_id').val(data.menu.module_id);
                    $('#edit_menu_type').val(data.menu.menu_type);
                    $('#edit_is_active').val(data.menu.is_active);
                    $('#edit_has_child').val(data.menu.has_child);
                    $('#edit_url').val(data.menu.url);
                    $('#edit_icon').val(data.menu.icon);
                    $('#editModal').modal('show');
                    $('#editMenuForm').attr('action', "{{ route('administration.menu.update', ':id') }}".replace(':id', id));
                });
            });

            $(document).on('change', '.menu-toggle', function() {
                const id = $(this).data('id');
                const status = $(this).is(':checked') ? 1 : 0;
                $.ajax({
                    url: '{{ route('administration.menu.toggle') }}',
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

            function toggleParentRequired() {
                const menuType = $('#menu_type').val();
                if (menuType === '2') {
                    $('#parent_id').attr('required', true);
                } else {
                    $('#parent_id').removeAttr('required');
                }
            }

            // Initial check
            toggleParentRequired();
            $('#menu_type').on('change', toggleParentRequired);


            $(document).on('click', '.delete-menu', function(e) {
                e.preventDefault();
                const menuId = $(this).data('id');
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
                            url: '{{ route('administration.menu.delete') }}',
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                id: menuId
                            },
                            success: function(response) {
                                Swal.fire('Deleted!', response.message ??
                                    'Menu deleted.', 'success');
                                table.ajax.reload(null, false);
                            },
                            error: function() {
                                Swal.fire('Error!', 'Something went wrong.', 'error');
                            }
                        });
                    }
                });
            });

            $('#module_id').on('change', function() {
                const moduleId = $(this).val();
                if (moduleId) {
                    $.ajax({
                        url: `/administration/menu/${moduleId}/parents`,
                        type: 'GET',
                        success: function(data) {
                            const parentSelect = $('#parent_id');
                            parentSelect.empty();
                            parentSelect.append('<option value="">Select Parent Menu</option>');

                            if (data.length > 0) {
                                data.forEach(function(item) {
                                    parentSelect.append(
                                        `<option value="${item.id}">${item.title}</option>`
                                    );
                                });
                            }
                        },
                        error: function() {
                            toastr.error('Could not load parent menus');
                        }
                    });
                } else {
                    $('#parent_id').html('<option value="">Select Parent Menu</option>');
                }
            });
        });
    </script>
@endpush
