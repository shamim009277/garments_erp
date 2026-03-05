@extends('layouts.app')
@section('title', 'Sample Delivery Details')
@section('content')
@push('styles')
    <style>
        .check-input {
            display: inline-block !important;
            opacity: 1 !important;
            border: 1px solid #b7bbf5 !important
        }

        
    </style>
@endpush
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
                <div class="d-flex order-2 order-md-2">
                    <!-- Edit Button -->
                    <button type="button" class="btn btn-sm btn-primary d-flex align-items-center me-2" data-bs-toggle="modal" data-bs-target="#editModal">
                        <i data-feather="edit" width="14" height="14" class="me-1"></i> Edit
                    </button>
                    <!-- Delete Button -->
                    <button type="button" class="btn btn-sm btn-danger d-flex align-items-center me-2" data-bs-toggle="modal" data-bs-target="#deleteModal">
                        <i data-feather="trash" width="14" height="14" class="me-1"></i> Delete
                    </button>
                    <!-- Back Button -->
                    <a href="{{ route('sms.database.sampledelivery.index') }}"
                        class="btn btn-sm btn-info d-flex align-items-center">
                        <i data-feather="arrow-left" width="14" height="14" class="me-1"></i> Back
                    </a>
                </div>
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
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title">Delivery Information: {{ $delivery->ChallanNo }}</h5>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-3">
                        <strong>Challan No:</strong> {{ $delivery->ChallanNo }}
                    </div>
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
            </div>
        </div>
         <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title">Delivery Items Information</h5>
            </div>
            
            <div class="card-body">
                <div class="row justify-content-center">
                <!-- <div class="col-md-12 mb-3">
                    <select name="programme_id" id="programme_id" class="form-control form-control-sm select2" required>
                        @foreach($sampleProductions as $item)
                            <option value="{{$item->id}}">{{@$item->initialOrder->order_code}}:{{@$item->programme->programme_code}}:{{@$item->color->color_name}}:{{@$item->size->size_name}}:{{@$item->sampleType->sample_type_name}}</option>
                        @endforeach
                    </select>
                </div> -->
                <form action="{{ route('sms.database.sampledelivery.update', $delivery->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="form_no" value="2">
                 <div class="table" style="max-height: 300px;overflow-y: auto;min-height: 300px;">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th class="text-center">Order ID</th>
                                <th class="text-center">Programme ID</th>
                                <th class="text-center">Sample Type</th>
                                <th class="text-center">Color</th>
                                <th class="text-center">Size</th>
                                <th class="text-center">Production Qnty</th>
                                <th class="text-center">Del Qnty</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-center">Comments</th>
                            </tr>
                        </thead>
                        <tbody >
                            @foreach($sampleProductions as $item)
                            <tr>
                                <td class="text-center">
                                <div class="form-check">
                                     <input class="form-check-input check-input" style="display: block;cursor: pointer;" type="checkbox" name="item_ids[]" value="{{ $item->id }}">
                                        {{@$item->initialOrder->order_code}}</td>
                                </div>    
                                <td class="text-center">{{@$item->programme->programme_code}}</td>
                                <td class="text-center">{{@$item->sampleType->sample_type_name}}</td>
                                <td class="text-center">{{@$item->color->color_name}}</td>
                                <td class="text-center">{{@$item->size->size_name}}</td>
                                <td class="text-center">{{@$item->production_quantity}}</td>
                                <td class="text-center">{{$item->delivery_qty??0}}</td>
                                <td class="text-center"><input type="number" class="form-control form-control-sm" name="delivery_qty[{{$item->id}}]" max="{{$item->production_quantity-$item->delivery_qty}}"></td>
                                <td class="text-center"><input type="text" class="form-control form-control-sm" name="comments[{{$item->id}}]"></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary btn-sm">Add To Delivery</button>
                </div>
                </form>
            </div>
               
            </div>
        </div>
    </div>
    <div class="col-12">
        
         <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title">Delivery Items Information</h5>
            </div>
            
            <div class="card-body">
                <div class="row justify-content-center">
                 <div class="table" style="max-height: 300px;overflow-y: auto;min-height: 300px;">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th class="text-center">Order ID</th>
                                <th class="text-center">Programme ID</th>
                                <th class="text-center">Sample Type</th>
                                <th class="text-center">Color</th>
                                <th class="text-center">Size</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-center">Comments</th>
                            </tr>
                        </thead>
                        <tbody >
                            @foreach($deliveryDetails as $item)
                            @php
                                $sampleProd = $sampleDetProd->where('id',$item->ProductionID)->first();
                            @endphp
                            <tr>
                                
                                <td class="text-center">{{@$sampleProd->initialOrder->order_code}}</td>
                                <td class="text-center">{{@$sampleProd->programme->programme_code}}</td>
                                <td class="text-center">{{@$sampleProd->sampleType->sample_type_name}}</td>
                                <td class="text-center">{{@$sampleProd->color->color_name}}</td>
                                <td class="text-center">{{@$sampleProd->size->size_name}}</td>
                                <td class="text-center">{{@$item->Quantity}}</td>
                                <td class="text-center">{{@$item->comments}}</td>
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

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Sample Delivery</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
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
                    <div class="mt-4 text-end">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-sm">Update Delivery</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete Sample Delivery</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this sample delivery? This action cannot be undone.</p>
                <div class="alert alert-warning">
                    <strong>Warning:</strong> This will also delete all associated details.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                <form action="{{ route('sms.database.sampledelivery.destroy', $delivery->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize Select2
        $('.select2').select2();

        

    });
</script>
@endpush
@endsection
