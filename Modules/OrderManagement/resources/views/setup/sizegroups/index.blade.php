@extends('layouts.app')
@section('title', 'ORDER MANAGEMENT')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'ORDER MANAGEMENT',
                'subtitle' => 'Size Groups',
                'breadcrumbs' => [
                    ['label' => 'ORDER MANAGEMENT', 'url' => route('ordermanagement.index')],
                    ['label' => 'Setup', 'url' => route('ordermanagement.index')],
                    ['label' => 'Size Groups', 'url' => route('ordermanagement.setup.sizegroups.index')],
                ],
            ])
        </div>
        <div class="col-md-8">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Size Groups List
                    </h6>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100" width="100%">
                        <thead>
                            {{-- $table->string('group_code', 20)->unique();
                            $table->string('group_name', 100);
                            $table->boolean('is_active')->default(true); --}}
                            <tr>
                                <th width="5%">#</th>
                                <th width="50%">Name</th>
                                <th width="50%">Code</th>
                                <th width="5%">Status</th>
                                <th width="15%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sizeGroups as $key => $sizeGroup)
                                <tr id="row-{{ $sizeGroup->id }}">
                                    <td width="5%">{{ $key + 1 }}</td>
                                    <td width="50%">{{ $sizeGroup->size_group_name }}</td>
                                    <td width="50%">{{ $sizeGroup->size_group_code }}</td>
                                    <td class="text-center">
                                        <div class="square-switch">
                                            <input type="checkbox" id="sizegroup-switch-{{ $sizeGroup->id }}"
                                                class="sizegroup-toggle" data-id="{{ $sizeGroup->id }}"
                                                switch="bool" {{ $sizeGroup->is_active ? 'checked' : '' }} />
                                            <label for="sizegroup-switch-{{ $sizeGroup->id }}" data-on-label="Yes"
                                                data-off-label="No" style="margin: 0px; vertical-align: middle;"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-soft-success waves-effect waves-light"
                                            style="padding: 4px 6px;" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $sizeGroup->id }}"><i class="fas fa-edit"></i></a>
                                        <a href="#" class="btn btn-soft-danger waves-effect waves-light delete-sizegroup"
                                            data-id="{{ $sizeGroup->id }}" style="padding: 4px 6px;"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                                {{-- load edit modal --}}
                                <div class="modal fade" id="editModal{{ $sizeGroup->id }}" tabindex="-1"
                                    aria-labelledby="editModalLabel{{ $sizeGroup->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel{{ $sizeGroup->id }}">Edit Size
                                                    Group
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="moduleForm"
                                                    action="{{ route('ordermanagement.setup.sizegroups.update', $sizeGroup->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <x-input-group name="size_group_name" label="Size Group Name"
                                                                :value="$sizeGroup->size_group_name" required />
                                                        </div>
                                                        <div class="col-md-12">
                                                            <x-select-input-group name="is_active" label="Is Active?"
                                                                :options="['1' => 'Active', '0' => 'Inactive']" :selected="$sizeGroup->is_active ? '1' : '0'" required />
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
                    <h6 class="my-0 text-primary"> <i class="mdi mdi-list"></i> Input Parameters For New Size Group ...
                    </h6>
                </div>
                <div class="card-body">
                    <form id="moduleForm" action="{{ route('ordermanagement.setup.sizegroups.store') }}" method="POST">
                        @csrf

                        <x-input-group name="size_group_name" label="Size Group Name" placeholder="Enter size group name" :value="old('size_group_name')"
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
        $(document).on('change', '.sizegroup-toggle', function() {
            let id = $(this).data('id');
            let status = $(this).is(':checked') ? 1 : 0;

            $.ajax({
                url: '{{ route('ordermanagement.setup.sizegroups.toggle') }}',
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

        $(document).on('click', '.delete-sizegroup', function(e) {
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
                        url: '{{ route('ordermanagement.setup.sizegroups.destroy', ':id') }}'.replace(':id', id),
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
