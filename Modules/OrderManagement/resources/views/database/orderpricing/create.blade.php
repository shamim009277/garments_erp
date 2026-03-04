@extends('layouts.app')
@section('title', 'Order Management')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'Order Management',
                'subtitle' => 'Create Initial Order',
                'breadcrumbs' => [
                    ['label' => 'Order Management', 'url' => route('ordermanagement.index')],
                    ['label' => 'Database', 'url' => route('ordermanagement.index')],
                    ['label' => 'Initial Orders', 'url' => route('ordermanagement.database.initialorders.index')],
                    ['label' => 'Create', 'url' => route('ordermanagement.database.initialorders.create')],
                ],
            ])
        </div>
        <div class="col-12">
            <div class="card alert-info alert-top-border">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i class="mdi mdi-plus"></i> Create New Initial Order
                    </h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('ordermanagement.database.initialorders.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <x-select-input-group name="buyer_id" label="Buyer *" 
                                    :options="$buyers->pluck('buyer_name', 'id')" 
                                    :selected="old('buyer_id')" required />
                            </div>
                            <div class="col-md-6">
                                <x-select-input-group name="organization_id" label="Organization" 
                                    :options="$organizations->pluck('name', 'id')" 
                                    :selected="old('organization_id')" />
                            </div>
                            <div class="col-md-6">
                                <x-input-group name="order_quantity" label="Order Quantity" 
                                    placeholder="Enter order quantity" :value="old('order_quantity')" 
                                    type="number" min="0" />
                            </div>
                            <div class="col-md-6">
                                <x-input-group name="style" label="Style" 
                                    placeholder="Enter style" :value="old('style')" />
                            </div>
                            <div class="col-md-6">
                                <x-input-group name="gsm" label="GSM" 
                                    placeholder="Enter GSM" :value="old('gsm')" />
                            </div>
                            <div class="col-md-6">
                                <x-input-group name="po" label="PO" 
                                    placeholder="Enter PO number" :value="old('po')" />
                            </div>
                            <div class="col-md-6">
                                <x-input-group name="seasson" label="Season" 
                                    placeholder="Enter season" :value="old('seasson')" />
                            </div>
                            <div class="col-md-6">
                                <x-input-group name="fabrication" label="Fabrication" 
                                    placeholder="Enter fabrication" :value="old('fabrication')" />
                            </div>
                            <div class="col-md-6">
                                <x-input-group name="finish_type" label="Finish Type" 
                                    placeholder="Enter finish type" :value="old('finish_type')" />
                            </div>
                            <div class="col-md-6">
                                <x-select-input-group name="color_id" label="Color" 
                                    :options="$colors->pluck('name', 'id')" 
                                    :selected="old('color_id')" />
                            </div>
                            <div class="col-md-6">
                                <x-select-input-group name="size_id" label="Size" 
                                    :options="$sizes->pluck('name', 'id')" 
                                    :selected="old('size_id')" />
                            </div>
                            <div class="col-md-6">
                                <x-select-input-group name="order_type_id" label="Order Type" 
                                    :options="$orderTypes->pluck('name', 'id')" 
                                    :selected="old('order_type_id')" />
                            </div>
                            <div class="col-md-6">
                                <x-select-input-group name="merchant_id" label="Merchant" 
                                    :options="$merchants->pluck('name', 'id')" 
                                    :selected="old('merchant_id')" />
                            </div>
                            <div class="col-md-6">
                                <x-select-input-group name="yarn_count_id" label="Yarn Count" 
                                    :options="$yarnCounts->pluck('name', 'id')" 
                                    :selected="old('yarn_count_id')" />
                            </div>
                            <div class="col-md-6">
                                <x-select-input-group name="product_category_id" label="Product Category" 
                                    :options="$productCategories->pluck('name', 'id')" 
                                    :selected="old('product_category_id')" />
                            </div>
                            {{-- <div class="col-12">
                                <x-textarea-group name="description" label="Description" 
                                    placeholder="Enter description" :value="old('description')" />
                            </div>
                            <div class="col-12">
                                <x-textarea-group name="instructions" label="Instructions" 
                                    placeholder="Enter instructions" :value="old('instructions')" />
                            </div> --}}
                        </div>
                        <div class="row">
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
