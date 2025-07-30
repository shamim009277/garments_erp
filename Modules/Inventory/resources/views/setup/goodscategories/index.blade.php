@extends('layouts.app')
@section('title', 'INVENTORY')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'INVENTORY',
                'subtitle' => 'Goods Categories',
                'breadcrumbs' => [
                    ['label' => 'INVENTORY', 'url' => route('inventory.index')],
                    ['label' => 'Setup', 'url' => route('inventory.index')],
                    ['label' => 'Goods Categories', 'url' => route('inventory.setup.goodscategories.index')],
                ],
            ])
        </div>
        <div class="col-md-8">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Goods Categories
                        List
                    </h6>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100" width="100%">
                        <thead>
                            {{-- $table->id();
            $table->string('category_code', 20)->unique();  // e.g., RM01, FG02
            $table->string('name', 100);                   // e.g., Raw Material, Finished Goods
            $table->text('description')->nullable();       // Optional details
            $table->unsignedBigInteger('parent_id')->nullable(); // For hierarchical categories
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            // Optional: Add foreign key if hierarchical
            $table->foreign('parent_id')->references('id')->on('inventory_setup_goods_categories')->onDelete('set null'); --}}
                            <tr>
                                <th>#</th>
                                <th>Category Code</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($goodscategories as $key => $goodscategory)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $goodscategory->category_code }}</td>
                                    <td>{{ $goodscategory->name }}</td>
                                    <td>{{ $goodscategory->description }}</td>
                                    <td>
                                        <div class="square-switch">
                                            <input type="checkbox" id="square-switch3{{ $goodscategory->id }}"
                                                class="goodscategory-toggle" data-id="{{ $goodscategory->id }}"
                                                switch="bool" {{ $goodscategory->is_active ? 'checked' : '' }} />
                                            <label for="square-switch3{{ $goodscategory->id }}" data-on-label="Yes"
                                                data-off-label="No" style="margin: 0px; vertical-align: middle;"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-soft-success waves-effect waves-light "
                                            style="padding: 4px 6px;" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $goodscategory->id }}"><i
                                                class="fas fa-edit"></i></a>
                                        {{--  --}}
                                        <a href="#"
                                            class="btn btn-soft-danger waves-effect waves-light delete-goodscategory"
                                            data-id="{{ $goodscategory->id }}" style="padding: 4px 6px;"><i
                                                class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                                {{-- load edit modal --}}
                                <div class="modal fade" id="editModal{{ $goodscategory->id }}" tabindex="-1"
                                    aria-labelledby="editModalLabel{{ $goodscategory->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel{{ $goodscategory->id }}">Edit
                                                    Goods Category</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="moduleForm"
                                                    action="{{ route('inventory.setup.goodscategories.update', $goodscategory->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')

                                                    <x-input-group name="name" label="Name" :value="$goodscategory->name"
                                                        required />
                                                    <x-input-group name="description" label="Description" :value="$goodscategory->description"
                                                        required />
                                                    <x-select-input-group name="is_active" label="Is Active?"
                                                        :options="['1' => 'Active', '0' => 'Inactive']" :selected="$goodscategory->is_active ? '1' : '0'" required />
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
                    <h6 class="my-0 text-primary"> <i class="mdi mdi-list"></i> Input Parameters For New Goods Category ...
                    </h6>
                </div>
                <div class="card-body">
                    <form id="moduleForm" action="{{ route('inventory.setup.goodscategories.store') }}" method="POST">
                        @csrf
                        <x-input-group name="name" label="Name" placeholder="Enter name" :value="old('name')" required />
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
            console.log('ready');
            $('.goodscategory-toggle').on('change', function() {
                console.log('change');
                let id = $(this).data('id');
                let status = $(this).is(':checked') ? 1 : 0;

                $.ajax({
                    url: '{{ route('inventory.setup.goodscategories.toggle') }}',
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

        $(document).on('click', '.delete-goodscategory', function(e) {
            console.log('delete');
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
                        url: '{{ route('inventory.setup.goodscategories.delete') }}',
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
