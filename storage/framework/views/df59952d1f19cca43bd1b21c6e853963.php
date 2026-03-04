 <?php $__env->startSection('styles'); ?>
 <style>
     .table,
     tr,
     th,
     td {
         border: none !important;
         border-collapse: collapse;
     }
 </style>
 <?php $__env->stopSection(); ?>
 <?php
 $lots = collect($lotColorsSizes)->unique('lot_id');
 ?>
 <?php $__currentLoopData = $lots; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
 <?php
 $Colors = collect($lotColorsSizes)->where('lot_id', $lot->lot_id)->unique('color_id');
 $colorText = $Colors->pluck('color_name')->implode(', ');
 ?>
 <div class="card border-0 shadow-sm">
     <div class="card-header bg-transparent border-bottom">
         <h6 class="my-0 text-primary">
             LOT : <?php echo $lot->lot_no; ?> | Colors : (<?php echo e($colorText); ?>)</h6>
     </div>
     <div class="card-body">
         <div class="row">
             <?php $__currentLoopData = $Colors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
             <?php
             $sizes = collect($lotColorsSizes)->where('lot_id', $lot->lot_id)->where('color_id', $color->color_id);
             ?>

             <div class="col-md-6">
                 <h6 class="my-0 text-primary">
                     Color : <?php echo e($color->color_name); ?></h6>
                 <table class="table table-bordered">
                     <thead>
                         <tr>
                             <th>Size</th>
                             <th>Quantity(PCS )</th>
                             <th>Remarks</th>
                             <th>Actiona</th>
                         </tr>
                     </thead>
                     <tbody id="size-container">
                         <?php $__currentLoopData = $sizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                         <tr>
                             <td><?php echo e($size->size_name); ?></td>
                             <td>
                                 <?php if (isset($component)) { $__componentOriginal66a280159691934507706df376ef5a6a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal66a280159691934507706df376ef5a6a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-group','data' => ['name' => 'qty','class' => 'form-control form-control-sm m-0 p-','value' => $size->qty,'id' => 'qty-'.e($size->id).'','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'qty','class' => 'form-control form-control-sm m-0 p-','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($size->qty),'id' => 'qty-'.e($size->id).'','required' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal66a280159691934507706df376ef5a6a)): ?>
<?php $attributes = $__attributesOriginal66a280159691934507706df376ef5a6a; ?>
<?php unset($__attributesOriginal66a280159691934507706df376ef5a6a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal66a280159691934507706df376ef5a6a)): ?>
<?php $component = $__componentOriginal66a280159691934507706df376ef5a6a; ?>
<?php unset($__componentOriginal66a280159691934507706df376ef5a6a); ?>
<?php endif; ?>
                             </td>
                             <td>
                                 <?php if (isset($component)) { $__componentOriginal66a280159691934507706df376ef5a6a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal66a280159691934507706df376ef5a6a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-group','data' => ['name' => 'remarks','class' => 'form-control form-control-sm','value' => $size->size_remarks,'id' => 'remarks-'.e($size->id).'','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'remarks','class' => 'form-control form-control-sm','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($size->size_remarks),'id' => 'remarks-'.e($size->id).'','required' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal66a280159691934507706df376ef5a6a)): ?>
<?php $attributes = $__attributesOriginal66a280159691934507706df376ef5a6a; ?>
<?php unset($__attributesOriginal66a280159691934507706df376ef5a6a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal66a280159691934507706df376ef5a6a)): ?>
<?php $component = $__componentOriginal66a280159691934507706df376ef5a6a; ?>
<?php unset($__componentOriginal66a280159691934507706df376ef5a6a); ?>
<?php endif; ?>
                             </td>
                             <td>
                                 <a href="#" class="btn btn-sm btn-soft-success" onclick='updateSize("<?php echo e($size->id); ?>")'><i class="fas fa-edit"></i></a>

                                 <a class="btn btn-sm btn-soft-danger"><i class="fas fa-trash"></i></a>
                             </td>
                         </tr>
                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     </tbody>
                 </table>
             </div>

             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         </div>

     </div>
 </div>
 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
 <script>
    function updateSize(sizeId) {
        var qty = $('#qty-' + sizeId).val();
        var remarks = $('#remarks-' + sizeId).val();
        // Add AJAX call to update size
        console.log(qty, remarks);
        $.ajax({
            url: '/ordermanagement/database/basicorders/lotcolorsizes/update/' + sizeId,
            method: 'POST',
            data: {
                qty: qty,
                remarks: remarks,
                _token: '<?php echo e(csrf_token()); ?>'
            },
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.success
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.error
                    });
                }
            }
        });
    }
 </script>
<?php /**PATH H:\laragon\www\garments_erp\Modules\OrderManagement\resources\views\database\basicorders\lotcolorsizes.blade.php ENDPATH**/ ?>