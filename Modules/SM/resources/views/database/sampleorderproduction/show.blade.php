@extends('layouts.app')
@section('title', 'Sample Management')
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
                    confirmButtonText: 'Yes, Accept it!'
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
        'title' => 'Sample Management',
        'subtitle' => 'Sample Management',
        'breadcrumbs' => [
        ['label' => 'Sample Management', 'url' => route('sms.index')],
        ['label' => 'Database', 'url' => route('sms.index')],
        ['label' => 'Sample Management', 'url' => route('sms.database.sampleorderprogramme.index')],
        ],
        ])
    </div>
    <!-- Sidebar -->
    <div class="col-md-3">
        <div class="card alert-primary alert-top-border padding-card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <i data-feather="list" width="16" height="16"></i>
                    <h6 class="my-0 text-primary ms-2">Sample Orders List</h6>
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
            <div class="card-body" style="min-height: 600px;max-height: 600px; overflow-y: auto;">
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
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($samples as $sample)
                            <tr>
                                <td>{{ $sample->fab_src }}</td>
                                <td>{{ $sample->color->color_name ?? '' }}</td>
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
                                <td>{{ $sample->size->size_name ?? '' }}</td>
                                <td>{{ $sample->delivery_deadline }}</td>
                                <td>
                                    <a href="#" class="btn btn-soft-success waves-effect waves-light" style="padding: 4px 6px;" data-bs-toggle="modal" data-bs-target="#editModal{{ $sample->id }}"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('sms.database.sampleorderprogramme.update', $sample->id) }}" method="POST" style="display:inline;" class="delete-form">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="accept_status" value="1">
                                        <button type="submit" class="btn btn-soft-info waves-effect waves-light" style="padding: 4px 6px;">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>

                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="editModal{{ $sample->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $sample->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel{{ $sample->id }}">Production Information</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('sms.database.sampleorderproduction.store') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="sample_order_programme_id" value="{{ $sample->id }}">
                                                    
                                                    <div class="modal-body text-start">
                                                        <table class="table table-bordered">
                                                            <tbody>
                                                                <tr>
                                                                    <th width="30%"><label class="form-label">Production Quantity</label></th>
                                                                    <td>
                                                                        <input type="number" step="0.01" name="production_quantity" class="form-control form-control-sm" value="{{ $sample->production->production_quantity ?? '' }}" required>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th><label class="form-label">Used Fabric Quantity</label></th>
                                                                    <td>
                                                                        <input type="number" step="0.01" name="used_fabric_quantity" class="form-control form-control-sm" value="{{ $sample->production->used_fabric_quantity ?? '' }}" required>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th><label class="form-label">Remarks</label></th>
                                                                    <td>
                                                                        <textarea name="production_notes" class="form-control form-control-sm" rows="2">{{ $sample->production->production_notes ?? '' }}</textarea>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th><label class="form-label">Programme Status</label></th>
                                                                    <td>
                                                                        <select name="current_status" class="form-control form-control-sm select2">
                                                                            <option value="">Programme Status</option>
                                                                            @foreach(['1'=>'Program Done By Merchandise','2'=>'Program Received By Sample','3'=>'Ready To Sweing','4'=>'Sweing Started','5'=>'Sweing Completed'] as $key => $item)
                                                                               @if($key >= $sample->current_status)
                                                                                    <option value="{{ $key }}" {{ $sample->current_status == $key ? 'selected' : '' }}>{{ $item }}</option>
                                                                               @else
                                                                                
                                                                                @endif
                                                                            @endforeach
                                                                        </select>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary btn-sm">Save Information</button>
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
