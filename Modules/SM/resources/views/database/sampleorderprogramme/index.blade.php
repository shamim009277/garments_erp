@extends('layouts.app')
@section('title', 'Sample Management')
@section('styles')
<style>
    .table, tr, th, td { border: none !important; border-collapse: collapse; }
</style>
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        @include('components.breadcrumb', [
        'title' => 'Sample Management',
        'subtitle' => 'Sample Management',
        'breadcrumbs' => [
        ['label' => 'Sample Management', 'url' => route('sms.index')],
        ['label' => 'Database', 'url' => route('sms.index')],
        ['label' => 'Sample Management', 'url' => route('sms.database.sampleorderprogramme.index')],
        ],
        ])
    </div>
    <div class="col-12 mb-3">
        <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
            <!-- Centered Title -->
            <h4 class="text-center flex-grow-1 order-1 order-md-0 mb-2 mb-md-0">
                Sample Order Programme
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
            <a href="{{ route('sms.database.sampleorderprogramme.index') }}"
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
            <div class="card-body" style="min-height: 477px;max-height: 477px; overflow-y: auto;">
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
                                    <a href="{{ route('sms.database.sampleorderprogramme.show', $order->id) }}" class="employee-link">
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
            <div class="card-body">
                <p class="text-center text-muted">Select an order from the list to view/add Sample Order Programme.</p>
            </div>
        </div>
    </div>
</div>
@endsection
