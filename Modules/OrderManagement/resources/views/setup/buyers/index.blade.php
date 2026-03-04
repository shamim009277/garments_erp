@extends('layouts.app')
@section('title', 'Order Management')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'Order Management',
                'subtitle' => 'Buyers',
                'breadcrumbs' => [
                    ['label' => 'Order Management', 'url' => route('ordermanagement.index')],
                    ['label' => 'Setup', 'url' => route('ordermanagement.index')],
                    ['label' => 'Buyers', 'url' => route('ordermanagement.setup.buyers.index')],
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
                            <tr>
                                <th width="5%">#</th>
                                <th width="50%">Buyer Name</th>
                                <th width="15%">Type</th>
                                <th width="10%">Email</th>
                                <th width="10%">Status</th>

                                <th width="10%">Phone</th>
                                <th width="10%">Mobile</th>
                                <th width="10%">Address</th>
                                <th width="10%">Website</th>
                                <th width="10%">Country</th>
                                <th width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($buyers as $key => $buyer)
                                <tr id="row-{{ $buyer->id }}">
                                    <td width="5%">{{ $key + 1 }}</td>
                                    <td width="50%">{{ $buyer->buyer_name }}</td>
                                    <td width="15%">
                                        @if ($buyer->buyer_type)
                                            {{ $buyer->buyer_type }}
                                        @endif
                                    </td>
                                    <td width="10%">{{ $buyer->email }}</td>
                                    <td class="text-center">
                                        <div class="square-switch">
                                            <input type="checkbox" id="buyer-switch-{{ $buyer->id }}"
                                                class="buyer-toggle" data-id="{{ $buyer->id }}"
                                                switch="bool" {{ $buyer->is_active ? 'checked' : '' }} />
                                            <label for="buyer-switch-{{ $buyer->id }}" data-on-label="Yes"
                                                data-off-label="No" style="margin: 0px; vertical-align: middle;"></label>
                                        </div>
                                    </td>
                                    <td width="10%">{{ $buyer->phone }}</td>
                                    <td width="10%">{{ $buyer->mobile }}</td>
                                    <td width="10%">{{ $buyer->address }}</td>
                                    <td width="10%">{{ $buyer->website }}</td>
                                    <td width="10%">{{ $buyer->country->country_name }}</td>
                                    
                                    <td>
                                        <a href="#" class="btn btn-soft-success waves-effect waves-light"
                                            style="padding: 4px 6px;" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $buyer->id }}"><i class="fas fa-edit"></i></a>
                                        
                                        <a href="#" class="btn btn-soft-danger waves-effect waves-light delete-buyer"
                                            data-id="{{ $buyer->id }}" style="padding: 4px 6px;"><i class="fas fa-trash"></i></a>
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
                                                    action="{{ route('ordermanagement.setup.buyers.update', $buyer->id) }}"
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
                                                                :options="['Local', 'Foreign', 'Both', 'Buying House', 'Retail', 'Online Seller']" :selected="collect(['Local', 'Foreign', 'Both', 'Buying House', 'Retail', 'Online Seller'])->search($buyer->buyer_type)??old('buyer_type')" required />
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
                    <form id="moduleForm" action="{{ route('ordermanagement.setup.buyers.store') }}" method="POST">
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
        $(document).on('change', '.buyer-toggle', function() {
            let id = $(this).data('id');
            let status = $(this).is(':checked') ? 1 : 0;

            $.ajax({
                url: '{{ route('ordermanagement.setup.buyers.toggle') }}',
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

        $(document).on('click', '.delete-buyer', function(e) {
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
                        url: '{{ route('ordermanagement.setup.buyers.destroy', ':id') }}'.replace(':id', id),
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
