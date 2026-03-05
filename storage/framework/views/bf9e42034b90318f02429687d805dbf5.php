
<?php $__env->startSection('title', 'Order Management'); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <?php echo $__env->make('components.breadcrumb', [
                'title' => 'Order Management',
                'subtitle' => 'Team Member Details',
                'breadcrumbs' => [
                    ['label' => 'Order Management', 'url' => route('ordermanagement.index')],
                    ['label' => 'Setup', 'url' => route('ordermanagement.index')],
                    ['label' => 'Team Members', 'url' => route('ordermanagement.setup.teammembers.index')],
                    ['label' => 'Details', 'url' => '#'],
                ],
            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
        <div class="col-12">
            <div class="card alert-success alert-top-border">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i class="mdi mdi-eye"></i> Team Member Details
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="text-primary">Basic Information</h6>
                            <table class="table table-sm">
                                <tr>
                                    <td width="30%"><strong>Team:</strong></td>
                                    <td><?php echo e($teamMember->team->team_name ?? 'N/A'); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Merchant:</strong></td>
                                    <td><?php echo e($teamMember->merchant->name ?? 'N/A'); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Is Leader:</strong></td>
                                    <td>
                                        <span class="badge bg-<?php echo e($teamMember->is_leader ? 'success' : 'secondary'); ?>">
                                            <?php echo e($teamMember->is_leader ? 'Yes' : 'No'); ?>

                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Is Assistant:</strong></td>
                                    <td>
                                        <span class="badge bg-<?php echo e($teamMember->is_assistant ? 'info' : 'secondary'); ?>">
                                            <?php echo e($teamMember->is_assistant ? 'Yes' : 'No'); ?>

                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Status:</strong></td>
                                    <td>
                                        <span class="badge bg-<?php echo e($teamMember->is_active ? 'success' : 'danger'); ?>">
                                            <?php echo e($teamMember->is_active ? 'Active' : 'Inactive'); ?>

                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-primary">System Information</h6>
                            <table class="table table-sm">
                                <tr>
                                    <td width="30%"><strong>Created At:</strong></td>
                                    <td><?php echo e($teamMember->created_at->format('d M Y H:i')); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Updated At:</strong></td>
                                    <td><?php echo e($teamMember->updated_at->format('d M Y H:i')); ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <a href="<?php echo e(route('ordermanagement.setup.teammembers.edit', $teamMember->id)); ?>" 
                               class="btn btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="<?php echo e(route('ordermanagement.setup.teammembers.index')); ?>" 
                               class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Back to List
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\garments_erp\Modules\OrderManagement\resources\views\setup\teammembers\show.blade.php ENDPATH**/ ?>