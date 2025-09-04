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
                    action="<?php echo e(route('inventory.database.basicorders.colors_sizes.store', $basicorder->id)); ?>">
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
                        <div class="col-md-2">
                            <label class="form-label">Color</label>
                            <select class="form-select" name="color_id" id="color_id">
                                <option value="">Select Color</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Size Group</label>
                            <select class="form-select" name="size_group_id" id="size_group_id">
                                <option value="">Select Size Group</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Size</th>
                                        <th>Quantity(PCS )</th>
                                    </tr>
                                </thead>
                                <tbody id="size-container">
                                    
                                </tbody>
                            </table>
                           
                        </div>
                        
                        
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
                    </div>
                </form>

            </div>


            <?php if(1): ?>
            <div class="card-body">
                <form method="POST" action="<?php echo e(route('inventory.database.basicorders.colors_sizes.store', $basicorder->id)); ?>">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="order_id" value="<?php echo e($basicorder->id); ?>">
                    <div class="row g-3">
                        <div class="col-md-12">
                        <?php $__currentLoopData = $lots; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Lot Number</label>
                                    <?php echo e($lot->lot_no); ?>

                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Color</label>
                                    <select class="form-select" name="lots[<?php echo e($loop->index); ?>][color_id]">
                                        <?php $__currentLoopData = $colors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($color->id); ?>"><?php echo e($color->color_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Size Group</label>
                                    <select class="form-select" name="lots[<?php echo e($loop->index); ?>][size_group_id]">
                                        <?php $__currentLoopData = $sizeGroups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sizeGroup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($sizeGroup->id); ?>"><?php echo e($sizeGroup->size_group_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Size</label>
                                    <select class="form-select" name="lots[<?php echo e($loop->index); ?>][size_id]">
                                        <?php $__currentLoopData = $sizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($size->id); ?>"><?php echo e($size->size_name); ?> with color QTY: <?php echo e($size->size_quantity); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Quantity</label>
                                    <input type="number" class="form-control" name="lots[<?php echo e($loop->index); ?>][quantity]" value="<?php echo e($lot->lot_quantity); ?>" >
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<script>
    document.getElementById('lot_id').addEventListener('change', function() {
        var lotId = this.value;
        var colorSelect = document.getElementById('color_id');
        var sizeGroupSelect = document.getElementById('size_group_id');
        var sizeSelect = document.getElementById('size_id');
        colorSelect.innerHTML = '<option value="">Select Color</option>';
        sizeGroupSelect.innerHTML = '<option value="">Select Size Group</option>';
        // sizeSelect.innerHTML = '<option value="">Select Size</option>';
        $.getJSON('/inventory/database/basicorders/lot/' + lotId + '/colors', function(colors) {
            colors.forEach(color => {
                var option = document.createElement('option');
                option.value = color.id;
                option.text = color.color_name;
                colorSelect.appendChild(option);
            });
        });
    });

    document.getElementById('color_id').addEventListener('change', function() {
        var colorId = this.value;
        var sizeGroupSelect = document.getElementById('size_group_id');
        var sizeSelect = document.getElementById('size_id');
        sizeGroupSelect.innerHTML = '<option value="">Select Size Group</option>';
        // sizeSelect.innerHTML = '<option value="">Select Size</option>';
        $.getJSON('/inventory/database/basicorders/color/' + colorId + '/sizes', function(sizesgroup) {
            sizesgroup.forEach(sizegroup => {
                var option = document.createElement('option');
                option.value = sizegroup.id;
                option.text = sizegroup.size_group_name;
                sizeGroupSelect.appendChild(option);
            });
        });
    });

    document.getElementById('size_group_id').addEventListener('change', function() {
        var sizeGroupId = this.value;
        var sizeSelect = document.getElementById('size-container');
       
        $.getJSON('/inventory/database/basicorders/size_group/' + sizeGroupId + '/sizes', function(sizes) {
            sizes.forEach(size => {
                var option = document.createElement('tr');
                option.innerHTML = `
                <td>
                    <input type="hidden" name="size_ids[]" value="${size.id}">
                    ${size.size_name}
                </td>
                <td><input type="text" class="form-control" name="sizes[${size.id}]" value="0"></td>
                `;
                sizeSelect.appendChild(option);
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
</script>
<?php /**PATH D:\laragon\www\new erp\garments_erp\Modules\Inventory\resources\views\database\basicorders\tab3.blade.php ENDPATH**/ ?>