<?php $__env->startSection('title', 'Sample Management'); ?>
<?php $__env->startSection('styles'); ?>
<style>
    .table, tr, th, td { border: none !important; border-collapse: collapse; }
    .form-label { font-size: 0.8rem; font-weight: bold; }
    .form-control-sm { font-size: 0.8rem; }
    .btn-xs { padding: 0.1rem 0.3rem; font-size: 0.7rem; }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
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
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-12">
        <?php echo $__env->make('components.breadcrumb', [
        'title' => 'Sample Management',
        'subtitle' => 'Sample Management',
        'breadcrumbs' => [
        ['label' => 'Sample Management', 'url' => route('sms.index')],
        ['label' => 'Database', 'url' => route('sms.index')],
        ['label' => 'Sample Management', 'url' => route('sms.database.sampleorderprogramme.index')],
        ],
        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>
    <div class="col-12 mb-3">
        <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
            <!-- Centered Title -->
            <h4 class="text-center flex-grow-1 order-1 order-md-0 mb-2 mb-md-0">
                Sample Order Programme
            </h4>

            <!-- Search Input + Button in One Line -->
            <form action="#" method="POST" class="d-flex order-0 order-md-1 mb-2 mb-md-0 me-md-2"
                style="max-width: 400px;" role="search">
                <?php echo csrf_field(); ?>
                <input class="form-control form-control-sm me-2" type="search" name="search"
                    placeholder="Basic Order No ..." aria-label="Search">
                <button class="btn btn-sm btn-primary d-flex align-items-center" type="submit"><i data-feather="search"
                        width="14" height="14" class="me-1"></i> Search</button>
            </form>
            <?php if(1): ?>
            <!-- Back Button -->
            <a href="<?php echo e(route('sms.database.sampleorderprogramme.index')); ?>"
                class="btn btn-sm btn-info d-flex align-items-center order-2 order-md-2">
                <i data-feather="arrow-left" width="14" height="14" class="me-1"></i> Back
            </a>
            <?php endif; ?>
        </div>
    </div>
    <!-- Sidebar -->
    <div class="col-md-3">
        <div class="card alert-primary alert-top-border padding-card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <i data-feather="list" width="16" height="16"></i>
                    <h6 class="my-0 text-primary ms-2">Sample Orders List</h6>
                </div>
            </div>
            <?php
            $org = collect($orders)->pluck('organization');
            $orgList = collect($org)->unique();
            ?>
           <div class="card-body" style="min-height: 477px;max-height: 477px; overflow-y: auto;">
                <ul class="nav-custom">
                    <?php $__currentLoopData = $orgList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $org): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="nav-custom-item">
                        <input type="checkbox" id="company<?php echo e($org->id); ?>">
                        <label class="nav-custom-link" for="company<?php echo e($org->id); ?>">
                            <span class="nav-custom-caret"></span>
                            <?php echo e($org->name); ?>

                        </label>
                        <?php
                        $ordList = collect($orders)->where('organization_id', $org->id);
                        $buyerList = collect($ordList)->pluck('buyer')->unique();
                        ?>
                        <ul class="nav-custom-content">
                            <?php $__currentLoopData = $buyerList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $buyer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="nav-custom-item">
                                <input type="checkbox" id="buyer<?php echo e($buyer->id); ?><?php echo e($org->id); ?>">
                                <label class="nav-custom-link" for="buyer<?php echo e($buyer->id); ?><?php echo e($org->id); ?>">
                                    <span class="nav-custom-caret"></span>
                                    <?php echo e($buyer->buyer_name); ?>

                                </label>
                                <?php
                                $ordList = collect($orders)->where('organization_id', $org->id)->where('buyer_id', $buyer->id);
                                ?>
                                <div class="nav-custom-content">
                                    <?php $__currentLoopData = $ordList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a href="<?php echo e(route('sms.database.sampleorderprogramme.show', $order->id)); ?>" class="employee-link">
                                        <?php echo e($order->order_code); ?>

                                    </a>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="col-md-9">
        <div class="card alert-success alert-top-border mb-3">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-12">
                        <h6 class="my-0 text-primary"> <i class="mdi mdi-eye"></i> Initial Order Details: <?php echo e($order->order_code); ?>

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
                                        $colorList = $order->colors->pluck('color_name')->filter()->implode(', ');
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
                                <td><?php echo e($order->orderType->name ?? 'N/A'); ?></td>
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
                            <?php $__currentLoopData = $samples; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sample): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($sample->fab_src); ?></td>
                                <td>
                                    <?php
                                        $colorList = $sample->colors->pluck('color_name')->filter()->implode(', ');
                                    ?>
                                    <?php echo e($colorList ?: 'N/A'); ?>

                                </td>
                                <td><?php echo e($sample->sampleType->sample_type_name ?? ''); ?></td>
                                <td><?php echo e($sample->composition->composition_name ?? ''); ?></td>
                                <td><?php echo e($sample->trims_fabric); ?></td>
                                <td><?php echo e($sample->wash_type); ?></td>
                                <td><?php echo e($sample->style_no); ?></td>
                                <td><?php echo e($sample->item->product_category_name ?? ''); ?></td>
                                <td><?php echo e($sample->f_dia); ?></td>
                                <td><?php echo e($sample->gsm); ?></td>
                                <td><?php echo e($sample->fin_fab_kg); ?></td>
                                <td><?php echo e($sample->qty_pcs); ?></td>
                                <td><?php echo e($sample->fabricTreatment->fabric_treatment_name ?? ''); ?></td>
                                <td>
                                    <?php
                                        $sizeList = $sample->sizes->pluck('size_name')->filter()->implode(', ');
                                    ?>
                                <?php echo e($sizeList ?: 'N/A'); ?>

                                </td>
                                <td><?php echo e($sample->delivery_deadline); ?></td>
                                <td>
                                    <a href="#" class="btn btn-soft-success waves-effect waves-light" style="padding: 4px 6px;" data-bs-toggle="modal" data-bs-target="#editModal<?php echo e($sample->id); ?>"><i class="fas fa-edit"></i></a>
                                    <form action="<?php echo e(route('sms.database.sampleorderprogramme.update', $sample->id)); ?>" method="POST" style="display:inline;" class="delete-form">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PUT'); ?>
                                        <input type="hidden" name="accept_status" value="1">
                                        <button type="submit" class="btn btn-soft-info waves-effect waves-light" style="padding: 4px 6px;">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>

                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="editModal<?php echo e($sample->id); ?>" tabindex="-1" aria-labelledby="editModalLabel<?php echo e($sample->id); ?>" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel<?php echo e($sample->id); ?>">Edit Sample Programme</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="<?php echo e(route('sms.database.sampleorderprogramme.update', $sample->id)); ?>" method="POST">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('PUT'); ?>
                                                    <div class="modal-body text-start">
                                                        <table class="table table-bordered">
                                                            <tbody>
                                                                <tr>
                                                                   
                                                                    <th width="20%"><label class="form-label">Item Name</label></th>
                                                                    <td width="30%">
                                                                        <select name="current_status" class="form-control form-control-sm select2">
                                                                            <option value="">Programme Status</option>
                                                                            <?php $__currentLoopData = ['1'=>'Program Done By Merchandise','2'=>'Program Received By Sample','3'=>'Ready To Sweing','4'=>'Sweing Started','5'=>'Sweing Completed']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                               <?php if($key >= $sample->current_status): ?>
                                                                                    <option value="<?php echo e($key); ?>" <?php echo e($sample->current_status == $key ? 'selected' : ''); ?>><?php echo e($item); ?></option>
                                                                               <?php else: ?>
                                                                                
                                                                                <?php endif; ?>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        </select>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary btn-sm">Update Sample Programme</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH H:\laragon\www\garments_erp\Modules/SM\resources/views/database/sampleorderprogramme/show.blade.php ENDPATH**/ ?>