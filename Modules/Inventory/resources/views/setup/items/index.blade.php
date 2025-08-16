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
                                <th width="25%">Item Name</th>
                                <th width="7%">Item Image</th>
                                <th width="7%">Category</th>
                                <th width="7%">Subcategory</th>
                                <th width="7%">Unit</th>
                                {{-- //varient --}}
                                <th width="7%">Model</th>
                                <th width="7%">Type</th>
                                <th width="7%">Remarks</th>
                                {{-- //present stock --}}
                                <th width="5%">Stock</th>
                                {{-- //item status --}}
                                <th width="7%">Status</th>
                                <th width="7%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->item_name }}</td>
                                    <td>{{ $item->item_image }}</td>
                                    <td>{{ $item->goodsCategory->name }}</td>
                                    <td>{{ $item->goodsSubcategory->name }}</td>
                                    <td>{{ $item->unit->name }}</td>
                                    <td>{{ $item->model }}</td>
                                    <td>{{ $item->type }}</td>
                                    <td>{{ $item->remarks }}</td>
                                    <td>{{ $item->present_stock }}</td>
                                    <td>
                                        <div class="square-switch">
                                            <input type="checkbox" id="square-switch3{{ $item->id }}"
                                                class="item-toggle" data-id="{{ $item->id }}" switch="bool"
                                                {{ $item->is_active ? 'checked' : '' }} />
                                            <label for="square-switch3{{ $item->id }}" data-on-label="Yes"
                                                data-off-label="No" style="margin: 0px; vertical-align: middle;"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-soft-success waves-effect waves-light"
                                            style="padding: 4px 6px;" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $item->id }}"><i class="fas fa-edit"></i></a>
                                        <a href="#" class="btn btn-soft-danger waves-effect waves-light delete-item"
                                            data-id="{{ $item->id }}" style="padding: 4px 6px;"><i
                                                class="fas fa-trash"></i></a>
                                    </td>
                                    {{-- load edit modal --}}
                                    <div id="editModal{{ $item->id }}" class="modal fade" tabindex="-1"
                                        aria-labelledby="myModalLabel" aria-hidden="true" data-bs-scroll="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title" id="myModalLabel">Edit Item</h6>
                                                    <button type="button" class="btn-close btn btn-sm"
                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <form id="editForm{{ $item->id }}"
                                                    action="{{ route('inventory.setup.items.update', $item->id) }}"
                                                    method="POST">
                                                    <div class="modal-body">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                                        <x-input-group name="item_name" label="Item Name" type="text"
                                                            placeholder="Enter item name" :value="$item->item_name" required />
                                                        <x-select-input-group name="goods_category_id" id="goods_category_id"
                                                            label="Goods Category" :options="$goodsCategories->pluck('name', 'id')" :selected="$item->goods_category_id"
                                                            required />

                                                        <x-select-input-group name="goods_subcategory_id" id="goods_subcategory_id"
                                                            label="Goods Subcategory" :options="[]" :selected="$item->goods_subcategory_id"
                                                            required />


                                                        <x-select-input-group name="unit_id" label="Unit"
                                                            :options="$units->pluck('name', 'id')" :selected="$item->unit_id" required />
                                                        <x-input-group name="model" label="Model" type="text"
                                                            placeholder="Enter model" :value="$item->model" required />
                                                        <x-input-group name="type" label="Type" type="text"
                                                            placeholder="Enter type" :value="$item->type" required />
                                                        <x-input-group name="remarks" label="Remarks" type="text"
                                                            placeholder="Enter remarks" :value="$item->remarks" required />
                                                        <x-select-input-group name="is_active" label="Is Active"
                                                            :options="['1' => 'Active', '0' => 'Inactive']" :selected="$item->is_active" required />
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary waves-effect btn-sm"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <x-primary-button id="submitBtn"
                                                            class="float-start btn-sm submitBtn">Save
                                                            changes</x-primary-button>
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

        <div class="col-md-4">
            <div class="card alert-info alert-top-border">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i class="mdi mdi-list"></i> Input Parameters For New Item ...
                    </h6>
                </div>
                <div class="card-body">
                    <form id="moduleForm" action="{{ route('inventory.setup.items.store') }}" method="POST">
                        @csrf
                        <x-input-group name="item_name" label="Item Name" placeholder="Enter item name"
                            :value="old('item_name')" required />
                        <x-select-input-group name="goods_category_id" id="goods_category_id" label="Goods Category"
                            :options="$goodsCategories->pluck('name', 'id')" :selected="old('goods_category_id')" required />
                        <!-- load subcategory based on category On change event Load Subcategory -->
                        <x-select-input-group name="goods_subcategory_id" id="goods_subcategory_id"
                            label="Goods Subcategory" :options="[]" :selected="old('goods_subcategory_id')" required />
                        <x-select-input-group name="unit_id" label="Unit" :options="$units->pluck('name', 'id')" :selected="old('unit_id')"
                            required />
                        <x-input-group name="model" label="Model" placeholder="Enter model" :value="old('model')" />
                        <x-input-group name="type" label="Type" placeholder="Enter type" :value="old('type')" />
                        <x-input-group name="remarks" label="Remarks" placeholder="Enter remarks" :value="old('remarks')" />
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
            $('.item-toggle').on('change', function() {
                let id = $(this).data('id');
                let status = $(this).is(':checked') ? 1 : 0;
                $.ajax({
                    url: '{{ route('inventory.setup.items.toggle') }}',
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

            $('.item-toggle').on('change', function() {
                let id = $(this).data('id');
                let status = $(this).is(':checked') ? 1 : 0;
                $.ajax({
                    url: '{{ route('inventory.setup.items.toggle') }}',
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

        $(document).on('click', '.delete-item', function(e) {
            e.preventDefault();
            let itemId = $(this).data('id');
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
                        url: '{{ route('inventory.setup.items.delete') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: itemId
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                'Item has been deleted.',
                                'success'
                            );
                            $('#row-' + itemId).remove();
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
                        'Item has not been deleted.',
                        'error'
                    );
                }
            });
        });

        $(document).ready(function() {
            $('#goods_category_id').on('change', function() {
                let categoryId = $(this).val();
                console.log(categoryId);
                $.ajax({
                    url: '{{ route('inventory.setup.items.getSubcategories') }}',
                    type: 'GET',
                    data: {
                        _token: '{{ csrf_token() }}',
                        category_id: categoryId
                    },
                    success: function(data) {
                        $('#goods_subcategory_id').html(data);
                    },
                    error: function() {
                        toastr.error('Something went wrong!');
                    }
                });
            });
        });
    </script>
@endpush
