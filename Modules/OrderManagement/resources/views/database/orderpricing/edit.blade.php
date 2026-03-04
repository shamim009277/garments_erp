@extends('layouts.app')
@section('title', 'Order Management')
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
                    <form action="{{ route('ordermanagement.database.initialorders.update', $order->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <x-select-input-group name="buyer_id" label="Buyer *" 
                                    :options="$buyers->pluck('buyer_name', 'id')" 
                                    :selected="$order->buyer_id ?? old('buyer_id')" required />
                            </div>
                            <div class="col-md-6">
                                <x-select-input-group name="organization_id" label="Organization" 
                                    :options="$organizations->pluck('name', 'id')" 
                                    :selected="$order->organization_id ?? old('organization_id')" />
                            </div>
                            <div class="col-md-6">
                                <x-input-group name="order_quantity" label="Order Quantity" 
                                    placeholder="Enter order quantity" :value="$order->order_quantity ?? old('order_quantity')" 
                                    type="number" min="0" />
                            </div>
                            <div class="col-md-6">
                                <x-input-group name="style" label="Style" 
                                    placeholder="Enter style" :value="$order->style ?? old('style')" />
                            </div>
                            <div class="col-md-6">
                                <x-input-group name="gsm" label="GSM" 
                                    placeholder="Enter GSM" :value="$order->gsm ?? old('gsm')" />
                            </div>
                            <div class="col-md-6">
                                <x-input-group name="po" label="PO" 
                                    placeholder="Enter PO number" :value="$order->po ?? old('po')" />
                            </div>
                            <div class="col-md-6">
                                <x-input-group name="seasson" label="Season" 
                                    placeholder="Enter season" :value="$order->seasson ?? old('seasson')" />
                            </div>
                            <div class="col-md-6">
                                <x-input-group name="fabrication" label="Fabrication" 
                                    placeholder="Enter fabrication" :value="$order->fabrication ?? old('fabrication')" />
                            </div>
                            <div class="col-md-6">
                                <x-input-group name="finish_type" label="Finish Type" 
                                    placeholder="Enter finish type" :value="$order->finish_type ?? old('finish_type')" />
                            </div>
                            <div class="col-md-6">
                                <x-select-input-group name="color_id" label="Color" 
                                    :options="$colors->pluck('color_code', 'id')" 
                                    :selected="$order->color_id ?? old('color_id')" />
                            </div>
                            <div class="col-md-6">
                                <x-select-input-group name="size_id" label="Size" 
                                    :options="$sizes->pluck('size_name', 'id')" 
                                    :selected="$order->size_id ?? old('size_id')" />
                            </div>
                            <div class="col-md-6">
                                <x-select-input-group name="order_type_id" label="Order Type" 
                                    :options="$orderTypes->pluck('name', 'id')" 
                                    :selected="$order->order_type_id ?? old('order_type_id')" />
                            </div>
                            <div class="col-md-6">
                                <x-select-input-group name="merchant_id" label="Merchant" 
                                    :options="$merchants->pluck('name', 'id')" 
                                    :selected="$order->merchant_id ?? old('merchant_id')" />
                            </div>
                            <div class="col-md-6">
                                <x-select-input-group name="yarn_count_id" label="Yarn Count" 
                                    :options="$yarnCounts->pluck('yarn_count_name', 'id')" 
                                    :selected="$order->yarn_count_id ?? old('yarn_count_id')" />
                            </div>
                            <div class="col-md-6">
                                <x-select-input-group name="product_category_id" label="Product Category" 
                                    :options="$productCategories->pluck('product_category_name', 'id')" 
                                    :selected="$order->product_category_id ?? old('product_category_id')" />
                            </div>
                            <div class="col-6">
                                <x-input-group type="text" name="description" label="Description" 
                                    placeholder="Enter description" :value="$order->description ?? old('description')" />
                            </div>
                            <div class="col-6">
                                <label for="instructions">Instructions</label>
                                <textarea name="instructions" class="form-control" rows="3" 
                                    placeholder="Enter instructions" :value="$order->instructions ?? old('instructions')">
                                    {{ $order->instructions ?? old('instructions') }}
                                </textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-2">
                                <x-primary-button class="float-start btn-sm">Update Order</x-primary-button>
                                <a href="{{ route('ordermanagement.database.initialorders.index') }}" 
                                   class="btn btn-secondary btn-sm float-start">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
