@extends('layouts.app')
@section('title', 'ORDER MANAGEMENT')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'ORDER MANAGEMENT',
                'subtitle' => 'Basic Orders',
                'breadcrumbs' => [
                    ['label' => 'ORDER MANAGEMENT', 'url' => route('ordermanagement.index')],
                    ['label' => 'Database', 'url' => route('ordermanagement.index')],
                    ['label' => 'Basic Orders', 'url' => route('ordermanagement.database.boms.index')],
                ],
            ])
        </div>
        <div class="col-12 mb-3">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                <!-- Centered Title -->
                <h4 class="text-center flex-grow-1 order-1 order-md-0 mb-2 mb-md-0">
                    Bom
                </h4>

                <!-- Search Input + Button in One Line -->
                <form action="#" method="POST" class="d-flex order-0 order-md-1 mb-2 mb-md-0 me-md-2"
                    style="max-width: 400px;" role="search">
                    @csrf
                    <input class="form-control form-control-sm me-2" type="search" name="search"
                        placeholder="Order No ..." aria-label="Search">
                    <button class="btn btn-sm btn-primary d-flex align-items-center" type="submit"><i data-feather="search"
                            width="14" height="14" class="me-1"></i> Search</button>
                </form>
                @if (1)
                    <!-- Back Button -->
                    <a href="{{ route('ordermanagement.database.boms.index') }}"
                        class="btn btn-sm btn-info d-flex align-items-center order-2 order-md-2">
                        <i data-feather="arrow-left" width="14" height="14" class="me-1"></i> Back
                    </a>
                @endif
            </div>
        </div>

        <div class="col-lg-3 pe-lg-0">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="18" height="18"></i> Basic Order
                        List</h6>
                </div>
                <div class="card-body" style="min-height: 457px;max-height: 457px; overflow-y: auto;">
                    <ul class="nav-custom">
                        @foreach ($buyers as $buyer)
                            @php
                                $buyerOrders = collect($ListOfOrders)->where('buyer_id', $buyer->id);

                            @endphp
                            <li class="nav-custom-item">
                                <input type="checkbox" id="buyer{{ $buyer->id }}">
                                <label class="nav-custom-link" for="buyer{{ $buyer->id }}"><span
                                        class="nav-custom-caret"></span> {{ $buyer->buyer_name }}
                                    ({{ $buyerOrders->count() }})</label>
                                <div class="nav-custom-content">
                                    <ul class="nav-custom">
                                        @foreach ($buyerOrders as $order)
                                            <li class="nav-custom-item">
                                                <a href="{{ route('ordermanagement.database.boms.show', $order->id) }}">
                                                    <label class="nav-custom-link" for="order{{ $order->id }}"><span
                                                            class="nav-custom-caret"></span> {!! $order->order_no !!}: {!! $order->style_no !!}</label>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    
@endpush
