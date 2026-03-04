@extends('layouts.app')
@section('title', 'Sample Delivery')
@section('content')
<div class="row">
    <div class="col-12">
        @include('components.breadcrumb', [
        'title' => 'Sample Delivery',
        'subtitle' => 'Sample Delivery List',
        'breadcrumbs' => [
        ['label' => 'Sample Management', 'url' => route('sms.index')],
        ['label' => 'Database', 'url' => route('sms.index')],
        ['label' => 'Sample Delivery', 'url' => route('sms.database.sampledelivery.index')],
        ],
        ])
    </div>
    <div class="col-12 mb-3">
        <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
            <!-- Centered Title -->
            <h4 class="text-center flex-grow-1 order-1 order-md-0 mb-2 mb-md-0">
                Sample Delivery Challan
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
            <a href="{{ route('sms.database.sampledelivery.index') }}"
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
            $dates = collect($deliveries)->pluck('Date');
            $deliveryList = collect($dates)->unique();
            @endphp
            <div class="card-body" style="min-height: 477px;max-height: 477px; overflow-y: auto;">
                <ul class="nav-custom">
                    @foreach ($deliveryList as $key => $challanDate)
                    <li class="nav-custom-item">
                        <input type="checkbox" id="company{{ $challanDate }}">
                        <label class="nav-custom-link" for="company{{ $challanDate }}">
                            <span class="nav-custom-caret"></span>
                            {{ $challanDate }}
                        </label>
                        @php
                        $buyerIdList = collect($deliveries)->where('Date', $challanDate)->pluck('BuyerID')->unique();
                        $buyerList = collect($buyers)->whereIn('id', $buyerIdList)->all();
                        @endphp
                         <ul class="nav-custom-content">
                                @foreach ($buyerList as $buyer)
                                <li class="nav-custom-item">
                                <input type="checkbox" id="company{{ $buyer->id }} {{ $challanDate }}">
                                <label class="nav-custom-link" for="company{{ $buyer->id }} {{ $challanDate }}">
                                    <span class="nav-custom-caret"></span>
                                    {{ $buyer->buyer_name }}
                                </label>
                                    @php
                                    $chList = collect($deliveries)->where('Date', $challanDate)->where('BuyerID', $buyer->id);
                                    @endphp
                                    <div class="nav-custom-content">
                                        @foreach ($chList as $key => $challan)
                                        <a href="{{ route('sms.database.sampledelivery.show', $challan->id) }}" class="employee-link">
                                            {{ $challan->ChallanNo }}
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
    <div class="col-9">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Create Sample Delivery</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('sms.database.sampledelivery.store') }}" method="POST">
                    <input type="hidden" name="form_type" value="1">
                    @csrf
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Challan No</label>
                            <input type="text" name="ChallanNo" class="form-control form-control-sm" disabled >
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Date</label>
                            <input type="date" name="Date" class="form-control form-control-sm" required value="{{ date('Y-m-d') }}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Buyer</label>
                            <select name="BuyerID" class="form-control form-control-sm select2" required>
                                <option value="">Select Buyer</option>
                                @foreach($buyers as $buyer)
                                    <option value="{{ $buyer->id }}">{{ $buyer->buyer_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Employee</label>
                            <select name="EmployeeID" class="form-control form-control-sm select2" required>
                                <option value="">Select Employee</option>
                                @foreach($employees as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Challan Type</label>
                            <select name="ChallanType" class="form-select form-select-sm" required>
                                <option value="1">Returnable</option>
                                <option value="2">Non-Returnable</option>
                                <option value="3">Export</option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Goods Type</label>
                            <select name="GoodsType" class="form-select form-select-sm" required>
                                <option value="1">Gray Fabric</option>
                                <option value="2">Complete Body</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Comments</label>
                            <input type="text" name="Comments" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="reset" class="btn btn-danger btn-sm">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm float-end">Save Delivery</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
   
</div>
@endsection
<script>
    $(document).ready(function() {
        // Initialize Select2
        $('.select2').select2();

        

    });
</script>