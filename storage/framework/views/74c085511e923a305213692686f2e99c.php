<?php $__env->startSection('title', 'HRIS'); ?>
<?php $__env->startSection('content'); ?>
<?php $__env->startPush('styles'); ?>
<style>
.table, tr, th, td {
    border: none !important;
    border-collapse: collapse;
}
</style>
<?php $__env->stopPush(); ?>
    <div class="row">
        <div class="col-12">
            <?php echo $__env->make('components.breadcrumb', [
                'title' => 'HRIS',
                'subtitle' => 'Calender',
                'breadcrumbs' => [
                    ['label' => 'HRIS', 'url' => route('hris.index')],
                    ['label' => 'Tools', 'url' => route('hris.index')],
                    ['label' => 'Calender', 'url' => route('hris.tools.calender.index')],
                ],
            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
        <div class="col-lg-8 col-md-8 ps-lg-1 ps-md-1" style="margin:0px auto;">
            <div class="card alert-primary alert-top-border">
                <div class="card-header" style="padding: 15px 16px;">
                    <h5 class="my-0 text-primary text-center"> Calender</h5>
                </div>
                <form action="<?php echo e(route('hris.tools.calender.store')); ?>" id="applicantForm" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                    <div class="card border">
                        <div class="card-body" style="overflow-y: auto;">
                            <div class="row">
                                <div class="col-lg-8" style="margin:0px auto;">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td style="width: 70%;">
                                                    <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['name' => 'year','label' => '','class' => 'form-control','type' => 'text','value' => ''.e(date('Y')).'','required' => true,'readonly' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'year','label' => '','class' => 'form-control','type' => 'text','value' => ''.e(date('Y')).'','required' => true,'readonly' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $attributes = $__attributesOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__attributesOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $component = $__componentOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__componentOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>
                                                </td>
                                                <td style="width: 30%;">
                                                    <?php if (isset($component)) { $__componentOriginald411d1792bd6cc877d687758b753742c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald411d1792bd6cc877d687758b753742c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.primary-button','data' => ['id' => 'submitBtn','class' => 'btn-sm submitBtn','type' => 'submit','style' => 'width: 100%; padding: 8px 6px;']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('primary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'submitBtn','class' => 'btn-sm submitBtn','type' => 'submit','style' => 'width: 100%; padding: 8px 6px;']); ?>Generate <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald411d1792bd6cc877d687758b753742c)): ?>
<?php $attributes = $__attributesOriginald411d1792bd6cc877d687758b753742c; ?>
<?php unset($__attributesOriginald411d1792bd6cc877d687758b753742c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald411d1792bd6cc877d687758b753742c)): ?>
<?php $component = $__componentOriginald411d1792bd6cc877d687758b753742c; ?>
<?php unset($__componentOriginald411d1792bd6cc877d687758b753742c); ?>
<?php endif; ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-8 col-md-8 ps-lg-1 ps-md-1" style="margin:0px auto;">
            <div class="card" style="overflow-y: auto;">
                <div class="card-header" style="padding: 15px 16px;">
                    <h6  class="my-0 text-primary"><i data-feather="list" width="16" height="16"></i> Calender List</h6>
                </div>
                <div class="card-body">
                    <table id="datacom" class="table table-striped" width="100%">
                        <thead class="table-light">
                            <tr>
                                <th width="10%">Date</th>
                                <th width="10%">Holiday?</th>
                                <th width="10%">Public Holiday?</th>
                                <th width="10%">Note</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $calender; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e(date('d-m-Y', strtotime($item->date))); ?></td>
                                <td>
                                    <input type="text" id="holiday_<?php echo e($item->id); ?>" class="form-control form-control-sm" name="holiday" value="<?php echo e($item->holiday); ?>">
                                </td>
                                <td>
                                    <input type="text" id="public_holiday_<?php echo e($item->id); ?>" class="form-control form-control-sm" name="public_holiday" value="<?php echo e($item->public_holiday); ?>">
                                </td>
                                <td>
                                    <input type="text" onblur="updateCalender(<?php echo e($item->id); ?>)" id="note_<?php echo e($item->id); ?>" class="form-control form-control-sm note" data-id="<?php echo e($item->id); ?>" name="note" value="<?php echo e($item->note); ?>">
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

<?php $__env->startPush('scripts'); ?>
<script>
    function updateCalender(id) {
        var note = $('#note_' + id).val();
        var holiday = $('#holiday_' + id).val();
        var public_holiday = $('#public_holiday_' + id).val();

        $.ajax({
            url: '<?php echo e(route("hris.tools.calender.update", ":id")); ?>'.replace(':id', id),
            type: 'PUT',
            data: {
                _token: '<?php echo e(csrf_token()); ?>',
                note: note,
                holiday: holiday,
                public_holiday: public_holiday
            },
            success: function(response) {
                if(response.success){
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message,
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Failed to update',
                    });
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    }
    $('#datacom').DataTable({
        paging: false,
        lengthChange: false,
        searching: true,
        ordering: false,
        scrollY: "400px",
        scrollX: true,
        scrollCollapse: true,
        fixedHeader: true,

        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excel',
                className: 'btn btn-sm btn-success'
            },
            {
                extend: 'csv',
                className: 'btn btn-sm btn-info'
            }
        ]
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH H:\laragon\www\garments_erp\Modules\HRIS\resources\views\tools\calender\index.blade.php ENDPATH**/ ?>