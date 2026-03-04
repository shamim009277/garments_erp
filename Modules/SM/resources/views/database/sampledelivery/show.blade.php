@extends('layouts.app')
@section('title', 'Sample Delivery Details')
@section('content')
<div class="row">
    <div class="col-12">
        @include('components.breadcrumb', [
        'title' => 'Sample Delivery Details',
        'subtitle' => 'Sample Delivery Details',
        'breadcrumbs' => [
        ['label' => 'Sample Management', 'url' => route('sms.index')],
        ['label' => 'Database', 'url' => route('sms.index')],
        ['label' => 'Sample Delivery', 'url' => route('sms.database.sampledelivery.index')],
        ['label' => 'Details', 'url' => '#'],
        ],
        ])
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title">Delivery Information: {{ $delivery->ChallanNo }}</h5>
                <a href="{{ route('sms.database.sampledelivery.index') }}" class="btn btn-secondary btn-sm">Back to List</a>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-3">
                        <strong>Date:</strong> {{ $delivery->Date }}
                    </div>
                    <div class="col-md-3">
                        <strong>Buyer:</strong> {{ $delivery->buyer->buyer_name ?? 'N/A' }}
                    </div>
                    <div class="col-md-3">
                        <strong>Employee:</strong> {{ $delivery->employee->name ?? 'N/A' }}
                    </div>
                    <div class="col-md-3">
                        <strong>Challan Type:</strong>
                        @if($delivery->ChallanType == 1) Returnable
                        @elseif($delivery->ChallanType == 2) Non-Returnable
                        @elseif($delivery->ChallanType == 3) Export
                        @endif
                    </div>
                    <div class="col-md-3">
                        <strong>Goods Type:</strong>
                        @if($delivery->GoodsType == 1) Gray Fabric
                        @elseif($delivery->GoodsType == 2) Complete Body
                        @endif
                    </div>
                    <div class="col-md-6">
                        <strong>Comments:</strong> {{ $delivery->Comments }}
                    </div>
                </div>

                <h5>Items</h5>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Sample Programme</th>
                                <th>Style</th>
                                <th>Order Code</th>
                                <th>Color</th>
                                <th>Quantity</th>
                                <th>Comments</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($delivery->details as $detail)
                            <tr>
                                <td>{{ $detail->sampleOrderProgramme->item->product_category_name ?? 'Item' }}</td>
                                <td>{{ $detail->sampleOrderProgramme->style_no ?? 'N/A' }}</td>
                                <td>{{ $detail->sampleOrderProgramme->initialOrder->order_code ?? 'N/A' }}</td>
                                <td>{{ $detail->Color }}</td>
                                <td>{{ $detail->Quantity }}</td>
                                <td>{{ $detail->Comments }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
