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
                                <th width="10%">Item Image</th>
                                <th width="10%">Goods Category</th>
                                <th width="10%">Goods Subcategory</th>
                                <th width="10%">Unit</th>
                                {{-- //varient --}}
                                <th width="10%">Model</th>
                                <th width="10%">Type</th>
                                <th width="10%">Remarks</th>
                                {{-- //present stock --}}
                                <th width="10%">Present Stock</th>
                                {{-- //item status --}}
                                <th width="10%">Item Status</th>
                                <th width="10%">Action</th>
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
                                    <td>{{ $item->unit->unit_name }}</td>
                                    <td>{{ $item->model }}</td>
                                    <td>{{ $item->type }}</td>
                                    <td>{{ $item->remarks }}</td>
                                    <td>{{ $item->present_stock }}</td>
                                    <td>{{ $item->is_active ? 'Active' : 'Inactive' }}</td>
                                    <td>
                                        <a href="{{ route('inventory.setup.items.edit', $item->id) }}"
                                            class="btn btn-primary btn-sm"><i class="mdi mdi-pencil"></i></a>
                                        <a href="{{ route('inventory.setup.items.destroy', $item->id) }}"
                                            class="btn btn-danger btn-sm"><i class="mdi mdi-delete"></i></a>
                                    </td>
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
