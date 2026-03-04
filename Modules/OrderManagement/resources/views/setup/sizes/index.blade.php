@extends('layouts.app')
@section('title', 'ORDER MANAGEMENT')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'ORDER MANAGEMENT',
                'subtitle' => 'Sizes',
                'breadcrumbs' => [
                    ['label' => 'ORDER MANAGEMENT', 'url' => route('ordermanagement.index')],
                    ['label' => 'Setup', 'url' => route('ordermanagement.index')],
                    ['label' => 'Sizes', 'url' => route('ordermanagement.setup.sizes.index')],
                ],
            ])
        </div>
        <div class="col-md-8">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Colors List
                    </h6>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100" width="100%">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th width="50%">Name</th>
                                <th width="15%">Group</th>
                                <th width="10%">Rank</th>
                                <th width="5%">Status</th>
                                <th width="15%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sizes as $key => $size)
                                <tr id="row-{{ $size->id }}">
                                    <td width="5%">{{ $key + 1 }}</td>
                                    <td width="50%">{{ $size->size_name }}</td>
                                    <td width="15%">
                                        @if ($size->sizeGroup)
                                            {{ $size->sizeGroup->size_group_name }}
                                        @endif
                                    </td>
                                    <td width="10%">{{ $size->size_rank }}</td>
                                    <td class="text-center">
                                        <div class="square-switch">
                                            <input type="checkbox" id="size-switch-{{ $size->id }}"
                                                class="size-toggle" data-id="{{ $size->id }}"
                                                switch="bool" {{ $size->is_active ? 'checked' : '' }} />
                                            <label for="size-switch-{{ $size->id }}" data-on-label="Yes"
                                                data-off-label="No" style="margin: 0px; vertical-align: middle;"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-soft-success waves-effect waves-light"
                                            style="padding: 4px 6px;" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $size->id }}"><i class="fas fa-edit"></i></a>
                                        <a href="#" class="btn btn-soft-danger waves-effect waves-light delete-size"
                                            data-id="{{ $size->id }}" style="padding: 4px 6px;"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                                {{-- load edit modal --}}
                                <div class="modal fade" id="editModal{{ $size->id }}" tabindex="-1"
                                    aria-labelledby="editModalLabel{{ $size->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel{{ $size->id }}">Edit Size
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="moduleForm"
                                                    action="{{ route('ordermanagement.setup.sizes.update', $size->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <x-input-group name="size_name" label="Size Name"
                                                                placeholder="Enter size name" :value="$size->size_name" required />
                                                        </div>
                                                        <div class="col-md-12">
                                                            <x-select-input-group name="size_group_id" label="Size Group"
                                                                :options="$sizeGroups->pluck('size_group_name', 'id')" :selected="$size->size_group_id" required />
                                                        </div>
                                                        <div class="col-md-12">
                                                            <x-input-group name="size_rank" label="Size Rank"
                                                                placeholder="Enter size rank" :value="$size->size_rank" required />
                                                        </div>
                                                        <div class="col-md-12">
                                                            <x-select-input-group name="is_active" label="Is Active?"
                                                                :options="['1' => 'Active', '0' => 'Inactive']" :selected="$size->is_active ? '1' : '0'" required />
                                                        </div>
                                                    </div>
                                                    <x-primary-button
                                                        class="float-start btn-sm submitBtn">Save</x-primary-button>
                                                </form>
                                            </div>
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
                    <h6 class="my-0 text-primary"> <i class="mdi mdi-list"></i> Input Parameters For New Size ...
                    </h6>
                </div>
                <div class="card-body">
                    <form id="moduleForm" action="{{ route('ordermanagement.setup.sizes.store') }}" method="POST">
                        @csrf

                        <x-input-group name="size_name" label="Size Name" placeholder="Enter size name" :value="old('size_name')"
                            required />

                        <x-select-input-group name="size_group_id" label="Size Group" :options="$sizeGroups->pluck('size_group_name', 'id')" :selected="old('size_group_id')"
                            required />
                        <x-input-group name="size_rank" label="Size Rank" placeholder="Enter size rank" :value="old('size_rank')"
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
        $(document).on('change', '.size-toggle', function() {
            let id = $(this).data('id');
            let status = $(this).is(':checked') ? 1 : 0;

            $.ajax({
                url: '{{ route('ordermanagement.setup.sizes.toggle') }}',
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

        $(document).on('click', '.delete-size', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
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
                        url: '{{ route('ordermanagement.setup.sizes.destroy', ':id') }}'.replace(':id', id),
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}',
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire(
                                    'Deleted!',
                                    response.message,
                                    'success'
                                );
                                $('#row-' + id).remove();
                            } else {
                                Swal.fire(
                                    'Error!',
                                    response.message,
                                    'error'
                                );
                            }
                        },
                        error: function() {
                            Swal.fire(
                                'Error!',
                                'Something went wrong.',
                                'error'
                            );
                        }
                    });
                }
            });
        });
    </script>
@endpush
