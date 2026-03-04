@extends('layouts.app')
@section('title', 'Order Management')
@section('styles')
<style>
    .table, tr, th, td { border: none !important; border-collapse: collapse; }
    .form-label { font-size: 0.8rem; font-weight: bold; }
    .form-control-sm { font-size: 0.8rem; }
    .btn-xs { padding: 0.1rem 0.3rem; font-size: 0.7rem; }
</style>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // SweetAlert for delete
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endpush
@section('content')
<div class="row">
    <div class="col-12">
        @include('components.breadcrumb', [
        'title' => 'Order Management',
        'subtitle' => 'Sample Order Programme',
        'breadcrumbs' => [
        ['label' => 'Order Management', 'url' => route('ordermanagement.index')],
        ['label' => 'Database', 'url' => route('ordermanagement.index')],
        ['label' => 'Sample Order Programme', 'url' => route('ordermanagement.database.sampleorderprogramme.index')],
        ],
        ])
    </div>
    <!-- Sidebar -->
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
            <div class="card-body" style="max-height: 800px;min-height: 800px; overflow-y: auto;">
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
                            <li class="nav-custom-item"><a href="{{ route('ordermanagement.database.sampleorderprogramme.show', $x->id) }}" class="nav-custom-link {{ $order->id == $x->id ? 'active' : '' }}">{{ $x->order_code }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="col-md-9">
        <div class="card alert-success alert-top-border mb-3">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-12">
                        <h6 class="my-0 text-primary"> <i class="mdi mdi-eye"></i> Initial Order Details: {{ $order->order_code }}
                        </h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <h6 class="text-primary">Basic Information</h6>
                        <table class="table table-sm">
                            <tr>
                                <td width="30%"><strong>Order Code:</strong></td>
                                <td>{{ $order->order_code }}</td>
                            </tr>
                            <tr>
                                <td><strong>Buyer:</strong></td>
                                <td>{{ $order->buyer->buyer_name ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Organization:</strong></td>
                                <td>{{ $order->organization->name ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Order Quantity:</strong></td>
                                <td>{{ $order->order_quantity ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Style:</strong></td>
                                <td>{{ $order->style ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>PO:</strong></td>
                                <td>{{ $order->po ?? 'N/A' }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-4">
                        <h6 class="text-primary">Technical Details</h6>
                        <table class="table table-sm">
                            <tr>
                                <td width="30%"><strong>GSM:</strong></td>
                                <td>{{ $order->gsm ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Season:</strong></td>
                                <td>{{ $order->seasson ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Fabrication:</strong></td>
                                <td>{{ $order->fabrication ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Finish Type:</strong></td>
                                <td>{{ $order->finish_type ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Color:</strong></td>
                                <td>
                                    @php
                                        $colorList = $order->colors->pluck('color_name')->filter()->implode(', ');
                                    @endphp
                                    {{ $colorList ?: 'N/A' }}
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Size:</strong></td>
                                <td>
                                    @php
                                        $sizeList = $order->sizes->pluck('size_name')->filter()->implode(', ');
                                    @endphp
                                    {{ $sizeList ?: 'N/A' }}
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-4">
                        <h6 class="text-primary">Order Details</h6>
                        <table class="table table-sm">
                            <tr>
                                <td width="30%"><strong>Order Type:</strong></td>
                                <td>{{ $order->orderType->name ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Merchant:</strong></td>
                                <td>{{ $order->merchant->name ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Yarn Count:</strong></td>
                                <td>{{ $order->yarnCount->yarn_count_name ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Product Category:</strong></td>
                                <td>{{ $order->productCategory->product_category_name ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td width="30%"><strong>Description:</strong></td>
                                <td>{{ $order->description ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Instructions:</strong></td>
                                <td>{{ $order->instructions ?? 'N/A' }}</td>
                            </tr>
                              <tr>
                                <td><strong>File:</strong></td>
                                <td>
                                    @if($order->file)
                                        <a href="{{ asset($order->file) }}" target="_blank">View File</a>
                                    @else
                                        N/A
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                  
                </div>
            </div>
        </div>

        <div class="card alert-info alert-top-border">
            <div class="card-header">
                <h6 class="my-0 text-primary">Sample Order Programme for {{ $order->order_code }}</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('ordermanagement.database.sampleorderprogramme.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="initial_order_id" value="{{ $order->id }}">
                    <div class="row">
                        <div class="col-md-3 mb-2">
                            <label class="form-label">Style</label>
                            <input type="text" name="style_no" value="{{ $order->style ?? 'N/A' }}" class="form-control form-control-sm">
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="form-label">Item Name</label>
                            <select name="item_id" class="form-control form-control-sm select2">
                                <option value="">Select Item</option>
                                @foreach($items as $item)
                                    <option value="{{ $item->id }}" {{ $order->product_category_id == $item->id ? 'selected' : '' }}>{{ $item->product_category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="form-label">GSM</label>
                            <input type="text" name="gsm" value="{{ $order->gsm ?? 'N/A' }}" class="form-control form-control-sm">
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="form-label">Fab Src.</label>
                            <select name="fab_src" class="form-control form-control-sm select2">
                                <option value="">Select Fabric Source</option>
                                @foreach($fabricSources as $source)
                                    <option value="{{ $source->fabric_source_name }}">{{ $source->fabric_source_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="form-label">Color</label>
                            <x-select-multiple-input name="colors_id[]" multiple 
                                                :options="$colors->pluck('color_name', 'id')" 
                                                :selected="old('colors_id')" />
                            <!-- <select name="color_id" class="form-control form-control-sm select2">
                                <option value="">Select Color</option>
                                @foreach($colors as $color)
                                    <option value="{{ $color->id }}">{{ $color->color_name }}</option>
                                @endforeach
                            </select> -->
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="form-label">Size</label>
                            <x-select-multiple-input name="sizes_id[]" multiple 
                                                :options="$sizes->pluck('size_name', 'id')" 
                                                :selected="old('sizes_id')" />
                            <!-- <select name="size_id" class="form-control form-control-sm select2">
                                <option value="">Select Size</option>
                                @foreach($sizes as $size)
                                    <option value="{{ $size->id }}">{{ $size->size_name }}</option>
                                @endforeach
                            </select> -->
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="form-label">Sample Type</label>
                            <select name="sample_type_id" class="form-control form-control-sm select2">
                                <option value="">Select Sample Type</option>
                                @foreach($sampleTypes as $sampleType)
                                    <option value="{{ $sampleType->id }}">{{ $sampleType->sample_type_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="form-label">Fabric Composition</label>
                            <select name="composition_id" class="form-control form-control-sm select2">
                                <option value="">Select Composition</option>
                                @foreach($compositions as $comp)
                                    <option value="{{ $comp->id }}">{{ $comp->composition_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="form-label">Trims Fabric</label>
                            <input type="text" name="trims_fabric" class="form-control form-control-sm">
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="form-label">Wash Type</label>
                            <select name="wash_type" class="form-control form-control-sm select2">
                                <option value="">Select Wash Type</option>
                                @foreach($washTypes as $wash)
                                    <option value="{{ $wash->wash_type_name }}">{{ $wash->wash_type_name }}</option>
                                @endforeach
                            </select>
                        </div>
                       
                        <div class="col-md-3 mb-2">
                            <label class="form-label">F/Dia(Inch)</label>
                            <input type="text" name="f_dia" class="form-control form-control-sm">
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="form-label">Fin. Fab(Kg)</label>
                            <input type="number" step="0.0001" name="fin_fab_kg" class="form-control form-control-sm">
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="form-label">Qty (Pcs)</label>
                            <input type="number" name="qty_pcs" class="form-control form-control-sm">
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="form-label">Fabric Treatment</label>
                            <select name="fabric_treatment_id" class="form-control form-control-sm select2">
                                <option value="">Select Treatment</option>
                                @foreach($fabricTreatments as $ft)
                                    <option value="{{ $ft->id }}">{{ $ft->fabric_treatment_name }}</option>
                                @endforeach
                            </select>
                        </div>
                         <div class="col-md-3 mb-2">
                            <label class="form-label">Delivery Deadline</label>
                            <input type="date" name="delivery_deadline" class="form-control form-control-sm">
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="form-label">Print & Emb Inst.</label>
                            <textarea name="print_emb_inst" class="form-control form-control-sm" rows="2"></textarea>
                        </div>
                         <div class="col-md-3 mb-2">
                            <label class="form-label">Tri & Acr</label>
                            <textarea name="tri_acr" class="form-control form-control-sm" rows="2"></textarea>
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="form-label">Tri & Acr Deadline</label>
                            <input type="date" name="tri_acr_deadline" class="form-control form-control-sm">
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="form-label">Remarks / Ins.</label>
                            <textarea name="remarks" class="form-control form-control-sm" rows="2"></textarea>
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary btn-sm">Add Sample Programme</button>
                    </div>
                </form>

                <hr>

               
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h5 class="text-center">Sample Programme List</h5>
             <!-- List -->
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-sm text-center" style="font-size: 0.8rem;">
                        <thead>
                            <tr>
                                <th>Fab Src.</th>
                                <th>Color</th>
                                <th>Sample Type</th>
                                <th>Composition</th>
                                <th>Trims Fab</th>
                                <th>Wash</th>
                                <th>Style</th>
                                <th>Item</th>
                                <th>F/Dia</th>
                                <th>GSM</th>
                                <th>Fin Fab</th>
                                <th>Qty</th>
                                <th>Treatment</th>
                                <th>Size</th>
                                <th>Deadline</th>
                                <th>Tri & Acr Deadline</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($samples as $sample)
                            <tr>
                                <td>{{ $sample->fab_src }}</td>
                                <td>
                                @php
                                    $colorList = $sample->colors->pluck('color_name')->filter()->implode(', ');
                                @endphp
                                {{ $colorList ?: 'N/A' }}
                                </td>
                                <td>{{ $sample->sampleType->sample_type_name ?? '' }}</td>
                                <td>{{ $sample->composition->composition_name ?? '' }}</td>
                                <td>{{ $sample->trims_fabric }}</td>
                                <td>{{ $sample->wash_type }}</td>
                                <td>{{ $sample->style_no }}</td>
                                <td>{{ $sample->item->product_category_name ?? '' }}</td>
                                <td>{{ $sample->f_dia }}</td>
                                <td>{{ $sample->gsm }}</td>
                                <td>{{ $sample->fin_fab_kg }}</td>
                                <td>{{ $sample->qty_pcs }}</td>
                                <td>{{ $sample->fabricTreatment->fabric_treatment_name ?? '' }}</td>
                                <td>
                                    @php
                                        $sizeList = $sample->sizes->pluck('size_name')->filter()->implode(', ');
                                    @endphp
                                {{ $sizeList ?: 'N/A' }}
                                   
                                </td>
                                <td>{{ $sample->delivery_deadline }}</td>
                                <td>{{ $sample->tri_acr_deadline }}</td>
                                <td>
                                    <a href="#" class="btn btn-soft-success waves-effect waves-light" style="padding: 4px 6px;" data-bs-toggle="modal" data-bs-target="#editModal{{ $sample->id }}"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('ordermanagement.database.sampleorderprogramme.destroy', $sample->id) }}" method="POST" style="display:inline;" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-soft-danger waves-effect waves-light" style="padding: 4px 6px;">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>

                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="editModal{{ $sample->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $sample->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel{{ $sample->id }}">Edit Sample Programme</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('ordermanagement.database.sampleorderprogramme.update', $sample->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body text-start">
                                                        <table class="table table-bordered">
                                                            <tbody>
                                                                <tr>
                                                                    <th width="20%"><label class="form-label">Style</label></th>
                                                                    <td width="30%"><input type="text" name="style_no" value="{{ $sample->style_no }}" class="form-control form-control-sm"></td>
                                                                    <th width="20%"><label class="form-label">Item Name</label></th>
                                                                    <td width="30%">
                                                                        <select name="item_id" class="form-control form-control-sm select2">
                                                                            <option value="">Select Item</option>
                                                                            @foreach($items as $item)
                                                                                <option value="{{ $item->id }}" {{ $sample->item_id == $item->id ? 'selected' : '' }}>{{ $item->product_category_name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th width="20%"><label class="form-label">GSM</label></th>
                                                                    <td width="30%"><input type="text" name="gsm" value="{{ $sample->gsm }}" class="form-control form-control-sm"></td>
                                                                    <th width="20%"><label class="form-label">Fab Src.</label></th>
                                                                    <td width="30%">
                                                                        <select name="fab_src" class="form-control form-control-sm select2">
                                                                            <option value="">Select Fabric Source</option>
                                                                            @foreach($fabricSources as $source)
                                                                                <option value="{{ $source->fabric_source_name }}" {{ $sample->fab_src == $source->fabric_source_name ? 'selected' : '' }}>{{ $source->fabric_source_name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th width="20%"><label class="form-label">Color</label></th>
                                                                    <td width="30%">
                                                                        <select name="color_id" class="form-control form-control-sm select2">
                                                                            <option value="">Select Color</option>
                                                                            @foreach($colors as $color)
                                                                                <option value="{{ $color->id }}" {{ $sample->color_id == $color->id ? 'selected' : '' }}>{{ $color->color_name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </td>
                                                                    <th width="20%"><label class="form-label">Size</label></th>
                                                                    <td width="30%">
                                                                        <select name="size_id" class="form-control form-control-sm select2">
                                                                            <option value="">Select Size</option>
                                                                            @foreach($sizes as $size)
                                                                                <option value="{{ $size->id }}" {{ $sample->size_id == $size->id ? 'selected' : '' }}>{{ $size->size_name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th width="20%"><label class="form-label">Sample Type</label></th>
                                                                    <td width="30%">
                                                                        <select name="sample_type_id" class="form-control form-control-sm select2">
                                                                            <option value="">Select Sample Type</option>
                                                                            @foreach($sampleTypes as $sampleType)
                                                                                <option value="{{ $sampleType->id }}" {{ $sample->sample_type_id == $sampleType->id ? 'selected' : '' }}>{{ $sampleType->sample_type_name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </td>
                                                                    <th width="20%"><label class="form-label">Fabric Composition</label></th>
                                                                    <td width="30%">
                                                                        <select name="composition_id" class="form-control form-control-sm select2">
                                                                            <option value="">Select Composition</option>
                                                                            @foreach($compositions as $comp)
                                                                                <option value="{{ $comp->id }}" {{ $sample->composition_id == $comp->id ? 'selected' : '' }}>{{ $comp->composition_name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th width="20%"><label class="form-label">Trims Fabric</label></th>
                                                                    <td width="30%"><input type="text" name="trims_fabric" value="{{ $sample->trims_fabric }}" class="form-control form-control-sm"></td>
                                                                    <th width="20%"><label class="form-label">Wash Type</label></th>
                                                                    <td width="30%">
                                                                        <select name="wash_type" class="form-control form-control-sm select2">
                                                                            <option value="">Select Wash Type</option>
                                                                            @foreach($washTypes as $wash)
                                                                                <option value="{{ $wash->wash_type_name }}" {{ $sample->wash_type == $wash->wash_type_name ? 'selected' : '' }}>{{ $wash->wash_type_name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th width="20%"><label class="form-label">F/Dia(Inch)</label></th>
                                                                    <td width="30%"><input type="text" name="f_dia" value="{{ $sample->f_dia }}" class="form-control form-control-sm"></td>
                                                                    <th width="20%"><label class="form-label">Fin. Fab(Kg)</label></th>
                                                                    <td width="30%"><input type="number" step="0.0001" name="fin_fab_kg" value="{{ $sample->fin_fab_kg }}" class="form-control form-control-sm"></td>
                                                                </tr>
                                                                <tr>
                                                                    <th width="20%"><label class="form-label">Qty (Pcs)</label></th>
                                                                    <td width="30%"><input type="number" name="qty_pcs" value="{{ $sample->qty_pcs }}" class="form-control form-control-sm"></td>
                                                                    <th width="20%"><label class="form-label">Fabric Treatment</label></th>
                                                                    <td width="30%">
                                                                        <select name="fabric_treatment_id" class="form-control form-control-sm select2">
                                                                            <option value="">Select Treatment</option>
                                                                            @foreach($fabricTreatments as $ft)
                                                                                <option value="{{ $ft->id }}" {{ $sample->fabric_treatment_id == $ft->id ? 'selected' : '' }}>{{ $ft->fabric_treatment_name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th width="20%"><label class="form-label">Delivery Deadline</label></th>
                                                                    <td width="30%"><input type="date" name="delivery_deadline" value="{{ $sample->delivery_deadline }}" class="form-control form-control-sm"></td>
                                                                    <th width="20%"></th>
                                                                    <td width="30%"></td>
                                                                </tr>
                                                                <tr>
                                                                    <th width="20%"><label class="form-label">Print & Emb Inst.</label></th>
                                                                    <td colspan="3"><textarea name="print_emb_inst" class="form-control form-control-sm" rows="2">{{ $sample->print_emb_inst }}</textarea></td>
                                                                </tr>
                                                                <tr>
                                                                    <th width="20%"><label class="form-label">Tri & Acr</label></th>
                                                                    <td colspan="3"><textarea name="tri_acr" class="form-control form-control-sm" rows="2">{{ $sample->tri_acr }}</textarea></td>
                                                                </tr>
                                                                <tr>
                                                                    <th width="20%"><label class="form-label">Tri & Acr Deadline</label></th>
                                                                    <td width="30%"><input type="date" name="tri_acr_deadline" value="{{ $sample->tri_acr_deadline }}" class="form-control form-control-sm"></td>
                                                                    <th width="20%"></th>
                                                                    <td width="30%"></td>
                                                                </tr>
                                                                <tr>
                                                                    <th width="20%"><label class="form-label">Remarks / Ins.</label></th>
                                                                    <td colspan="3"><textarea name="remarks" class="form-control form-control-sm" rows="2">{{ $sample->remarks }}</textarea></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary btn-sm">Update Sample Programme</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
        </div>
    </div>
</div>
@endsection
