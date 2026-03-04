<div class="card alert-info alert-top-border padding-card">
    <div class="card-header">
        <h6 class="my-0 text-primary"> <i data-feather="list" width="18" height="18"></i> Input
            Parameters For Basic Order {!! $basicorder->order_no !!}</h6>
    </div>
    @php 

    // dd($basicorder);
    @endphp
    <div class="card-body">
        <form action="{{ route('inventory.database.basicorders.update', $basicorder->id) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{ $basicorder->id }}">   
            <div class="row">
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Order Type</label>
                        <select name="order_type"  class="form-control form-control-sm" required>
                            <option value="Confirmed" {{ $basicorder->order_type == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="Pending" {{ $basicorder->order_type == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Cancelled" {{ $basicorder->order_type == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Compile Type</label>
                        <select name="compile_type" class="form-control form-control-sm" required>
                            <option value="Always Barcode" {{ $basicorder->compile_type == 'Always Barcode' ? 'selected' : '' }}>Always Barcode</option>
                            <option value="Manual" {{ $basicorder->compile_type == 'Manual' ? 'selected' : '' }}>Manual</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Organization <span
                                class="text-danger">*</span></label>
                        <select name="organization_id" class="form-control form-control-sm" required>
                            @foreach ($organizations as $organization)
                                <option value="{{ $organization->id }}" {{ $basicorder->organization_id == $organization->id ? 'selected' : '' }}>{{ $organization->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Buyer <span
                                class="text-danger">*</span></label>
                        <select name="buyer_id" class="form-control form-control-sm" required>
                            @foreach ($buyers as $buyer)
                                <option value="{{ $buyer->id }}" {{ $basicorder->buyer_id == $buyer->id ? 'selected' : '' }}>{{ $buyer->buyer_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Style No</label>
                        <input class="form-control form-control-sm" name="style_no" type="text" id="example-text-input" value="{{ $basicorder->style_no }}">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Style Description</label>
                        <input class="form-control form-control-sm" name="style_description" type="text" value="{{ $basicorder->style_description }}"
                            id="example-text-input">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Order No <span
                                class="text-danger">(Auto)</span></label>
                        <input class="form-control form-control-sm" name="order_no" type="text" id="example-text-input" value="{{ $basicorder->order_no }}" readonly>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Season</label>
                        <input class="form-control form-control-sm" name="season" type="text" id="example-text-input" value="{{ $basicorder->season }}">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Fitting Type</label>
                        <select name="fitting_type" class="form-control form-control-sm" required>
                            <option>Select Fitting Type</option>
                            <option value="Regular" {{ $basicorder->fitting_type == 'Regular' ? 'selected' : '' }}>Regular</option>
                            <option value="Plus" {{ $basicorder->fitting_type == 'Plus' ? 'selected' : '' }}>Plus</option>
                            <option value="Slim" {{ $basicorder->fitting_type == 'Slim' ? 'selected' : '' }}>Slim</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Product Category <span
                                class="text-danger">*</span></label>
                        <select name="product_category_id" class="form-control form-control-sm" required>
                            @foreach ($product_categories as $product_category)
                                <option value="{{ $product_category->id }}" {{ $basicorder->product_category_id == $product_category->id ? 'selected' : '' }}>
                                    {{ $product_category->product_category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Merchandiser <span
                                class="text-danger">*</span></label>
                        <select name="merchandiser_id" class="form-control form-control-sm" required>
                            @foreach ($merchandisers as $merchandiser)
                                <option value="{{ $merchandiser->id }}" {{ $basicorder->merchandiser_id == $merchandiser->id ? 'selected' : '' }}>{{ $merchandiser->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Fabric Type <span
                                class="text-danger">*</span></label>
                        <select name="fabric_type_id" class="form-control form-control-sm" required>
                            @foreach ($fabric_types as $fabric_type)
                                <option value="{{ $fabric_type->id }}" {{ $basicorder->fabric_type_id == $fabric_type->id ? 'selected' : '' }}>{{ $fabric_type->fabric_type_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Composition <span
                                class="text-danger">*</span></label>
                        <select name="composition_id" class="form-control form-control-sm" required>
                            @foreach ($compositions as $composition)
                                <option value="{{ $composition->id }}" {{ $basicorder->composition_id == $composition->id ? 'selected' : '' }}>{{ $composition->composition_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Fabric Treatment</label>
                        <select name="fabric_treatment_id" class="form-control form-control-sm" required>
                            @foreach ($fabric_treatments as $fabric_treatment)
                                <option value="{{ $fabric_treatment->id }}" {{ $basicorder->fabric_treatment_id == $fabric_treatment->id ? 'selected' : '' }}>
                                    {{ $fabric_treatment->fabric_treatment_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Yarn Count </label>
                        <select name="yarn_count_id" class="form-control form-control-sm" required>
                            @foreach ($yarn_counts as $yarn_count)
                                <option value="{{ $yarn_count->id }}" {{ $basicorder->yarn_count_id == $yarn_count->id ? 'selected' : '' }}>{{ $yarn_count->yarn_count_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Yarn Category</label>
                        <select name="yarn_category_id" class="form-control form-control-sm" required>
                            @foreach ($yarn_categories as $yarn_category)
                                <option value="{{ $yarn_category->id }}" {{ $basicorder->yarn_category_id == $yarn_category->id ? 'selected' : '' }}>
                                    {{ $yarn_category->yarn_category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">GSM <span
                                class="text-danger">*</span></label>
                        <input class="form-control form-control-sm" type="text" name="gsm" id="gsm" value="{{ $basicorder->gsm }}">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">BW GSM <span
                                class="text-danger">*</span></label>
                        <input class="form-control form-control-sm" type="text" name="bw_gsm" id="bw_gsm" value="{{ $basicorder->bw_gsm }}">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Finish Diameter <span
                                class="text-danger">*</span></label>
                        <input class="form-control form-control-sm" type="number" name="finished_dia" id="finished_dia" value="{{ $basicorder->finished_dia }}">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Finish Type</label>
                        <select name="finish_type" class="form-control form-control-sm" required>
                            <option>Select Finish Type</option>
                            <option value="Regular" {{ $basicorder->finish_type == 'Regular' ? 'selected' : '' }}>Regular</option>
                            <option value="Plus" {{ $basicorder->finish_type == 'Plus' ? 'selected' : '' }}>Plus</option>
                            <option value="Slim" {{ $basicorder->finish_type == 'Slim' ? 'selected' : '' }}>Slim</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Print Type</label>
                        <select name="print_type" class="form-control form-control-sm" required>
                            <option>Select Print Type</option>
                            <option value="Regular" {{ $basicorder->print_type == 'Regular' ? 'selected' : '' }}>Regular</option>
                            <option value="Plus" {{ $basicorder->print_type == 'Plus' ? 'selected' : '' }}>Plus</option>
                            <option value="Slim" {{ $basicorder->print_type == 'Slim' ? 'selected' : '' }}>Slim</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Print Price Per Dzn <span
                                class="text-danger">*</span></label>
                        <input class="form-control form-control-sm" type="number" name="print_price_per_dzn"
                            id="print_price_per_dzn" value="{{ $basicorder->print_price_per_dzn }}">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">embroidery type</label>
                        <select name="embroidery_type" class="form-control form-control-sm" required>
                            <option>Select embroidery type</option>
                            <option value="Regular" {{ $basicorder->embroidery_type == 'Regular' ? 'selected' : '' }}>Regular</option>
                            <option value="Plus" {{ $basicorder->embroidery_type == 'Plus' ? 'selected' : '' }}>Plus</option>
                            <option value="Slim" {{ $basicorder->embroidery_type == 'Slim' ? 'selected' : '' }}>Slim</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">embroidery price per dzn</label>
                        <input class="form-control form-control-sm" type="number" name="embroidery_price_per_dzn"
                            id="embroidery_price_per_dzn" value="{{ $basicorder->embroidery_price_per_dzn }}">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">wash type</label>
                        <select name="wash_type" class="form-control form-control-sm" required>
                            <option>Select wash type</option>
                            <option value="Regular" {{ $basicorder->wash_type == 'Regular' ? 'selected' : '' }}>Regular</option>
                            <option value="Plus" {{ $basicorder->wash_type == 'Plus' ? 'selected' : '' }}>Plus</option>
                            <option value="Slim" {{ $basicorder->wash_type == 'Slim' ? 'selected' : '' }}>Slim</option>
                        </select>
                    </div>
                </div>
                {{-- Pricing & Costing --}}
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">garment dye price per dzn</label>
                        <input class="form-control form-control-sm" type="number" name="garment_dye_price_per_dzn"
                            id="garment_dye_price_per_dzn" value="{{ $basicorder->garment_dye_price_per_dzn }}">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">order date</label>
                        <input class="form-control form-control-sm" type="date" name="order_date"
                            value="{{ $basicorder->order_date }}" id="order_date">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">unit price <span
                                class="text-danger">*</span></label>
                        <input class="form-control form-control-sm" type="number" name="unit_price" id="unit_price" value="{{ $basicorder->unit_price }}">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">cm price per dzn</label>
                        <input class="form-control form-control-sm" type="number" name="cm_price_per_dzn"
                            id="cm_price_per_dzn" value="{{ $basicorder->cm_price_per_dzn }}">
                    </div>
                </div>
                {{-- Quantities --}}
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Order Quantity <span
                                class="text-danger">*</span></label>
                        <input class="form-control form-control-sm" type="text" name="order_quantity"
                            id="order_quantity" value="{{ $basicorder->order_quantity }}">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Extra Cutting Percent <span
                                class="text-danger">*</span></label>
                        <input class="form-control form-control-sm" type="number" name="extra_cutting_percent"
                            id="extra_cutting_percent" value="{{ $basicorder->extra_cutting_percent }}">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Fabric Booking Needed <span
                                class="text-danger">*</span></label>
                        <select name="fabric_booking_needed" class="form-control form-control-sm" required>
                            <option>Select fabric booking needed</option>
                            <option value="1" {{ $basicorder->fabric_booking_needed == 1 ? 'selected' : '' }}>Yes</option>
                            <option value="0" {{ $basicorder->fabric_booking_needed == 0 ? 'selected' : '' }}>No</option>
                        </select>
                    </div>
                </div>

                {{-- Consumption --}}
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Fabric Consumption (kg/dzn) <span
                                class="text-danger">*</span></label>
                        <input class="form-control form-control-sm" type="number" name="fabric_consumption_kg_dz"
                            id="fabric_consumption_kg_dz" value="{{ $basicorder->fabric_consumption_kg_dz }}">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Kd Allowance Percent <span
                                class="text-danger">*</span></label>
                        <input class="form-control form-control-sm" type="number" name="kd_allowance_percent"
                            id="kd_allowance_percent" value="{{ $basicorder->kd_allowance_percent }}">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Cutting Consumption
                            (yards/pcs)</label>
                        <input class="form-control form-control-sm" type="number" name="cutting_consumption_yards_pcs"
                            id="cutting_consumption_yards_pcs" value="{{ $basicorder->cutting_consumption_yards_pcs }}">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Booking Consumption
                            (yards/pcs)</label>
                        <input class="form-control form-control-sm" type="number" name="booking_consumption_yards_pcs"
                            id="booking_consumption_yards_pcs" value="{{ $basicorder->booking_consumption_yards_pcs }}">
                    </div>
                </div>
                {{-- Delivery --}}
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Delivery Mode <span
                                class="text-danger">*</span></label>
                        <select name="delivery_mode" class="form-control form-control-sm" required>
                            <option>Select delivery_mode</option>
                            <option value="Sea" {{ $basicorder->delivery_mode == 'Sea' ? 'selected' : '' }}>Sea</option>
                            <option value="Air" {{ $basicorder->delivery_mode == 'Air' ? 'selected' : '' }}>Air</option>
                            <option value="Road" {{ $basicorder->delivery_mode == 'Road' ? 'selected' : '' }}>Road</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Delivery Date</label>
                        <input class="form-control form-control-sm" type="date" name="delivery_date" id="delivery_date" value="{{ $basicorder->delivery_date }}">
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">trims required approved</label>
                        <select name="trims_required_approved" class="form-control form-control-sm" required>
                            <option>Select trims required approved</option>
                            <option value="1" {{ $basicorder->trims_required_approved == 1 ? 'selected' : '' }}>Yes</option>
                            <option value="0" {{ $basicorder->trims_required_approved == 0 ? 'selected' : '' }}>No</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">closed</label>
                        <select name="closed" class="form-control form-control-sm" required>
                            <option>Select closed</option>
                            <option value="1" {{ $basicorder->closed == 1 ? 'selected' : '' }}>Yes</option>
                            <option value="0" {{ $basicorder->closed == 0 ? 'selected' : '' }}>No</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">fabric from stock</label>
                        <select name="fabric_from_stock" class="form-control form-control-sm" required>
                            <option>Select fabric from stock</option>
                            <option value="1" {{ $basicorder->fabric_from_stock == 1 ? 'selected' : '' }}>Yes</option>
                            <option value="0" {{ $basicorder->fabric_from_stock == 0 ? 'selected' : '' }}>No</option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-12">
                    {{-- save and go to next --}}
                    <button type="submit" class="btn btn-primary float-end me-2">Update and Go to Next</button>
                    {{-- save and close --}}
                    <button type="#" class="btn btn-success float-end me-2">Update and Close</button>
                    {{-- cancel --}}
                    <button type="#" class="btn btn-danger float-end me-2">Cancel</button>
                </div>

            </div>
        </form>
    </div>
</div>