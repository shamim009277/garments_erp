@extends('layouts.app')
@section('title', 'Sample Production Entry')
@section('content')
<div class="row">
    <div class="col-12">
        @include('components.breadcrumb', [
        'title' => 'Sample Management',
        'subtitle' => 'Sample Production Entry',
        'breadcrumbs' => [
        ['label' => 'Sample Management', 'url' => route('sms.index')],
        ['label' => 'Database', 'url' => route('sms.index')],
        ['label' => 'Sample Production', 'url' => route('sms.database.sampleorderproduction.index')],
        ],
        ])
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Sample Production Entry</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('sms.database.sampleorderproduction.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="sample_order_programme_id" id="sample_order_programme_id">
                    <div class="row">
                        <div class="col-md-2 mb-2">
                            <label for="buyer_id" class="form-label">Buyer</label>
                            <select name="buyer_id" id="buyer_id" class="form-control select2" required>
                                <option value="">Select Buyer</option>
                                @foreach($buyers as $buyer)
                                    <option value="{{ $buyer->id }}">{{ $buyer->buyer_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 mb-2">
                            <label for="order_id" class="form-label">Order ID</label>
                            <select name="order_id" id="order_id" class="form-control select2" required disabled>
                                <option value="">Select Order</option>
                            </select>
                        </div>
                        <div class="col-md-2 mb-2">
                            <label for="programme_id" class="form-label">Programme</label>
                            <select name="programme_id" id="programme_id" class="form-control select2" required disabled>
                                <option value="">Select Programme</option>
                            </select>
                        </div>
                        <div class="col-md-2 mb-2">
                            <label for="sample_type_id" class="form-label">Sample Type</label>
                            <select name="sample_type_id" id="sample_type_id" class="form-control select2" disabled>
                                <option value="">Select Sample Type</option>
                            </select>
                        </div>
                        <div class="col-md-2 mb-2">
                            <label for="color_id" class="form-label">Color</label>
                            <select name="color_id" id="color_id" class="form-control select2"  disabled>
                                <option value="">Select Color</option>
                            </select>
                        </div>
                        <div class="col-md-2 mb-2">
                            <label for="size_id" class="form-label">Size</label>
                            <select name="size_id" id="size_id" class="form-control select2" disabled>
                                <option value="">Select Size</option>
                            </select>
                        </div>
                        <div class="col-md-2 mb-2">
                            <label for="production_quantity" class="form-label">Production Quantity</label>
                            <input type="number" name="production_quantity" id="production_quantity" class="form-control" required disabled>
                        </div>
                        <div class="col-md-2 mb-2">
                            <label for="used_fabric_quantity" class="form-label">Used Fabric Quantity</label>
                            <input type="number" step="0.01" name="used_fabric_quantity" id="used_fabric_quantity" class="form-control" required disabled>
                        </div>
                        <div class="col-md-2 mb-2">
                            <label for="production_notes" class="form-label">Remarks</label>
                            <textarea name="production_notes" id="production_notes" class="form-control" rows="1" disabled></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary" id="submitBtn" disabled>Save Production Info</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
         <div class="col-lg-12 pr-0">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                        <h6 class="my-0 text-primary text-center">Today Production LIST</h6>
                   
                </div>
                <div class="card-body">
                    <div style="overflow-x: auto;">
                        <table class="table table-bordered table-hover table-striped" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Programme ID</th>
                                    <th>Order ID</th>
                                    <th>Color</th>
                                    <th>Size</th>
                                    <th>Sample Type</th>
                                    <th>Production Qty</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i = 1;
                                @endphp
                                @foreach ($sampleProductions as $employee)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $employee->programme->programme_code }}</td>
                                        <td>{{ $employee->initialOrder->order_code }}</td>
                                        <td>{{ @$employee->color->color_name }}</td>
                                        <td>{{ @$employee->size->size_name }}</td>
                                        <td>{{ @$employee->sampleType->sample_type_name }}</td>
                                        <td>{{ @$employee->production_quantity }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize Select2
        $('.select2').select2();

        let allSamples = [];

        // Buyer Change
        $('#buyer_id').change(function() {
            let buyerId = $(this).val();
            $('#order_id').html('<option value="">Select Order</option>').prop('disabled', true);
            
            if (buyerId) {
                // Use a placeholder for the ID and replace it
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
                        $('#order_id').html(options).prop('disabled', false);
                    }
                });
            }
        });

        // Order Change
        $('#order_id').change(function() {
            let orderId = $(this).val();
            if (orderId) {
                // Use a placeholder for the ID and replace it
                let url = "{{ route('sms.database.sampleorderproduction.get-programmes', ':id') }}";
                url = url.replace(':id', orderId);
                $.ajax({
                    url: url,
                    type: "GET",
                    success: function(data) {
                        let options = '<option value="">Select Programme</option>';
                        data.forEach(function(data) {
                            
                                options += `<option value="${data.id}">${data.programme_code}</option>`;
                          
                        });
                        $('#programme_id').html(options).prop('disabled', false);
                        $('#sample_type_id').prop('disabled', false);
                        $('#production_quantity').prop('disabled', false);
                        $('#used_fabric_quantity').prop('disabled', false);
                        $('#production_notes').prop('disabled', false);
                        $('#submitBtn').prop('disabled', false);
                    }
                });
            }
        });

        $('#programme_id').change(function() {
            let programmeId = $(this).val();
            if (programmeId) {
                // Use a placeholder for the ID and replace it
                let url = "{{ route('sms.database.sampleorderproduction.get-samples', ':id') }}";
                url = url.replace(':id', programmeId);
                $.ajax({
                    url: url,
                    type: "GET",
                    success: function(data) {
                        let options = '<option value="">Select Color</option>';
                        data.colors.forEach(function(data) {
                            
                                options += `<option value="${data.id}">${data.color_name}</option>`;
                          
                        });
                        $('#color_id').html(options).prop('disabled', false);
                        options = '<option value="">Select Size</option>';
                        data.sizes.forEach(function(data) {
                            
                                options += `<option value="${data.id}">${data.size_name}</option>`;
                          
                        });

                        $('#size_id').html(options).prop('disabled', false);
                        options = '<option value="">Select Sample Type</option>';
                        data.sampleTypes.forEach(function(data) {
                            
                                options += `<option value="${data.id}" selected>${data.sample_type_name}</option>`;
                          
                        });
                        $('#sample_type_id').html(options).prop('disabled', false);
                        $('#production_quantity').prop('disabled', false);
                        $('#used_fabric_quantity').prop('disabled', false);
                        $('#production_notes').prop('disabled', false);
                        $('#submitBtn').prop('disabled', false);
                    }
                });
            }
        });

    });
</script>
@endpush
