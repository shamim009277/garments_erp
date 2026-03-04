<?php $__env->startSection('title', 'Sample Delivery Details'); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-12">
        <?php echo $__env->make('components.breadcrumb', [
        'title' => 'Sample Delivery Details',
        'subtitle' => 'Sample Delivery Details',
        'breadcrumbs' => [
        ['label' => 'Sample Management', 'url' => route('sms.index')],
        ['label' => 'Database', 'url' => route('sms.index')],
        ['label' => 'Sample Delivery', 'url' => route('sms.database.sampledelivery.index')],
        ['label' => 'Details', 'url' => '#'],
        ],
        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title">Delivery Information: <?php echo e($delivery->ChallanNo); ?></h5>
                <a href="<?php echo e(route('sms.database.sampledelivery.index')); ?>" class="btn btn-secondary btn-sm">Back to List</a>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-3">
                        <strong>Date:</strong> <?php echo e($delivery->Date); ?>

                    </div>
                    <div class="col-md-3">
                        <strong>Buyer:</strong> <?php echo e($delivery->buyer->buyer_name ?? 'N/A'); ?>

                    </div>
                    <div class="col-md-3">
                        <strong>Employee:</strong> <?php echo e($delivery->employee->name ?? 'N/A'); ?>

                    </div>
                    <div class="col-md-3">
                        <strong>Challan Type:</strong>
                        <?php if($delivery->ChallanType == 1): ?> Returnable
                        <?php elseif($delivery->ChallanType == 2): ?> Non-Returnable
                        <?php elseif($delivery->ChallanType == 3): ?> Export
                        <?php endif; ?>
                    </div>
                    <div class="col-md-3">
                        <strong>Goods Type:</strong>
                        <?php if($delivery->GoodsType == 1): ?> Gray Fabric
                        <?php elseif($delivery->GoodsType == 2): ?> Complete Body
                        <?php endif; ?>
                    </div>
                    <div class="col-md-6">
                        <strong>Comments:</strong> <?php echo e($delivery->Comments); ?>

                    </div>
                </div>

                <h5>Items</h5>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Sample Programme</th>
                                <th>Style</th>
                                <th>Order Code</th>
                                <th>Color</th>
                                <th>Quantity</th>
                                <th>Comments</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $delivery->details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($detail->sampleOrderProgramme->item->product_category_name ?? 'Item'); ?></td>
                                <td><?php echo e($detail->sampleOrderProgramme->style_no ?? 'N/A'); ?></td>
                                <td><?php echo e($detail->sampleOrderProgramme->initialOrder->order_code ?? 'N/A'); ?></td>
                                <td><?php echo e($detail->Color); ?></td>
                                <td><?php echo e($detail->Quantity); ?></td>
                                <td><?php echo e($detail->Comments); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/aandg/public_html/Modules/SM/resources/views/database/sampledelivery/show.blade.php ENDPATH**/ ?>