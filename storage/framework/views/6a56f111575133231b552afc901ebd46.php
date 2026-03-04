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
                'subtitle' => 'Service Benefit',
                'breadcrumbs' => [
                    ['label' => 'HRIS', 'url' => route('hris.index')],
                    ['label' => 'Database', 'url' => route('hris.index')],
                    ['label' => 'Service Benefit', 'url' => route('hris.database.servicebenefit.index')],
                ],
            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
        <div class="col-12 mb-3">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                <h4 class="text-center flex-grow-1 order-1 order-md-0 mb-2 mb-md-0">Service Benefit</h4>
            </div>
        </div>
        <div class="col-lg-9 pe-lg-0" style="margin:0px auto;">
            <div class="card alert-primary alert-top-border">
                <div class="card-header" style="padding: 15px 16px;"><h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Service Benefit List For : <?php echo e($monthYear); ?></h6></div>
                <div class="card-body" style="overflow-y: auto;">
                    <table id="datacom" class="table table-bordered table-striped" width="100%">
                        <thead class="table-light">
                            <tr>
                                <th>SL</th>
                                <th>EmpID</th>
                                <th>Name</th>
                                <th>Department</th>
                                <th>Category</th>
                                <th>Join Date</th>
                                <th>Leaving Date</th>
                                <th>Tenure<br>(Y|M|D)</th>
                                <th>Pay<br>Days</th>
                                <th>Basic<br>Salary</th>
                                <th>Rate</th>
                                <th>Amount</th>
                                <th>Stamp</th>
                                <th>Net Payable</th>
                                <th>For Pay</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody >
                            <?php $__currentLoopData = $servicebenfits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $servicebenefit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr id="row_<?php echo e($servicebenefit->id); ?>">
                                    <td><?php echo e($key + 1); ?></td>
                                    <td style="width:100px;">
                                        <div style="display:flex; align-items:center; gap:8px;">
                                            <input type="checkbox"
                                                class="row_checkbox"
                                                name="servicebenefit_id[]"
                                                value="<?php echo e($servicebenefit->id); ?>" style="display:block !important;">
                                            <span><?php echo e(str_pad($servicebenefit->employee_id, 8, '0', STR_PAD_LEFT)); ?></span>
                                        </div>
                                    </td>
                                    <td><?php echo e($servicebenefit->employee->name); ?></td>
                                    <td><?php echo e($servicebenefit->department->department); ?></td>
                                    <td class='text-center'><?php echo e($servicebenefit->category); ?></td>
                                    <td><?php echo e(date('d-m-Y', strtotime($servicebenefit->joining_date))); ?></td>
                                    <td><?php echo e(date('d-m-Y', strtotime($servicebenefit->leaving_date))); ?></td>
                                    <td><?php echo \Carbon\Carbon::parse($servicebenefit->joining_date)->diff(\Carbon\Carbon::parse($servicebenefit->leaving_date))->format('%y|%m|%d'); ?></td>
                                    <td><?php echo e($servicebenefit->paydays); ?></td>
                                    <td><?php echo e($servicebenefit->basic); ?></td>
                                    <td><?php echo e($servicebenefit->rate); ?></td>
                                    <td><?php echo e($servicebenefit->amount); ?></td>
                                    <td><?php echo e($servicebenefit->stamp); ?></td>
                                    <td><?php echo e($servicebenefit->net_payable); ?></td>
                                    <td class='text-center'><?php echo e($servicebenefit->for_pay); ?></td>
                                    <td class="statusCell">
                                        <?php echo e($servicebenefit->status == 'Y' ? 'Paid' : 'Unpaid'); ?>

                                    </td>
                                    <td class="text-center">
                                        <a href="#" class="btn btn-soft-danger waves-effect waves-light delete-servicebenefit" data-id="<?php echo e($servicebenefit->id); ?>" style="padding: 4px 6px;"><i class="fas fa-trash"></i></a>
                                    </td>
                              </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <th colspan="17">
                                    <div class="d-flex justify-content-between align-items-center">

                                        <!-- LEFT SIDE -->
                                        <div>
                                            <button type="button" class="btn btn-sm btn-outline-success" id="check_all_forward">
                                                <i data-feather="check-square" width="14" height="14"></i> Check All
                                            </button>

                                            <button type="button" class="btn btn-sm btn-outline-primary" id="uncheck_all_forward">
                                                <i data-feather="x-square" width="14" height="14"></i> Uncheck All
                                            </button>
                                        </div>

                                        <!-- RIGHT SIDE -->
                                        <div>
                                            <button type="button" id="updateBtn" class="btn btn-primary waves-effect waves-light btn-sm" style="padding: 4px 6px;" data-bs-toggle="modal" data-bs-target="#editModal">
                                                <i data-feather="check-circle" style="width:16px; height:16px;"></i>
                                                <span class="ms-1">Update</span>
                                            </button>
                                        </div>
                                    </div>
                                </th>
                                <div id="editModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-bs-scroll="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h6 class="modal-title" id="myModalLabel">Service Benefit</h6>
                                                <button type="button" class="btn-close btn btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <form action="#" id="editForm">
                                                <div class="modal-body">
                                                    <?php if (isset($component)) { $__componentOriginal243648788f657c94d456cacfc3f7cdc3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal243648788f657c94d456cacfc3f7cdc3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-input-group','data' => ['name' => 'status','label' => 'Payment Status','options' => ['Y' => 'Paid', 'N' => 'Unpaid'],'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-input-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'status','label' => 'Payment Status','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['Y' => 'Paid', 'N' => 'Unpaid']),'required' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal243648788f657c94d456cacfc3f7cdc3)): ?>
<?php $attributes = $__attributesOriginal243648788f657c94d456cacfc3f7cdc3; ?>
<?php unset($__attributesOriginal243648788f657c94d456cacfc3f7cdc3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal243648788f657c94d456cacfc3f7cdc3)): ?>
<?php $component = $__componentOriginal243648788f657c94d456cacfc3f7cdc3; ?>
<?php unset($__componentOriginal243648788f657c94d456cacfc3f7cdc3); ?>
<?php endif; ?>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary waves-effect btn-sm" data-bs-dismiss="modal">Close</button>
                                                    <?php if (isset($component)) { $__componentOriginald411d1792bd6cc877d687758b753742c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald411d1792bd6cc877d687758b753742c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.primary-button','data' => ['id' => 'submitBtn','class' => 'float-start btn-sm submitBtn']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('primary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'submitBtn','class' => 'float-start btn-sm submitBtn']); ?>Save changes <?php echo $__env->renderComponent(); ?>
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
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>



        <div class="col-lg-3" style="margin:0px auto;">
            <form action="<?php echo e(route('hris.database.servicebenefit.store')); ?>" id="applicantForm" method="POST">
                <?php echo csrf_field(); ?>
                <div class="card alert-primary alert-top-border">
                    <div class="card-header" style="padding: 15px 16px;">
                        <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Input Parameter For Service Benefit</h6>
                    </div>
                    <div class="card-body" style="overflow-y: auto;">
                        <label for="Organization">Organization</label>
                        <?php if (isset($component)) { $__componentOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-input','data' => ['name' => 'org_id','id' => 'org_id','class' => 'select2','options' => $organizations,'selected' => selected_org($organizations),'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'org_id','id' => 'org_id','class' => 'select2','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($organizations),'selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(selected_org($organizations)),'required' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36)): ?>
<?php $attributes = $__attributesOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36; ?>
<?php unset($__attributesOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36)): ?>
<?php $component = $__componentOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36; ?>
<?php unset($__componentOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36); ?>
<?php endif; ?><br><br>
                        <?php if (isset($component)) { $__componentOriginal66a280159691934507706df376ef5a6a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal66a280159691934507706df376ef5a6a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-group','data' => ['name' => 'employee_id','id' => 'employee_id','label' => 'Employee ID','type' => 'text','class' => 'form-control-sm','value' => ''.e(old('employee_id')).'','placeholder' => 'Employee ID']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'employee_id','id' => 'employee_id','label' => 'Employee ID','type' => 'text','class' => 'form-control-sm','value' => ''.e(old('employee_id')).'','placeholder' => 'Employee ID']); ?>
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
                        <?php if (isset($component)) { $__componentOriginal66a280159691934507706df376ef5a6a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal66a280159691934507706df376ef5a6a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-group','data' => ['name' => 'name','label' => 'Name','id' => 'name','type' => 'text','class' => 'form-control-sm','value' => ''.e(old('name')).'','placeholder' => 'Name','required' => true,'readonly' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'name','label' => 'Name','id' => 'name','type' => 'text','class' => 'form-control-sm','value' => ''.e(old('name')).'','placeholder' => 'Name','required' => true,'readonly' => true]); ?>
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
                        <?php if (isset($component)) { $__componentOriginal66a280159691934507706df376ef5a6a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal66a280159691934507706df376ef5a6a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-group','data' => ['name' => 'department','label' => 'Department','id' => 'department','type' => 'text','class' => 'form-control-sm','value' => ''.e(old('department')).'','placeholder' => 'Department','readonly' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'department','label' => 'Department','id' => 'department','type' => 'text','class' => 'form-control-sm','value' => ''.e(old('department')).'','placeholder' => 'Department','readonly' => true]); ?>
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
                        <?php if (isset($component)) { $__componentOriginal66a280159691934507706df376ef5a6a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal66a280159691934507706df376ef5a6a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-group','data' => ['name' => 'start_date','label' => 'Start Date','id' => 'start_date','type' => 'date','class' => 'form-control-sm','value' => ''.e($startDate).'','placeholder' => 'Start Date','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'start_date','label' => 'Start Date','id' => 'start_date','type' => 'date','class' => 'form-control-sm','value' => ''.e($startDate).'','placeholder' => 'Start Date','required' => true]); ?>
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
                        <?php if (isset($component)) { $__componentOriginal66a280159691934507706df376ef5a6a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal66a280159691934507706df376ef5a6a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-group','data' => ['name' => 'end_date','label' => 'End Date','id' => 'end_date','type' => 'date','class' => 'form-control-sm','value' => ''.e($endDate).'','placeholder' => 'End Date','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'end_date','label' => 'End Date','id' => 'end_date','type' => 'date','class' => 'form-control-sm','value' => ''.e($endDate).'','placeholder' => 'End Date','required' => true]); ?>
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
                    </div>
                    <div class="card-footer" style="padding:15px 16px;">
                         <button id="regenerateBtn" class="btn btn-secondary btn-sm">
                            <i data-feather="refresh-cw" style="width:16px; height:16px;"></i>
                            <span class="ms-1">Regenerate</span>
                        </button>

                        <button id="confirmBtn" class="btn btn-warning btn-sm">
                            <i data-feather="check-circle" style="width:16px; height:16px;"></i>
                            <span class="ms-1">Confirm</span>
                        </button>
                        <?php if (isset($component)) { $__componentOriginald411d1792bd6cc877d687758b753742c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald411d1792bd6cc877d687758b753742c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.primary-button','data' => ['id' => 'submitBtn','class' => 'btn-sm submitBtn float-end','type' => 'submit']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('primary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'submitBtn','class' => 'btn-sm submitBtn float-end','type' => 'submit']); ?>Generate <?php echo $__env->renderComponent(); ?>
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
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    $(document).ready(function() {
        function toggleButtons() {
            let anyChecked = $('.row_checkbox:checked').length > 0;
            $('#updateBtn').prop('disabled', !anyChecked);
        }

        /* ------------------ CHECK ALL ------------------ */
        $('#check_all_forward').on('click', function () {
            $('.row_checkbox').prop('checked', true).trigger('change');
        });

        $('#uncheck_all_forward').on('click', function () {
            $('.row_checkbox').prop('checked', false).trigger('change');
        });

        /* ------------------ ROW CHECKBOX ------------------ */
        $(document).on('change', '.row_checkbox', function () {
            let row = $(this).closest('tr');
            let isChecked = $(this).is(':checked');
            toggleButtons();
        });

        $('.row_checkbox').trigger('change');
        toggleButtons();


        function employeeInfo() {
            let employeeId = $("#employee_id").val();

            if (employeeId.length >= 6) {
                $.ajax({
                    url: "<?php echo e(route('payroll.database.advance.employee.info')); ?>",
                    type: "POST",
                data: {
                    employee_id: employeeId
                },
                success: function (response) {
                    $("#name").val('');
                    $("#department").val('');

                    if (response && Object.keys(response).length > 0) {
                        $("#name").val(response.name || '');
                        $("#department").val(response.department?.department || '');
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Failed to load employee info.',
                        });
                    }
                },
                error: function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Failed to load employee info.',
                    });
                }
                });
            }else {
                $("#name").val('');
                $("#department").val('');
            }
        }

        employeeInfo();
        $("#employee_id").on("blur", function () {
            employeeInfo();
        });

        $('#datacom').DataTable({
            paging: false,
            lengthChange: false,
            searching: true,
            ordering: false,
            scrollY: "400px",
            scrollX: true,
            scrollCollapse: true,
            fixedHeader: true,
        });
    });

    $(document).on('click', '.delete-servicebenefit', function(e) {
        e.preventDefault();
        let servicebenefitId = $(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?php echo e(route('hris.database.servicebenefit.delete')); ?>',
                    type: 'POST',
                    data: {
                        _token: '<?php echo e(csrf_token()); ?>',
                        id: servicebenefitId
                    },
                    success: function(response) {
                        if(response.success == true){
                            Swal.fire(
                                'Deleted!',
                                'Advance has been deleted.',
                                'success'
                            );
                            $('#row-' + servicebenefitId).remove();
                        }else{
                            Swal.fire(
                                'Error!',
                                response.message,
                                'error'
                            );
                        }
                    },
                    error: function() {
                        Swal.fire(
                            'Error!',
                            'Something went wrong.',
                            'error'
                        );
                    }
                });
            } else {
                Swal.fire(
                    'Cancelled!',
                    'Advance has not been deleted.',
                    'error'
                );
            }
        });
    });



    $(document).on('click', '#regenerateBtn', function (e) {
        e.preventDefault(); // extra safety
        // regenerate logic here
        console.log('Regenerate clicked');
    });

    $('#editForm').on('submit', function (e) {
        e.preventDefault();

        let status = $('select[name="status"]').val();
        let servicebenefitId = [];
        $('.row_checkbox').each(function () {
            if ($(this).is(':checked')) {
                servicebenefitId.push($(this).val());
            }
        });

        if (servicebenefitId.length === 0) {
            Swal.fire('Warning', 'No row selected!', 'warning');
            return;
        }

        $.ajax({
            url: '<?php echo e(route('hris.database.servicebenefit.status.update')); ?>',
            type: 'POST',
            data: {
                _token: '<?php echo e(csrf_token()); ?>',
                status: status,
                service_id: servicebenefitId,
            },
            beforeSend() {
                Swal.fire({
                    title: 'Processing...',
                    allowOutsideClick: false,
                    didOpen: () => Swal.showLoading()
                });
            },
            success(res) {
                Swal.close();
                if (res.status === 'success') {
                    $('#editModal').modal('hide');
                    Swal.fire('Success', res.message, 'success');

                    servicebenefitId.forEach(function(id) {
                        let row = $('#row_' + id);
                        row.find('.statusCell').text(status == 'Y' ? 'Paid' : 'Unpaid');
                        row.find('.row_checkbox').prop('checked', false);
                    });
                } else {
                    Swal.fire('Error', res.message, 'error');
                }
            }
        });

        $('#editModal').on('hidden.bs.modal', function () {
            $(this).find('form')[0].reset(); // all inputs reset
            $(this).find('button[type="submit"]').prop('disabled', false).html('Save changes'); // spinner reset
        });
    });

    $(document).on('click', '#confirmBtn', function (e) {
        e.preventDefault();

        let orgId = $('#org_id').val();
        let startDate = $('#start_date').val();
        let endDate = $('#end_date').val();

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Confirm!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?php echo e(route('hris.database.servicebenefit.confirm')); ?>',
                    type: 'POST',
                    data: {
                        _token: '<?php echo e(csrf_token()); ?>',
                        org_id: orgId,
                        start_date: startDate,
                        end_date: endDate,
                    },
                    success: function(response) {
                        if(response.success == true){
                            Swal.fire(
                                'Deleted!',
                                'Advance has been deleted.',
                                'success'
                            );
                            $('#row-' + servicebenefitId).remove();
                        }else{
                            Swal.fire(
                                'Error!',
                                response.message,
                                'error'
                            );
                        }
                    },
                    error: function() {
                        Swal.fire(
                            'Error!',
                            'Something went wrong.',
                            'error'
                        );
                    }
                });
            } else {
                Swal.fire(
                    'Cancelled!',
                    'Advance has not been deleted.',
                    'error'
                );
            }
        });
    });
</script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH H:\laragon\www\garments_erp\Modules\HRIS\resources\views\database\servicebenefit\index.blade.php ENDPATH**/ ?>