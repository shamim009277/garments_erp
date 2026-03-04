@extends('layouts.app')
@section('title', 'ORDER MANAGEMENT')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'ORDER MANAGEMENT',
                'subtitle' => 'Fabric Treatments',
                'breadcrumbs' => [
                    ['label' => 'ORDER MANAGEMENT', 'url' => route('ordermanagement.index')],
                    ['label' => 'Setup', 'url' => route('ordermanagement.index')],
                    ['label' => 'Fabric Treatments', 'url' => route('ordermanagement.setup.fabictreatments.index')],
                ],
            ])
        </div>
        <div class="col-md-8">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Fabric Treatments List
                    </h6>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100" width="100%">
                        <thead>
                            {{-- // $table->string('fabric_treatment_code', 20)->unique(); // Like FT001
                            // $table->string('fabric_treatment_name', 100);
                            // $table->string('fabric_treatment_description')->nullable();
                            // $table->boolean('is_active')->default(true); --}}
                            <tr>
                                <th>#</th>
                                <th>Fabric Treatment Code</th>
                                <th>Fabric Treatment Name</th>
                                <th>Fabric Treatment Description</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($fabricTreatments as $key => $fabricTreatment)
                                <tr id="row-{{ $fabricTreatment->id }}">
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $fabricTreatment->fabric_treatment_code }}</td>
                                    <td>{{ $fabricTreatment->fabric_treatment_name }}</td>
                                    <td>{{ $fabricTreatment->fabric_treatment_description }}</td>
                                    <td class="text-center">
                                        <div class="square-switch">
                                            <input type="checkbox" id="fabric-treatment-switch-{{ $fabricTreatment->id }}"
                                                class="fabric-treatment-toggle" data-id="{{ $fabricTreatment->id }}"
                                                switch="bool" {{ $fabricTreatment->is_active ? 'checked' : '' }} />
                                            <label for="fabric-treatment-switch-{{ $fabricTreatment->id }}"
                                                data-on-label="Yes" data-off-label="No"
                                                style="margin: 0px; vertical-align: middle;"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-soft-success waves-effect waves-light"
                                            style="padding: 4px 6px;" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $fabricTreatment->id }}"><i
                                                class="fas fa-edit"></i></a>
                                        <a href="#" class="btn btn-soft-danger waves-effect waves-light delete-fabric-treatment"
                                            data-id="{{ $fabricTreatment->id }}" style="padding: 4px 6px;"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                                {{-- load edit modal --}}
                                <div class="modal fade" id="editModal{{ $fabricTreatment->id }}" tabindex="-1"
                                    aria-labelledby="editModalLabel{{ $fabricTreatment->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel{{ $fabricTreatment->id }}">Edit
                                                    Fabric Treatment</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="moduleForm"
                                                    action="{{ route('ordermanagement.setup.fabictreatments.update', $fabricTreatment->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <x-input-group name="fabric_treatment_name" label="Fabric Treatment Name" :value="$fabricTreatment->fabric_treatment_name"
                                                        required />
                                                    <x-input-group name="fabric_treatment_description" label="Fabric Treatment Description" :value="$fabricTreatment->fabric_treatment_description"
                                                        required />
                                                    <x-select-input-group name="is_active" label="Is Active?"
                                                        :options="['1' => 'Active', '0' => 'Inactive']" :selected="$fabricTreatment->is_active ? '1' : '0'" required />
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
                    <h6 class="my-0 text-primary"> <i class="mdi mdi-list"></i> Input Parameters For New Fabric Treatment ...</h6>
                </div>
                <div class="card-body">
                    <form id="moduleForm" action="{{ route('ordermanagement.setup.fabictreatments.store') }}" method="POST">
                        @csrf
                        <x-input-group name="fabric_treatment_name" label="Fabric Treatment Name" placeholder="Enter fabric treatment name"
                            :value="old('fabric_treatment_name')" required />
                        <x-input-group name="fabric_treatment_description" label="Fabric Treatment Description" placeholder="Enter fabric treatment description"
                            :value="old('fabric_treatment_description')" required />
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
            $('.fabric-treatment-toggle').on('change', function() {
                let id = $(this).data('id');
                let status = $(this).is(':checked') ? 1 : 0;
                $.ajax({
                    url: '{{ route('ordermanagement.setup.fabictreatments.toggle') }}',
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

        $(document).on('click', '.delete-fabric-treatment', function(e) {
            e.preventDefault();
            let fabricTreatmentId = $(this).data('id');
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
                        url: '{{ route('ordermanagement.setup.fabictreatments.delete') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: fabricTreatmentId
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire(
                                    'Deleted!',
                                    response.message,
                                    'success'
                                );
                                $('#row-' + fabricTreatmentId).remove();
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
