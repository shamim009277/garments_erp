@extends('layouts.app')
@section('title', 'ORDER MANAGEMENT')
@section('content')
    <div class="row">
         <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'ORDER MANAGEMENT',
                'subtitle' => 'Boms',
                'breadcrumbs' => [
                    ['label' => 'ORDER MANAGEMENT', 'url' => route('ordermanagement.index')],
                    ['label' => 'Database', 'url' => route('ordermanagement.index')],
                    ['label' => 'Boms', 'url' => route('ordermanagement.database.boms.index')],
                ],
            ])
        </div>
        <div class="col-12 mb-3">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                <!-- Centered Title -->
                <h4 class="text-center flex-grow-1 order-1 order-md-0 mb-2 mb-md-0">
                    Bom
                </h4>

                <!-- Search Input + Button in One Line -->
                <form action="#" method="POST" class="d-flex order-0 order-md-1 mb-2 mb-md-0 me-md-2"
                    style="max-width: 400px;" role="search">
                    @csrf
                    <input class="form-control form-control-sm me-2" type="search" name="search"
                        placeholder="Order No ..." aria-label="Search">
                    <button class="btn btn-sm btn-primary d-flex align-items-center" type="submit"><i data-feather="search"
                            width="14" height="14" class="me-1"></i> Search</button>
                </form>
                @if (1)
                    <!-- Back Button -->
                    <a href="{{ route('ordermanagement.database.boms.index') }}"
                        class="btn btn-sm btn-info d-flex align-items-center order-2 order-md-2">
                        <i data-feather="arrow-left" width="14" height="14" class="me-1"></i> Back
                    </a>
                @endif
            </div>
        </div>

        <div class="col-lg-2 pe-lg-0">
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
                                                <a href="{{ route('ordermanagement.database.boms.show', $order->id) }}">
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
        <div class="col-md-10">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    <h6 class="my-0 text-primary">
                        <i data-feather="list" width="16" height="16"></i> BOM Setup List For : {{ $buyerId->buyer_name }}
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-4 ms-auto">
                            <input type="text" id="bom-items-search" class="form-control form-control-sm"
                                placeholder="Search items...">
                        </div>
                    </div>
                     <form action="{{ route('ordermanagement.database.boms.update', $order->id) }}" method="POST">
                            @csrf
                            @method('POST')
                    <div style="height: 400px; overflow-y: auto;">
                   
                        <table id="bom-items-table" class="table nowrap w-100" >
                        <thead>
                            <tr>
                                <th style="width: 2%;">#</th>
                                <th style="width: 8%;">Item</th>
                                <th style="width: 5%;">Cons</th>
                                <th style="width: 5%;">Cons (PCS)</th>
                                <th style="width: 14%;">Cons Unit</th>
                                <th style="width: 5%;">Con Ratio</th>
                                <th style="width: 14%;">Pur Unit</th>
                                <th style="width: 5%;">Extra (%)</th>
                                <th style="width: 16%;">Supplier</th>
                                <th style="width: 14%;">Breakdown</th>
                                <th style="width: 14%;">Remarks</th>
                            </tr>
                        </thead>
                        <tbody >
                            @foreach ($items as $key => $item)
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" style="display: block;" type="checkbox" name="item_ids[]" value="{{ $item->id }}">
                                        </div>
                                    </td>
                                    <td>{{ $item->item_name }}</td>
                                    <td><input type="text" name="consumption[{{ $item->id }}]" class="form-control form-control-sm" required></td>
                                    <td><input type="text" name="consumption_pcs[{{ $item->id }}]" class="form-control form-control-sm" required></td>
                                   <td> <x-select-search-input name="consumption_unit_id" required
                                                :options="$units->pluck('name', 'id')" 
                                                :selected="old('consumption_unit_id')"  /></td>
                                    <td><input type="text" name="convert_ratio[{{ $item->id }}]" class="form-control form-control-sm" required></td>

                                    <td> <x-select-search-input name="unit_id" required
                                                :options="$units->pluck('name', 'id')" 
                                                :selected="old('unit_id')" /></td>
                                    <td><input type="text" name="extra[{{ $item->id }}]" class="form-control form-control-sm" required></td>
                                    <td> <x-select-search-input name="supplier_id" required
                                                :options="$suppliers->pluck('name', 'id')" 
                                                :selected="old('supplier_id')"  /></td>
                                    <td> <x-select-search-input name="breakdown_id" required
                                                :options="[1=>'All',2=>'Color',3=>'Size',4=>'Color & Size']" 
                                                :selected="old('breakdown_id')"  /></td>
                                    <td><textarea name="remarks[{{ $item->id }}]" class="form-control form-control-sm"></textarea></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary btn-sm">Update BOM</button>
                    </div>
                    </form>

                </div>
            </div>
        </div>


    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var searchInput = document.getElementById('bom-items-search');
            var table = document.getElementById('bom-items-table');

            if (!searchInput || !table) {
                return;
            }

            searchInput.addEventListener('keyup', function () {
                var value = this.value.toLowerCase();
                var rows = table.querySelectorAll('tbody tr');

                rows.forEach(function (row) {
                    var text = row.textContent.toLowerCase();
                    row.style.display = text.indexOf(value) > -1 ? '' : 'none';
                });
            });
        });
    </script>
@endsection
