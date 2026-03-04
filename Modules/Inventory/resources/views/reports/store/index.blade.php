@extends('layouts.app')
@section('title', 'INVENTORY')
@section('content')

@push('styles')
    <style>
        input[type="checkbox"] {
            display: inline-block !important;
            opacity: 1 !important;
        }

        .collapse {
            display: none;
            margin-left: 35px;
        }

        .toggle-btn {
            cursor: pointer;
            color: #5156be;
            margin-left: 5px;
        }
        .parent-label {
            font-weight: bold;
        }

        .disabled-select {
            cursor: not-allowed !important;
            background-color: #dad9d9 !important;
        }
        .form-check-input:checked:disabled {
            background-color: #b7bbf5 !important;
            border: 1px solid #b7bbf5 !important;
        }
    </style>
@endpush
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'INVENTORY',
                'subtitle' => 'Store Reports',
                'breadcrumbs' => [
                    ['label' => 'INVENTORY', 'url' => route('inventory.index')],
                    ['label' => 'Reports', 'url' => route('inventory.index')],
                    ['label' => 'Store Reports', 'url' => route('inventory.reports.store.index')],
                ],
            ])
        </div>
         <div class="col-lg-12 pr-0">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Store Report
                    </h6>
                </div>
                <form id="storeReportForm" action="{{ route('inventory.reports.store.index') }}" method="POST" target="_blank">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <!-- Titles -->
                            <div class="col-lg-3 mb-3 pe-lg-0">
                                <div class="card alert-info alert-top-border">
                                    <div class="card-header">
                                        <h6 class="my-0 text-primary"> <i data-feather="list" width="16"height="16"></i>Preview Title's</h6>
                                    </div>
                                    <div class="card-body" style="max-height:450px;min-height:450px; overflow-y: auto;">
                                        <div class="form-check">
                                            <input type="radio" id="title1" name="title" value="1"class="form-check-input titles" checked>
                                            <label class="form-check-label" for="title1">Organization Wise Stock Report</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" id="title2" name="title" value="2"class="form-check-input titles">
                                            <label class="form-check-label" for="title2">Store Location Wise Stock Report</label>
                                        </div>

                                        <div class="form-check">
                                            <input type="radio" id="title3" name="title" value="3"class="form-check-input titles">
                                            <label class="form-check-label" for="title3">Organization & Store Location Wise Stock Report</label>
                                        </div>

                                        <div class="form-check">
                                            <input type="radio" id="title4" name="title" value="4"class="form-check-input titles">
                                            <label class="form-check-label" for="title4">Category Wise Stock Report</label>
                                        </div>

                                        <div class="form-check">
                                            <input type="radio" id="title5" name="title" value="5"class="form-check-input titles">
                                            <label class="form-check-label" for="title5">Sub Category Wise Stock Report</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 mb-3 pe-lg-0">
                                <div class="card alert-info alert-top-border">
                                    <div class="card-header">
                                        <h6 class="my-0 text-primary"> <i data-feather="list" width="16"height="16"></i> Organizations</h6>
                                    </div>
                                    <div class="card-body" style="max-height:400px;min-height:400px; overflow-y: auto;">
                                        <!-- Sample departments -->
                                        <div class="department-list">
                                            <!-- Parent 1 -->
                                           @foreach ($organizations as $items)
                                            <label><input type="checkbox" class="form-check-input child-of-{{ $items->id }} departmentID" name="organization_id[]" value="{{ $items->id }}"> {{ $items->name }}</label><br>
                                            @endforeach
                                                
                                        </div>
                                    </div>
                                    <div class="card-footer" style="padding:10px 15px;">
                                        <button type="button" class="btn btn-sm btn-outline-primary" id="check_all">Check All</button>
                                        <button type="button" class="btn btn-sm btn-outline-danger" id="uncheck_all">Uncheck All</button>
                                    </div>
                                </div>

                            </div>

                            <div class="col-lg-3 mb-3 pe-lg-0">
                                <div class="card alert-info alert-top-border">
                                    <div class="card-header">
                                        <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Store Locations</h6>
                                    </div>
                                    <div class="card-body" style="max-height:400px;min-height:400px; overflow-y: auto;">
                                        @foreach ($store_locations as $store_location)
                                            <div class="form-check">
                                                <input type="checkbox" name="store_location_id[]" class="form-check-input store_locationID" id="store_location{{ $store_location->id }}" value="{{ $store_location->id }}">
                                                <label class="form-check-label" for="store_location{{ $store_location->id }}">{{ $store_location->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="card-footer" style="padding:10px 15px;">
                                        <button type="button" class="btn btn-sm btn-outline-primary" id="check_all2">Check All</button>
                                        <button type="button" class="btn btn-sm btn-outline-danger" id="uncheck_all2">Uncheck All</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Department & Designation -->
                            <div class="col-lg-3 mb-3 pe-lg-0">
                                <div class="card alert-info alert-top-border">
                                    <div class="card-body" style="max-height:460px;min-height:460px; overflow-y: auto;">
                                        <table class="table table-sm" width="100%">
                                            <tbody>
                                               
                                                <tr>
                                                    <th>Start Date</th>
                                                    <td width="60%">
                                                        <x-text-input name="start_date[]" type="date" id="start_date" class="form-control-sm" value="{{ old('start_date', $startDate) }}" placeholder="Start Date"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th width="40%">End Date</th>
                                                    <td width="60%">
                                                        <x-text-input name="end_date[]" type="date" id="end_date" class="form-control-sm" value="{{ old('end_date', $endDate) }}" placeholder="End Date" />
                                                    </td>
                                                </tr>
                                                 <tr>
                                                    <th width="40%">Categories</th>
                                                    <td width="60%">
                                                        <x-select-input name="category_id" id="category_id" class="select2" :options="$goodsCategories" selected="{{ old('category_id', 1) }}" placeholder="Select Category" />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th width="40%">Sub Categories</th>
                                                    <td width="60%">
                                                        <x-select-input name="sub_category_id" id="sub_category_id" class="select2" :options="$goodsSubcategories" selected="{{ old('sub_category_id', 1) }}" placeholder="Select Sub Category" />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th width="40%">View Mode</th>
                                                    <td width="60%">
                                                        <x-select-input name="view_mode" id="view_mode" class="select2" :options="['1' => 'Normal View', '2' => 'PDF View']" selected="{{ old('view_mode', 1) }}" placeholder="View Mode" />
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="card-footer" style="padding:10px 15px;">
                                        <button type="submit" class="btn btn-sm btn-primary float-end">Preview</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    
@endpush
