<div class="row g-3">
    <div class="col-lg-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-transparent border-bottom">
                <h6 class="my-0 text-primary"> <i data-feather="list" width="18" height="18"></i> Assigned Shipment
                    Schedule
                    <?php echo $basicorder->order_no; ?> | Order Quantity: <?php echo e($basicorder->order_quantity); ?></h6>
            </div>
            <div class="card-body">
                <form method="POST" action="<?php echo e(route('inventory.database.basicorders.lots.store', $basicorder->id)); ?>">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="order_id" value="<?php echo e($basicorder->id); ?>">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Lots</label>
                                <div id="lotsContainer">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Lot No.</label>
                                                <input type="text" class="form-control" name="lots[0][lot_no]"
                                                    placeholder="Lot No." required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">PO No.</label>
                                                <input type="text" class="form-control" name="lots[0][po_no]"
                                                    placeholder="PO No.">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Lot Description</label>
                                                <input type="text" class="form-control"
                                                    name="lots[0][lot_description]" placeholder="Lot Description">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Shipping Date</label>
                                                <input type="date" class="form-control" name="lots[0][shipping_date]"
                                                    placeholder="Shipping Date">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Expected Shipping Date</label>
                                                <input type="date" class="form-control"
                                                    name="lots[0][expected_shipping_date]"
                                                    placeholder="Expected Shipping Date">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Actual Shipping Date</label>
                                                <input type="date" class="form-control"
                                                    name="lots[0][actual_shipping_date]"
                                                    placeholder="Actual Shipping Date">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Lot Quantity</label>
                                                <input type="number" class="form-control" name="lots[0][lot_quantity]"
                                                    placeholder="Lot Quantity">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Lot Remarks</label>
                                                <input type="text" class="form-control" name="lots[0][lot_remarks]"
                                                    placeholder="Lot Remarks">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary" id="addMoreLots">Add More Lots</button>
                                <button type="button" class="btn btn-danger" id="removeLots">Remove Lots</button>
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
                <?php if($lots->count() > 0): ?>
                    <?php $__currentLoopData = $lots; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-12 mt-3 mb-3">
                            <div class="mb-3">
                                <label class="form-label">Lots <?php echo e($loop->index + 1); ?></label>
                                <div id="lotsContainer">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="mb-3">
                                                <label class="form-label">Lot No.</label>
                                                <input type="text" class="form-control"
                                                    name="lots[<?php echo e($loop->index); ?>][lot_no]" placeholder="Lot No."
                                                    required value="<?php echo e($lot->lot_no); ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="mb-3">
                                                <label class="form-label">PO No.</label>
                                                <input type="text" class="form-control"
                                                    name="lots[<?php echo e($loop->index); ?>][po_no]" placeholder="PO No."
                                                    value="<?php echo e($lot->po_no); ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="mb-3">
                                                <label class="form-label">Lot Quantity</label>
                                                <input type="number" class="form-control"
                                                    name="lots[<?php echo e($loop->index); ?>][lot_quantity]"
                                                    placeholder="Lot Quantity" value="<?php echo e($lot->lot_quantity); ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="mb-3">
                                                <label class="form-label">Shipping Date</label>
                                                <input type="date" class="form-control"
                                                    name="lots[<?php echo e($loop->index); ?>][shipping_date]"
                                                    placeholder="Shipping Date" value="<?php echo e($lot->shipping_date); ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="mb-3">
                                                <label class="form-label">Expected Shipping Date</label>
                                                <input type="date" class="form-control"
                                                    name="lots[<?php echo e($loop->index); ?>][expected_shipping_date]"
                                                    placeholder="Expected Shipping Date"
                                                    value="<?php echo e($lot->expected_shipping_date); ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="mb-3">
                                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#basicOrderLot_<?php echo e($lot->id); ?>">
                                                    Edit
                                                </button>
                                                <form action="#" method="POST">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>


                                        <div class="modal fade" id="basicOrderLot_<?php echo e($lot->id); ?>"
                                            tabindex="-1" role="dialog"
                                            aria-labelledby="basicOrderLot_<?php echo e($lot->id); ?>Label"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="basicOrderLot_<?php echo e($lot->id); ?>Label">Edit Lot</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="#" method="POST">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('PUT'); ?>
                                                            <div class="mb-3">
                                                                <label class="form-label">Lot No.</label>
                                                                <input type="text" class="form-control"
                                                                    name="lot_no" placeholder="Lot No."
                                                                    value="<?php echo e($lot->lot_no); ?>">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">PO No.</label>
                                                                <input type="text" class="form-control"
                                                                    name="po_no" placeholder="PO No."
                                                                    value="<?php echo e($lot->po_no); ?>">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Lot Quantity</label>
                                                                <input type="number" class="form-control"
                                                                    name="lot_quantity" placeholder="Lot Quantity"
                                                                    value="<?php echo e($lot->lot_quantity); ?>">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Shipping Date</label>
                                                                <input type="date" class="form-control"
                                                                    name="shipping_date" placeholder="Shipping Date"
                                                                    value="<?php echo e($lot->shipping_date); ?>">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Expected Shipping
                                                                    Date</label>
                                                                <input type="date" class="form-control"
                                                                    name="expected_shipping_date"
                                                                    placeholder="Expected Shipping Date"
                                                                    value="<?php echo e($lot->expected_shipping_date); ?>">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save
                                                                    changes</button>
                                                            </div>
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
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>


    </div>
</div>
</div>
</div>


<script></script>
<?php /**PATH D:\laragon\www\new erp\garments_erp\Modules\Inventory\resources\views\database\basicorders\tab2.blade.php ENDPATH**/ ?>