@extends('layouts.app')
@section('title', 'INVENTORY')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'INVENTORY',
                'subtitle' => 'Supplier Types',
                'breadcrumbs' => [
                    ['label' => 'INVENTORY', 'url' => route('inventory.index')],
                    ['label' => 'Setup', 'url' => route('inventory.index')],
                    ['label' => 'Supplier Types', 'url' => route('inventory.setup.suppliertypes.index')],
                ],
            ])
        </div>
        <div class="col-md-8">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Supplier Types List
                    </h6>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100" width="100%">
                        <thead>
                            {{-- $table->string('supplier_code', 50)->unique();
            $table->string('name', 150)->unique();
            $table->unsignedBigInteger('supplier_type_id');
            $table->string('contact_person', 100)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('phone', 30)->nullable();
            $table->string('mobile', 30)->nullable();
            $table->string('address_line_1');
            $table->string('address_line_2')->nullable();
            $table->string('city', 100)->nullable();
            $table->string('state', 100)->nullable();
            $table->string('zip_code', 20)->nullable();
            $table->string('country', 100)->nullable();
            $table->string('tax_id', 50)->nullable();
            $table->string('trade_license', 100)->nullable();
            $table->string('bank_account', 100)->nullable();
            $table->string('bank_name', 100)->nullable();
            $table->string('swift_code', 50)->nullable();
            $table->boolean('is_active')->default(true); --}}
                            <tr>
                                <th>#</th>
                                <th>Supplier Code</th>
                                <th>Name</th>
                                <th>Supplier Type</th>
                                <th>Contact Person</th>
                                <th>Phone</th>
                                <th>Mobile</th>
                                <th>Address Line 1</th>
                                <th>Address Line 2</th>
                                <th>City</th>
                                <th>State</th>
                                <th>Zip Code</th>
                                <th>Country</th>
                                <th>Tax ID</th>
                                <th>Trade License</th>
                                <th>Bank Account</th>
                                <th>Bank Name</th>
                                <th>Swift Code</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($suppliers as $key => $supplier)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $supplier->supplier_code }}</td>
                                    <td>{{ $supplier->name }}</td>
                                    <td>{{ $supplier->supplier_type_id }}</td>
                                    <td>{{ $supplier->contact_person }}</td>
                                    <td>{{ $supplier->phone }}</td>
                                    <td>{{ $supplier->mobile }}</td>
                                    <td>{{ $supplier->address_line_1 }}</td>
                                    <td>{{ $supplier->address_line_2 }}</td>
                                    <td>{{ $supplier->city }}</td>
                                    <td>{{ $supplier->state }}</td>
                                    <td>{{ $supplier->zip_code }}</td>
                                    <td>{{ $supplier->country }}</td>
                                    <td>{{ $supplier->tax_id }}</td>
                                    <td>{{ $supplier->trade_license }}</td>
                                    <td>{{ $supplier->bank_account }}</td>
                                    <td>{{ $supplier->bank_name }}</td>
                                    <td>{{ $supplier->swift_code }}</td>
                                    <td class="text-center">
                                        <p class="text-{{ $supplier->is_active ? 'success' : 'danger' }}">
                                            {{ $supplier->is_active ? 'Active' : 'Inactive' }}</p>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-soft-success waves-effect waves-light"
                                            style="padding: 4px 6px;" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $supplier->id }}"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('inventory.setup.suppliers.destroy', $supplier->id) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            {{-- add confirm dialog --}}
                                            <button type="submit" class="btn btn-sm btn-danger" 
                                                onclick="return confirm('Are you sure you want to delete this supplier type?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                {{-- load edit modal --}}
                                <div class="modal fade" id="editModal{{ $supplier->id }}" tabindex="-1"
                                    aria-labelledby="editModalLabel{{ $supplier->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel{{ $supplier->id }}">Edit Supplier
                                                    Type</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="moduleForm"
                                                    action="{{ route('inventory.setup.suppliers.update', $supplier->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')

                                                    <x-input-group name="name" label="Name" :value="$supplier->name"
                                                        required />
                                                    
                                                    <x-select-input-group name="supplier_type_id" label="Supplier Type"
                                                        :options="$supplierTypes->pluck('name', 'id')" :selected="$supplier->supplier_type_id" required />
                                                    <x-input-group name="contact_person" label="Contact Person"
                                                        :value="$supplier->contact_person" />
                                                    <x-input-group name="phone" label="Phone"
                                                        :value="$supplier->phone" />
                                                    <x-input-group name="mobile" label="Mobile"
                                                        :value="$supplier->mobile" />
                                                    <x-input-group name="address_line_1" label="Address Line 1"
                                                        :value="$supplier->address_line_1" />
                                                    <x-input-group name="address_line_2" label="Address Line 2"
                                                        :value="$supplier->address_line_2" />
                                                    <x-input-group name="city" label="City"
                                                        :value="$supplier->city" />
                                                    <x-input-group name="state" label="State"
                                                        :value="$supplier->state" />
                                                    <x-input-group name="zip_code" label="Zip Code"
                                                        :value="$supplier->zip_code" />
                                                    <x-input-group name="country" label="Country"
                                                        :value="$supplier->country" />
                                                    <x-input-group name="tax_id" label="Tax ID"
                                                        :value="$supplier->tax_id" />
                                                    <x-input-group name="trade_license" label="Trade License"
                                                        :value="$supplier->trade_license" />
                                                    <x-input-group name="bank_account" label="Bank Account"
                                                        :value="$supplier->bank_account" />
                                                    <x-input-group name="bank_name" label="Bank Name"
                                                        :value="$supplier->bank_name" />
                                                    <x-input-group name="swift_code" label="Swift Code"
                                                        :value="$supplier->swift_code" />
                                                    <x-select-input-group name="is_active" label="Is Active?"
                                                        :options="['1' => 'Active', '0' => 'Inactive']" :selected="$supplier->is_active ? '1' : '0'" required />
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
                    <h6 class="my-0 text-primary"> <i class="mdi mdi-list"></i> Input Parameters For New Supplier ...</h6>
                </div>
                <div class="card-body">
                    <form id="moduleForm" action="{{ route('inventory.setup.suppliers.store') }}" method="POST">
                        @csrf

                        <x-input-group name="name" label="Name" placeholder="Enter name" :value="old('name')" required />
                        <x-select-input-group name="supplier_type_id" label="Supplier Type" :options="$supplierTypes->pluck('name', 'id')" :selected="old('supplier_type_id')" required />
                        <x-input-group name="contact_person" label="Contact Person" placeholder="Enter contact person"
                            :value="old('contact_person')" />
                        <x-input-group name="phone" label="Phone" placeholder="Enter phone" :value="old('phone')" />
                        <x-input-group name="mobile" label="Mobile" placeholder="Enter mobile" :value="old('mobile')" />
                        <x-input-group name="address_line_1" label="Address Line 1" placeholder="Enter address line 1"
                            :value="old('address_line_1')" />
                        <x-input-group name="address_line_2" label="Address Line 2" placeholder="Enter address line 2"
                            :value="old('address_line_2')" />
                        <x-input-group name="city" label="City" placeholder="Enter city" :value="old('city')" />
                        <x-input-group name="state" label="State" placeholder="Enter state" :value="old('state')" />
                        <x-input-group name="zip_code" label="Zip Code" placeholder="Enter zip code"
                            :value="old('zip_code')" />
                        <x-input-group name="country" label="Country" placeholder="Enter country" :value="old('country')" />
                        <x-input-group name="tax_id" label="Tax ID" placeholder="Enter tax id" :value="old('tax_id')" />
                        <x-input-group name="trade_license" label="Trade License" placeholder="Enter trade license"
                            :value="old('trade_license')" />
                        <x-input-group name="bank_account" label="Bank Account" placeholder="Enter bank account"
                            :value="old('bank_account')" />
                        <x-input-group name="bank_name" label="Bank Name" placeholder="Enter bank name"
                            :value="old('bank_name')" />
                        <x-input-group name="swift_code" label="Swift Code" placeholder="Enter swift code"
                            :value="old('swift_code')" />
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
