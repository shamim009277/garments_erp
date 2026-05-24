@extends('layouts.app')
@section('title', 'IPE')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'IPE',
                'subtitle' => 'Machine Type List',
                'breadcrumbs' => [
                    ['label' => 'IPE', 'url' => route('ipe.index')],
                    ['label' => 'Setup', 'url' => route('ipe.index')],
                    ['label' => 'Machine Type', 'url' => route('ipe.setup.machine-types.index')],
                ],
            ])
        </div>
        <div class="col-lg-8 pe-lg-0">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Machine Type List</h6>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100" width="100%">
                        <thead>
                            <tr>
                                <th width="5%">SL</th>
                                <th width="35%">Machine</th>
                                <th width="30%">Machine Bangla</th>
                                <th width="15%">Is Active</th>
                                <th width="15%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($types as $key => $type)
                                <tr id="row-{{ $type->id }}">
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $type->name }}</td>
                                    <td>{{ $type->name_bn }}</td>
                                    <td>
                                        <div class="square-switch">
                                            <input type="checkbox" id="square-switch3{{ $type->id }}" class="degree-toggle" data-id="{{ $type->id }}" switch="bool" {{ $type->is_active ? 'checked' : '' }} />
                                            <label for="square-switch3{{ $type->id }}" data-on-label="Yes" data-off-label="No" style="margin: 0px; vertical-align: middle;"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-soft-success waves-effect waves-light" style="padding: 4px 6px;" data-bs-toggle="modal" data-bs-target="#editModal{{ $type->id }}"><i class="fas fa-edit"></i></a>
                                        <a href="#" class="btn btn-soft-danger waves-effect waves-light delete-degree" data-id="{{ $type->id }}" style="padding: 4px 6px;"><i class="fas fa-trash"></i></a>
                                    </td>
                                    <div id="editModal{{ $type->id }}" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-bs-scroll="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title" id="myModalLabel">Edit Machine Type</h6>
                                                    <button type="button" class="btn-close btn btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <form id="editForm{{ $type->id }}" action="{{ route('ipe.setup.machine-types.update', $type->id) }}" method="POST">
                                                    <div class="modal-body">
                                                        @csrf
                                                        @method('PUT')
                                                        <x-input-group name="name" label="Machine Type" type="text" placeholder="Enter machine type" :value="$type->name" required />
                                                        <x-input-group name="name_bn" label="Degree Bangla" type="text" placeholder="Enter machine type bangla" :value="$type->name_bn" />
                                                        <x-select-input-group name="is_active" label="Is Active" :options="['1' => 'Active', '0' => 'Inactive']" :selected="$type->is_active" required />
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
                    <h6 class="my-0 text-primary"> <i class="mdi mdi-list"></i> Input Parameters For New Machine Type ...</h6>
                </div>
                <div class="card-body">
                    <form id="moduleForm" action="{{ route('ipe.setup.machine-types.store') }}" method="POST">
                        @csrf
                        <x-input-group name="name" label="Machine Type" type="text" placeholder="Enter machine type" :value="old('name')" required />
                        <x-input-group name="name_bn" label="Machine Type Bangla" type="text" placeholder="Enter machine type bangla" :value="old('name_bn')" />
                        <x-select-input-group
                            name="is_active"
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
            $('.degree-toggle').on('change', function() {
                let id = $(this).data('id');
                let status = $(this).is(':checked') ? 1 : 0;
                $.ajax({
                    url: '{{ route('ipe.setup.machine-types.toggle') }}',
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

        $(document).on('click', '.delete-degree', function(e) {
            e.preventDefault();
            let degreeId = $(this).data('id');
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
                        url: '{{ route('ipe.setup.machine-types.delete') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: degreeId
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                'Degree has been deleted.',
                                'success'
                            );
                            $('#row-' + degreeId).remove();
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
                        'Degree has not been deleted.',
                        'error'
                    );
                }
            });
        });
    </script>
@endpush
