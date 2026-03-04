<?php $__env->startSection('title', 'HRIS'); ?>
<?php $__env->startSection('styles'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<style>
    .table, tr, th, td {
        border: none !important;
        border-collapse: collapse;
    }
    .responsive-table {
        width: 100%;
        max-width: 100%;
        border-collapse: collapse;
    }

    .responsive-table th {
        text-align: center;
        padding: 8px;
    }

    .img-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        border: 1px solid #000;
        overflow: hidden;
        margin: auto;
    }

    /* Photo container */
    .photo-box {
        width: 128px;
        height: 148px;
    }

    /* Signature container */
    .signature-box {
        width: 300px;
        height: 100px;
    }

    .img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    @media (max-width: 576px) {
        .photo-box,
        .signature-box {
            width: 100%;
            max-width: 300px;
            height: auto;
            aspect-ratio: 128 / 148;
        }
        .signature-box {
            aspect-ratio: 300 / 100;
        }
    }
</style>
    <div class="row">
        <div class="col-12">
            <?php echo $__env->make('components.breadcrumb', [
                'title' => 'HRIS',
                'subtitle' => 'Photo & Signature',
                'breadcrumbs' => [
                    ['label' => 'HRIS', 'url' => route('hris.index')],
                    ['label' => 'Database', 'url' => route('hris.index')],
                    ['label' => 'Photo & Signature', 'url' => route('hris.database.photosign.index')],
                ],
            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
        <div class="col-lg-8" style="margin:0px auto;">
            <form action="<?php echo e(route('hris.database.photosign.store')); ?>" id="applicantForm" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="card alert-primary alert-top-border">
                    <div class="card-header d-flex justify-content-between align-items-center flex-wrap px-10 py-12" style="padding: 16px 20px">
                        <h6 class="my-0 text-primary d-flex align-items-center gap-1"><i data-feather="list" width="18" height="18"></i>
                            Photo & Signature
                        </h6>
                    </div>

                    <div class="card-body" style="min-height: 500px;max-height: 500px; overflow-y: auto;">
                        <div class="row">
                            <!-- Employee basic info -->
                            <div class="col-lg-7">
                                <table class="table table-bordered" id="employeeInfoTable" width="100%">
                                    <tr>
                                        <th width="30%" style="border: none;">Employee ID</th>
                                        <td width="70%" style="border: none;"><?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['name' => 'employee_id','class' => 'form-control-sm','id' => 'employee_id','type' => 'text','placeholder' => 'Employee ID','autocomplete' => 'off','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'employee_id','class' => 'form-control-sm','id' => 'employee_id','type' => 'text','placeholder' => 'Employee ID','autocomplete' => 'off','required' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $attributes = $__attributesOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__attributesOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $component = $__componentOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__componentOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?></td>
                                    </tr>
                                    <tr>
                                        <th width="30%" style="border: none;">Name</th>
                                        <td width="70%" style="border: none;"><?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['name' => 'name','class' => 'form-control-sm','id' => 'name','type' => 'text','placeholder' => 'Employee Name','readonly' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'name','class' => 'form-control-sm','id' => 'name','type' => 'text','placeholder' => 'Employee Name','readonly' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $attributes = $__attributesOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__attributesOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $component = $__componentOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__componentOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?></td>
                                    </tr>
                                    <tr>
                                        <th width="30%" style="border: none;">Designation</th>
                                        <input type="hidden" name="designation_id" id="designation_id">
                                        <td width="70%" style="border: none;"><?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['name' => 'designation','class' => 'form-control-sm','id' => 'designation','type' => 'text','placeholder' => 'Designation','readonly' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'designation','class' => 'form-control-sm','id' => 'designation','type' => 'text','placeholder' => 'Designation','readonly' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $attributes = $__attributesOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__attributesOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $component = $__componentOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__componentOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?></td>
                                    </tr>
                                    <tr>
                                        <th width="30%" style="border: none;">Department</th>
                                        <input type="hidden" name="department_id" id="department_id">
                                        <td width="70%" style="border: none;"><?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['name' => 'department','class' => 'form-control-sm','id' => 'department','type' => 'text','placeholder' => 'Department','readonly' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'department','class' => 'form-control-sm','id' => 'department','type' => 'text','placeholder' => 'Department','readonly' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $attributes = $__attributesOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__attributesOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $component = $__componentOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__componentOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?></td>
                                    </tr>
                                    <tr>
                                        <th width="30%" style="border: none;">Joining Date</th>
                                        <td width="70%" style="border: none;"><?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['name' => 'join_date','class' => 'form-control-sm','id' => 'join_date','type' => 'text','placeholder' => 'Joining Date','readonly' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'join_date','class' => 'form-control-sm','id' => 'join_date','type' => 'text','placeholder' => 'Joining Date','readonly' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $attributes = $__attributesOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__attributesOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $component = $__componentOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__componentOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?></td>
                                    </tr>
                                    <tr>
                                        <th width="30%" style="border: none;">NID/Birth Certificate</th>
                                        <td width="70%" style="border: none;"><?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['name' => 'nid_birth_certificate','class' => 'form-control-sm','id' => 'nid_birth_certificate','type' => 'text','placeholder' => 'NID/Birth Certificate','readonly' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'nid_birth_certificate','class' => 'form-control-sm','id' => 'nid_birth_certificate','type' => 'text','placeholder' => 'NID/Birth Certificate','readonly' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $attributes = $__attributesOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__attributesOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $component = $__componentOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__componentOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?></td>
                                    </tr>
                                </table>
                            </div>

                            <!-- Upload new photo & signature -->
                            <div class="col-lg-5" style="min-height:450px; border:1px solid #ddd; overflow:hidden;">
                                <table class="responsive-table">
                                    <tr>
                                        <th colspan="2">Photo (128x148)</th>
                                    </tr>
                                    <tr>
                                        <td class="text-center">
                                            <div class="img-wrapper photo-box">
                                                <img id="photoPreview" src="<?php echo e(asset('backend/assets/images/demo.png')); ?>" alt="Photo Preview">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">
                                            <input type="file" name="photo" id="photo" accept="image/*" class="form-control mt-2">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th colspan="2">Sign (300x150)</th>
                                    </tr>
                                    <tr>
                                        <td class="text-center">
                                            <div class="img-wrapper signature-box">
                                                <img id="signaturePreview" src="<?php echo e(asset('backend/assets/images/sig.png')); ?>" alt="Signature Preview">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">
                                            <input type="file" name="signature" id="signature" accept="image/*" class="form-control mt-2">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer px-3 py-2">
                        <div class="d-flex align-items-center justify-content-between">
                            <p id="message" class="mb-0" style="color:#FF6C37;font-weight:semi-bold"></p>
                            <?php if (isset($component)) { $__componentOriginald411d1792bd6cc877d687758b753742c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald411d1792bd6cc877d687758b753742c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.primary-button','data' => ['id' => 'submitBtn','type' => 'submit','class' => 'btn btn-sm btn-primary submitBtn']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('primary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'submitBtn','type' => 'submit','class' => 'btn btn-sm btn-primary submitBtn']); ?>Assign <?php echo $__env->renderComponent(); ?>
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
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        // Image preview helpers
        function readURL(input, previewSelector) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = e => {
                    $(previewSelector).attr('src', e.target.result).show();
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        $('#photo').on('change', function () {
            readURL(this, '#photoPreview');
        });

        $('#signature').on('change', function () {
            readURL(this, '#signaturePreview');
        });

        function employeeInfo() {
            let employeeId = $("#employee_id").val();

            if (employeeId.length >= 8) {
                $.ajax({
                    url: "<?php echo e(route('hris.database.photosign.info')); ?>",
                    type: "POST",
                data: {
                    employee_id: employeeId
                },
                success: function (response) {
                    $("#message").text('');
                    $("#name").val('');
                    $("#designation").val('');
                    $("#department").val('');
                    $("#join_date").val('');
                    $("#nid_birth_certificate").val('');
                    $("#designation_id").val('');
                    $("#department_id").val('');

                    if (response && Object.keys(response).length > 0) {
                        console.log(response);

                        $("#name").val(response.name || '');
                        $("#designation").val(response.designation?.designation || '');
                        $("#department").val(response.department?.department || '');
                        $("#join_date").val(response.joining_date || '');

                        if (response.photo) {
                            $('#photoPreview').attr('src', '/storage/' + response.photo);
                        }
                        if (response.signature || response.signature != null) {
                            $('#signaturePreview').attr('src', '/storage/' + response.signature);
                        }

                        if (response.employee_personal?.national_id) {
                            $("#nid_birth_certificate").val(response.employee_personal.national_id);
                        }
                        if (response.employee_personal?.birth_certificate) {
                            $("#nid_birth_certificate").val(response.employee_personal.birth_certificate);
                        }
                        $("#designation_id").val(response.designation_id || '');
                        $("#department_id").val(response.department_id || '');
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
            }else{
                $("#name").val('');
                $("#designation").val('');
                $("#department").val('');
                $("#join_date").val('');
                $("#nid_birth_certificate").val('');
                $("#designation_id").val('');
                $("#department_id").val('');

                $('#photoPreview').attr('src', "<?php echo e(asset('backend/assets/images/demo.png')); ?>");
                $('#signaturePreview').attr('src', "<?php echo e(asset('backend/assets/images/sig.png')); ?>");

                $("#message").text('Employee ID must be exactly 8 digits');
            }
        }


        employeeInfo();
        $("#employee_id").on("input", function () {
            employeeInfo();
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH H:\laragon\www\garments_erp\Modules\HRIS\resources\views\database\photosign\index.blade.php ENDPATH**/ ?>