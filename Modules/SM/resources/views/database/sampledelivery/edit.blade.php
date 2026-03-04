@extends('layouts.app')
@section('title', 'Edit Sample Delivery')
@section('content')
<div class="row">
    <div class="col-12">
        @include('components.breadcrumb', [
        'title' => 'Sample Delivery',
        'subtitle' => 'Edit Sample Delivery',
        'breadcrumbs' => [
        ['label' => 'Sample Management', 'url' => route('sms.index')],
        ['label' => 'Database', 'url' => route('sms.index')],
        ['label' => 'Sample Delivery', 'url' => route('sms.database.sampledelivery.index')],
        ['label' => 'Edit', 'url' => '#'],
        ],
        ])
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Edit Sample Delivery</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('sms.database.sampledelivery.update', $delivery->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Challan No</label>
                            <input type="text" name="ChallanNo" class="form-control form-control-sm" required value="{{ $delivery->ChallanNo }}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Date</label>
                            <input type="date" name="Date" class="form-control form-control-sm" required value="{{ $delivery->Date }}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Buyer</label>
                            <select name="BuyerID" class="form-select form-select-sm" required>
                                <option value="">Select Buyer</option>
                                @foreach($buyers as $buyer)
                                <option value="{{ $buyer->id }}" {{ $delivery->BuyerID == $buyer->id ? 'selected' : '' }}>{{ $buyer->buyer_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Employee</label>
                            <select name="EmployeeID" class="form-select form-select-sm" required>
                                <option value="">Select Employee</option>
                                @foreach($employees as $employee)
                                <option value="{{ $employee->id }}" {{ $delivery->EmployeeID == $employee->id ? 'selected' : '' }}>{{ $employee->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Challan Type</label>
                            <select name="ChallanType" class="form-select form-select-sm" required>
                                <option value="1" {{ $delivery->ChallanType == 1 ? 'selected' : '' }}>Returnable</option>
                                <option value="2" {{ $delivery->ChallanType == 2 ? 'selected' : '' }}>Non-Returnable</option>
                                <option value="3" {{ $delivery->ChallanType == 3 ? 'selected' : '' }}>Export</option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Goods Type</label>
                            <select name="GoodsType" class="form-select form-select-sm" required>
                                <option value="1" {{ $delivery->GoodsType == 1 ? 'selected' : '' }}>Gray Fabric</option>
                                <option value="2" {{ $delivery->GoodsType == 2 ? 'selected' : '' }}>Complete Body</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Comments</label>
                            <input type="text" name="Comments" class="form-control form-control-sm" value="{{ $delivery->Comments }}">
                        </div>
                    </div>

                    <h5 class="mt-4">Details</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm" id="detailsTable">
                            <thead>
                                <tr>
                                    <th>Sample Programme</th>
                                    <th>Color</th>
                                    <th>Quantity</th>
                                    <th>Comments</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($delivery->details as $index => $detail)
                                <tr>
                                    <td>
                                        <select name="details[{{ $index }}][SampleOrderProgrammeID]" class="form-select form-select-sm select2" required>
                                            <option value="">Select Item</option>
                                            @foreach($sampleProgrammes as $sp)
                                            <option value="{{ $sp->id }}" {{ $detail->SampleOrderProgrammeID == $sp->id ? 'selected' : '' }}>
                                                {{ $sp->item->product_category_name ?? 'Item' }} - 
                                                {{ $sp->style_no ?? 'No Style' }}
                                                ({{ $sp->initialOrder->order_code ?? '' }})
                                            </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td><input type="text" name="details[{{ $index }}][Color]" class="form-control form-control-sm" required value="{{ $detail->Color }}"></td>
                                    <td><input type="number" name="details[{{ $index }}][Quantity]" class="form-control form-control-sm" required value="{{ $detail->Quantity }}"></td>
                                    <td><input type="text" name="details[{{ $index }}][Comments]" class="form-control form-control-sm" value="{{ $detail->Comments }}"></td>
                                    <td><button type="button" class="btn btn-danger btn-xs remove-row">X</button></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <button type="button" class="btn btn-info btn-sm mt-2" id="addRow">Add Row</button>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary btn-sm">Update Delivery</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let rowIdx = {{ count($delivery->details) }};
        document.getElementById('addRow').addEventListener('click', function() {
            let tableBody = document.querySelector('#detailsTable tbody');
            let options = `
                <option value="">Select Item</option>
                @foreach($sampleProgrammes as $sp)
                <option value="{{ $sp->id }}">
                    {{ $sp->item->product_category_name ?? 'Item' }} - 
                    {{ $sp->style_no ?? 'No Style' }}
                    ({{ $sp->initialOrder->order_code ?? '' }})
                </option>
                @endforeach
            `;

            let newRow = `
                <tr>
                    <td>
                        <select name="details[${rowIdx}][SampleOrderProgrammeID]" class="form-select form-select-sm select2" required>
                            ${options}
                        </select>
                    </td>
                    <td><input type="text" name="details[${rowIdx}][Color]" class="form-control form-control-sm" required></td>
                    <td><input type="number" name="details[${rowIdx}][Quantity]" class="form-control form-control-sm" required></td>
                    <td><input type="text" name="details[${rowIdx}][Comments]" class="form-control form-control-sm"></td>
                    <td><button type="button" class="btn btn-danger btn-xs remove-row">X</button></td>
                </tr>
            `;
            tableBody.insertAdjacentHTML('beforeend', newRow);
            rowIdx++;
        });

        document.querySelector('#detailsTable').addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-row')) {
                if(document.querySelectorAll('#detailsTable tbody tr').length > 1){
                    e.target.closest('tr').remove();
                } else {
                    alert('At least one row is required.');
                }
            }
        });
    });
</script>
@endpush
@endsection
