@extends('layouts.app')
@section('title', 'Order Management')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'Order Management',
                'subtitle' => 'Initial Order Details',
                'breadcrumbs' => [
                    ['label' => 'Order Management', 'url' => route('ordermanagement.index')],
                    ['label' => 'Database', 'url' => route('ordermanagement.index')],
                    ['label' => 'Initial Orders', 'url' => route('ordermanagement.database.initialorders.index')],
                    ['label' => 'Details', 'url' => '#'],
                ],
            ])
        </div>
        <div class="col-12">
            <div class="card alert-success alert-top-border">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-9">
                            <h6 class="my-0 text-primary"> <i class="mdi mdi-eye"></i> Initial Order Details: {{ $order->order_code }}
                            </h6>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('ordermanagement.database.initialorders.edit', $order->id) }}" 
                               class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a type="button" class="btn btn-sm btn-info" href="{{ route('ordermanagement.database.intitialorders.pdf', $order->id) }}" target="_blank" id="printBtn">
                                <i data-feather="printer" width="14" height="14"></i> Print
                            </a>
                            <form action="{{ route('ordermanagement.database.initialorders.destroy', $order->id) }}" 
                                    method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" 
                                        onclick="return confirm('Are you sure you want to delete this order?')" 
                                        title="Delete">
                                    <i class="fas fa-trash"></i>DELETE
                                </button>
                            </form>
                            <a href="{{ route('ordermanagement.database.initialorders.index') }}" 
                               class="btn btn-sm btn-secondary">
                                <i class="fas fa-arrow-left"></i> Back to List
                            </a>
                        </div>

                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
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
                        <div class="col-md-6">
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
                                            $colorList = $order->colors->pluck('color_code')->filter()->implode(', ');
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
                        <div class="col-md-6">
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
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-primary">Additional Information</h6>
                            <table class="table table-sm">
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
                                            @php
                                                $extension = pathinfo($order->file, PATHINFO_EXTENSION);
                                            @endphp
                                            @if(in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif']))
                                                <br>
                                                <img src="{{ asset($order->file) }}" alt="Order File" style="max-width: 200px; margin-top: 10px;">
                                            @endif
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Created At:</strong></td>
                                    <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Updated At:</strong></td>
                                    <td>{{ $order->updated_at->format('d M Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
