@extends('layouts.app')
@section('title', 'ORDER MANAGEMENT')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'ORDER MANAGEMENT',
                'subtitle' => 'BOM Setup',
                'breadcrumbs' => [
                    ['label' => 'ORDER MANAGEMENT', 'url' => route('ordermanagement.index')],
                    ['label' => 'Setup', 'url' => route('ordermanagement.index')],
                    ['label' => 'BOM Setup', 'url' => route('ordermanagement.setup.bomsetups.index')],
                ],
            ])
        </div>
        
         <div class="col-md-3">
            <div class="card alert-info alert-top-border">
                <div class="card-header">
                    <h6 class="my-0 text-primary">
                        <i class="mdi mdi-list"></i> Input Parameters For New BOM Setup ...
                    </h6>
                </div>
               
                <div class="card-body">
                    <form action="{{ route('ordermanagement.setup.bomsetups.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label">Item</label>
                                <input type="hidden" name="buyer_id" value="{{ $buyerId->id }}">
                                 <x-select-search-input name="item_id" required
                                                :options="$items->pluck('item_name', 'id')" 
                                                :selected="old('item_id')" />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Consumption</label>
                                <input type="number" step="0.0001" name="consumption" class="form-control"
                                    value="{{ old('consumption') }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Consumption (PCS)</label>
                                <input type="number" step="0.0001" name="consumption_pcs" class="form-control"
                                    value="{{ old('consumption_pcs') }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Convert Ratio</label>
                                <input type="number" step="0.0001" name="convert_ratio" class="form-control"
                                    value="{{ old('convert_ratio') }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Consumption Unit</label>
                                <x-select-search-input name="consumption_unit_id" required
                                                :options="$units->pluck('name', 'id')" 
                                                :selected="old('consumption_unit_id')" />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Purchase Unit</label>
                                 <x-select-search-input name="unit_id" required
                                                :options="$units->pluck('name', 'id')" 
                                                :selected="old('unit_id')" />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Extra</label>
                                <input type="number" step="0.01" name="extra" class="form-control"
                                    value="{{ old('extra') }}">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Supplier</label>
                                
                                 <x-select-search-input name="supplier_id" required
                                                :options="$suppliers->pluck('name', 'id')" 
                                                :selected="old('supplier_id')" />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Breakdown ID</label>
                                 <x-select-search-input name="breakdown_id" required
                                                :options="[1=>'All',2=>'Color',3=>'Size',4=>'Color & Size']" 
                                                :selected="old('breakdown_id')" />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Create Date</label>
                                <input type="date" name="create_date" class="form-control"
                                    value="{{ date('Y-m-d') }}" disabled>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Remarks</label>
                                <textarea name="remarks" class="form-control" rows="2">{{ old('remarks') }}</textarea>
                            </div>
                        </div>
                        <div class="mt-3">
                            <x-primary-button class="float-start btn-sm submitBtn">Save</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    <h6 class="my-0 text-primary">
                        <i data-feather="list" width="16" height="16"></i> BOM Setup List For : {{ $buyerId->buyer_name }}
                    </h6>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Item</th>
                                <th>Consumption</th>
                                <th>Consumption (PCS)</th>
                                <th>Convert Ratio</th>
                                <th>Consumption Unit</th>
                                <th>Unit</th>
                                <th>Extra</th>
                                <th>Supplier</th>
                                <th>Breakdown</th>
                                <th>Remarks</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($boms as $key => $bom)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ optional($bom->item)->item_name }}</td>
                                    <td>{{ $bom->consumption }}</td>
                                    <td>{{ $bom->consumption_pcs }}</td>
                                    <td>{{ $bom->convert_ratio }}</td>
                                    <td>{{ optional($bom->consumptionUnit)->name }}</td>
                                    <td>{{ optional($bom->unit)->name }}</td>
                                    <td>{{ $bom->extra }}</td>
                                    <td>{{ optional($bom->supplier)->name }}</td>
                                    <td>{{ $bom->breakdown_id }}</td>
                                    <td>{{ $bom->remarks }}</td>
                                    <td>
                                        <a href="#"
                                            class="btn btn-soft-success waves-effect waves-light"
                                            style="padding: 4px 6px;"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $bom->id }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('ordermanagement.setup.bomsetups.destroy', $bom->id) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this BOM setup?')">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                <div class="modal fade" id="editModal{{ $bom->id }}" tabindex="-1"
                                    aria-labelledby="editModalLabel{{ $bom->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel{{ $bom->id }}">Edit BOM Setup</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('ordermanagement.setup.bomsetups.update', $bom->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="row g-3">
                                                        <div class="col-md-4">
                                                            <label class="form-label">Buyer</label>
                                                            <select name="buyer_id" class="form-select">
                                                                <option value="">Select Buyer</option>
                                                                @foreach ($buyers as $buyer)
                                                                    <option value="{{ $buyer->id }}"
                                                                        {{ $bom->buyer_id == $buyer->id ? 'selected' : '' }}>
                                                                        {{ $buyer->buyer_name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">Organization</label>
                                                            <select name="organization_id" class="form-select">
                                                                <option value="">Select Organization</option>
                                                                @foreach ($organizations as $organization)
                                                                    <option value="{{ $organization->id }}"
                                                                        {{ $bom->organization_id == $organization->id ? 'selected' : '' }}>
                                                                        {{ $organization->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">Item</label>
                                                            <select name="item_id" class="form-select">
                                                                <option value="">Select Item</option>
                                                                @foreach ($items as $item)
                                                                    <option value="{{ $item->id }}"
                                                                        {{ $bom->item_id == $item->id ? 'selected' : '' }}>
                                                                        {{ $item->item_name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">Consumption</label>
                                                            <input type="number" step="0.0001" name="consumption"
                                                                class="form-control"
                                                                value="{{ $bom->consumption }}">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">Consumption (PCS)</label>
                                                            <input type="number" step="0.0001" name="consumption_pcs"
                                                                class="form-control"
                                                                value="{{ $bom->consumption_pcs }}">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">Convert Ratio</label>
                                                            <input type="number" step="0.0001" name="convert_ratio"
                                                                class="form-control"
                                                                value="{{ $bom->convert_ratio }}">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">Consumption Unit</label>
                                                            <select name="consumption_unit_id" class="form-select">
                                                                <option value="">Select Unit</option>
                                                                @foreach ($units as $unit)
                                                                    <option value="{{ $unit->id }}"
                                                                        {{ $bom->consumption_unit_id == $unit->id ? 'selected' : '' }}>
                                                                        {{ $unit->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">Unit</label>
                                                            <select name="unit_id" class="form-select">
                                                                <option value="">Select Unit</option>
                                                                @foreach ($units as $unit)
                                                                    <option value="{{ $unit->id }}"
                                                                        {{ $bom->unit_id == $unit->id ? 'selected' : '' }}>
                                                                        {{ $unit->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">Extra</label>
                                                            <input type="number" step="0.01" name="extra"
                                                                class="form-control"
                                                                value="{{ $bom->extra }}">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">Supplier</label>
                                                            <select name="supplier_id" class="form-select">
                                                                <option value="">Select Supplier</option>
                                                                @foreach ($suppliers as $supplier)
                                                                    <option value="{{ $supplier->id }}"
                                                                        {{ $bom->supplier_id == $supplier->id ? 'selected' : '' }}>
                                                                        {{ $supplier->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">Breakdown ID</label>
                                                            <input type="number" name="breakdown_id" class="form-control"
                                                                value="{{ $bom->breakdown_id }}">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">Create Date</label>
                                                            <input type="date" name="create_date" class="form-control"
                                                                value="{{ $bom->create_date }}">
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label class="form-label">Remarks</label>
                                                            <textarea name="remarks" class="form-control" rows="2">{{ $bom->remarks }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="mt-3">
                                                        <x-primary-button class="btn-sm submitBtn">Save</x-primary-button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

       
    </div>
@endsection
