<div class="row g-3">
    <div class="col-lg-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-transparent border-bottom">
                <h6 class="my-0 text-primary"> <i data-feather="list" width="18" height="18"></i> Assigned Shipment
                    Schedule
                    <?php echo $basicorder->order_no; ?> | Order Quantity: <?php echo e($basicorder->order_quantity); ?></h6>
            </div>
            <div class="card-body">
                <form method="POST"
                    action="<?php echo e(route('ordermanagement.database.basicorders.colors_sizes.store', $basicorder->id)); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="row g-3">
                        <div class="col-md-2">
                            <label class="form-label">Lot</label>
                            <select class="form-select" name="lot_id" id="lot_id">
                                <option value="">Select Lot</option>
                                <?php $__currentLoopData = $basicorder->lots; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($lot->id); ?>"><?php echo e($lot->lot_no); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Color</label>
                            <?php if (isset($component)) { $__componentOriginalcd5480bec14091361d89d1705da56ae0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcd5480bec14091361d89d1705da56ae0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-multiple-input','data' => ['name' => 'color_id[]','multiple' => true,'options' => $colors->pluck('color_name', 'id'),'selected' => old('color_id')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-multiple-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'color_id[]','multiple' => true,'options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($colors->pluck('color_name', 'id')),'selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('color_id'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalcd5480bec14091361d89d1705da56ae0)): ?>
<?php $attributes = $__attributesOriginalcd5480bec14091361d89d1705da56ae0; ?>
<?php unset($__attributesOriginalcd5480bec14091361d89d1705da56ae0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalcd5480bec14091361d89d1705da56ae0)): ?>
<?php $component = $__componentOriginalcd5480bec14091361d89d1705da56ae0; ?>
<?php unset($__componentOriginalcd5480bec14091361d89d1705da56ae0); ?>
<?php endif; ?>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Size Group</label>
                            <?php if (isset($component)) { $__componentOriginalcd5480bec14091361d89d1705da56ae0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcd5480bec14091361d89d1705da56ae0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-multiple-input','data' => ['name' => 'size_name[]','multiple' => true,'options' => $sizes->pluck('size_name', 'id'),'selected' => old('size_name')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-multiple-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'size_name[]','multiple' => true,'options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($sizes->pluck('size_name', 'id')),'selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('size_name'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalcd5480bec14091361d89d1705da56ae0)): ?>
<?php $attributes = $__attributesOriginalcd5480bec14091361d89d1705da56ae0; ?>
<?php unset($__attributesOriginalcd5480bec14091361d89d1705da56ae0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalcd5480bec14091361d89d1705da56ae0)): ?>
<?php $component = $__componentOriginalcd5480bec14091361d89d1705da56ae0; ?>
<?php unset($__componentOriginalcd5480bec14091361d89d1705da56ae0); ?>
<?php endif; ?>
                        </div>
                        


                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <?php echo $__env->make('ordermanagement::database.basicorders.lotcolorsizes', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>
</div>
<!-- <script>
    $(document).ready(function() {
        $('#lot_id').on('change', function() {
            var lotId = $(this).val();
            var colorSelect = $('#color_id');
            var sizeGroupSelect = $('#size_group_id');
            colorSelect.empty().append('<option value="">Select Color</option>');
            sizeGroupSelect.empty().append('<option value="">Select Size Group</option>');

            $.getJSON('/inventory/database/basicorders/lot/' + lotId + '/colors', function(colors) {
                $.each(colors, function(index, color) {
                    colorSelect.append('<option value="' + color.id + '">' + color.color_name + '</option>');
                });
            });
        });

        $('#color_id').on('change', function() {
            var colorId = $(this).val();
            var sizeGroupSelect = $('#size_group_id');
            sizeGroupSelect.empty().append('<option value="">Select Size Group</option>');

            $.getJSON('/inventory/database/basicorders/color/' + colorId + '/sizes', function(sizesgroup) {
                $.each(sizesgroup, function(index, sizegroup) {
                    sizeGroupSelect.append('<option value="' + sizegroup.id + '">' + sizegroup.size_group_name + '</option>');
                });
            });
        });

        $('#size_group_id').on('change', function() {
            var sizeGroupId = $(this).val();
            var sizeContainer = $('#size-container');
            sizeContainer.empty();

            $.getJSON('/inventory/database/basicorders/size_group/' + sizeGroupId + '/sizes', function(sizes) {
                $.each(sizes, function(index, size) {
                    var row = '<tr>' +
                        '<td>' +
                        '<input type="hidden" name="size_ids[]" value="' + size.id + '">' +
                        size.size_name +
                        '</td>' +
                        '<td><input type="text" class="form-control" name="sizes[' + size.id + ']" value="0"></td>' +
                        '</tr>';
                    sizeContainer.append(row);
                });
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#addLots').click(function() {
            var row = `<div class="col-md-12">
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <label class="form-label">Color</label>
                                    <select class="form-select" name="color_id">
                                        <?php $__currentLoopData = $colors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($color->id); ?>"><?php echo e($color->color_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Size</label>
                                    <select class="form-select" name="size_id">
                                        <?php $__currentLoopData = $sizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($size->id); ?>"><?php echo e($size->size_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Quantity</label>
                                    <input type="number" class="form-control" name="quantity">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Action</label>
                                    <button type="button" class="btn btn-primary" id="addLots"><i data-feather="plus"
                                            width="14" height="14" class="me-1"></i> Add</button>
                                </div>
                            </div>
                        </div>`;
            $('#addLots').before(row);
        });
    });
</script> --><?php /**PATH C:\laragon\www\garments_erp\Modules\OrderManagement\resources\views\database\basicorders\tab3.blade.php ENDPATH**/ ?>