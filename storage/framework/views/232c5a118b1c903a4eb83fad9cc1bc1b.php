<div class="card padding-card" style="margin-bottom: 0px !important;">
    <div class="card-body" style="min-height: 450px;">
        <div class="row">
            <div class="col-lg-6 col-md-6 pe-lg-0 pe-md-0">
                <div class="card alert-primary alert-top-border padding-card">
                    <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2 py-3">
                        <h6 class="my-0 text-primary">Documents</h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped mb-0" id="academicTable" width="100%">
                            <thead>
                                <tr>
                                    <th style="">SL#</th>
                                    <th style="">Document</th>
                                </tr>
                            </thead>
                            <tbody>
                               <?php $__currentLoopData = $employee_documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($key + 1); ?></td>
                                    <td><?php echo e($document->document->name); ?></td>
                                </tr>
                               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 pe-lg-0 pe-md-0">
                <form action="<?php echo e(route('hris.database.employee.document')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="card alert-info alert-top-border padding-card">
                        <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2 py-3" >
                            <h6 class="my-0 text-primary">Input Parameters For New Document</h6>
                        </div>
                        <div class="card-body" style="padding:10px 10px;">
                            <table class="table table-striped mb-0" id="academicTable" width="100%">
                                <tr>
                                    <th width="40%" style="border: none; text-align: center;">Document</th>
                                    <td width="60%" style="border: none;">
                                        <?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $checked = $employee_documents->contains('document_id', $document->id) ? 'checked' : '';
                                            ?>
                                            <div class="form-check">
                                                <input type="hidden" name="employee_id[]" value="<?php echo e($employee->employee_id); ?>">
                                                <input class="form-check-input" type="checkbox" style="display: inline-block;" name="document_id[]" id="document_id_<?php echo e($document->id); ?>" value="<?php echo e($document->id); ?>" <?php echo e($checked); ?>>
                                                <label class="form-check-label" for="document_id_<?php echo e($document->id); ?>"><?php echo e($document->name); ?></label>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th width="40%" style="border: none; text-align: center;"></th>
                                    <td width="60%" style="border: none;">
                                        <button type="button" class="btn btn-sm btn-success" id="checkAll" style="margin-right: 10px;">Check All</button>
                                        <button type="button" class="btn btn-sm btn-danger" id="uncheckAll">Uncheck All</button>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="card-footer" style="padding:10px 10px;">
                            <?php if (isset($component)) { $__componentOriginald411d1792bd6cc877d687758b753742c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald411d1792bd6cc877d687758b753742c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.primary-button','data' => ['class' => 'float-start btn-sm submitBtn']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('primary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'float-start btn-sm submitBtn']); ?><?php echo e(count($employee_documents) > 0 ? 'Update' : 'Save'); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald411d1792bd6cc877d687758b753742c)): ?>
<?php $attributes = $__attributesOriginald411d1792bd6cc877d687758b753742c; ?>
<?php unset($__attributesOriginald411d1792bd6cc877d687758b753742c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald411d1792bd6cc877d687758b753742c)): ?>
<?php $component = $__componentOriginald411d1792bd6cc877d687758b753742c; ?>
<?php unset($__componentOriginald411d1792bd6cc877d687758b753742c); ?>
<?php endif; ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Unbind previous events to prevent multiple bindings if reloaded
    $(document).off('click', '#checkAll').on('click', '#checkAll', function (e) {
        e.preventDefault();
        $('input[type="checkbox"][name="document_id[]"]').prop('checked', true);
    });

    $(document).off('click', '#uncheckAll').on('click', '#uncheckAll', function (e) {
        e.preventDefault();
        $('input[type="checkbox"][name="document_id[]"]').prop('checked', false);
    });
</script>
<?php /**PATH C:\laragon\www\garments_erp\Modules\HRIS\resources\views\database\employee\tab8.blade.php ENDPATH**/ ?>