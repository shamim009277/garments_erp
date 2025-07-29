@extends('layouts.app')
@section('title', 'INVENTORY')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'INVENTORY',
                'subtitle' => 'Store Locations',
                'breadcrumbs' => [
                    ['label' => 'INVENTORY', 'url' => route('inventory.index')],
                    ['label' => 'Setup', 'url' => route('inventory.index')],
                    ['label' => 'Store Locations', 'url' => route('inventory.setup.storelocations.index')],
                ],
            ])
        </div>
        <div class="col-md-8">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Store Locations
                        List
                    </h6>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100" width="100%">
                        <thead>
                            {{-- // $table->string('name', 100);
                            // $table->string('store_code', 50)->unique();
                            // $table->string('address_line_1');
                            // $table->string('address_line_2')->nullable();
                            // $table->string('city', 100);
                            // $table->string('state', 100)->nullable();
                            // $table->string('zip_code', 20)->nullable();
                            // $table->string('country', 100);
                            // $table->string('store_size', 20)->nullable();
                            // $table->unsignedBigInteger('store_type_id');
                            // $table->unsignedBigInteger('organization_id');
                            // $table->string('owner_id', 50)->nullable();
                            // $table->string('owner_name', 100)->nullable();
                            // $table->decimal('latitude', 10, 8)->nullable();
                            // $table->decimal('longitude', 11, 8)->nullable();
                            // $table->string('contact_person', 100)->nullable();
                            // $table->string('phone', 20)->nullable();
                            // $table->string('email', 100)->nullable();
                            // $table->boolean('is_active')->default(true);
                            // $table->unsignedBigInteger('created_by')->nullable();
                            // $table->unsignedBigInteger('updated_by')->nullable();
                            // // foreign key
                            // $table->foreign('store_type_id')
                            //       ->references('id')->on('inventory_setup_storetype')
                            //       ->onDelete('cascade');
                            // $table->foreign('organization_id')
                            //       ->references('id')->on('hris_setup_organizations')
                            //       ->onDelete('cascade');            
                            // $table->timestamps(); --}}
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Store Code</th>
                                <th>Address Line 1</th>
                                <th>Country</th>
                                <th>Store Size</th>
                                <th>Store Type</th>
                                <th>Organization</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($storelocations as $key => $storelocation)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $storelocation->name }}</td>
                                    <td>{{ $storelocation->store_code }}</td>
                                    <td>{{ $storelocation->address_line_1 }}</td>
                                    <td>{{ $storelocation->country }}</td>
                                    <td>{{ $storelocation->store_size }}</td>
                                    <td>
                                        @foreach ($storetypes as $storetype)
                                            @if ($storetype->id == $storelocation->store_type_id)
                                                {{ $storetype->name }}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($organizations as $organization)
                                            @if ($organization->id == $storelocation->organization_id)
                                                {{ $organization->name }}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        <p class="text-{{ $storelocation->is_active ? 'success' : 'danger' }}">
                                            {{ $storelocation->is_active ? 'Active' : 'Inactive' }}</p>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-soft-success waves-effect waves-light"
                                            style="padding: 4px 6px;" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $storelocation->id }}"><i
                                                class="fas fa-edit"></i></a>
                                        <form
                                            action="{{ route('inventory.setup.storelocations.destroy', $storelocation->id) }}"
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
                                <div class="modal fade" id="editModal{{ $storelocation->id }}" tabindex="-1"
                                    aria-labelledby="editModalLabel{{ $storelocation->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel{{ $storelocation->id }}">Edit
                                                    Store
                                                    Line</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="moduleForm"
                                                    action="{{ route('inventory.setup.storelocations.update', $storelocation->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')

                                                    <x-input-group name="name" label="Name" :value="$storelocation->name"
                                                        required />
                                                    <x-input-group name="address_line_1" label="Address Line 1"
                                                        :value="$storelocation->address_line_1" required />
                                                    <x-input-group name="address_line_2" label="Address Line 2"
                                                        :value="$storelocation->address_line_2" />
                                                    <x-input-group name="city" label="City" :value="$storelocation->city"
                                                        required />
                                                    <x-input-group name="state" label="State" :value="$storelocation->state" />
                                                    <x-input-group name="zip_code" label="Zip Code" :value="$storelocation->zip_code" />
                                                    <x-input-group name="country" label="Country" :value="$storelocation->country"
                                                        required />
                                                    <x-input-group name="store_size" label="Store Size" :value="$storelocation->store_size" />
                                                    <x-select-input-group name="store_type_id" label="Store Type"
                                                        :options="$storetypes->pluck('name', 'id')" :selected="$storelocation->store_type_id" required />
                                                    <x-input-group name="owner_id" label="Owner ID" :value="$storelocation->owner_id"
                                                        required />
                                                    <x-input-group name="owner_name" label="Owner Name"
                                                        :value="$storelocation->owner_name" />
                                                    <x-input-group name="latitude" label="Latitude" :value="$storelocation->latitude" />
                                                    <x-input-group name="longitude" label="Longitude" :value="$storelocation->longitude" />
                                                    <x-input-group name="contact_person" label="Contact Person"
                                                        :value="$storelocation->contact_person" />
                                                    <x-input-group name="phone" label="Phone" :value="$storelocation->phone" />
                                                    <x-input-group name="email" label="Email" :value="$storelocation->email"
                                                        required />
                                                    <x-input-group name="description" label="Description"
                                                        :value="$storelocation->description" />
                                                    <x-select-input-group name="is_active" label="Is Active?"
                                                        :options="['1' => 'Active', '0' => 'Inactive']" :selected="$storelocation->is_active ? '1' : '0'" required />
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
                    <h6 class="my-0 text-primary"> <i class="mdi mdi-list"></i> Input Parameters For New Store Line ...</h6>
                </div>
                <div class="card-body">
                    <form id="moduleForm" action="{{ route('inventory.setup.storelocations.store') }}" method="POST">
                        @csrf

                        <x-input-group name="name" label="Name" placeholder="Enter name" :value="old('name')" required />
                        <x-input-group name="address_line_1" label="Address Line 1" placeholder="Enter address line 1"
                            :value="old('address_line_1')" required />
                        <x-input-group name="address_line_2" label="Address Line 2" placeholder="Enter address line 2"
                            :value="old('address_line_2')" />
                        <x-input-group name="city" label="City" placeholder="Enter city" :value="old('city')"
                            required />
                        <x-input-group name="state" label="State" placeholder="Enter state" :value="old('state')" />
                        <x-input-group name="zip_code" label="Zip Code" placeholder="Enter zip code"
                            :value="old('zip_code')" />
                        <x-input-group name="country" label="Country" placeholder="Enter country" :value="old('country')"
                            required />
                        <x-input-group name="store_size" label="Store Size" placeholder="Enter store size"
                            :value="old('store_size')" />
                        <x-select-input-group name="store_type_id" label="Store Type" :options="$storetypes->pluck('name', 'id')"
                            :selected="old('store_type_id')" required />
                        <x-select-input-group name="organization_id" label="Organization" :options="$organizations->pluck('name', 'id')"
                            :selected="old('organization_id')" required />
                        <x-input-group name="owner_id" label="Owner ID" placeholder="Enter owner id"
                            :value="old('owner_id')" />
                        <x-input-group name="owner_name" label="Owner Name" placeholder="Enter owner name"
                            :value="old('owner_name')" />
                        <x-input-group name="latitude" label="Latitude" placeholder="Enter latitude"
                            :value="old('latitude')" />
                        <x-input-group name="longitude" label="Longitude" placeholder="Enter longitude"
                            :value="old('longitude')" />
                        <x-input-group name="contact_person" label="Contact Person" placeholder="Enter contact person"
                            :value="old('contact_person')" />
                        <x-input-group name="phone" label="Phone" placeholder="Enter phone" :value="old('phone')" />
                        <x-input-group name="email" label="Email" placeholder="Enter email" :value="old('email')" />
                        <x-input-group name="description" label="Description" placeholder="Enter description"
                            :value="old('description')" />
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
