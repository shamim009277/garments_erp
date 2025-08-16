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
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Buyers List
                    </h6>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100" width="100%">
                        <thead>

                            {{-- // $table->id();
                            // $table->string('buyer_code', 20)->unique(); // Like BY001
                            // $table->string('buyer_name', 100);
                            // $table->enum('buyer_type', ['Local', 'Foreign', 'Both', 'Buying House', 'Retail', 'Online Seller'])->default('Local');
                            // $table->string('contact_person')->nullable();
                            // $table->string('email')->nullable();
                            // $table->string('phone', 30)->nullable();
                            // $table->string('mobile', 30)->nullable();
                            // $table->string('fax', 30)->nullable();
                            // $table->text('address')->nullable();
                            // $table->string('website')->nullable();
                            // $table->boolean('is_active')->default(true);
                            // $table->foreignId('country_id')
                            //     ->nullable()
                            //     ->constrained('inventory_setup_goods_setup_country')
                            //     ->onDelete('restrict'); --}}

                            <tr>
                                <th width="5%">#</th>
                                <th width="50%">Buyer Name</th>
                                <th width="15%">Buyer Type</th>
                                <th width="10%">Email</th>
                                <th width="10%">Phone</th>
                                <th width="10%">Mobile</th>
                                <th width="10%">Address</th>
                                <th width="10%">Website</th>
                                <th width="10%">Country</th>
                                <th width="10%">Status</th>
                                <th width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($buyers as $key => $buyer)
                                <tr>
                                    <td width="5%">{{ $key + 1 }}</td>
                                    <td width="50%">{{ $buyer->buyer_name }}</td>
                                    <td width="15%">
                                        @if ($buyer->buyer_type)
                                            {{ $buyer->buyer_type }}
                                        @endif
                                    </td>
                                    <td width="10%">{{ $buyer->email }}</td>
                                    <td width="10%">{{ $buyer->phone }}</td>
                                    <td width="10%">{{ $buyer->mobile }}</td>
                                    <td width="10%">{{ $buyer->address }}</td>
                                    <td width="10%">{{ $buyer->website }}</td>
                                    <td width="10%">{{ $buyer->country->country_name }}</td>
                                    <td class="text-center">
                                        <p class="text-{{ $buyer->is_active ? 'success' : 'danger' }}">
                                            {{ $buyer->is_active ? 'Active' : 'Inactive' }}</p>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-soft-success waves-effect waves-light"
                                            style="padding: 4px 6px;" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $buyer->id }}"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('inventory.setup.buyers.destroy', $buyer->id) }}"
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
                                <div class="modal fade" id="editModal{{ $buyer->id }}" tabindex="-1"
                                    aria-labelledby="editModalLabel{{ $buyer->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel{{ $buyer->id }}">Edit Buyer
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="moduleForm"
                                                    action="{{ route('inventory.setup.buyers.update', $buyer->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <x-input-group name="buyer_name" label="Buyer Name"
                                                                placeholder="Enter buyer name" :value="$buyer->buyer_name??old('buyer_name')" required />
                                                        </div>
                                                        <div class="col-md-12">
                                                            <x-select-input-group name="buyer_type" label="Buyer Type"
                                                                :options="['Local', 'Foreign', 'Both', 'Buying House', 'Retail', 'Online Seller']" :selected="$buyer->buyer_type??old('buyer_type')" required />
                                                        </div>
                                                        <div class="col-md-12">
                                                            <x-input-group name="contact_person" label="Contact Person"
                                                                placeholder="Enter contact person" :value="$buyer->contact_person??old('contact_person')" required />
                                                        </div>
                                                        <div class="col-md-12">
                                                            <x-input-group name="email" label="Email"
                                                                placeholder="Enter email" :value="$buyer->email" required />
                                                        </div>
                                                        <div class="col-md-12">
                                                            <x-input-group name="phone" label="Phone"
                                                                placeholder="Enter phone" :value="$buyer->phone" required />
                                                        </div>
                                                        <div class="col-md-12">
                                                            <x-input-group name="mobile" label="Mobile"
                                                                placeholder="Enter mobile" :value="$buyer->mobile" required />
                                                        </div>
                                                        <div class="col-md-12">
                                                            <x-input-group name="address" label="Address"
                                                                placeholder="Enter address" :value="$buyer->address" required />
                                                        </div>
                                                        <div class="col-md-12">
                                                            <x-input-group name="website" label="Website"
                                                                placeholder="Enter website" :value="$buyer->website" required />
                                                        </div>
                                                        <div class="col-md-12">
                                                            <x-select-input-group name="is_active" label="Is Active?"
                                                                :options="['1' => 'Active', '0' => 'Inactive']" :selected="$buyer->is_active ? '1' : '0'" required />
                                                        </div>
                                                        <div class="col-md-12">
                                                            <x-select-input-group name="country_id" label="Country"
                                                                :options="$countries->pluck('country_name', 'id')" :selected="$buyer->country_id??old('country_id')" required />
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
                    <h6 class="my-0 text-primary"> <i class="mdi mdi-list"></i> Input Parameters For New Buyer ...
                    </h6>
                </div>
                <div class="card-body">
                    <form id="moduleForm" action="{{ route('inventory.setup.buyers.store') }}" method="POST">
                        @csrf
                        <x-input-group name="buyer_name" label="Buyer Name" placeholder="Enter buyer name" :value="old('buyer_name')"
                            required />
                        <x-select-input-group name="buyer_type" label="Buyer Type" :options="['Local', 'Foreign', 'Both', 'Buying House', 'Retail', 'Online Seller']" :selected="old('buyer_type')"
                            required />
                        <x-input-group name="contact_person" label="Contact Person" placeholder="Enter contact person" :value="old('contact_person')"
                            required />
                        <x-input-group name="email" label="Email" placeholder="Enter email" :value="old('email')"
                            required />
                        <x-input-group name="phone" label="Phone" placeholder="Enter phone" :value="old('phone')"
                            required />
                        <x-input-group name="mobile" label="Mobile" placeholder="Enter mobile" :value="old('mobile')"
                            required />
                        <x-input-group name="address" label="Address" placeholder="Enter address" :value="old('address')"
                            required />
                        <x-input-group name="website" label="Website" placeholder="Enter website" :value="old('website')"
                            required />
                        <x-select-input-group name="is_active" label="Is Active?" :options="['1' => 'Active', '0' => 'Inactive']" :selected="old('is_active', '1')"
                            required />
                        <x-select-input-group name="country_id" label="Country" :options="$countries->pluck('country_name', 'id')" :selected="old('country_id')"
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
