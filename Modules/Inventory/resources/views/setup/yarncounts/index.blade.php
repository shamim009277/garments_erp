@extends('layouts.app')
@section('title', 'INVENTORY')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'INVENTORY',
                'subtitle' => 'Challan Purposes',
                'breadcrumbs' => [
                    ['label' => 'INVENTORY', 'url' => route('inventory.index')],
                    ['label' => 'Setup', 'url' => route('inventory.index')],
                    ['label' => 'Challan Purposes', 'url' => route('inventory.setup.challanpurposes.index')],
                ],
            ])
        </div>
        <div class="col-md-8">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Challan Purposes List
                    </h6>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100" width="100%">
                        <thead>
                            {{-- $table->string('purpose_name', 100)->unique();   // e.g., Purchase Receipt
                            $table->string('description')->nullable();       // Optional description
                            $table->boolean('is_active')->default(true); --}}
                            <tr>
                                <th>#</th>
                                <th>Purpose Name</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($challanpurposes as $key => $challanpurpose)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $challanpurpose->purpose_name }}</td>
                                    <td>{{ $challanpurpose->description }}</td>
                                    <td>{{ $challanpurpose->is_active ? 'Active' : 'Inactive' }}</td>
                                    <td>
                                        <a href="#" class="btn btn-soft-success waves-effect waves-light"
                                            style="padding: 4px 6px;" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $challanpurpose->id }}"><i
                                                class="fas fa-edit"></i></a>
                                        <form
                                            action="{{ route('inventory.setup.challanpurposes.destroy', $challanpurpose->id) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            {{-- add confirm dialog --}}
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this challan purpose?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                {{-- load edit modal --}}
                                <div class="modal fade" id="editModal{{ $challanpurpose->id }}" tabindex="-1"
                                    aria-labelledby="editModalLabel{{ $challanpurpose->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel{{ $challanpurpose->id }}">Edit
                                                    Challan Purpose</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="moduleForm"
                                                    action="{{ route('inventory.setup.challanpurposes.update', $challanpurpose->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')

                                                    <x-input-group name="purpose_name" label="Purpose Name"
                                                        :value="$challanpurpose->purpose_name" required />
                                                    <x-input-group name="description" label="Description" :value="$challanpurpose->description"
                                                        required />
                                                    <x-select-input-group name="is_active" label="Is Active?"
                                                        :options="['1' => 'Active', '0' => 'Inactive']" :selected="$challanpurpose->is_active ? '1' : '0'" required />
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
                    <h6 class="my-0 text-primary"> <i class="mdi mdi-list"></i> Input Parameters For New Challan Purpose ...</h6>
                </div>
                <div class="card-body">
                    <form id="moduleForm" action="{{ route('inventory.setup.challanpurposes.store') }}" method="POST">
                        @csrf

                        <x-input-group name="purpose_name" label="Purpose Name" placeholder="Enter purpose name"
                            :value="old('purpose_name')" required />
                        <x-input-group name="description" label="Description" placeholder="Enter description"
                            :value="old('description')" required />
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
