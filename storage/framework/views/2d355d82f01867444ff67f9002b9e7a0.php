
<?php $__env->startSection('title', 'Order Management'); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <?php echo $__env->make('components.breadcrumb', [
                'title' => 'Order Management',
                'subtitle' => 'Initial Order Details',
                'breadcrumbs' => [
                    ['label' => 'Order Management', 'url' => route('ordermanagement.index')],
                    ['label' => 'Database', 'url' => route('ordermanagement.index')],
                    ['label' => 'Initial Orders', 'url' => route('ordermanagement.database.initialorders.index')],
                    ['label' => 'Details', 'url' => '#'],
                ],
            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
        <div class="col-12">
            <div class="card alert-success alert-top-border">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-9">
                            <h6 class="my-0 text-primary"> <i class="mdi mdi-eye"></i> Initial Order Details: <?php echo e($order->order_code); ?>

                            </h6>
                        </div>
                        <div class="col-md-3">
                            <a href="<?php echo e(route('ordermanagement.database.initialorders.edit', $order->id)); ?>" 
                               class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a type="button" class="btn btn-sm btn-info" href="<?php echo e(route('ordermanagement.database.intitialorders.pdf', $order->id)); ?>" target="_blank" id="printBtn">
                                <i data-feather="printer" width="14" height="14"></i> Print
                            </a>
                            <form action="<?php echo e(route('ordermanagement.database.initialorders.destroy', $order->id)); ?>" 
                                    method="POST" class="d-inline">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-sm btn-danger" 
                                        onclick="return confirm('Are you sure you want to delete this order?')" 
                                        title="Delete">
                                    <i class="fas fa-trash"></i>DELETE
                                </button>
                            </form>
                            <a href="<?php echo e(route('ordermanagement.database.initialorders.index')); ?>" 
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
                                    <td><?php echo e($order->order_code); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Buyer:</strong></td>
                                    <td><?php echo e($order->buyer->buyer_name ?? 'N/A'); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Organization:</strong></td>
                                    <td><?php echo e($order->organization->name ?? 'N/A'); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Order Quantity:</strong></td>
                                    <td><?php echo e($order->order_quantity ?? 'N/A'); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Style:</strong></td>
                                    <td><?php echo e($order->style ?? 'N/A'); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>PO:</strong></td>
                                    <td><?php echo e($order->po ?? 'N/A'); ?></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-primary">Technical Details</h6>
                            <table class="table table-sm">
                                <tr>
                                    <td width="30%"><strong>GSM:</strong></td>
                                    <td><?php echo e($order->gsm ?? 'N/A'); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Season:</strong></td>
                                    <td><?php echo e($order->seasson ?? 'N/A'); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Fabrication:</strong></td>
                                    <td><?php echo e($order->fabrication ?? 'N/A'); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Finish Type:</strong></td>
                                    <td><?php echo e($order->finish_type ?? 'N/A'); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Color:</strong></td>
                                    <td>
                                        <?php
                                            $colorList = $order->colors->pluck('color_code')->filter()->implode(', ');
                                        ?>
                                        <?php echo e($colorList ?: 'N/A'); ?>

                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Size:</strong></td>
                                    <td>
                                        <?php
                                            $sizeList = $order->sizes->pluck('size_name')->filter()->implode(', ');
                                        ?>
                                        <?php echo e($sizeList ?: 'N/A'); ?>

                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-primary">Order Details</h6>
                            <table class="table table-sm">
                                <tr>
                                    <td width="30%"><strong>Order Type:</strong></td>
                                    <td><?php echo e($order->orderType->order_type ?? 'N/A'); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Merchant:</strong></td>
                                    <td><?php echo e($order->merchant->name ?? 'N/A'); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Yarn Count:</strong></td>
                                    <td><?php echo e($order->yarnCount->yarn_count_name ?? 'N/A'); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Product Category:</strong></td>
                                    <td><?php echo e($order->productCategory->product_category_name ?? 'N/A'); ?></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-primary">Additional Information</h6>
                            <table class="table table-sm">
                                <tr>
                                    <td width="30%"><strong>Description:</strong></td>
                                    <td><?php echo e($order->description ?? 'N/A'); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Instructions:</strong></td>
                                    <td><?php echo e($order->instructions ?? 'N/A'); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>File:</strong></td>
                                    <td>
                                        <?php if($order->file): ?>
                                            <a href="<?php echo e(asset($order->file)); ?>" target="_blank">View File</a>
                                            <?php
                                                $extension = pathinfo($order->file, PATHINFO_EXTENSION);
                                            ?>
                                            <?php if(in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif'])): ?>
                                                <br>
                                                <img src="<?php echo e(asset($order->file)); ?>" alt="Order File" style="max-width: 200px; margin-top: 10px;">
                                            <?php endif; ?>
                                        <?php else: ?>
                                            N/A
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Created At:</strong></td>
                                    <td><?php echo e($order->created_at->format('d M Y H:i')); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Updated At:</strong></td>
                                    <td><?php echo e($order->updated_at->format('d M Y H:i')); ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH H:\laragon\www\garments_erp\Modules/OrderManagement\resources/views/database/initialorders/show.blade.php ENDPATH**/ ?>