@extends('layouts.app')
@section('title', 'INVENTORY')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'INVENTORY',
                'subtitle' => 'Buyers',
                'breadcrumbs' => [
                    ['label' => 'INVENTORY', 'url' => route('inventory.index')],
                    ['label' => 'Setup', 'url' => route('inventory.index')],
                    ['label' => 'Buyers', 'url' => route('inventory.setup.buyers.index')],
                ],
            ])
        </div>
        <div class="col-md-8">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Buyers List</h6>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100" width="100%">
                        <thead>
                                {{-- $table->string('buyer_name')->unique();
                                $table->string('country')->nullable();
                                $table->string('email')->nullable();
                                $table->string('phone')->nullable();
                                $table->string('address')->nullable();
                                $table->string('status')->default('active');
                                $table->string('created_by')->nullable();
                                $table->string('updated_by')->nullable(); --}}
                            <tr>
                                <th>#</th>
                                <th>Buyer Name</th>
                                <th>Country</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($buyers as $key => $buyer)
                                <tr id="row-{{ $buyer->id }}">
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $buyer->buyer_name }}</td>
                                    <td>{{ $buyer->country }}</td>
                                    <td>{{ $buyer->email }}</td>
                                    <td>{{ $buyer->phone }}</td>
                                    <td>{{ $buyer->address }}</td>
                                    <td class="text-center">
                                        <p class="text-{{ $buyer->is_active ? 'success' : 'danger' }}">{{ $buyer->is_active ? 'Active' : 'Inactive' }}</p>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-soft-success waves-effect waves-light" style="padding: 4px 6px;" data-bs-toggle="modal" data-bs-target="#editModal{{ $buyer->id }}"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('inventory.setup.buyers.destroy', $buyer->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            {{-- add confirm dialog --}}
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this buyer?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                {{-- load edit modal --}}
                                <div class="modal fade" id="editModal{{ $buyer->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $buyer->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel{{ $buyer->id }}">Edit Buyer</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="editForm{{ $buyer->id }}" action="{{ route('inventory.setup.buyers.update', $buyer->id) }}" method="POST">
                                                    <div class="modal-body">
                                                    @csrf
                                                    @method('PUT')
                                                    <x-input-group name="buyer_name" label="Buyer Name" :value="$buyer->buyer_name" required />
                                                    <x-input-group name="country" label="Country" :value="$buyer->country" required />
                                                    <x-input-group name="email" label="Email" :value="$buyer->email" required />
                                                    <x-input-group name="phone" label="Phone" :value="$buyer->phone" required />
                                                    <x-input-group name="address" label="Address" :value="$buyer->address" required />
                                                    <x-select-input-group
                                                        name="is_active"
                                                        label="Is Active?"
                                                        :options="['1' => 'Active', '0' => 'Inactive']"
                                                        :selected="$buyer->is_active ? '1' : '0'"
                                                        required
                                                    />
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary waves-effect btn-sm" data-bs-dismiss="modal">Close</button>
                                                        <x-primary-button id="submitBtn" class="float-start btn-sm submitBtn">Save changes</x-primary-button>
                                                    </div>
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
                    <h6 class="my-0 text-primary"> <i class="mdi mdi-list"></i> Input Parameters For New District ...</h6>
                </div>
                <div class="card-body">
                    <form id="moduleForm" action="{{ route('inventory.setup.buyers.store') }}" method="POST">
                        @csrf
                        <x-input-group name="buyer_name" label="Buyer Name" placeholder="Enter buyer name" :value="old('buyer_name')" required />
                        <x-input-group name="country" label="Country" placeholder="Enter country" :value="old('country')" required />
                        <x-input-group name="email" label="Email" placeholder="Enter email" :value="old('email')" required />
                        <x-input-group name="phone" label="Phone" placeholder="Enter phone" :value="old('phone')" required />
                        <x-input-group name="address" label="Address" placeholder="Enter address" :value="old('address')" required />
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
