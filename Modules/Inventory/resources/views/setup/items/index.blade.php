@extends('layouts.app')
@section('title', 'INVENTORY')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'INVENTORY',
                'subtitle' => 'Items',
                'breadcrumbs' => [
                    ['label' => 'INVENTORY', 'url' => route('inventory.index')],
                    ['label' => 'Setup', 'url' => route('inventory.index')],
                    ['label' => 'Items', 'url' => route('inventory.setup.items.index')],
                ],
            ])
        </div>
        <div class="col-md-8">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Items List
                    </h6>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100" width="100%">
                        <thead>
                            {{-- //         $table->id();
                            //         //relationship
                            //         $table->unsignedBigInteger('goods_category_id');
                            //         $table->unsignedBigInteger('goods_subcategory_id');
                            //         $table->unsignedBigInteger('unit_id');
                            //         //items info 
                            //         $table->string('item_code', 20)->unique(); // Like IT001
                            //         $table->string('item_name', 100);
                            //         $table->string('item_description')->nullable();
                            //         $table->string('item_barcode')->nullable();
                            //         $table->string('item_image')->nullable();
                            //         $table->boolean('is_active')->default(true);
                            //         //varient 
                            //         $table->json('varient')->nullable();
                            //         $table->string('model')->nullable();
                            //         $table->string('type')->nullable();
                            //         $table->string('remarks')->nullable();
                            //         //present stock
                            //         $table->integer('present_stock')->default(0);
                            //         $table->integer('minimum_stock')->default(0);
                            //         $table->integer('maximum_stock')->default(0);
                            //         $table->integer('reorder_level')->default(0);
                            //         $table->integer('reorder_quantity')->default(0);
                            //         $table->integer('reorder_quantity')->default(0);
                            //         //foreign key
                            //         $table->foreign('goods_category_id')
                            //             ->references('id')
                            //             ->on('inventory_setup_goods_setup_category')
                            //             ->onDelete('restrict');
                            //         $table->foreign('goods_subcategory_id')
                            //             ->references('id')
                            //             ->on('inventory_setup_goods_setup_subcategory')
                            //             ->onDelete('restrict');
                            //         $table->foreign('unit_id')
                            //             ->references('id')
                            //             ->on('master_setup_units')
                            //             ->onDelete('restrict');
                            //         $table->timestamps(); --}}

                            <tr>
                                <th width="5%">#</th>
                                <th width="50%">Item Name</th>
                                <th width="15%">Item Code</th>
                                <th width="10%">Item Description</th>
                                <th width="10%">Item Barcode</th>
                                <th width="10%">Item Image</th>
                                {{-- //varient --}}
                                <th width="10%">Model</th>
                                <th width="10%">Type</th>
                                <th width="10%">Remarks</th>
                                {{-- //present stock --}}
                                <th width="10%">Present Stock</th>
                                <th width="10%">Minimum Stock</th>
                                <th width="10%">Maximum Stock</th>
                                <th width="10%">Reorder Level</th>
                                <th width="10%">Reorder Quantity</th>
                                {{-- //foreign key --}}
                                <th width="10%">Goods Category</th>
                                <th width="10%">Goods Subcategory</th>
                                <th width="10%">Unit</th>
                                {{-- //item status --}}
                                <th width="10%">Item Status</th>
                                <th width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $key => $item)
                                <tr>
                                    <td width="5%">{{ $key + 1 }}</td>
                                    <td width="50%">{{ $item->item_name }}</td>
                                    <td width="15%">
                                        @if ($item->item_code)
                                            {{ $item->item_code }}
                                        @endif
                                    </td>
                                    <td width="10%">{{ $item->item_description }}</td>
                                    <td width="10%">{{ $item->item_barcode }}</td>
                                    <td width="10%">{{ $item->item_image }}</td>
                                    {{-- //varient --}}
                                    <td width="10%">{{ $item->model }}</td>
                                    <td width="10%">{{ $item->type }}</td>
                                    <td width="10%">{{ $item->remarks }}</td>
                                    {{-- //present stock --}}
                                    <td width="10%">{{ $item->present_stock }}</td>
                                    <td width="10%">{{ $item->minimum_stock }}</td>
                                    <td width="10%">{{ $item->maximum_stock }}</td>
                                    <td width="10%">{{ $item->reorder_level }}</td>
                                    <td width="10%">{{ $item->reorder_quantity }}</td>
                                    <td width="10%">{{ $item->goods_category->category_name }}</td>
                                    <td width="10%">{{ $item->goods_subcategory->subcategory_name }}</td>
                                    <td width="10%">{{ $item->unit->unit_name }}</td>
                                    {{-- //item status --}}
                                    <td class="text-center">
                                        <p class="text-{{ $item->is_active ? 'success' : 'danger' }}">
                                            {{ $item->is_active ? 'Active' : 'Inactive' }}</p>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-soft-success waves-effect waves-light"
                                            style="padding: 4px 6px;" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $item->id }}"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('inventory.setup.items.destroy', $item->id) }}"
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
                                <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel{{ $item->id }}">Edit Item
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="moduleForm"
                                                    action="{{ route('inventory.setup.items.update', $item->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    
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
                    <h6 class="my-0 text-primary"> <i class="mdi mdi-list"></i> Input Parameters For New Item ...
                    </h6>
                </div>
                <div class="card-body">
                    <form id="moduleForm" action="{{ route('inventory.setup.items.store') }}" method="POST">
                        @csrf
                        <x-input-group name="item_name" label="Item Name" placeholder="Enter item name" :value="old('item_name')"
                            required />
                        <x-select-input-group name="goods_category_id" label="Goods Category" :options="$goodsCategories->pluck('name', 'id')" :selected="old('goods_category_id')"
                            required />
                        <x-select-input-group name="goods_subcategory_id" label="Goods Subcategory" :options="$goodsSubcategories->pluck('name', 'id')" :selected="old('goods_subcategory_id')"
                            required />
                        <x-select-input-group name="unit_id" label="Unit" :options="$units->pluck('unit_name', 'id')" :selected="old('unit_id')"
                            required />
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
