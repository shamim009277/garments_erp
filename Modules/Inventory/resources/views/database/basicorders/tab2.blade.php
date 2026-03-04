<div class="row g-3">
    <div class="col-lg-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-transparent border-bottom">
                <h6 class="my-0 text-primary"> <i data-feather="list" width="18" height="18"></i> Assigned Shipment
                    Schedule
                    {!! $basicorder->order_no !!} | Order Quantity: {{ $basicorder->order_quantity }}</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('inventory.database.basicorders.lots.store', $basicorder->id) }}">
                    @csrf
                    <input type="hidden" name="order_id" value="{{ $basicorder->id }}">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Lots</label>
                                <div id="lotsContainer">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="mb-3">
                                                <label class="form-label">Lot No.</label>
                                                <input type="text" class="form-control" name="lots[0][lot_no]"
                                                    placeholder="Lot No." required>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="mb-3">
                                                <label class="form-label">PO No.</label>
                                                <input type="text" class="form-control" name="lots[0][po_no]"
                                                    placeholder="PO No.">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-2">
                                            <div class="mb-3">
                                                <label class="form-label">Shipping Date</label>
                                                <input type="date" class="form-control" name="lots[0][shipping_date]"
                                                    placeholder="Shipping Date">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="mb-3">
                                                <label class="form-label">Expected Shipping Date</label>
                                                <input type="date" class="form-control"
                                                    name="lots[0][expected_shipping_date]"
                                                    placeholder="Expected Shipping Date">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-2">
                                            <div class="mb-3">
                                                <label class="form-label">Lot Quantity</label>
                                                <input type="number" class="form-control" name="lots[0][lot_quantity]"
                                                    placeholder="Lot Quantity">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="mb-3">
                                                <label class="form-label">Lot Remarks</label>
                                                <input type="text" class="form-control" name="lots[0][lot_remarks]"
                                                    placeholder="Lot Remarks">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
                @if ($lots->count() > 0)
                    @foreach ($lots as $lot)
                        <div class="col-md-12 mt-3 mb-3">
                            <div class="mb-3">
                                <label class="form-label">Lots {{ $loop->index + 1 }}</label>
                                <div id="lotsContainer">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="mb-3">
                                                <label class="form-label">Lot No.</label>
                                                <input type="text" class="form-control"
                                                    name="lots[{{ $loop->index }}][lot_no]" placeholder="Lot No."
                                                    required value="{{ $lot->lot_no }}">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="mb-3">
                                                <label class="form-label">PO No.</label>
                                                <input type="text" class="form-control"
                                                    name="lots[{{ $loop->index }}][po_no]" placeholder="PO No."
                                                    value="{{ $lot->po_no }}">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="mb-3">
                                                <label class="form-label">Lot Quantity</label>
                                                <input type="number" class="form-control"
                                                    name="lots[{{ $loop->index }}][lot_quantity]"
                                                    placeholder="Lot Quantity" value="{{ $lot->lot_quantity }}">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="mb-3">
                                                <label class="form-label">Shipping Date</label>
                                                <input type="date" class="form-control"
                                                    name="lots[{{ $loop->index }}][shipping_date]"
                                                    placeholder="Shipping Date" value="{{ $lot->shipping_date }}">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="mb-3">
                                                <label class="form-label">Expected Shipping Date</label>
                                                <input type="date" class="form-control"
                                                    name="lots[{{ $loop->index }}][expected_shipping_date]"
                                                    placeholder="Expected Shipping Date"
                                                    value="{{ $lot->expected_shipping_date }}">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="example-text-input">Action</label>
                                            <div class="mb-3">
                                                <div class="d-flex gap-2">
                                                    <a href="#"
                                                        class="btn btn-soft-success waves-effect waves-light "
                                                        style="padding: 4px 6px;" data-bs-toggle="modal"
                                                        data-bs-target="#editModal{{ $lot->id }}"><i
                                                            class="fas fa-edit"></i></a>

                                                    <a href="#"
                                                        class="btn btn-soft-danger waves-effect waves-light delete-lot"
                                                        data-id="{{ $lot->id }}" style="padding: 4px 6px;"><i
                                                            class="fas fa-trash"></i></a>
                                                </div>
                                            </div>
                                            {{-- load edit modal --}}
                                            <div class="modal fade" id="editModal{{ $lot->id }}" tabindex="-1"
                                                aria-labelledby="editModalLabel{{ $lot->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="editModalLabel{{ $lot->id }}">Edit
                                                                Lot</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form id="moduleForm"
                                                                action="{{ route('inventory.database.basicorders.update_lots', $lot->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('POST')

                                                                <x-input-group name="lot_no" label="Lot No."
                                                                    :value="$lot->lot_no" required />
                                                                <x-input-group name="po_no"  label="PO No."
                                                                    :value="$lot->po_no" required />
                                                                <x-input-group name="lot_quantity"
                                                                    label="Lot Quantity" type="number" :value="$lot->lot_quantity" required />
                                                                <x-input-group name="shipping_date"
                                                                    label="Shipping Date" type="date" :value="$lot->shipping_date" required />
                                                                <x-input-group name="expected_shipping_date"
                                                                    label="Expected Shipping Date" type="date" :value="$lot->expected_shipping_date"
                                                                    required />
                                                                <x-primary-button
                                                                    class="float-start btn-sm submitBtn">Update</x-primary-button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('#removeLots').click(function() {
            $(this).closest('.col-md-12').remove();
        });
    });
</script>

