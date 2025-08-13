@extends('layouts.app')
@section('title', 'INVENTORY')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'INVENTORY',
                'subtitle' => 'Basic Orders',
                'breadcrumbs' => [
                    ['label' => 'INVENTORY', 'url' => route('inventory.index')],
                    ['label' => 'Database', 'url' => route('inventory.index')],
                    ['label' => 'Basic Orders', 'url' => route('inventory.database.basicorders.index')],
                ],
            ])
        </div>
        <div class="col-12 mb-3">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                <!-- Centered Title -->
                <h4 class="text-center flex-grow-1 order-1 order-md-0 mb-2 mb-md-0">
                    Basic Orders
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
                    <a href="{{ route('inventory.database.basicorders.index') }}"
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
                                                <a href="{{ route('inventory.database.basicorders.show', $order->id) }}">
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

        <div class="col-lg-9">
            <div class="card alert-info alert-top-border padding-card">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="18" height="18"></i> Input
                        Parameters For New Basic Order ...</h6>
                </div>

                <div class="card-body">
                    <form action="{{ route('inventory.database.basicorders.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Order Type</label>
                                    <select name="order_type" class="form-control" required>
                                        <option value="Confirmed">Confirmed</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Cancelled">Cancelled</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Compile Type</label>
                                    <select name="compile_type" class="form-control" required>
                                        <option value="Always Barcode">Always Barcode</option>
                                        <option value="Manual">Manual</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Organization <span
                                            class="text-danger">*</span></label>
                                    <select name="organization_id" class="form-control" required>
                                        @foreach ($organizations as $organization)
                                            <option value="{{ $organization->id }}">{{ $organization->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Buyer <span
                                            class="text-danger">*</span></label>
                                    <select name="buyer_id" class="form-control" required>
                                        @foreach ($buyers as $buyer)
                                            <option value="{{ $buyer->id }}">{{ $buyer->buyer_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Style No</label>
                                    <input class="form-control" name="style_no" type="text" id="example-text-input">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Style Description</label>
                                    <input class="form-control" name="style_description" type="text"
                                        id="example-text-input">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Order No <span
                                            class="text-danger">(Auto)</span></label>
                                    <input class="form-control" name="order_no" type="text" id="example-text-input">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Season</label>
                                    <input class="form-control" name="season" type="text" id="example-text-input">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Fitting Type</label>
                                    <select name="fitting_type" class="form-control" required>
                                        <option>Select Fitting Type</option>
                                        <option value="Regular">Regular</option>
                                        <option value="Plus">Plus</option>
                                        <option value="Slim">Slim</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Product Category <span
                                            class="text-danger">*</span></label>
                                    <select name="product_category_id" class="form-control" required>
                                        @foreach ($product_categories as $product_category)
                                            <option value="{{ $product_category->id }}">
                                                {{ $product_category->product_category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Merchandiser <span
                                            class="text-danger">*</span></label>
                                    <select name="merchandiser_id" class="form-control" required>
                                        @foreach ($merchandisers as $merchandiser)
                                            <option value="{{ $merchandiser->id }}">{{ $merchandiser->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Fabric Type <span
                                            class="text-danger">*</span></label>
                                    <select name="fabric_type_id" class="form-control" required>
                                        @foreach ($fabric_types as $fabric_type)
                                            <option value="{{ $fabric_type->id }}">{{ $fabric_type->fabric_type_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Composition <span
                                            class="text-danger">*</span></label>
                                    <select name="composition_id" class="form-control" required>
                                        @foreach ($compositions as $composition)
                                            <option value="{{ $composition->id }}">{{ $composition->composition_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Fabric Treatment</label>
                                    <select name="fabric_treatment_id" class="form-control" required>
                                        @foreach ($fabric_treatments as $fabric_treatment)
                                            <option value="{{ $fabric_treatment->id }}">
                                                {{ $fabric_treatment->fabric_treatment_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Yarn Count </label>
                                    <select name="yarn_count_id" class="form-control" required>
                                        @foreach ($yarn_counts as $yarn_count)
                                            <option value="{{ $yarn_count->id }}">{{ $yarn_count->yarn_count_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Yarn Category</label>
                                    <select name="yarn_category_id" class="form-control" required>
                                        @foreach ($yarn_categories as $yarn_category)
                                            <option value="{{ $yarn_category->id }}">
                                                {{ $yarn_category->yarn_category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">GSM <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="gsm" id="gsm">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">BW GSM <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="bw_gsm" id="bw_gsm">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Finish Diameter <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="number" name="finished_dia" id="finished_dia">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Finish Type</label>
                                    <select name="finish_type" class="form-control" required>
                                        <option>Select Finish Type</option>
                                        <option value="Regular">Regular</option>
                                        <option value="Plus">Plus</option>
                                        <option value="Slim">Slim</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Print Type</label>
                                    <select name="print_type" class="form-control" required>
                                        <option>Select Print Type</option>
                                        <option value="Regular">Regular</option>
                                        <option value="Plus">Plus</option>
                                        <option value="Slim">Slim</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Print Price Per Dzn <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="number" name="print_price_per_dzn"
                                        id="print_price_per_dzn">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">embroidery type</label>
                                    <select name="embroidery_type" class="form-control" required>
                                        <option>Select embroidery type</option>
                                        <option value="Regular">Regular</option>
                                        <option value="Plus">Plus</option>
                                        <option value="Slim">Slim</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">embroidery price per dzn</label>
                                    <input class="form-control" type="number" name="embroidery_price_per_dzn"
                                        id="embroidery_price_per_dzn">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">wash type</label>
                                    <select name="wash_type" class="form-control" required>
                                        <option>Select wash type</option>
                                        <option value="Regular">Regular</option>
                                        <option value="Plus">Plus</option>
                                        <option value="Slim">Slim</option>
                                    </select>
                                </div>
                            </div>
                            {{-- Pricing & Costing --}}
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">garment dye price per dzn</label>
                                    <input class="form-control" type="number" name="garment_dye_price_per_dzn"
                                        id="garment_dye_price_per_dzn">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">order date</label>
                                    <input class="form-control" type="date" name="order_date"
                                        value="<?php echo e(date('Y-m-d')); ?>" id="order_date">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">unit price <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="number" name="unit_price" id="unit_price">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">cm price per dzn</label>
                                    <input class="form-control" type="number" name="cm_price_per_dzn"
                                        id="cm_price_per_dzn">
                                </div>
                            </div>
                            {{-- Quantities --}}
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Order Quantity <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="order_quantity"
                                        id="order_quantity">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Extra Cutting Percent <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="number" name="extra_cutting_percent"
                                        id="extra_cutting_percent">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Fabric Booking Needed <span
                                            class="text-danger">*</span></label>
                                    <select name="fabric_booking_needed" class="form-control" required>
                                        <option>Select fabric booking needed</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>

                            {{-- Consumption --}}
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Fabric Consumption (kg/dzn) <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="number" name="fabric_consumption_kg_dz"
                                        id="fabric_consumption_kg_dz">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Kd Allowance Percent <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="number" name="kd_allowance_percent"
                                        id="kd_allowance_percent">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Cutting Consumption
                                        (yards/pcs)</label>
                                    <input class="form-control" type="number" name="cutting_consumption_yards_pcs"
                                        id="cutting_consumption_yards_pcs">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Booking Consumption
                                        (yards/pcs)</label>
                                    <input class="form-control" type="number" name="booking_consumption_yards_pcs"
                                        id="booking_consumption_yards_pcs">
                                </div>
                            </div>
                            {{-- Delivery --}}
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Delivery Mode <span
                                            class="text-danger">*</span></label>
                                    <select name="delivery_mode" class="form-control" required>
                                        <option>Select delivery_mode</option>
                                        <option value="Sea">Sea</option>
                                        <option value="Air">Air</option>
                                        <option value="Road">Road</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Delivery Date</label>
                                    <input class="form-control" type="date" name="delivery_date" id="delivery_date">
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">trims required approved</label>
                                    <select name="trims_required_approved" class="form-control" required>
                                        <option>Select trims required approved</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">closed</label>
                                    <select name="closed" class="form-control" required>
                                        <option>Select closed</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">fabric from stock</label>
                                    <select name="fabric_from_stock" class="form-control" required>
                                        <option>Select fabric from stock</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                {{-- save and go to next --}}
                                <button type="submit" class="btn btn-primary float-end me-2">Save and Go to Next</button>
                                {{-- save and close --}}
                                <button type="#" class="btn btn-success float-end me-2">Save and Close</button>
                                {{-- cancel --}}
                                <button type="#" class="btn btn-danger float-end me-2">Cancel</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script>
        let lotIndex = 0;

        document.getElementById('add-lot-btn').addEventListener('click', function() {
            lotIndex++;
            let lotsContainer = document.getElementById('lots-container');

            let lotHtml = `
        <div class="lot" data-lot-index="${lotIndex}">
            <label>Lot No:</label>
            <input type="text" name="lots[${lotIndex}][lot_no]" required>
    
            <h4>Colors</h4>
            <div class="colors-container">
                <div class="color" data-color-index="0">
                    <label>Color Name:</label>
                    <input type="text" name="lots[${lotIndex}][colors][0][color_name]" required>
    
                    <h5>Sizes</h5>
                    <div class="sizes-container">
                        <div class="size" data-size-index="0">
                            <label>Size Name:</label>
                            <input type="text" name="lots[${lotIndex}][colors][0][sizes][0][size_name]" required>
                            <label>Quantity:</label>
                            <input type="number" name="lots[${lotIndex}][colors][0][sizes][0][quantity]" min="0" required>
                        </div>
                    </div>
                    <button type="button" class="add-size-btn">Add Size</button>
                </div>
            </div>
            <button type="button" class="add-color-btn">Add Color</button>
        </div>
        `;
            lotsContainer.insertAdjacentHTML('beforeend', lotHtml);
        });

        // Delegate event listeners for add color and add size buttons
        document.getElementById('lots-container').addEventListener('click', function(e) {
            if (e.target.classList.contains('add-color-btn')) {
                let lotDiv = e.target.closest('.lot');
                let lotIdx = lotDiv.getAttribute('data-lot-index');

                let colorsContainer = lotDiv.querySelector('.colors-container');
                let colorCount = colorsContainer.querySelectorAll('.color').length;
                let colorHtml = `
            <div class="color" data-color-index="${colorCount}">
                <label>Color Name:</label>
                <input type="text" name="lots[${lotIdx}][colors][${colorCount}][color_name]" required>
    
                <h5>Sizes</h5>
                <div class="sizes-container">
                    <div class="size" data-size-index="0">
                        <label>Size Name:</label>
                        <input type="text" name="lots[${lotIdx}][colors][${colorCount}][sizes][0][size_name]" required>
                        <label>Quantity:</label>
                        <input type="number" name="lots[${lotIdx}][colors][${colorCount}][sizes][0][quantity]" min="0" required>
                    </div>
                </div>
                <button type="button" class="add-size-btn">Add Size</button>
            </div>
            `;
                colorsContainer.insertAdjacentHTML('beforeend', colorHtml);
            }

            if (e.target.classList.contains('add-size-btn')) {
                let colorDiv = e.target.closest('.color');
                let lotDiv = e.target.closest('.lot');
                let lotIdx = lotDiv.getAttribute('data-lot-index');
                let colorIdx = colorDiv.getAttribute('data-color-index');

                let sizesContainer = colorDiv.querySelector('.sizes-container');
                let sizeCount = sizesContainer.querySelectorAll('.size').length;
                let sizeHtml = `
            <div class="size" data-size-index="${sizeCount}">
                <label>Size Name:</label>
                <input type="text" name="lots[${lotIdx}][colors][${colorIdx}][sizes][${sizeCount}][size_name]" required>
                <label>Quantity:</label>
                <input type="number" name="lots[${lotIdx}][colors][${colorIdx}][sizes][${sizeCount}][quantity]" min="0" required>
            </div>
            `;
                sizesContainer.insertAdjacentHTML('beforeend', sizeHtml);
            }
        });
    </script>
@endpush
