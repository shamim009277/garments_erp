@extends('layouts.app')
@section('title', 'Administration')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'Administration',
                'subtitle' => 'Module',
                'breadcrumbs' => [
                    ['label' => 'Administration', 'url' => route('administration.index')],
                    ['label' => 'Module'],
                ],
            ])
        </div>
        <div class="col-md-8 pr-0">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Module List</h6>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Name</th>
                                <th>URL</th>
                                <th>Is Active</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($modules as $module)
                                <tr id="row-{{ $module->id }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td><a href="{{ url($module->url) }}" target="_blank" class="text-primary">{{ $module->name }}</a></td>
                                    <td>{{ $module->url }}</td>
                                    <td>
                                        <div class="square-switch">
                                            <input type="checkbox" id="square-switch3{{ $module->id }}"class="module-toggle" data-id="{{ $module->id }}" switch="bool" {{ $module->is_active ? 'checked' : '' }} />
                                            <label for="square-switch3{{ $module->id }}" data-on-label="Yes"data-off-label="No" style="margin: 0px; vertical-align: middle;"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-soft-success waves-effect waves-light" style="padding: 4px 6px;" data-bs-toggle="modal" data-bs-target="#editModal{{ $module->id }}"><i class="fas fa-edit"></i></a>
                                        <a href="#" class="btn btn-soft-danger waves-effect waves-light delete-module" data-id="{{ $module->id }}" style="padding: 4px 6px;"><i class="fas fa-trash"></i></a>
                                    </td>

                                    <div id="editModal{{ $module->id }}" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-bs-scroll="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title" id="myModalLabel">Edit Module</h6>
                                                    <button type="button" class="btn-close btn btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <form id="editForm{{ $module->id }}" action="{{ route('administration.module.update', $module->id) }}" method="POST">
                                                    <div class="modal-body">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Name</label>
                                                            <input
                                                                type="text"class="form-control @error('name') is-invalid @enderror"
                                                                id="name" name="name" value="{{ $module->name }}"
                                                                required>
                                                            <x-input-error :messages="$errors->get('name')" />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="url" class="form-label">URL</label>
                                                            <input
                                                                type="text"class="form-control @error('url') is-invalid @enderror"
                                                                id="url" name="url" value="{{ $module->url }}"
                                                                required>
                                                            <x-input-error :messages="$errors->get('url')" />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="is_active" class="form-label">Is Active?</label>
                                                            <select name="is_active"
                                                                class="form-control @error('is_active') is-invalid @enderror"
                                                                required value="{{ old('is_active') }}" id="is_active">
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
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card alert-info alert-top-border">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i class="mdi mdi-list"></i> Input Parameters For New Module ...</h6>
                </div>
                <div class="card-body">
                    <form id="moduleForm" action="{{ route('administration.module.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ old('name') }}" placeholder="Enter module name" required>
                            <x-input-error :messages="$errors->get('name')" />
                        </div>
                        <div class="mb-3">
                            <label for="url" class="form-label">URL</label>
                            <input type="text" class="form-control @error('url') is-invalid @enderror" id="url"
                                name="url" value="{{ old('url') }}" placeholder="Enter module url" required>
                            <x-input-error :messages="$errors->get('url')" />
                        </div>
                        <div class="mb-3">
                            <label for="is_active" class="form-label">Is Active?</label>
                            <select name="is_active" class="form-control @error('is_active') is-invalid @enderror"
                                required value="{{ old('is_active') }}" id="is_active">
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
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.module-toggle').on('change', function() {
                let id = $(this).data('id');
                let status = $(this).is(':checked') ? 1 : 0;
                $.ajax({
                    url: '{{ route('administration.module.toggle') }}',
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

        $(document).on('click', '.delete-module', function(e) {
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
                        url: '{{ route('administration.module.delete') }}',
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
