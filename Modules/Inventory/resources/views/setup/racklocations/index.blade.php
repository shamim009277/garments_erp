@extends('layouts.app')
@section('title', 'INVENTORY')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'INVENTORY',
                'subtitle' => 'Rack Locations',
                'breadcrumbs' => [
                    ['label' => 'INVENTORY', 'url' => route('inventory.index')],
                    ['label' => 'Setup', 'url' => route('inventory.index')],
                    ['label' => 'Rack Locations', 'url' => route('inventory.setup.racklocations.index')],
                ],
            ])
        </div>
        <div class="col-md-8">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Rack Locations List
                    </h6>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100" width="100%">
                        <thead>
                            {{-- $table->string('rack_name', 100)->nullable();
                            $table->string('rack_code', 50)->unique();
                            $table->string('aisle', 50)->nullable();
                            $table->string('row', 20)->nullable();
                            $table->string('column', 20)->nullable();
                            $table->tinyInteger('floor_level')->nullable();
                            $table->unsignedBigInteger('store_line_id');
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
            // foreign key
            $table->foreign('store_line_id')
                  ->references('id')->on('inventory_setup_store_line')
                  ->onDelete('cascade'); --}}
                            <tr>
                                <th>#</th>
                                <th>Rack Name</th>
                                <th>Rack Code</th>
                                <th>Aisle</th>
                                <th>Row</th>
                                <th>Column</th>
                                <th>Floor Level</th>
                                <th>Store Line</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php 
                            $storeLines = \Modules\Inventory\Models\Setup\StoreLine::all();
                            @endphp
                            @foreach ($rackLocations as $key => $racklocation)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $racklocation->rack_name }}</td>
                                    <td>{{ $racklocation->rack_code }}</td>
                                    <td>{{ $racklocation->aisle }}</td>
                                    <td>{{ $racklocation->row }}</td>
                                    <td>{{ $racklocation->column }}</td>
                                    <td>{{ $racklocation->floor_level }}</td>
                                    <td>
                                        @foreach ($storeLines as $storeLine)
                                            @if ($storeLine->id == $racklocation->store_line_id)
                                                {{ $storeLine->name }}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>{{ $racklocation->description }}</td>
                                    <td class="text-center">
                                        <p class="text-{{ $racklocation->is_active ? 'success' : 'danger' }}">
                                            {{ $racklocation->is_active ? 'Active' : 'Inactive' }}</p>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-soft-success waves-effect waves-light"
                                            style="padding: 4px 6px;" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $racklocation->id }}"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('inventory.setup.racklocations.destroy', $racklocation->id) }}"
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
                                <div class="modal fade" id="editModal{{ $racklocation->id }}" tabindex="-1"
                                    aria-labelledby="editModalLabel{{ $racklocation->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel{{ $racklocation->id }}">Edit Rack
                                                    Line</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="moduleForm"
                                                    action="{{ route('inventory.setup.racklocations.update', $racklocation->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')

                                                    <x-input-group name="rack_name" label="Rack Name" :value="$racklocation->rack_name"
                                                        required />
                                                    <x-input-group name="aisle" label="Aisle" :value="$racklocation->aisle"
                                                        required />
                                                    <x-input-group name="row" label="Row" :value="$racklocation->row"
                                                        required />
                                                    <x-input-group name="column" label="Column" :value="$racklocation->column"
                                                        required />
                                                    <x-input-group name="floor_level" label="Floor Level" :value="$racklocation->floor_level"
                                                        required />
                                                    <x-select-input-group name="store_line_id" label="Store Line" :options="$storeLines->pluck('name', 'id')" :selected="$racklocation->store_line_id" required />
                                                    <x-input-group name="description" label="Description"
                                                        :value="$racklocation->description" />
                                                    <x-select-input-group name="is_active" label="Is Active?"
                                                        :options="['1' => 'Active', '0' => 'Inactive']" :selected="$racklocation->is_active ? '1' : '0'" required />
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
                    <form id="moduleForm" action="{{ route('inventory.setup.racklocations.store') }}" method="POST">
                        @csrf

                        <x-input-group name="rack_name" label="Rack Name" placeholder="Enter rack name" :value="old('rack_name')" required />
                        <x-input-group name="aisle" label="Aisle" placeholder="Enter aisle" :value="old('aisle')" required />
                        <x-input-group name="row" label="Row" placeholder="Enter row" :value="old('row')" required />   
                        <x-input-group name="column" label="Column" placeholder="Enter column" :value="old('column')" required />
                        <x-input-group name="floor_level" label="Floor Level" placeholder="Enter floor level" :value="old('floor_level')" required />
                        <x-select-input-group name="store_line_id" label="Store Line" :options="$storeLines->pluck('name', 'id')" :selected="old('store_line_id')" required />
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
