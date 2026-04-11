@extends('layouts.app')
@section('title', 'Order Management')
@section('styles')
<style>
    .table,
    tr,
    th,
    td {
        border: none !important;
        border-collapse: collapse;
    }
</style>
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        @include('components.breadcrumb', [
        'title' => 'Order Management',
        'subtitle' => 'Initial Orders',
        'breadcrumbs' => [
        ['label' => 'Order Management', 'url' => route('ordermanagement.index')],
        ['label' => 'Database', 'url' => route('ordermanagement.index')],
        ['label' => 'Initial Orders', 'url' => route('ordermanagement.database.initialorders.index')],
        ],
        ])
    </div>
    <div class="col-12 mb-3">
        <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
            <!-- Centered Title -->
            <h4 class="text-center flex-grow-1 order-1 order-md-0 mb-2 mb-md-0">
                Initial Orders
            </h4>

            <!-- Search Input + Button in One Line -->
            <form action="#" method="POST" class="d-flex order-0 order-md-1 mb-2 mb-md-0 me-md-2"
                style="max-width: 400px;" role="search">
                @csrf
                <input class="form-control form-control-sm me-2" type="search" name="search"
                    placeholder="Basic Order No ..." aria-label="Search">
                <button class="btn btn-sm btn-primary d-flex align-items-center" type="submit"><i data-feather="search"
                        width="14" height="14" class="me-1"></i> Search</button>
            </form>
            @if (1)
            <!-- Back Button -->
            <a href="{{ route('ordermanagement.database.initialorders.index') }}"
                class="btn btn-sm btn-info d-flex align-items-center order-2 order-md-2">
                <i data-feather="arrow-left" width="14" height="14" class="me-1"></i> Back
            </a>
            @endif
        </div>
    </div>
    <div class="col-md-3">
        <div class="card alert-primary alert-top-border padding-card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <i data-feather="list" width="16" height="16"></i>
                    <h6 class="my-0 text-primary ms-2">Initial Orders List</h6>
                </div>
            </div>
            @php
            $org = collect($orders)->pluck('organization');
            $orgList = collect($org)->unique();
            @endphp
            <div class="card-body" style="min-height: 677px;max-height: 677px; overflow-y: auto;">
                <ul class="nav-custom">
                    @foreach ($orgList as $key => $org)
                    <li class="nav-custom-item">
                        <input type="checkbox" id="company{{ $org->id }}">
                        <label class="nav-custom-link" for="company{{ $org->id }}">
                            <span class="nav-custom-caret"></span>
                            {{ $org->name }}
                        </label>
                        @php
                        $ordList = collect($orders)->where('organization_id', $org->id);
                        $buyerList = collect($ordList)->pluck('buyer')->unique();
                        @endphp
                        <ul class="nav-custom-content">
                            @foreach ($buyerList as $key => $buyer)
                            <li class="nav-custom-item">
                                <input type="checkbox" id="buyer{{ $buyer->id }}{{ $org->id }}">
                                <label class="nav-custom-link" for="buyer{{ $buyer->id }}{{ $org->id }}">
                                    <span class="nav-custom-caret"></span>
                                    {{ $buyer->buyer_name }}
                                </label>
                                @php
                                $ordList = collect($orders)->where('organization_id', $org->id)->where('buyer_id', $buyer->id);
                                @endphp
                                <div class="nav-custom-content">
                                    @foreach ($ordList as $key => $order)
                                    <a href="{{ route('ordermanagement.database.initialorders.show', $order->id) }}" class="employee-link">
                                        {{ $order->order_code }}
                                    </a>
                                    @endforeach
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card alert-info alert-top-border">
            <div class="card-header">
                <h6 class="my-0 text-primary"> <i class="mdi mdi-plus"></i> Create New Initial Order
                </h6>
            </div>
            <div class="card-body">
                <form action="{{ route('ordermanagement.database.initialorders.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <!-- Basic Information -->
                        <div class="col-md-6">
                            <h6 class="text-primary mb-3">Basic Information</h6>
                            <table class="table table-sm">
                                <tr>
                                    <td><strong>Organization *:</strong></td>
                                    <td>
                                        <x-select-search-input name="organization_id" required class="form-control form-control-sm"
                                            :options="$organizations->pluck('name', 'id')"
                                            :selected="old('organization_id')" />
                                    </td>
                                </tr>
                                <tr>
                                    <td width="30%"><strong>Buyer *:</strong></td>
                                    <td width="70%">
                                        <x-select-search-input name="buyer_id" class="form-control form-control-sm"
                                            :options="$buyers->pluck('buyer_name', 'id')"
                                            :selected="old('buyer_id')" required />
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Order Quantity *:</strong></td>
                                    <td>
                                        <x-text-input name="order_quantity" class="form-control-sm"
                                            placeholder="Enter order quantity" :value="old('order_quantity')"
                                            type="number" min="0" required />
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Style:</strong></td>
                                    <td>
                                        <x-text-input name="style" class="form-control-sm"
                                            placeholder="Enter style" :value="old('style')" />
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>PO:</strong></td>
                                    <td>
                                        <x-text-input name="po" class="form-control-sm"
                                            placeholder="Enter PO number" :value="old('po')" />
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <!-- Technical Details -->
                        <div class="col-md-6">
                            <h6 class="text-primary mb-3">Technical Details</h6>
                            <table class="table table-sm">
                                <tr>
                                    <td width="30%"><strong>GSM:</strong></td>
                                    <td width="70%">
                                        <x-text-input name="gsm" class="form-control-sm"
                                            placeholder="Enter GSM" :value="old('gsm')" />
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Season:</strong></td>
                                    <td>
                                        <x-text-input name="seasson" class="form-control-sm"
                                            placeholder="Enter season" :value="old('seasson')" />
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Fabrication:</strong></td>
                                    <td>
                                        <x-text-input name="fabrication" class="form-control-sm"
                                            placeholder="Enter fabrication" :value="old('fabrication')" />
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Finish Type:</strong></td>
                                    <td>
                                        <x-text-input name="finish_type" class="form-control-sm"
                                            placeholder="Enter finish type" :value="old('finish_type')" />
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Color:</strong></td>
                                    <td>
                                        <x-select-multiple-input name="color_id[]" multiple
                                            :options="$colors->pluck('color_name', 'id')"
                                            :selected="old('color_id')" />
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Size:</strong></td>
                                    <td>
                                        <x-select-multiple-input name="size_id[]" multiple
                                            :options="$sizes->pluck('size_name', 'id')"
                                            :selected="old('size_id')" />
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <!-- Order Details -->
                        <div class="col-md-6">
                            <h6 class="text-primary mb-3">Order Details</h6>
                            <table class="table table-sm">
                                <tr>
                                    <td width="30%"><strong>Order Type *:</strong></td>
                                    <td width="70%">
                                        <x-select-search-input name="order_type_id"
                                            :options="$orderTypes->pluck('order_type', 'id')"
                                            :selected="old('order_type_id')" />
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Merchant *:</strong></td>
                                    <td>
                                        <x-select-search-input name="merchant_id"
                                            :options="$merchants->pluck('name', 'id')"
                                            :selected="old('merchant_id')" required />
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Yarn Count *:</strong></td>
                                    <td>
                                        <x-select-search-input name="yarn_count_id"
                                            :options="$yarnCounts->pluck('yarn_count_name', 'id')"
                                            :selected="old('yarn_count_id')" required />
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Product Category *:</strong></td>
                                    <td>
                                        <x-select-search-input name="product_category_id"
                                            :options="$productCategories->pluck('product_category_name', 'id')"
                                            :selected="old('product_category_id')" required />
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <!-- Additional Information -->
                        <div class="col-md-6">
                            <h6 class="text-primary mb-3">Additional Information</h6>
                            <table class="table table-sm">
                                <tr>
                                    <td width="30%"><strong>Description:</strong></td>
                                    <td width="70%">
                                        <x-text-input name="description" class="form-control-sm"
                                            placeholder="Enter description" :value="old('description')" />
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Upload File:</strong></td>
                                    <td>
                                        <input type="file" name="file" class="form-control form-control-sm">
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Instructions:</strong></td>
                                    <td>
                                        <textarea name="instructions" class="form-control form-control-sm" rows="3"
                                            placeholder="Enter instructions">{{ old('instructions') }}</textarea>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-12">
                            <x-primary-button class="float-start">Save Order</x-primary-button>
                            <a href="{{ route('ordermanagement.database.initialorders.index') }}"
                                class="btn btn-secondary float-start ms-2">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
{{-- <script>
        $(document).ready(function() {
            $('#datatable').DataTable({
                responsive: true,
                pageLength: 10,
                ordering: true,
                searching: true
            });
        });
    </script> --}}
@endpush