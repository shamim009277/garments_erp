@extends('layouts.app')
@section('title', 'Order Management')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'Order Management',
                'subtitle' => 'Brand Categories',
                'breadcrumbs' => [
                    ['label' => 'Order Management', 'url' => route('ordermanagement.index')],
                    ['label' => 'Setup', 'url' => route('ordermanagement.index')],
                    ['label' => 'Brand Categories', 'url' => route('ordermanagement.setup.brandcategories.index')],
                ],
            ])
        </div>
        <div class="col-md-8">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Brand Categories List
                    </h6>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100" width="100%">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th width="25%">Category Name</th>
                                <th width="20%">Category Code</th>
                                <th width="20%">Organization</th>
                                <th width="15%">Status</th>
                                <th width="15%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($brandCategories as $key => $brandCategory)
                                <tr>
                                    <td width="5%">{{ $key + 1 }}</td>
                                    <td width="25%">{{ $brandCategory->category_name }}</td>
                                    <td width="20%">{{ $brandCategory->category_code }}</td>
                                    <td width="20%">{{ $brandCategory->organization->name ?? 'N/A' }}</td>
                                    <td class="text-center">
                                        <p class="text-{{ $brandCategory->is_active ? 'success' : 'danger' }}">
                                            {{ $brandCategory->is_active ? 'Active' : 'Inactive' }}</p>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-soft-success waves-effect waves-light"
                                            style="padding: 4px 6px;" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $brandCategory->id }}"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('ordermanagement.setup.brandcategories.destroy', $brandCategory->id) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this brand category?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                {{-- load edit modal --}}
                                <div class="modal fade" id="editModal{{ $brandCategory->id }}" tabindex="-1"
                                    aria-labelledby="editModalLabel{{ $brandCategory->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel{{ $brandCategory->id }}">Edit Brand Category
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="moduleForm"
                                                    action="{{ route('ordermanagement.setup.brandcategories.update', $brandCategory->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <x-input-group name="category_name" label="Category Name"
                                                                placeholder="Enter category name" :value="$brandCategory->category_name??old('category_name')" required />
                                                        </div>
                                                        <div class="col-md-12">
                                                            <x-input-group name="category_code" label="Category Code"
                                                                placeholder="Enter category code" :value="$brandCategory->category_code??old('category_code')" />
                                                        </div>
                                                        <div class="col-md-12">
                                                            <x-select-input-group name="organization_id" label="Organization"
                                                                :options="$organizations->pluck('name', 'id')" :selected="$brandCategory->organization_id??old('organization_id')" />
                                                        </div>
                                                        <div class="col-md-12">
                                                            <x-select-input-group name="is_active" label="Is Active?"
                                                                :options="['1' => 'Active', '0' => 'Inactive']" :selected="$brandCategory->is_active ? '1' : '0'" required />
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
                    <h6 class="my-0 text-primary"> <i class="mdi mdi-list"></i> Input Parameters For New Brand Category ...
                    </h6>
                </div>
                <div class="card-body">
                    <form id="moduleForm" action="{{ route('ordermanagement.setup.brandcategories.store') }}" method="POST">
                        @csrf
                        <x-input-group name="category_name" label="Category Name" placeholder="Enter category name" :value="old('category_name')" required />
                        <x-input-group name="category_code" label="Category Code" placeholder="Enter category code" :value="old('category_code')" />
                        <x-select-input-group name="organization_id" label="Organization" :options="$organizations->pluck('name', 'id')" :selected="old('organization_id')" />
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
            // Add any specific JavaScript for Brand Categories if needed
        });
    </script>
@endpush
