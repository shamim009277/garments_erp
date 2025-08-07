@extends('layouts.app')
@section('title', 'Inventory')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'Inventory',
                'subtitle' => 'Country',
                'breadcrumbs' => [
                    ['label' => 'Inventory', 'url' => route('inventory.index')],
                    ['label' => 'Setup', 'url' => route('inventory.index')],
                    ['label' => 'Country', 'url' => route('inventory.setup.countries.index')],
                ],
            ])
        </div>
        <div class="col-lg-8 pr-0">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Country List</h6>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100" width="100%">
                        <thead>
                            {{-- $table->string('country_name', 100)->unique();
                            $table->string('country_code', 20)->unique();
                            $table->boolean('is_active')->default(true);
                            //currency
                            $table->string('currency', 20)->unique();
                            $table->string('currency_code', 20)->unique();
                            $table->string('currency_symbol', 20)->unique();
                            //exchange rate
                            $table->decimal('exchange_rate', 10, 2)->default(1); --}}
                            <tr>
                                <th width="5%">SL</th>
                                <th width="50%">Country Name</th>
                                <th width="50%">Currency</th>
                                <th width="50%">Currency Code</th>
                                <th width="50%">Currency Symbol</th>
                                <th width="50%">Exchange Rate</th>
                                <th width="30%">Is Active</th>
                                <th width="15%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($countries as $key => $country)
                                <tr id="row-{{ $country->id }}">
                                    <td>{{ $key + 1 }}</td>                                    
                                    <td>{{ $country->country_name }}</td>
                                    <td>{{ $country->currency }}</td>
                                    <td>{{ $country->currency_code }}</td>
                                    <td>{{ $country->currency_symbol }}</td>
                                    <td>{{ $country->exchange_rate }}</td>
                                    <td>
                                        <div class="square-switch">
                                            <input type="checkbox" id="square-switch3{{ $country->id }}" class="country-toggle" data-id="{{ $country->id }}" switch="bool" {{ $country->is_active ? 'checked' : '' }} />
                                            <label for="square-switch3{{ $country->id }}" data-on-label="Yes" data-off-label="No" style="margin: 0px; vertical-align: middle;"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-soft-success waves-effect waves-light" style="padding: 4px 6px;" data-bs-toggle="modal" data-bs-target="#editModal{{ $country->id }}"><i class="fas fa-edit"></i></a>
                                        <a href="#" class="btn btn-soft-danger waves-effect waves-light delete-country" data-id="{{ $country->id }}" style="padding: 4px 6px;"><i class="fas fa-trash"></i></a>
                                    </td>

                                    <div id="editModal{{ $country->id }}" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-bs-scroll="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title" id="myModalLabel">Edit Country</h6>
                                                    <button type="button" class="btn-close btn btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <form id="editForm{{ $country->id }}" action="{{ route('inventory.setup.countries.update', $country->id) }}" method="POST">
                                                    <div class="modal-body">
                                                        @csrf
                                                        @method('PUT')
                                                        <x-input-group name="country_name" label="Country Name" placeholder="Enter country name" :value="$country->country_name" required />
                                                        <x-input-group name="currency" label="Currency" placeholder="Enter currency" :value="$country->currency"  />
                                                        <x-input-group name="currency_code" label="Currency Code" placeholder="Enter currency code" :value="$country->currency_code"  />
                                                        <x-input-group name="currency_symbol" label="Currency Symbol" placeholder="Enter currency symbol" :value="$country->currency_symbol"  />
                                                        <x-input-group name="exchange_rate" label="Exchange Rate For BDT Currency" placeholder="Enter exchange rate" :value="$country->exchange_rate"  />
                                                        <x-select-input-group name="is_active" label="Is Active?" :options="['1' => 'Active', '0' => 'Inactive']" :selected="$country->is_active ? '1' : '0'" required />
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary waves-effect btn-sm" data-bs-dismiss="modal">Close</button>
                                                        <x-primary-button id="submitBtn" class="float-start btn-sm submitBtn">Save changes</x-primary-button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card alert-info alert-top-border">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i class="mdi mdi-list"></i> Input Parameters For New Country ...</h6>
                </div>
                <div class="card-body">
                    <form id="moduleForm" action="{{ route('inventory.setup.countries.store') }}" method="POST">
                        @csrf
                        <x-input-group name="country_name" label="Country Name" placeholder="Enter country name" :value="old('country_name')" required />
                        <x-input-group name="currency" label="Currency" placeholder="Enter currency" :value="old('currency')"  />
                        <x-input-group name="currency_code" label="Currency Code" placeholder="Enter currency code" :value="old('currency_code')"  />
                        <x-input-group name="currency_symbol" label="Currency Symbol" placeholder="Enter currency symbol" :value="old('currency_symbol')"  />
                        <x-input-group name="exchange_rate" label="Exchange Rate For BDT Currency" placeholder="Enter exchange rate" :value="old('exchange_rate')"  />
                        <x-select-input-group name="is_active" label="Is Active?" :options="['1' => 'Active', '0' => 'Inactive']" :selected="old('is_active', '1')" required />
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
            $('.country-toggle').on('change', function() {
                let id = $(this).data('id');
                let status = $(this).is(':checked') ? 1 : 0;
                $.ajax({
                    url: '{{ route('inventory.setup.countries.toggle') }}',
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

        $(document).on('click', '.delete-country', function(e) {
            e.preventDefault();
            let countryId = $(this).data('id');
            console.log(countryId);
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
                        url: '{{ route('inventory.setup.countries.delete') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: countryId
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                'Country has been deleted.',
                                'success'
                            );
                            $('#row-' +countryId).remove();
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
                        'Country has not been deleted.',
                        'error'
                    );
                }
            });
        });
    </script>
@endpush
