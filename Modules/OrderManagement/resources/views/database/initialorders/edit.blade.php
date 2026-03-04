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
                'subtitle' => 'Edit Initial Order',
                'breadcrumbs' => [
                    ['label' => 'Order Management', 'url' => route('ordermanagement.index')],
                    ['label' => 'Database', 'url' => route('ordermanagement.index')],
                    ['label' => 'Initial Orders', 'url' => route('ordermanagement.database.initialorders.index')],
                    ['label' => 'Edit', 'url' => '#'],
                ],
            ])
        </div>
        <div class="col-12">
            <div class="card alert-warning alert-top-border">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i class="mdi mdi-edit"></i> Edit Initial Order: {{ $order->order_code }}
                    </h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('ordermanagement.database.initialorders.update', $order->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <!-- Basic Information -->
                            <div class="col-md-6">
                                <h6 class="text-primary mb-3">Basic Information</h6>
                                <table class="table table-sm">
                                    <tr>
                                        <td width="30%"><strong>Buyer *:</strong></td>
                                        <td width="70%">
                                            <x-select-input name="buyer_id" class="form-control-sm select2" 
                                                :options="$buyers->pluck('buyer_name', 'id')" 
                                                :selected="$order->buyer_id ?? old('buyer_id')" required />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Organization *:</strong></td>
                                        <td>
                                            <x-select-search-input name="organization_id" required
                                                :options="$organizations->pluck('name', 'id')" 
                                                :selected="$order->organization_id ?? old('organization_id')" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Order Quantity:</strong></td>
                                        <td>
                                            <x-text-input name="order_quantity" class="form-control-sm" 
                                                placeholder="Enter order quantity" :value="$order->order_quantity ?? old('order_quantity')" 
                                                type="number" min="0" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Style:</strong></td>
                                        <td>
                                            <x-text-input name="style" class="form-control-sm" 
                                                placeholder="Enter style" :value="$order->style ?? old('style')" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>PO:</strong></td>
                                        <td>
                                            <x-text-input name="po" class="form-control-sm" 
                                                placeholder="Enter PO number" :value="$order->po ?? old('po')" />
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
                                                placeholder="Enter GSM" :value="$order->gsm ?? old('gsm')" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Season:</strong></td>
                                        <td>
                                            <x-text-input name="seasson" class="form-control-sm" 
                                                placeholder="Enter season" :value="$order->seasson ?? old('seasson')" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Fabrication:</strong></td>
                                        <td>
                                            <x-text-input name="fabrication" class="form-control-sm" 
                                                placeholder="Enter fabrication" :value="$order->fabrication ?? old('fabrication')" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Finish Type:</strong></td>
                                        <td>
                                            <x-text-input name="finish_type" class="form-control-sm" 
                                                placeholder="Enter finish type" :value="$order->finish_type ?? old('finish_type')" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Color:</strong></td>
                                        <td>
                                            <x-select-multiple-input name="color_id[]" multiple 
                                                :options="$colors->pluck('color_name', 'id')" 
                                                :selected="$order->colors->pluck('id')->toArray() ?? old('color_id')" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Size:</strong></td>
                                        <td>
                                            <x-select-multiple-input name="size_id[]" multiple 
                                                :options="$sizes->pluck('size_name', 'id')" 
                                                :selected="$order->sizes->pluck('id')->toArray() ?? old('size_id')" />
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <!-- Order Details -->
                            <div class="col-md-6">
                                <h6 class="text-primary mb-3">Order Details</h6>
                                <table class="table table-sm">
                                    <tr>
                                        <td width="30%"><strong>Order Type:</strong></td>
                                        <td width="70%">
                                            <x-select-search-input name="order_type_id" 
                                                :options="$orderTypes->pluck('order_type', 'id')" 
                                                :selected="$order->order_type_id ?? old('order_type_id')" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Merchant:</strong></td>
                                        <td>
                                            <x-select-search-input name="merchant_id" 
                                                :options="$merchants->pluck('name', 'id')" 
                                                :selected="$order->merchant_id ?? old('merchant_id')" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Yarn Count:</strong></td>
                                        <td>
                                            <x-select-search-input name="yarn_count_id" 
                                                :options="$yarnCounts->pluck('yarn_count_name', 'id')" 
                                                :selected="$order->yarn_count_id ?? old('yarn_count_id')" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Product Category:</strong></td>
                                        <td>
                                            <x-select-search-input name="product_category_id" 
                                                :options="$productCategories->pluck('product_category_name', 'id')" 
                                                :selected="$order->product_category_id ?? old('product_category_id')" />
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
                                                placeholder="Enter description" :value="$order->description ?? old('description')" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Upload File:</strong></td>
                                        <td>
                                            <input type="file" name="file" class="form-control form-control-sm">
                                            @if($order->file)
                                                <div class="mt-1">
                                                    <small>Current file: <a href="{{ asset($order->file) }}" target="_blank">View</a></small>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Instructions:</strong></td>
                                        <td>
                                            <textarea name="instructions" class="form-control form-control-sm" rows="3" 
                                                placeholder="Enter instructions">{{ $order->instructions ?? old('instructions') }}</textarea>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12">
                                <x-primary-button class="float-start">Update Order</x-primary-button>
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
