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
        <div class="col-12 mb-3">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                <!-- Centered Title -->
                <h4 class="text-center flex-grow-1 order-1 order-md-0 mb-2 mb-md-0">
                    Sample Delivery Challan
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
                <div class="d-flex order-2 order-md-2">
                    <!-- Edit Button -->
                    <button type="button" class="btn btn-sm btn-primary d-flex align-items-center me-2" data-bs-toggle="modal" data-bs-target="#editModal">
                        <i data-feather="edit" width="14" height="14" class="me-1"></i> Edit
                    </button>
                    <!-- Delete Button -->
                    <button type="button" class="btn btn-sm btn-danger d-flex align-items-center me-2" data-bs-toggle="modal" data-bs-target="#deleteModal">
                        <i data-feather="trash" width="14" height="14" class="me-1"></i> Delete
                    </button>
                    <!-- Back Button -->
                    <a href="<?php echo e(route('sms.database.sampledelivery.index')); ?>"
                        class="btn btn-sm btn-info d-flex align-items-center">
                        <i data-feather="arrow-left" width="14" height="14" class="me-1"></i> Back
                    </a>
                </div>
            </div>
         </div>
     <div class="col-md-3">
        <div class="card alert-primary alert-top-border padding-card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <i data-feather="list" width="16" height="16"></i>
                    <h6 class="my-0 text-primary ms-2">Initial Orders List</h6>
                </div>
            </div>
            <?php
            $dates = collect($deliveries)->pluck('Date');
            $deliveryList = collect($dates)->unique();
            ?>
            <div class="card-body" style="min-height: 477px;max-height: 477px; overflow-y: auto;">
                <ul class="nav-custom">
                    <?php $__currentLoopData = $deliveryList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $challanDate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="nav-custom-item">
                        <input type="checkbox" id="company<?php echo e($challanDate); ?>">
                        <label class="nav-custom-link" for="company<?php echo e($challanDate); ?>">
                            <span class="nav-custom-caret"></span>
                            <?php echo e($challanDate); ?>

                        </label>
                        <?php
                        $buyerIdList = collect($deliveries)->where('Date', $challanDate)->pluck('BuyerID')->unique();
                        $buyerList = collect($buyers)->whereIn('id', $buyerIdList)->all();
                        ?>
                         <ul class="nav-custom-content">
                                <?php $__currentLoopData = $buyerList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $buyer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="nav-custom-item">
                                <input type="checkbox" id="company<?php echo e($buyer->id); ?> <?php echo e($challanDate); ?>">
                                <label class="nav-custom-link" for="company<?php echo e($buyer->id); ?> <?php echo e($challanDate); ?>">
                                    <span class="nav-custom-caret"></span>
                                    <?php echo e($buyer->buyer_name); ?>

                                </label>
                                    <?php
                                    $chList = collect($deliveries)->where('Date', $challanDate)->where('BuyerID', $buyer->id);
                                    ?>
                                    <div class="nav-custom-content">
                                        <?php $__currentLoopData = $chList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $challan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <a href="<?php echo e(route('sms.database.sampledelivery.show', $challan->id)); ?>" class="employee-link">
                                            <?php echo e($challan->ChallanNo); ?>

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
    <div class="col-9">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title">Delivery Information: <?php echo e($delivery->ChallanNo); ?></h5>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-3">
                        <strong>Challan No:</strong> <?php echo e($delivery->ChallanNo); ?>

                    </div>
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
            </div>
        </div>
         <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title">Delivery Items Information</h5>
            </div>
            
            <div class="card-body">
                <div class="row justify-content-center">
                <div class="col-md-12 mb-3">
                    <select name="programme_id" id="programme_id" class="form-control form-control-sm select2" required>
                        <option value="">Select Order : Programme</option>
                        
                    </select>
                </div>
            </div>
                <div class="table">
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

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Sample Delivery</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?php echo e(route('sms.database.sampledelivery.update', $delivery->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Challan No</label>
                            <input type="text" name="ChallanNo" class="form-control form-control-sm" required value="<?php echo e($delivery->ChallanNo); ?>">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Date</label>
                            <input type="date" name="Date" class="form-control form-control-sm" required value="<?php echo e($delivery->Date); ?>">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Buyer</label>
                            <select name="BuyerID" class="form-select form-select-sm" required>
                                <option value="">Select Buyer</option>
                                <?php $__currentLoopData = $buyers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $buyer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($buyer->id); ?>" <?php echo e($delivery->BuyerID == $buyer->id ? 'selected' : ''); ?>><?php echo e($buyer->buyer_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Employee</label>
                            <select name="EmployeeID" class="form-select form-select-sm" required>
                                <option value="">Select Employee</option>
                                <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($employee->id); ?>" <?php echo e($delivery->EmployeeID == $employee->id ? 'selected' : ''); ?>><?php echo e($employee->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Challan Type</label>
                            <select name="ChallanType" class="form-select form-select-sm" required>
                                <option value="1" <?php echo e($delivery->ChallanType == 1 ? 'selected' : ''); ?>>Returnable</option>
                                <option value="2" <?php echo e($delivery->ChallanType == 2 ? 'selected' : ''); ?>>Non-Returnable</option>
                                <option value="3" <?php echo e($delivery->ChallanType == 3 ? 'selected' : ''); ?>>Export</option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Goods Type</label>
                            <select name="GoodsType" class="form-select form-select-sm" required>
                                <option value="1" <?php echo e($delivery->GoodsType == 1 ? 'selected' : ''); ?>>Gray Fabric</option>
                                <option value="2" <?php echo e($delivery->GoodsType == 2 ? 'selected' : ''); ?>>Complete Body</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Comments</label>
                            <input type="text" name="Comments" class="form-control form-control-sm" value="<?php echo e($delivery->Comments); ?>">
                        </div>
                    </div>
                    <div class="mt-4 text-end">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-sm">Update Delivery</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete Sample Delivery</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this sample delivery? This action cannot be undone.</p>
                <div class="alert alert-warning">
                    <strong>Warning:</strong> This will also delete all associated details.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                <form action="<?php echo e(route('sms.database.sampledelivery.destroy', $delivery->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let rowIdx = <?php echo e(count($delivery->details)); ?>;
        document.getElementById('addEditRow').addEventListener('click', function() {
            let tableBody = document.querySelector('#editDetailsTable tbody');
            let options = `
                <option value="">Select Item</option>
                <?php $__currentLoopData = $sampleProgrammes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($sp->id); ?>">
                    <?php echo e($sp->item->product_category_name ?? 'Item'); ?> - 
                    <?php echo e($sp->style_no ?? 'No Style'); ?>

                    (<?php echo e($sp->initialOrder->order_code ?? ''); ?>)
                </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            `;

            let newRow = `
                <tr>
                    <td>
                        <select name="details[${rowIdx}][SampleOrderProgrammeID]" class="form-select form-select-sm select2" required>
                            ${options}
                        </select>
                    </td>
                    <td><input type="text" name="details[${rowIdx}][Color]" class="form-control form-control-sm" required></td>
                    <td><input type="number" name="details[${rowIdx}][Quantity]" class="form-control form-control-sm" required></td>
                    <td><input type="text" name="details[${rowIdx}][Comments]" class="form-control form-control-sm"></td>
                    <td><button type="button" class="btn btn-danger btn-xs remove-row">X</button></td>
                </tr>
            `;
            tableBody.insertAdjacentHTML('beforeend', newRow);
            rowIdx++;
            
            // Re-initialize Select2 if needed (assuming select2 function exists)
            if (typeof $ !== 'undefined' && $.fn.select2) {
                $('.select2').select2();
            }
        });

        document.querySelector('#editDetailsTable').addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-row')) {
                if(document.querySelectorAll('#editDetailsTable tbody tr').length > 1){
                    e.target.closest('tr').remove();
                } else {
                    alert('At least one row is required.');
                }
            }
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\garments_erp\Modules/SM\resources/views/database/sampledelivery/show.blade.php ENDPATH**/ ?>