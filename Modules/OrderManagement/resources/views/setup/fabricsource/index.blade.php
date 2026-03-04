@extends('layouts.app')
@section('title', 'ORDER MANAGEMENT')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'ORDER MANAGEMENT',
                'subtitle' => 'Fabric Source',
                'breadcrumbs' => [
                    ['label' => 'ORDER MANAGEMENT', 'url' => route('ordermanagement.index')],
                    ['label' => 'Setup', 'url' => route('ordermanagement.index')],
                    ['label' => 'Fabric Source', 'url' => route('ordermanagement.setup.fabricsources.index')],
                ],
            ])
        </div>
        <div class="col-md-8">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Fabric Source List
                    </h6>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Fabric Source Code</th>
                                <th>Fabric Source Name</th>
                                <th>Fabric Source Description</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($fabricSources as $key => $fabricSource)
                                <tr id="row-{{ $fabricSource->id }}">
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $fabricSource->fabric_source_code }}</td>
                                    <td>{{ $fabricSource->fabric_source_name }}</td>
                                    <td>{{ $fabricSource->fabric_source_description }}</td>
                                    <td>{{ $fabricSource->is_active ? 'Active' : 'Inactive' }}</td>
                                    <td>
                                        <a href="#" class="btn btn-soft-success waves-effect waves-light"
                                            style="padding: 4px 6px;" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $fabricSource->id }}"><i
                                                class="fas fa-edit"></i></a>
                                        <button type="button" class="btn btn-sm btn-danger delete-item" data-id="{{ $fabricSource->id }}">Delete</button>
                                    </td>
                                </tr>
                                {{-- load edit modal --}}
                                <div class="modal fade" id="editModal{{ $fabricSource->id }}" tabindex="-1"
                                    aria-labelledby="editModalLabel{{ $fabricSource->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel{{ $fabricSource->id }}">Edit
                                                    Fabric Source</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="moduleForm"
                                                    action="{{ route('ordermanagement.setup.fabricsources.update', $fabricSource->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <x-input-group name="fabric_source_name" label="Fabric Source Name"
                                                        :value="$fabricSource->fabric_source_name" required />
                                                    <x-input-group name="fabric_source_description"
                                                        label="Fabric Source Description" :value="$fabricSource->fabric_source_description" required />
                                                    <x-select-input-group name="is_active" label="Is Active?"
                                                        :options="['1' => 'Active', '0' => 'Inactive']" :selected="$fabricSource->is_active ? '1' : '0'" required />
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
                    <h6 class="my-0 text-primary"> <i class="mdi mdi-list"></i> Input Parameters For New Fabric Source
                    </h6>
                </div>
                <div class="card-body">
                    <form id="moduleForm" action="{{ route('ordermanagement.setup.fabricsources.store') }}" method="POST">
                        @csrf
                        <x-input-group name="fabric_source_name" label="Fabric Source Name" placeholder="Enter fabric source name"
                            :value="old('fabric_source_name')" required />
                        <x-input-group name="fabric_source_description" label="Fabric Source Description"
                            placeholder="Enter fabric source description" :value="old('fabric_source_description')" required />
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
            // Add toggle status logic if needed, similar to fabric types
        });

        $(document).on('click', '.delete-item', function(e) {
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
                        url: '{{ route("ordermanagement.setup.fabricsources.destroy", ":id") }}'.replace(':id', id),
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            _method: 'DELETE'
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
                        error: function(xhr, status, error) {
                            Swal.fire(
                                'Error!',
                                'Something went wrong!',
                                'error'
                            );
                        }
                    });
                }
            });
        });
    </script>
@endpush
