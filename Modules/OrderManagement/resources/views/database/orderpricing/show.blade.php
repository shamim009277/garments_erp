@extends('layouts.app')
@section('title', 'Order Management')
@section('styles')
<style>
    .table,
    tr,
    th,
    td {
        border: none !important;
        border-collapse: collapse;
    }
</style>
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        @include('components.breadcrumb', [
        'title' => 'Order Management',
        'subtitle' => 'Initial Orders',
        'breadcrumbs' => [
        ['label' => 'Order Management', 'url' => route('ordermanagement.index')],
        ['label' => 'Database', 'url' => route('ordermanagement.index')],
        ['label' => 'Initial Orders', 'url' => route('ordermanagement.database.initialorders.index')],
        ],
        ])
    </div>
    <div class="col-md-3">
        <div class="card alert-primary alert-top-border padding-card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <i data-feather="list" width="16" height="16"></i>
                    <h6 class="my-0 text-primary ms-2">Initial Orders List</h6>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="input-group">
                            <input type="text" name="search" id="search" class="form-control form-control-sm" placeholder="Search here...">
                        </div>
                    </div>
                </div>
            </div>
            @php
            $org = collect($orders)->pluck('organization');
            $orgList = collect($org)->unique();
            @endphp
            <div class="card-body">
                @foreach ($orgList as $key => $org)
                <ul class="nav-custom">
                    <li class="nav-custom-item">
                        <input type="checkbox" id="dept{{ $org->id }}">
                        <label class="nav-custom-link" for="dept{{ $org->id }}">
                            <span class="nav-custom-caret"> </span>
                            {{ $org->name }}
                        </label>
                        @php
                        $ordList = collect($orders)->where('organization_id', $org->id);
                        @endphp
                        <ul class="nav-custom-content">
                            @foreach ($ordList as $key => $x)
                            <li class="nav-custom-item"><a href="{{ route('ordermanagement.database.orderpricing.show', $x->id) }}" class="nav-custom-link">{{ $x->order_code }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card alert-info alert-top-border">
            <div class="card-header">
                <h6 class="my-0 text-primary"> <i class="mdi mdi-file-document"></i> PRICING FORMAT
                </h6>
            </div>
            <div class="card-body p-2">
                <form action="{{ route('ordermanagement.database.orderpricing.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="initial_order_id" value="{{ $check ? $order->initial_order_id : $order->id }}">
                    <input type="hidden" name="order_code" value="{{ $order->order_code ?? '' }}" />
                    <input type="hidden" name="form_number" value="0" />
                    <!-- Top Section -->
                    <div class="row mb-5">

                        <!-- Column 1 -->
                        <div class="col-md-5">
                            <table class="table table-bordered table-sm mb-0">

                                <tr>
                                    <td class="fw-bold">Organization</td>
                                    <td>
                                        <x-text-input name="organization" class="form-control form-control-sm border-0" value="{{ $order->organization->name ?? '' }}" readonly />
                                        <input type="hidden" name="organization_id" value="{{ $order->organization_id ?? '' }}" />
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Buyer</td>
                                    <td>
                                        <input type="hidden" name="buyer_id" value="{{ $order->buyer_id ?? '' }}" />
                                        <x-text-input name="buyer" class="form-control form-control-sm border-0" value="{{ $order->buyer->buyer_name ?? '' }}" readonly />
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">ORDER QTY.</td>
                                    <td>
                                        <x-text-input name="order_quantity" class="form-control form-control-sm border-0" value="{{ $order->order_quantity ?? '' }}" required/>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">SEASON</td>
                                    <td>
                                        <x-text-input name="seasson" class="form-control form-control-sm border-0" value="{{ $order->seasson ?? '' }}" required/>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">STYLE</td>
                                    <td>
                                        <x-text-input name="style" class="form-control form-control-sm border-0" value="{{ $order->style ?? '' }}" required/>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">FABRICATION</td>
                                    <td>
                                        <x-text-input name="fabrication" class="form-control form-control-sm border-0" value="{{ $order->fabrication ?? '' }}" required />
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">GSM</td>
                                    <td>
                                        <x-text-input name="gsm" class="form-control form-control-sm border-0" value="{{ $order->gsm ?? '' }}" required />
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">BRAND CATEGORY</td>
                                    <td>
                                        <x-select-input name="brand_category_id"
                                            :options="$brandCategories->pluck('category_name', 'id')" 
                                            :selected="$order->brand_category_id ?? old('brand_category_id')"
                                            />
                                    </td>
                                </tr>

                                <tr>
                                    <td class="fw-bold">PRICE/PCS ($)</td>
                                    <td>
                                        <x-text-input name="price_per_pcs" class="form-control form-control-sm border-0 fw-bold text-center" style="font-size: 1.2em;" value="{{ $order->pricing->price_per_pcs ?? '0.00' }}" />
                                    </td>
                                </tr>

                            </table>
                        </div>
                        <div class="col-md-4">
                            <table class="table table-bordered table-sm mb-0">
                                <tr>
                                    <td class="fw-bold">EMBROIDERY</td>
                                    <td>
                                        <select name="has_embroidery" class="form-select form-select-sm border-0">
                                            <option value="N" {{ ($order->pricing->has_embroidery ?? 'N') == 'N' ? 'selected' : '' }}>N</option>
                                            <option value="Y" {{ ($order->pricing->has_embroidery ?? 'N') == 'Y' ? 'selected' : '' }}>Y</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">PRINT</td>
                                    <td>
                                        <select name="has_print" class="form-select form-select-sm border-0">
                                            <option value="N" {{ ($order->pricing->has_print ?? 'N') == 'N' ? 'selected' : '' }}>N</option>
                                            <option value="Y" {{ ($order->pricing->has_print ?? 'N') == 'Y' ? 'selected' : '' }}>Y</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">PATCHES</td>
                                    <td>
                                        <select name="has_patches" class="form-select form-select-sm border-0">
                                            <option value="N" {{ ($order->pricing->has_patches ?? 'N') == 'N' ? 'selected' : '' }}>N</option>
                                            <option value="Y" {{ ($order->pricing->has_patches ?? 'N') == 'Y' ? 'selected' : '' }}>Y</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold" style="font-size: 0.8rem;">KNITTING+DYEING ALLOWANCE %</td>
                                    <td><x-text-input type="number" step="0.01" name="knitting_dyeing_allowance_percent" class="form-control form-control-sm border-0" value="{{ $order->pricing->knitting_dyeing_allowance_percent ?? '0.00' }}" /></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold" style="font-size: 0.8rem;">CUTTING WASTAGE ALLOWANCE %</td>
                                    <td><x-text-input type="number" step="0.01" name="cutting_wastage_allowance_percent" class="form-control form-control-sm border-0" value="{{ $order->pricing->cutting_wastage_allowance_percent ?? '0.00' }}" /></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold" style="font-size: 0.8rem;">DOLLAR CONVERTION RATE (BDT)</td>
                                    <td><x-text-input type="number" step="0.01" name="dollar_conversion_rate" class="form-control form-control-sm border-0" value="{{ $order->pricing->dollar_conversion_rate ?? '0.00' }}" /></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">NO. OF M/C REQ.</td>
                                    <td><x-text-input type="number" name="no_of_mc_req" class="form-control form-control-sm border-0" value="{{ $order->no_of_mc_req ?? '' }}" /></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">AVG. PRODUCTIVITY</td>
                                    <td><x-text-input type="number" name="avg_productivity" class="form-control form-control-sm border-0" value="{{ $order->avg_productivity ?? '' }}" /></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">CAD CONSUMPTION (KG/Dzn.)</td>
                                    <td><x-text-input type="number" name="cad_consumption_kg_dzn" class="form-control form-control-sm border-0" value="{{ $order->cad_consumption_kg_dzn ?? '' }}" /></td>
                                </tr>
                            </table>
                        </div>
                        <!-- Column 4 (Photo) -->
                        <div class="col-md-3">
                            <div class="card h-100">
                                <div class="card-header bg-info text-white text-center py-1">GARMENTS PHOTO</div>
                                <div class="card-body p-1 d-flex align-items-center justify-content-center border">
                                    @if(isset($order) && $order->file)
                                    <img src="{{ asset($order->file) }}" alt="Garment" class="img-fluid" style="max-height: 150px;">
                                    @else
                                    <div class="text-muted text-center" style="height: 100px; line-height: 100px;">No Image</div>
                                    @endif
                                </div>
                                <div style="margin-top: 10px;text-align: center;">
                                    <strong>Upload Image:</strong>
                                    <input type="file" name="file" class="form-control form-control-sm">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 text-right mt-3">
                            <button type="button" class="btn btn-secondary me-auto">Cancel</button>

                            <button type="submit" class="btn btn-primary me-auto">Save & Proceed</button>
                        </div>
                    </div>
                </form>
            </div>
             <div class="row mb-4">
                        <div class="col-12">
                            <div class="text-center fw-bold border border-dark">FABRICS CONSUMPTION</div>
                            <table class="table table-bordered table-sm text-center mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th>FABRICS (KG/DZN.)</th>
                                        <th>CUTTING (KG/DZN.)</th>
                                        <th>RIB (KG/DZN.)</th>
                                        <th>YARN (KG/DZN.)</th>
                                        <th>TOTAL FABRICS (KG/DZN.)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input type="number" step="0.0001" name="fabrics_kg_dzn" class="form-control form-control-sm border-0 text-center" value="{{ $order->pricing->fabrics_kg_dzn ?? '0.00' }}"></td>
                                        <td><input type="number" step="0.0001" name="cutting_kg_dzn" class="form-control form-control-sm border-0 text-center" value="{{ $order->pricing->cutting_kg_dzn ?? '0.00' }}"></td>
                                        <td><input type="number" step="0.0001" name="rib_kg_dzn" class="form-control form-control-sm border-0 text-center" value="{{ $order->pricing->rib_kg_dzn ?? '0.00' }}"></td>
                                        <td><input type="number" step="0.0001" name="yarn_kg_dzn" class="form-control form-control-sm border-0 text-center" value="{{ $order->pricing->yarn_kg_dzn ?? '0.00' }}"></td>
                                        <td><input type="number" step="0.0001" name="total_fabrics_kg_dzn" class="form-control form-control-sm border-0 text-center fw-bold" value="{{ $order->pricing->total_fabrics_kg_dzn ?? '0.00' }}" readonly></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

            <!-- Tabs -->
            <ul class="nav nav-tabs nav-tabs-custom" role="tablist">
                <li class="nav-item">
                    <button class="nav-link" id="measurement-tab" data-bs-toggle="tab" data-bs-target="#measurement" type="button" role="tab" aria-controls="measurement" aria-selected="false">GARMENTS MEASUREMENT</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" id="cost-breakup-tab" data-bs-toggle="tab" data-bs-target="#cost-breakup" type="button" role="tab" aria-controls="cost-breakup" aria-selected="false">FABRICS COST BREAKUP</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" id="cost-summary-tab" data-bs-toggle="tab" data-bs-target="#cost-summary" type="button" role="tab" aria-controls="cost-summary" aria-selected="false">FABRICS PRICE/ DZN.</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" id="accessories-tab" data-bs-toggle="tab" data-bs-target="#accessories" type="button" role="tab" aria-controls="accessories" aria-selected="false">ACCESSORIES LIST</button>
                </li>
            </ul>

            <div class="tab-content p-3 border border-top-0">
                <!-- Tab 2: Garments Measurement -->
                <div class="tab-pane fade" id="measurement" role="tabpanel" aria-labelledby="measurement-tab" style="min-height: 400px;">
                    <div class="row">
                        <div class="col-12">
                            <div class="text-center fw-bold border mb-1">GARMENTS MEASUREMENT</div>
                            
                            <!-- Dynamic Measurement UI -->
                            @php
                                $pricingId = null;
                                if(isset($order->initial_order_id)) { // OrderPricing model
                                    $pricingId = $order->id;
                                    $measurements = $order->measurements;
                                } elseif(isset($order->pricing)) { // InitialOrder model
                                    $pricingId = $order->pricing->id ?? null;
                                    $measurements = $order->pricing->measurements ?? collect([]);
                                } else {
                                    $measurements = collect([]);
                                }
                            @endphp

                            @if($pricingId)
                            <div class="card mb-2 border-0">
                                <div class="card-body p-0">
                                    <div class="row g-1 align-items-center mb-2">
                                        <div class="col-md-5">
                                            <x-select-input name="part_name_id" id="new_part_name_id"
                                            :options="$partNames->pluck('part_name', 'id')" 
                                            :selected="$order->part_name_id ?? old('part_name_id')"
                                            />
                                        </div>
                                        <div class="col-md-5">
                                            <input type="text" id="new_measurement_value" class="form-control form-control-sm" placeholder="Value">
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-sm btn-success w-100" id="addMeasurementBtn">Add</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="alert alert-warning py-1 mb-2">Please save the pricing details first to add measurements.</div>
                            @endif

                            <table class="table table-bordered table-sm" id="measurementsTable">
                                <thead class="bg-light">
                                    <tr>
                                        <th>Part Name</th>
                                        <th>Value</th>
                                        <th style="width: 50px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="measurementsTableBody">
                                    @foreach($measurements as $measurement)
                                        <tr id="measurement-row-{{ $measurement->id }}">
                                            <td>{{ $measurement->partName->part_name ?? '' }}</td>
                                            <td>{{ $measurement->value }}</td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-sm btn-danger py-0 px-1 delete-measurement-btn" data-id="{{ $measurement->id }}">&times;</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Tab 3: Fabrics Cost Breakup -->
                <div class="tab-pane fade" id="cost-breakup" role="tabpanel" aria-labelledby="cost-breakup-tab"  style="min-height: 400px;">
                    <div class="row">
                        <div class="col-12">
                            <div class="text-center fw-bold border mb-1">FABRICS COST BREAKUP</div>
                            <div class="mt-3">
                                <div class="bg-light p-2 border mb-2">
                                    <div class="row g-2 align-items-center">
                                        <div class="col-md-5">
                                            <select id="costing_head_select" class="form-control form-control-sm">
                                                <option value="">Select Costing Head</option>
                                                @foreach($costingHeads as $costingHead)
                                                <option value="{{ $costingHead->id }}">{{ $costingHead->costing_head_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="number" step="0.0001" id="fabrics_cost_value" class="form-control form-control-sm" placeholder="Value">
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-sm btn-primary w-100" id="addFabricsCostBtn">Add</button>
                                        </div>
                                    </div>
                                </div>
                                
                                <table class="table table-bordered table-sm text-center" id="fabricsCostTable">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>Costing Head</th>
                                            <th>Value</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="fabricsCostList">
                                        @if(isset($order->pricing) && $order->pricing->fabricsCosts)
                                            @foreach($order->pricing->fabricsCosts as $fabricsCost)
                                            <tr data-id="{{ $fabricsCost->id }}">
                                                <td>{{ $fabricsCost->costingHead->costing_head_name ?? 'N/A' }}</td>
                                                <td>{{ $fabricsCost->value }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-danger delete-fabrics-cost" data-id="{{ $fabricsCost->id }}">Delete</button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        @elseif(isset($order->fabricsCosts))
                                             @foreach($order->fabricsCosts as $fabricsCost)
                                            <tr data-id="{{ $fabricsCost->id }}">
                                                <td>{{ $fabricsCost->costingHead->costing_head_name ?? 'N/A' }}</td>
                                                <td>{{ $fabricsCost->value }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-danger delete-fabrics-cost" data-id="{{ $fabricsCost->id }}">Delete</button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tab 4: Cost Summary (FABRICS PRICE/ DZN.) -->
                <div class="tab-pane fade" id="cost-summary" role="tabpanel" aria-labelledby="cost-summary-tab"  style="min-height: 400px;">
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-bordered table-sm">
                                <tr>
                                    <td>FABRICS PRICE/ DZN.</td>
                                    <td><input type="number" step="0.0001" name="fabrics_price_dzn" class="form-control form-control-sm border-0 text-center" value="{{ $order->pricing->fabrics_price_dzn ?? '0.00' }}"></td>
                                </tr>
                                <tr>
                                    <td>ACCESSORIES PRICE/ DZN.</td>
                                    <td><input type="number" step="0.0001" name="accessories_price_dzn" class="form-control form-control-sm border-0 text-center" value="{{ $order->pricing->accessories_price_dzn ?? '0.00' }}"></td>
                                </tr>
                                <tr>
                                    <td>PRINT CHARGE/ DZN.</td>
                                    <td><input type="number" step="0.0001" name="print_charge_dzn" class="form-control form-control-sm border-0 text-center" value="{{ $order->pricing->print_charge_dzn ?? '0.00' }}"></td>
                                </tr>
                                <tr>
                                    <td>EMBROIDERY CHARGE/ DZN.</td>
                                    <td><input type="number" step="0.0001" name="embroidery_charge_dzn" class="form-control form-control-sm border-0 text-center" value="{{ $order->pricing->embroidery_charge_dzn ?? '0.00' }}"></td>
                                </tr>
                                <tr>
                                    <td>GARMENT WASH/ DZN.</td>
                                    <td><input type="number" step="0.0001" name="garment_wash_dzn" class="form-control form-control-sm border-0 text-center" value="{{ $order->pricing->garment_wash_dzn ?? '0.00' }}"></td>
                                </tr>
                                <tr>
                                    <td>CM/ DZN.</td>
                                    <td><input type="number" step="0.0001" name="cm_dzn" class="form-control form-control-sm border-0 text-center" value="{{ $order->pricing->cm_dzn ?? '0.00' }}"></td>
                                </tr>
                                <tr>
                                    <td>BANK, C&F, OTHERS/ DZN.</td>
                                    <td><input type="number" step="0.0001" name="bank_cnf_others_dzn" class="form-control form-control-sm border-0 text-center" value="{{ $order->pricing->bank_cnf_others_dzn ?? '0.00' }}"></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">COMMERCIAL COST/ DZN.</td>
                                    <td><input type="number" step="0.0001" name="commercial_cost_dzn" class="form-control form-control-sm border-0 text-center fw-bold" value="{{ $order->pricing->commercial_cost_dzn ?? '0.00' }}" readonly></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">PROFIT/ DZN.</td>
                                    <td><input type="number" step="0.0001" name="profit_dzn" class="form-control form-control-sm border-0 text-center fw-bold" value="{{ $order->pricing->profit_dzn ?? '0.00' }}"></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">FOB/ DZN.</td>
                                    <td><input type="number" step="0.0001" name="fob_dzn" class="form-control form-control-sm border-0 text-center fw-bold" value="{{ $order->pricing->fob_dzn ?? '0.00' }}" readonly></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">FOB/ PCS.</td>
                                    <td><input type="number" step="0.0001" name="fob_pcs" class="form-control form-control-sm border-0 text-center fw-bold" value="{{ $order->pricing->fob_pcs ?? '0.00' }}" readonly></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold"></td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-primary w-100" id="btnAdd">Save</button>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Tab 5: Accessories List -->
                <div class="tab-pane fade" id="accessories" role="tabpanel" aria-labelledby="accessories-tab"  style="min-height: 400px;">
                    <div class="row">
                        <div class="col-12">
                            <!-- Input Section -->
                            <div class="bg-light p-2 border mb-2">
                                <div class="row g-2 align-items-center">
                                    <div class="col-md-5">
                                        <select id="acc_accessory_id" class="form-control form-control-sm">
                                            <option value="">Select Accessory</option>
                                            @foreach($accessories as $acc)
                                                <option value="{{ $acc->id }}">{{ $acc->accessories_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-5">
                                        <input type="number" step="0.0001" id="acc_value" class="form-control form-control-sm" placeholder="Value">
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-sm btn-primary w-100" id="btnAddAccessory">Add</button>
                                    </div>
                                </div>
                            </div>

                            <!-- List Table -->
                            <table class="table table-bordered table-sm text-center" id="accessoriesTable">
                                <thead class="bg-light">
                                    <tr>
                                        <th>ITEM NAME</th>
                                        <th>VALUE</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody id="accessoriesListBody">
                                    @php
                                        $accessoriesList = collect([]);
                                        if(isset($order->pricing) && $order->pricing->accessories) {
                                            $accessoriesList = $order->pricing->accessories;
                                        } elseif(isset($order->accessories)) {
                                            $accessoriesList = $order->accessories;
                                        }
                                    @endphp
                                    @foreach($accessoriesList as $acc)
                                    <tr data-id="{{ $acc->id }}">
                                        <td>{{ $acc->accessory ? $acc->accessory->accessories_name : $acc->item_name }}</td>
                                        <td>{{ $acc->value }}</td>
                                        <td><button type="button" class="btn btn-sm btn-danger delete-accessory-btn" data-id="{{ $acc->id }}">Delete</button></td>
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
</div>

<style>
    .form-control-sm {
        padding: 2px 5px;
        font-size: 0.85rem;
    }

    .table-sm td,
    .table-sm th {
        padding: 4px;
        vertical-align: middle;
    }

    /* Custom Tab Styling */
    .nav-tabs-custom {
        background-color: #5559ca;
        border-bottom: none;
        padding: 0;
    }
    
    .nav-tabs-custom .nav-link {
        color: #ffffff;
        border: none;
        border-radius: 0;
        margin-bottom: 0;
        font-weight: 500;
    }
    
    .nav-tabs-custom .nav-link:hover {
        background-color: rgba(255, 255, 255, 0.2);
        color: #ffffff;
        border: none;
    }
    
    .nav-tabs-custom .nav-link.active {
        background-color: #ffffff;
        color: #5559ca;
        font-weight: bold;
        border: 1px solid #dee2e6;
        border-bottom-color: #fff;
    }
</style>

</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Calculation Logic
        function calculateFabricsTotal() {
            let fabrics = parseFloat($('input[name="fabrics_kg_dzn"]').val()) || 0;
            let cutting = parseFloat($('input[name="cutting_kg_dzn"]').val()) || 0;
            let rib = parseFloat($('input[name="rib_kg_dzn"]').val()) || 0;
            let yarn = parseFloat($('input[name="yarn_kg_dzn"]').val()) || 0;
            let total = fabrics + cutting + rib + yarn;
            $('input[name="total_fabrics_kg_dzn"]').val(total.toFixed(4));
        }

        function calculateCommercialCost() {
            let fabrics_price = parseFloat($('input[name="fabrics_price_dzn"]').val()) || 0;
            let accessories_price = parseFloat($('input[name="accessories_price_dzn"]').val()) || 0;
            let print_charge = parseFloat($('input[name="print_charge_dzn"]').val()) || 0;
            let embroidery_charge = parseFloat($('input[name="embroidery_charge_dzn"]').val()) || 0;
            let garment_wash = parseFloat($('input[name="garment_wash_dzn"]').val()) || 0;
            let cm = parseFloat($('input[name="cm_dzn"]').val()) || 0;
            let bank_cnf = parseFloat($('input[name="bank_cnf_others_dzn"]').val()) || 0;

            let total = fabrics_price + accessories_price + print_charge + embroidery_charge + garment_wash + cm + bank_cnf;
            $('input[name="commercial_cost_dzn"]').val(total.toFixed(4));
            calculateFOB();
        }

        function calculateFOB() {
            let commercial_cost = parseFloat($('input[name="commercial_cost_dzn"]').val()) || 0;
            let profit = parseFloat($('input[name="profit_dzn"]').val()) || 0;
            let fob_dzn = commercial_cost + profit;
            let fob_pcs = fob_dzn / 12;

            $('input[name="fob_dzn"]').val(fob_dzn.toFixed(4));
            $('input[name="fob_pcs"]').val(fob_pcs.toFixed(4));
            $('input[name="price_per_pcs"]').val(fob_pcs.toFixed(4)); // Update Top Price/Pcs
        }

        function calculateAccessoriesCost() {
            let totalCost = 0;
            $('#accessoriesTable tbody tr').each(function() {
                // Try to get value from input (legacy/fallback) or text (new)
                let costVal = 0;
                let costInput = $(this).find('input[name*="[cost_per_dzn]"]');
                if(costInput.length > 0) {
                    costVal = parseFloat(costInput.val()) || 0;
                } else {
                    // New structure: 6th column (index 5)
                    let textVal = $(this).find('td:eq(5)').text();
                    costVal = parseFloat(textVal) || 0;
                }
                totalCost += costVal;
            });
            $('input[name="accessories_price_dzn"]').val(totalCost.toFixed(4));
            calculateCommercialCost();
        }

        // Bind Events
        $('input[name="fabrics_kg_dzn"], input[name="cutting_kg_dzn"], input[name="rib_kg_dzn"], input[name="yarn_kg_dzn"]').on('input', calculateFabricsTotal);

        $('input[name="fabrics_price_dzn"], input[name="accessories_price_dzn"], input[name="print_charge_dzn"], input[name="embroidery_charge_dzn"], input[name="garment_wash_dzn"], input[name="cm_dzn"], input[name="bank_cnf_others_dzn"]').on('input', calculateCommercialCost);

        $('input[name="profit_dzn"]').on('input', calculateFOB);

        // Recalculate on load
        calculateAccessoriesCost();

        // --- Fabrics Cost AJAX Handling ---
        
        // Add Fabrics Cost
        $('#addFabricsCostBtn').click(function() {
            let costingHeadId = $('#costing_head_select').val();
            let value = $('#fabrics_cost_value').val();
            
            // Try to resolve orderPricingId safely
            let orderPricingId = '{{ isset($order->pricing) ? $order->pricing->id : ((isset($order) && $check) ? $order->id : "") }}';

            if(!costingHeadId) {
                alert('Please select a costing head.');
                return;
            }

            if(!value) {
                alert('Please enter a value.');
                return;
            }

            if(!orderPricingId) {
                alert('Order Pricing ID not found. Please save the order first.');
                return;
            }

            $.ajax({
                url: "{{ route('ordermanagement.database.orderpricing.fabrics-cost.store') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    order_pricing_id: orderPricingId,
                    costing_head_id: costingHeadId,
                    value: value
                },
                success: function(response) {
                    if(response.status === 'success') {
                        let item = response.fabricsCost;
                        let row = `
                            <tr data-id="${item.id}">
                                <td>${item.costing_head ? item.costing_head.costing_head_name : 'N/A'}</td>
                                <td>${item.value}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-danger delete-fabrics-cost" data-id="${item.id}">Delete</button>
                                </td>
                            </tr>
                        `;
                        $('#fabricsCostList').append(row);
                        
                        // Clear inputs
                        $('#costing_head_select').val('');
                        $('#fabrics_cost_value').val('');
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function(xhr) {
                    let msg = 'Error adding fabrics cost';
                    if(xhr.responseJSON && xhr.responseJSON.message) {
                        msg += ': ' + xhr.responseJSON.message;
                    }
                    alert(msg);
                }
            });
        });

        // Delete Fabrics Cost
        $(document).on('click', '.delete-fabrics-cost', function() {
            if(!confirm('Are you sure you want to delete this item?')) return;
            
            let btn = $(this);
            let id = btn.data('id');
            let url = "{{ route('ordermanagement.database.orderpricing.fabrics-cost.delete', ':id') }}";
            url = url.replace(':id', id);

            $.ajax({
                url: url,
                type: "DELETE",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    if(response.status === 'success') {
                        btn.closest('tr').remove();
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function(xhr) {
                     let msg = 'Error deleting item';
                    if(xhr.responseJSON && xhr.responseJSON.message) {
                        msg += ': ' + xhr.responseJSON.message;
                    }
                    alert(msg);
                }
            });
        });

        // --- Accessories AJAX Handling ---

        // Add Accessory
        $('#btnAddAccessory').click(function() {
            let accessoryId = $('#acc_accessory_id').val();
            let value = parseFloat($('#acc_value').val()) || 0;
            
            // Try to resolve orderPricingId safely
            let orderPricingId = '{{ isset($order->pricing) ? $order->pricing->id : ((isset($order) && $check) ? $order->id : "") }}';

            if(!accessoryId) {
                alert('Please select an accessory.');
                return;
            }
            
            if(!value) {
                alert('Please enter a value.');
                return;
            }

            if(!orderPricingId) {
                alert('Order Pricing ID not found. Please save the order first.');
                return;
            }

            $.ajax({
                url: "{{ route('ordermanagement.database.orderpricing.accessory.store') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    order_pricing_id: orderPricingId,
                    accessory_id: accessoryId,
                    value: value
                },
                success: function(response) {
                    if(response.status === 'success') {
                        let acc = response.accessory;
                        
                        let row = `
                            <tr data-id="${acc.id}">
                                <td>${acc.accessory ? acc.accessory.accessories_name : (acc.item_name || '')}</td>
                                <td>${acc.value}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-danger delete-accessory-btn" data-id="${acc.id}">Delete</button>
                                </td>
                            </tr>
                        `;
                        $('#accessoriesListBody').append(row);
                        
                        // Update total
                        calculateAccessoriesCost();

                        // Clear inputs
                        $('#acc_accessory_id').val('');
                        $('#acc_value').val('');
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function(xhr) {
                    let msg = 'Error adding accessory';
                    if(xhr.responseJSON && xhr.responseJSON.message) {
                        msg += ': ' + xhr.responseJSON.message;
                    }
                    alert(msg);
                }
            });
        });

        // Delete Accessory
        $(document).on('click', '.delete-accessory-btn', function() {
            if(!confirm('Are you sure you want to delete this item?')) return;
            
            let btn = $(this);
            let id = btn.data('id');
            let url = "{{ route('ordermanagement.database.orderpricing.accessory.delete', ':id') }}";
            url = url.replace(':id', id);

            $.ajax({
                url: url,
                type: "DELETE",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    if(response.status === 'success') {
                        btn.closest('tr').remove();
                        calculateAccessoriesCost();
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function(xhr) {
                     let msg = 'Error deleting item';
                    if(xhr.responseJSON && xhr.responseJSON.message) {
                        msg += ': ' + xhr.responseJSON.message;
                    }
                    alert(msg);
                }
            });
        });

        // --- Measurements AJAX Handling ---
        
        // Add Measurement
        $('#addMeasurementBtn').click(function() {
            let partNameId = $('#new_part_name_id').val();
            let value = $('#new_measurement_value').val();
            let orderPricingId = '{{ $pricingId }}';

            if(!partNameId || !value) {
                alert('Please select a part and enter a value.');
                return;
            }

            if(!orderPricingId) {
                alert('Order Pricing ID not found. Please save the order first.');
                return;
            }

            $.ajax({
                url: "{{ route('ordermanagement.database.orderpricing.measurement.store') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    order_pricing_id: orderPricingId,
                    part_name_id: partNameId,
                    value: value
                },
                success: function(response) {
                    if(response.status === 'success') {
                        let measurement = response.measurement;
                        let row = `
                            <tr id="measurement-row-${measurement.id}">
                                <td>${measurement.part_name ? measurement.part_name.part_name : ''}</td>
                                <td>${measurement.value}</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-danger py-0 px-1 delete-measurement-btn" data-id="${measurement.id}">&times;</button>
                                </td>
                            </tr>
                        `;
                        $('#measurementsTableBody').append(row);
                        
                        // Clear inputs
                        $('#new_part_name_id').val('');
                        $('#new_measurement_value').val('');
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function(xhr) {
                    let msg = 'Error adding measurement';
                    if(xhr.responseJSON && xhr.responseJSON.message) {
                        msg += ': ' + xhr.responseJSON.message;
                    }
                    alert(msg);
                }
            });
        });

        // Delete Measurement
        $(document).on('click', '.delete-measurement-btn', function() {
            if(!confirm('Are you sure you want to delete this measurement?')) return;
            
            let btn = $(this);
            let id = btn.data('id');
            let url = "{{ route('ordermanagement.database.orderpricing.measurement.delete', ':id') }}";
            url = url.replace(':id', id);

            $.ajax({
                url: url,
                type: "DELETE",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    if(response.status === 'success') {
                        $('#measurement-row-' + id).remove();
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function(xhr) {
                     let msg = 'Error deleting measurement';
                    if(xhr.responseJSON && xhr.responseJSON.message) {
                        msg += ': ' + xhr.responseJSON.message;
                    }
                    alert(msg);
                }
            });
        });

        // --- Fabrics Cost Breakup AJAX Handling ---
        
        // Add Fabrics Cost
        $('#addFabricsCostBtn').click(function() {
            let costingHeadId = $('#costing_head_select').val();
            let value = $('#fabrics_cost_value').val();
            // Try to resolve orderPricingId safely
            let orderPricingId = '{{ isset($order->pricing) ? $order->pricing->id : ((isset($order) && $check) ? $order->id : "") }}';

            if(!costingHeadId || !value) {
                alert('Please select a costing head and enter a value.');
                return;
            }

            if(!orderPricingId) {
                alert('Order Pricing ID not found. Please save the order first.');
                return;
            }

            $.ajax({
                url: "{{ route('ordermanagement.database.orderpricing.fabrics-cost.store') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    order_pricing_id: orderPricingId,
                    costing_head_id: costingHeadId,
                    value: value
                },
                success: function(response) {
                    if(response.status === 'success') {
                        let fabricsCost = response.fabricsCost;
                        let row = `
                            <tr data-id="${fabricsCost.id}">
                                <td>${fabricsCost.costing_head ? fabricsCost.costing_head.costing_head_name : ''}</td>
                                <td>${fabricsCost.value}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-danger delete-fabrics-cost" data-id="${fabricsCost.id}">Delete</button>
                                </td>
                            </tr>
                        `;
                        $('#fabricsCostList').append(row);
                        
                        // Clear inputs
                        $('#costing_head_select').val('');
                        $('#fabrics_cost_value').val('');
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function(xhr) {
                    let msg = 'Error adding fabrics cost';
                    if(xhr.responseJSON && xhr.responseJSON.message) {
                        msg += ': ' + xhr.responseJSON.message;
                    }
                    alert(msg);
                }
            });
        });

        // Delete Fabrics Cost
        $(document).on('click', '.delete-fabrics-cost', function() {
            if(!confirm('Are you sure you want to delete this item?')) return;
            
            let btn = $(this);
            let id = btn.data('id');
            let url = "{{ route('ordermanagement.database.orderpricing.fabrics-cost.delete', ':id') }}";
            url = url.replace(':id', id);

            $.ajax({
                url: url,
                type: "DELETE",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    if(response.status === 'success') {
                        btn.closest('tr').remove();
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function(xhr) {
                     let msg = 'Error deleting item';
                    if(xhr.responseJSON && xhr.responseJSON.message) {
                        msg += ': ' + xhr.responseJSON.message;
                    }
                    alert(msg);
                }
            });
        });

    });
</script>
@endpush