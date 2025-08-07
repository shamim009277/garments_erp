@extends('layouts.app')
@section('title', 'INVENTORY')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'INVENTORY',
                'subtitle' => 'Colors',
                'breadcrumbs' => [
                    ['label' => 'INVENTORY', 'url' => route('inventory.index')],
                    ['label' => 'Setup', 'url' => route('inventory.index')],
                    ['label' => 'Color Groups', 'url' => route('inventory.setup.colorgroups.index')],
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
                            {{-- $table->id();
            $table->string('color_code', 20)->unique();
            $table->string('color_name', 100);
            $table->char('color_hex', 7)->nullable();
            $table->unsignedBigInteger('color_group_id');
            $table->foreign('color_group_id')
                ->references('id')
                ->on('inventory_setup_color_groups')
                ->onDelete('restrict');

            $table->boolean('is_active')->default(true);
            $table->timestamps(); --}}
                            <tr>
                                <th width="5%">#</th>
                                <th width="50%">Name</th>
                                <th width="50%">Group</th>
                                <th width="50%">Code</th>
                                <th width="5%">Status</th>
                                <th width="15%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($colors as $key => $color)
                                <tr>
                                    <td width="5%">{{ $key + 1 }}</td>
                                    <td width="50%">{{ $color->color_name }}</td>
                                    <td width="50%">
                                        @if ($color->colorGroup)
                                            {{ $color->colorGroup->group_name }}
                                        @endif
                                    </td>
                                    <td width="50%">{{ $color->color_code }}</td>
                                    <td class="text-center">
                                        <p class="text-{{ $color->is_active ? 'success' : 'danger' }}">
                                            {{ $color->is_active ? 'Active' : 'Inactive' }}</p>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-soft-success waves-effect waves-light"
                                            style="padding: 4px 6px;" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $color->id }}"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('inventory.setup.colors.destroy', $color->id) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            {{-- add confirm dialog --}}
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this store line?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                {{-- load edit modal --}}
                                <div class="modal fade" id="editModal{{ $color->id }}" tabindex="-1"
                                    aria-labelledby="editModalLabel{{ $color->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel{{ $color->id }}">Edit Color
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="moduleForm"
                                                    action="{{ route('inventory.setup.colors.update', $color->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <x-input-group name="color_name" label="Color Name"
                                                                placeholder="Enter color name"
                                                                :value="$color->color_name" required />
                                                        </div>
                                                        <div class="col-md-12">
                                                            <x-select-input-group name="color_group_id" label="Color Group"
                                                                :options="$colorGroups->pluck('group_name', 'id')" :selected="$color->color_group_id" required />
                                                        </div>
                                                        <div class="col-md-12">
                                                            <x-input-group name="color_code" label="Color Code"
                                                                placeholder="Enter color code"
                                                                :value="$color->color_code" required />
                                                        </div>
                                                        <div class="col-md-12">
                                                            <x-select-input-group name="is_active" label="Is Active?"
                                                                :options="['1' => 'Active', '0' => 'Inactive']" :selected="$color->is_active ? '1' : '0'" required />
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
                    <h6 class="my-0 text-primary"> <i class="mdi mdi-list"></i> Input Parameters For New Color ...
                    </h6>
                </div>
                <div class="card-body">
                    <form id="moduleForm" action="{{ route('inventory.setup.colors.store') }}" method="POST">
                        @csrf

                        <x-input-group name="color_name" label="Color Name" placeholder="Enter color name" :value="old('color_name')"
                            required />
                        <x-select-input-group name="color_group_id" label="Color Group" :options="$colorGroups->pluck('group_name', 'id')" :selected="old('color_group_id')" required />
                        <x-input-group name="color_code" label="Color Code" placeholder="Enter color code" :value="old('color_code')" required />   
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
            $('.division-toggle').on('change', function() {
                let id = $(this).data('id');
                let status = $(this).is(':checked') ? 1 : 0;
                $.ajax({
                    url: '{{ route('hris.setup.divisions.toggle') }}',
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

            $('.district-toggle').on('change', function() {
                let id = $(this).data('id');
                let status = $(this).is(':checked') ? 1 : 0;
                $.ajax({
                    url: '{{ route('hris.setup.districts.toggle') }}',
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

        $(document).on('click', '.delete-district', function(e) {
            e.preventDefault();
            let districtId = $(this).data('id');
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
                        url: '{{ route('hris.setup.districts.delete') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: districtId
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                'District has been deleted.',
                                'success'
                            );
                            $('#row-' + districtId).remove();
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
                        'District has not been deleted.',
                        'error'
                    );
                }
            });
        });
    </script>
@endpush
