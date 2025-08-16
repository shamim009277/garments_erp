@extends('layouts.app')
@section('title', 'INVENTORY')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'INVENTORY',
                'subtitle' => 'Goods Sub Categories',
                'breadcrumbs' => [
                    ['label' => 'INVENTORY', 'url' => route('inventory.index')],
                    ['label' => 'Setup', 'url' => route('inventory.index')],
                    ['label' => 'Goods Sub Categories', 'url' => route('inventory.setup.goodsSubCategories.index')],    
                ],
            ])
        </div>
        <div class="col-md-8">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Goods Sub Categories
                        List
                    </h6>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100" width="100%">
                        <thead>
                            {{-- $table->unsignedBigInteger('goods_category_id');
                            $table->unsignedBigInteger('organization_id');
                            $table->string('name');
                            $table->string('subcategory_code', 20)->nullable();
                            $table->string('bn_name')->nullable();
                            $table->boolean('is_active')->default(true);
                
                            $table->unsignedBigInteger('created_by')->nullable();
                            $table->unsignedBigInteger('updated_by')->nullable();
                            //foreign key
                            $table->foreign('goods_category_id')->references('id')->on('inventory_setup_goods_categories')->onDelete('cascade');
                            $table->foreign('organization_id')->references('id')->on('hris_setup_organizations')->onDelete('cascade');
                            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
                            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade'); 
                            $table->timestamps(); --}}
                            <tr>
                                <th>#</th>
                                <th>Category Name</th>
                                <th>Name</th>
                                <th>Sub Category Code</th>
                                <th>BN Name</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($goodsSubCategories as $key => $goodsSubCategory)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        {{-- show category name --}}
                                        {{ $goodsSubCategory->goodsCategory->name }}
                                    </td>
                                    <td>{{ $goodsSubCategory->name }}</td>
                                    <td>{{ $goodsSubCategory->sub_category_code }}</td>
                                    <td>{{ $goodsSubCategory->bn_name }}</td>
                                    <td>
                                        <div class="square-switch">
                                            <input type="checkbox" id="square-switch3{{ $goodsSubCategory->id }}" class="goodsSubCategory-toggle" data-id="{{ $goodsSubCategory->id }}" switch="bool" {{ $goodsSubCategory->is_active ? 'checked' : '' }} />
                                            <label for="square-switch3{{ $goodsSubCategory->id }}" data-on-label="Yes" data-off-label="No" style="margin: 0px; vertical-align: middle;"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-soft-success waves-effect waves-light "
                                            style="padding: 4px 6px;" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $goodsSubCategory->id }}"><i
                                                class="fas fa-edit"></i></a>
                                        {{--  --}}
                                        <a href="#" class="btn btn-soft-danger waves-effect waves-light delete-goodsSubCategory" data-id="{{ $goodsSubCategory->id }}" style="padding: 4px 6px;"><i class="fas fa-trash"></i></a> 
                                    </td>
                                </tr>
                                {{-- load edit modal --}}
                                <div class="modal fade" id="editModal{{ $goodsSubCategory->id }}" tabindex="-1"
                                    aria-labelledby="editModalLabel{{ $goodsSubCategory->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel{{ $goodsSubCategory->id }}">Edit
                                                    Goods Sub Category</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="moduleForm"
                                                    action="{{ route('inventory.setup.goodsSubCategories.update', $goodsSubCategory->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    
                                                    <x-input-group name="name" label="Name" :value="$goodsSubCategory->name"
                                                        required />
                                                    <x-input-group name="bn_name" label="BN Name" :value="$goodsSubCategory->bn_name"
                                                        required />
                                                    <x-select-input-group name="goods_category_id" label="Goods Category" :options="$goodscategories->pluck('name', 'id')" :selected="$goodsSubCategory->goods_category_id" required />
                                                    <x-select-input-group name="organization_id" label="Organization" :options="$organizations->pluck('name', 'id')" :selected="$goodsSubCategory->organization_id" required />
                                                    <x-select-input-group name="is_active" label="Is Active?"
                                                        :options="['1' => 'Active', '0' => 'Inactive']" :selected="$goodsSubCategory->is_active ? '1' : '0'" required />
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
                    <h6 class="my-0 text-primary"> <i class="mdi mdi-list"></i> Input Parameters For New Goods Sub Category ...
                    </h6>
                </div>
                <div class="card-body">
                    <form id="moduleForm" action="{{ route('inventory.setup.goodsSubCategories.store') }}" method="POST">
                        @csrf                       
                        <x-input-group name="name" label="Name" placeholder="Enter name" :value="old('name')" required />
                        <x-input-group name="bn_name" label="BN Name" placeholder="Enter bn name"
                            :value="old('bn_name')" required />
                        <x-select-input-group name="goods_category_id" label="Goods Category" :options="$goodscategories->pluck('name', 'id')" :selected="old('goods_category_id')" required />
                        <x-select-input-group name="organization_id" label="Organization" :options="$organizations->pluck('name', 'id')" :selected="old('organization_id')" required />
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
            console.log('ready');
            $('.goodsSubCategory-toggle').on('change', function() {
                console.log('change');
                let id = $(this).data('id');
                let status = $(this).is(':checked') ? 1 : 0;
                
                $.ajax({
                    url: '{{ route('inventory.setup.goodsSubCategories.toggle') }}',
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

        $(document).on('click', '.delete-goodsSubCategory', function(e) {
            console.log('delete');
            e.preventDefault();
            let goodsSubCategoryId = $(this).data('id');
            console.log(goodsSubCategoryId);
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
                        url: '{{ route('inventory.setup.goodsSubCategories.delete') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: goodsSubCategoryId
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                'District has been deleted.',
                                'success'
                            );
                            $('#row-' + goodsSubCategoryId).remove();
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
