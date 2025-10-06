<div class="card padding-card" style="margin-bottom: 0px !important;">
    <form action="<?php echo e(route('hris.database.employee.bangla')); ?>" method="POST">
        <?php echo csrf_field(); ?>
    <div class="card-body" style="min-height: 400px;">
        <div class="row">
            <div class="col-lg-12">
                <div class="row" style="border: 1px dotted #2f2f30; padding: 8px 0px;">
                    <div class="col-lg-4 col-md-6 pe-lg-0 pe-md-0">
                        <table class="table table-striped mb-0" id="employeeTable" width="100%">
                            <input type="hidden" name="employee_id" id="employee_id" value="<?php echo e($employee_bangla->employee_id); ?>">
                            <input type="hidden" name="org_id" id="org_id" value="<?php echo e($employee_bangla->org_id); ?>">
                            <tr>
                                <th width="30%" style="border: none;">নাম </th>
                                <td width="70%" style="border: none;"><?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['name' => 'name_bangla','id' => 'name_bangla','class' => 'form-control-sm','value' => ''.e($employee_bangla->name_bangla).'','placeholder' => 'নাম','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'name_bangla','id' => 'name_bangla','class' => 'form-control-sm','value' => ''.e($employee_bangla->name_bangla).'','placeholder' => 'নাম','required' => true]); ?>
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
                                <th width="30%" style="border: none;">পিতার নাম </th>
                                <td width="70%" style="border: none;"><?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['name' => 'fname_bangla','id' => 'fname_bangla','class' => 'form-control-sm','value' => ''.e($employee_bangla->fname_bangla).'','placeholder' => 'পিতার নাম','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'fname_bangla','id' => 'fname_bangla','class' => 'form-control-sm','value' => ''.e($employee_bangla->fname_bangla).'','placeholder' => 'পিতার নাম','required' => true]); ?>
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
                                <th width="30%" style="border: none;">মাতার নাম </th>
                                <td width="70%" style="border: none;"><?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['name' => 'mname_bangla','id' => 'mname_bangla','class' => 'form-control-sm','value' => ''.e($employee_bangla->mname_bangla).'','placeholder' => 'মাতার নাম','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'mname_bangla','id' => 'mname_bangla','class' => 'form-control-sm','value' => ''.e($employee_bangla->mname_bangla).'','placeholder' => 'মাতার নাম','required' => true]); ?>
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
                                <th width="30%" style="border: none;">স্বামী/স্ত্রী</th>
                                <td width="70%" style="border: none;"><?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['name' => 'spouse_name_bangla','id' => 'spouse_name_bangla','class' => 'form-control-sm','placeholder' => 'স্বামী/স্ত্রী','value' => ''.e(old('spouse_name_bangla',$employee_bangla->spouse_name_bangla)).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'spouse_name_bangla','id' => 'spouse_name_bangla','class' => 'form-control-sm','placeholder' => 'স্বামী/স্ত্রী','value' => ''.e(old('spouse_name_bangla',$employee_bangla->spouse_name_bangla)).'']); ?>
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
                                <th style="border: none;">&nbsp; &nbsp;</th>
                                <td style="border: none;">&nbsp; &nbsp;</td>
                            </tr>
                        </table>
                    </div>

                    <div class="col-lg-4 col-md-6 pe-lg-0 pe-md-0">
                        <table class="table table-striped mb-0" id="presentAddressTable" width="100%">
                            <tr>
                                <th width="30%" style="border: none;">সনাক্ত করণ চিহ্ন</th>
                                <td width="70%" style="border: none;"><?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['name' => 'identification','id' => 'identification','class' => 'form-control-sm','placeholder' => 'সনাক্ত করণ চিহ্ন','value' => ''.e(old('identification',$employee_bangla->identification)).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'identification','id' => 'identification','class' => 'form-control-sm','placeholder' => 'সনাক্ত করণ চিহ্ন','value' => ''.e(old('identification',$employee_bangla->identification)).'']); ?>
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
                                <th width="30%" style="border: none;">আচরণ</th>
                                <td width="70%" style="border: none;"><?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['name' => 'conduct','id' => 'conduct','class' => 'form-control-sm','placeholder' => 'আচরণ','value' => ''.e(old('conduct',$employee_bangla->conduct)).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'conduct','id' => 'conduct','class' => 'form-control-sm','placeholder' => 'আচরণ','value' => ''.e(old('conduct',$employee_bangla->conduct)).'']); ?>
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
                                <th width="30%" style="border: none;">নমিনির নাম </th>
                                <td width="70%" style="border: none;"><?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['name' => 'nname_bangla','id' => 'nname_bangla','class' => 'form-control-sm','placeholder' => 'নমিনির নাম','value' => ''.e(old('nname_bangla',$employee_bangla->nname_bangla)).'','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'nname_bangla','id' => 'nname_bangla','class' => 'form-control-sm','placeholder' => 'নমিনির নাম','value' => ''.e(old('nname_bangla',$employee_bangla->nname_bangla)).'','required' => true]); ?>
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
                                <th width="30%" style="border: none;">মোবাইল নাম্বার </th>
                                <td width="70%" style="border: none;"><?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['name' => 'nmobile_number','id' => 'mobile_number','pattern' => '[0-9]{11}','oninput' => 'this.value = this.value.replace(/[^0-9.]/g, \'\').replace(/(\..*)\./g, \'$1\')','class' => 'form-control-sm','placeholder' => 'নমিনির মোবাইল নাম্বার','value' => ''.e(old('nmobile_number',$employee_bangla->nmobile_number)).'','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'nmobile_number','id' => 'mobile_number','pattern' => '[0-9]{11}','oninput' => 'this.value = this.value.replace(/[^0-9.]/g, \'\').replace(/(\..*)\./g, \'$1\')','class' => 'form-control-sm','placeholder' => 'নমিনির মোবাইল নাম্বার','value' => ''.e(old('nmobile_number',$employee_bangla->nmobile_number)).'','required' => true]); ?>
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
                                <th width="30%" style="border: none;">সম্পর্ক </th>
                                <td width="70%" style="border: none;"><?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['name' => 'nominee_relation','id' => 'nominee_relation','class' => 'form-control-sm','placeholder' => 'নমিনির সম্পর্ক','value' => ''.e(old('nominee_relation',$employee_bangla->nominee_relation)).'','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'nominee_relation','id' => 'nominee_relation','class' => 'form-control-sm','placeholder' => 'নমিনির সম্পর্ক','value' => ''.e(old('nominee_relation',$employee_bangla->nominee_relation)).'','required' => true]); ?>
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

                    <div class="col-lg-4 col-md-6 pe-lg-0 pe-md-0">
                        <table class="table table-striped mb-0" id="presentAddressTable" width="100%">
                            <h5 class="text-primary font-weight-bold">জরুরী যোগাযোগ</h5>
                            <tr>
                                <th width="30%" style="border: none;">নাম</th>
                                <td width="70%" style="border: none;"><?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['type' => 'text','name' => 'emergency_name','id' => 'emergency_name','class' => 'form-control-sm','value' => ''.e($employee_bangla->emergency_name??old('emergency_name')).'','placeholder' => 'নাম']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'text','name' => 'emergency_name','id' => 'emergency_name','class' => 'form-control-sm','value' => ''.e($employee_bangla->emergency_name??old('emergency_name')).'','placeholder' => 'নাম']); ?>
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
                                <th width="30%" style="border: none;">মোবাইল নাম্বার</th>
                                <td width="70%" style="border: none;"><?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['type' => 'text','name' => 'emergency_mobile','id' => 'emergency_mobile','pattern' => '(01)[0-9]{9}','maxlength' => '11','oninput' => 'this.value=this.value.replace(/[^0-9]/g,\'\')','class' => 'form-control-sm','value' => ''.e($employee_bangla->emergency_mobile??old('emergency_mobile')).'','placeholder' => 'মোবাইল নাম্বার']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'text','name' => 'emergency_mobile','id' => 'emergency_mobile','pattern' => '(01)[0-9]{9}','maxlength' => '11','oninput' => 'this.value=this.value.replace(/[^0-9]/g,\'\')','class' => 'form-control-sm','value' => ''.e($employee_bangla->emergency_mobile??old('emergency_mobile')).'','placeholder' => 'মোবাইল নাম্বার']); ?>
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
                                <th width="30%" style="border: none;">সম্পর্ক</th>
                                <td width="70%" style="border: none;"><?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['type' => 'text','name' => 'emergency_relation','id' => 'emergency_relation','class' => 'form-control-sm','value' => ''.e($employee_bangla->emergency_relation??old('emergency_relation')).'','placeholder' => 'সম্পর্ক']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'text','name' => 'emergency_relation','id' => 'emergency_relation','class' => 'form-control-sm','value' => ''.e($employee_bangla->emergency_relation??old('emergency_relation')).'','placeholder' => 'সম্পর্ক']); ?>
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
                                <th width="30%" style="border: none;">ঠিকানা</th>
                                <td width="70%" style="border: none;"><?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['type' => 'text','name' => 'emergency_address','id' => 'emergency_address','class' => 'form-control-sm','value' => ''.e($employee_bangla->emergency_address??old('emergency_address')).'','placeholder' => 'ঠিকানা']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'text','name' => 'emergency_address','id' => 'emergency_address','class' => 'form-control-sm','value' => ''.e($employee_bangla->emergency_address??old('emergency_address')).'','placeholder' => 'ঠিকানা']); ?>
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
                </div>

                <div class="row mt-4" style="border: 1px dotted #2f2f30; padding: 8px 0px;">
                    <div class="col-lg-4 col-md-6 pe-lg-0 pe-md-0">
                        <table class="table table-striped mb-0" id="employeeTable" width="100%">
                            <h5 class="text-primary font-weight-bold">বর্তমান ঠিকানা</h5>
                            <tr>
                                <th width="30%" style="border: none;">জেলা </th>
                                <td width="70%" style="border: none;"><?php if (isset($component)) { $__componentOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-input','data' => ['name' => 'pdistrict_id_bangla','id' => 'pdistrict_id_bangla','class' => 'select2','options' => $districts,'selected' => ''.e($employee_bangla->pdistrict_id_bangla).'','value' => ''.e(old('pdistrict_id_bangla',$employee_bangla->pdistrict_id_bangla)).'','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'pdistrict_id_bangla','id' => 'pdistrict_id_bangla','class' => 'select2','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($districts),'selected' => ''.e($employee_bangla->pdistrict_id_bangla).'','value' => ''.e(old('pdistrict_id_bangla',$employee_bangla->pdistrict_id_bangla)).'','required' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36)): ?>
<?php $attributes = $__attributesOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36; ?>
<?php unset($__attributesOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36)): ?>
<?php $component = $__componentOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36; ?>
<?php unset($__componentOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36); ?>
<?php endif; ?></td>
                            </tr>
                            <tr>
                                <th width="30%" style="border: none;">থানা </th>
                                <td width="70%" style="border: none;">
                                    <?php if (isset($component)) { $__componentOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-input','data' => ['name' => 'pthana_id_bangla','id' => 'pthana_id_bangla','class' => 'select2','options' => $thanas,'selected' => ''.e($employee_bangla->pthana_id_bangla).'','value' => ''.e(old('pthana_id_bangla',$employee_bangla->pthana_id_bangla)).'','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'pthana_id_bangla','id' => 'pthana_id_bangla','class' => 'select2','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($thanas),'selected' => ''.e($employee_bangla->pthana_id_bangla).'','value' => ''.e(old('pthana_id_bangla',$employee_bangla->pthana_id_bangla)).'','required' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36)): ?>
<?php $attributes = $__attributesOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36; ?>
<?php unset($__attributesOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36)): ?>
<?php $component = $__componentOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36; ?>
<?php unset($__componentOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36); ?>
<?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <th width="30%" style="border: none;">ডাকঘর </th>
                                <td width="70%" style="border: none;">
                                    <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['name' => 'ppost_office_bangla','id' => 'ppost_office_bangla','class' => 'form-control-sm','value' => ''.e($employee_bangla->ppost_office_bangla).'','placeholder' => 'ডাকঘর','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'ppost_office_bangla','id' => 'ppost_office_bangla','class' => 'form-control-sm','value' => ''.e($employee_bangla->ppost_office_bangla).'','placeholder' => 'ডাকঘর','required' => true]); ?>
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
                            </tr>
                            <tr>
                                <th width="30%" style="border: none;">বাড়ি নং/রাস্তা নং /গ্রাম </th>
                                <td width="70%" style="border: none;">
                                    <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['name' => 'pvillage_bangla','id' => 'pvillage_bangla','class' => 'form-control-sm','value' => ''.e($employee_bangla->pvillage_bangla).'','placeholder' => 'বাড়ি নং/রাস্তা নং /গ্রাম','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'pvillage_bangla','id' => 'pvillage_bangla','class' => 'form-control-sm','value' => ''.e($employee_bangla->pvillage_bangla).'','placeholder' => 'বাড়ি নং/রাস্তা নং /গ্রাম','required' => true]); ?>
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
                            </tr>
                        </table>
                    </div>

                    <div class="col-lg-4 col-md-6 pe-lg-0 pe-md-0">
                        <table class="table table-striped mb-0" id="employeeTable" width="100%">
                            <h5 class="text-primary font-weight-bold">স্থায়ী ঠিকানা</h5>
                            <tr>
                                <th width="30%" style="border: none;">জেলা </th>
                                <td width="70%" style="border: none;"><?php if (isset($component)) { $__componentOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-input','data' => ['name' => 'mdistrict_id_bangla','id' => 'mdistrict_id_bangla','class' => 'select2','options' => $districts,'selected' => ''.e($employee_bangla->mdistrict_id_bangla).'','value' => ''.e(old('mdistrict_id_bangla',$employee_bangla->mdistrict_id_bangla)).'','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'mdistrict_id_bangla','id' => 'mdistrict_id_bangla','class' => 'select2','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($districts),'selected' => ''.e($employee_bangla->mdistrict_id_bangla).'','value' => ''.e(old('mdistrict_id_bangla',$employee_bangla->mdistrict_id_bangla)).'','required' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36)): ?>
<?php $attributes = $__attributesOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36; ?>
<?php unset($__attributesOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36)): ?>
<?php $component = $__componentOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36; ?>
<?php unset($__componentOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36); ?>
<?php endif; ?></td>
                            </tr>
                            <tr>
                                <th width="30%" style="border: none;">থানা </th>
                                <td width="70%" style="border: none;">
                                    <?php if (isset($component)) { $__componentOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-input','data' => ['name' => 'mthana_id_bangla','id' => 'mthana_id_bangla','class' => 'select2','options' => $thanas,'selected' => ''.e($employee_bangla->mthana_id_bangla).'','value' => ''.e(old('mthana_id_bangla',$employee_bangla->mthana_id_bangla)).'','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'mthana_id_bangla','id' => 'mthana_id_bangla','class' => 'select2','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($thanas),'selected' => ''.e($employee_bangla->mthana_id_bangla).'','value' => ''.e(old('mthana_id_bangla',$employee_bangla->mthana_id_bangla)).'','required' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36)): ?>
<?php $attributes = $__attributesOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36; ?>
<?php unset($__attributesOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36)): ?>
<?php $component = $__componentOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36; ?>
<?php unset($__componentOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36); ?>
<?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <th width="30%" style="border: none;">ডাকঘর </th>
                                <td width="70%" style="border: none;">
                                    <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['name' => 'mpost_office_bangla','id' => 'mpost_office_bangla','class' => 'form-control-sm','value' => ''.e($employee_bangla->mpost_office_bangla).'','placeholder' => 'ডাকঘর','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'mpost_office_bangla','id' => 'mpost_office_bangla','class' => 'form-control-sm','value' => ''.e($employee_bangla->mpost_office_bangla).'','placeholder' => 'ডাকঘর','required' => true]); ?>
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
                            </tr>
                            <tr>
                                <th width="30%" style="border: none;">বাড়ি নং/রাস্তা নং /গ্রাম </th>
                                <td width="70%" style="border: none;">
                                    <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['name' => 'mvillage_bangla','id' => 'mvillage_bangla','class' => 'form-control-sm','value' => ''.e($employee_bangla->mvillage_bangla).'','placeholder' => 'বাড়ি নং/রাস্তা নং /গ্রাম','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'mvillage_bangla','id' => 'mvillage_bangla','class' => 'form-control-sm','value' => ''.e($employee_bangla->mvillage_bangla).'','placeholder' => 'বাড়ি নং/রাস্তা নং /গ্রাম','required' => true]); ?>
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
                            </tr>
                        </table>
                    </div>

                    <div class="col-lg-4 col-md-6 pe-lg-0 pe-md-0">
                        <table class="table table-striped mb-0" id="employeeTable" width="100%">
                            <h5 class="text-primary font-weight-bold">নমিনির ঠিকানা</h5>
                            <tr>
                                <th width="30%" style="border: none;">জেলা </th>
                                <td width="70%" style="border: none;"><?php if (isset($component)) { $__componentOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-input','data' => ['name' => 'ndistrict_id_bangla','id' => 'ndistrict_id_bangla','class' => 'select2','options' => $districts,'selected' => ''.e($employee_bangla->ndistrict_id_bangla).'','value' => ''.e(old('ndistrict_id_bangla',$employee_bangla->ndistrict_id_bangla)).'','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'ndistrict_id_bangla','id' => 'ndistrict_id_bangla','class' => 'select2','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($districts),'selected' => ''.e($employee_bangla->ndistrict_id_bangla).'','value' => ''.e(old('ndistrict_id_bangla',$employee_bangla->ndistrict_id_bangla)).'','required' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36)): ?>
<?php $attributes = $__attributesOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36; ?>
<?php unset($__attributesOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36)): ?>
<?php $component = $__componentOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36; ?>
<?php unset($__componentOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36); ?>
<?php endif; ?></td>
                            </tr>
                            <tr>
                                <th width="30%" style="border: none;">থানা </th>
                                <td width="70%" style="border: none;">
                                    <?php if (isset($component)) { $__componentOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-input','data' => ['name' => 'nthana_id_bangla','id' => 'nthana_id_bangla','class' => 'select2','options' => $thanas,'selected' => ''.e($employee_bangla->nthana_id_bangla).'','value' => ''.e(old('nthana_id_bangla',$employee_bangla->nthana_id_bangla)).'','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'nthana_id_bangla','id' => 'nthana_id_bangla','class' => 'select2','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($thanas),'selected' => ''.e($employee_bangla->nthana_id_bangla).'','value' => ''.e(old('nthana_id_bangla',$employee_bangla->nthana_id_bangla)).'','required' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36)): ?>
<?php $attributes = $__attributesOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36; ?>
<?php unset($__attributesOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36)): ?>
<?php $component = $__componentOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36; ?>
<?php unset($__componentOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36); ?>
<?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <th width="30%" style="border: none;">ডাকঘর </th>
                                <td width="70%" style="border: none;">
                                    <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['name' => 'npost_office_bangla','id' => 'npost_office_bangla','class' => 'form-control-sm','value' => ''.e($employee_bangla->npost_office_bangla).'','placeholder' => 'ডাকঘর']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'npost_office_bangla','id' => 'npost_office_bangla','class' => 'form-control-sm','value' => ''.e($employee_bangla->npost_office_bangla).'','placeholder' => 'ডাকঘর']); ?>
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
                            </tr>
                            <tr>
                                <th width="30%" style="border: none;">বাড়ি নং/রাস্তা নং /গ্রাম </th>
                                <td width="70%" style="border: none;">
                                    <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['name' => 'nvillage_bangla','id' => 'nvillage_bangla','class' => 'form-control-sm','value' => ''.e($employee_bangla->nvillage_bangla).'','placeholder' => 'বাড়ি নং/রাস্তা নং /গ্রাম']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'nvillage_bangla','id' => 'nvillage_bangla','class' => 'form-control-sm','value' => ''.e($employee_bangla->nvillage_bangla).'','placeholder' => 'বাড়ি নং/রাস্তা নং /গ্রাম']); ?>
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
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer mb-4" style="padding:10px 10px;">
        <?php if (isset($component)) { $__componentOriginald411d1792bd6cc877d687758b753742c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald411d1792bd6cc877d687758b753742c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.primary-button','data' => ['class' => 'float-start btn-sm submitBtn']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('primary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'float-start btn-sm submitBtn']); ?><?php echo e($employee_bangla->employee_id ?? '' ? 'Update' : 'Save'); ?> <?php echo $__env->renderComponent(); ?>
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
<?php /**PATH D:\laragon\www\new erp\garments_erp\Modules\HRIS\resources\views\database\employee\tab10.blade.php ENDPATH**/ ?>