@extends('layouts.app')
@section('title', 'Sample Production Report')
@section('content')
<div class="row">
    <div class="col-12">
        @include('components.breadcrumb', [
        'title' => 'Sample Management',
        'subtitle' => 'Sample Production Report',
        'breadcrumbs' => [
        ['label' => 'Sample Management', 'url' => route('sms.index')],
        ['label' => 'Report', 'url' => '#'],
        ['label' => 'Sample Production Report', 'url' => route('sms.report.sample_production')],
        ],
        ])
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Filter Report</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('sms.report.sample_production') }}" method="GET">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="buyer_id" class="form-label">Buyer</label>
                            <select name="buyer_id" id="buyer_id" class="form-control select2">
                                <option value="">Select Buyer</option>
                                @foreach($buyers as $buyer)
                                    <option value="{{ $buyer->id }}" {{ request('buyer_id') == $buyer->id ? 'selected' : '' }}>{{ $buyer->buyer_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="order_id" class="form-label">Order</label>
                            <select name="order_id" id="order_id" class="form-control select2">
                                <option value="">Select Order</option>
                                @foreach($orders as $order)
                                    <option value="{{ $order->id }}" {{ request('order_id') == $order->id ? 'selected' : '' }}>{{ $order->order_code }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="color_id" class="form-label">Color</label>
                            <select name="color_id" id="color_id" class="form-control select2">
                                <option value="">Select Color</option>
                                @foreach($colors as $color)
                                    <option value="{{ $color->id }}" {{ request('color_id') == $color->id ? 'selected' : '' }}>{{ $color->color_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="sample_type_id" class="form-label">Sample Type</label>
                            <select name="sample_type_id" id="sample_type_id" class="form-control select2">
                                <option value="">Select Sample Type</option>
                                @foreach($sampleTypes as $sampleType)
                                    <option value="{{ $sampleType->id }}" {{ request('sample_type_id') == $sampleType->id ? 'selected' : '' }}>{{ $sampleType->sample_type_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="date_from" class="form-label">Date From</label>
                            <input type="date" name="date_from" id="date_from" class="form-control" value="{{ request('date_from') }}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="date_to" class="form-label">Date To</label>
                            <input type="date" name="date_to" id="date_to" class="form-control" value="{{ request('date_to') }}">
                        </div>
                        <div class="col-md-2 mb-3 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100">Filter</button>
                        </div>
                        <div class="col-md-2 mb-3 d-flex align-items-end">
                            <a href="{{ route('sms.report.sample_production') }}" class="btn btn-secondary w-100">Reset</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h5 class="card-title">Sample Production List</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="datatable">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Date</th>
                                <th>Buyer</th>
                                <th>Order No</th>
                                <th>Color</th>
                                <th>Sample Type</th>
                                <th>Production Qty</th>
                                <th>Used Fabric Qty</th>
                                <th>Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($productions as $key => $production)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $production->created_at->format('d-M-Y') }}</td>
                                    <td>{{ optional($production->buyer)->buyer_name }}</td>
                                    <td>{{ optional($production->initialOrder)->order_code }}</td>
                                    <td>{{ optional($production->color)->color_name }}</td>
                                    <td>{{ optional($production->sampleType)->sample_type_name }}</td>
                                    <td>{{ $production->production_quantity }}</td>
                                    <td>{{ $production->used_fabric_quantity }}</td>
                                    <td>{{ $production->production_notes }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">No records found</td>
                                </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="6" class="text-end">Total</th>
                                <th>{{ $totals['production_quantity'] ?? 0 }}</th>
                                <th>{{ $totals['used_fabric_quantity'] ?? 0 }}</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('.select2').select2();

        $('#buyer_id').change(function() {
            let buyerId = $(this).val();
            $('#order_id').html('<option value="">Select Order</option>');
            $('#color_id').html('<option value="">Select Color</option>');
            
            if (buyerId) {
                let url = "{{ route('sms.database.sampleorderproduction.get-orders', ':id') }}";
                url = url.replace(':id', buyerId);

                $.ajax({
                    url: url,
                    type: "GET",
                    success: function(data) {
                        let options = '<option value="">Select Order</option>';
                        data.forEach(function(order) {
                            options += `<option value="${order.id}">${order.order_code}</option>`;
                        });
                        $('#order_id').html(options);
                    }
                });
            }
        });

        $('#order_id').change(function() {
            let orderId = $(this).val();
            $('#color_id').html('<option value="">Select Color</option>');

            if (orderId) {
                let url = "{{ route('sms.database.sampleorderproduction.get-samples', ':id') }}";
                url = url.replace(':id', orderId);

                $.ajax({
                    url: url,
                    type: "GET",
                    success: function(data) {
                        let options = '<option value="">Select Color</option>';
                        data.forEach(function(color) {
                            options += `<option value="${color.id}">${color.color_name}</option>`;
                        });
                        $('#color_id').html(options);
                    }
                });
            }
        });
    });
</script>
@endpush
