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
                    <h6 class="my-0 text-primary">
                        <i class="mdi mdi-list"></i> Menu List
                    </h6>

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
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                                name="title" value="{{ old('title') }}" placeholder="Enter menu title" required>
                            <x-input-error :messages="$errors->get('title')" />
                        </div>
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
                            <label for="menu_type" class="form-label">Menu Type</label>
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
                            <select name="parent_id" class="form-select @error('parent_id') is-invalid @enderror" required
                                id="parent_id" placeholder="Select Parent Menu"></select>
                            <x-input-error :messages="$errors->get('parent_id')" />
                        </div>

                        <div class="mb-3">
                            <label for="url" class="form-label">URL</label>
                            <input type="text" class="form-control @error('url') is-invalid @enderror" id="url"
                                name="url" value="{{ old('url') }}" placeholder="Enter menu url" required>
                            <x-input-error :messages="$errors->get('url')" />
                        </div>

                        <div class="mb-3">
                            <label for="icon" class="form-label">Icon (Feather Icon)</label>
                            <input type="text" class="form-control @error('icon') is-invalid @enderror" id="icon"
                                name="icon" value="{{ old('icon') }}" placeholder="i.e chrome" required>
                            <x-input-error :messages="$errors->get('icon')" />
                        </div>

                        <div class="mb-3">
                            <label for="has_child" class="form-label">Has Child</label>
                            <select name="has_child" class="form-select @error('has_child') is-invalid @enderror" required
                                value="{{ old('has_child') }}" id="has_child" placeholder="Select Has Child" required>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                            <x-input-error :messages="$errors->get('has_child')" />
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
                        <x-primary-button class="float-start btn-md submitBtn">Save</x-primary-button>
                    </form>
                </div>
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
                        name: 'title'
                    },
                    {
                        data: 'slug',
                        name: 'slug'
                    },
                    {
                        data: 'module_name',
                        name: 'module.name'
                    },
                    {
                        data: 'parent_name',
                        name: 'parent.title'
                    },
                    {
                        data: 'url',
                        name: 'url'
                    },
                    {
                        data: 'is_active',
                        name: 'is_active',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'has_child',
                        name: 'has_child'
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
