
<?php $__env->startSection('title', 'Order Management'); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <?php echo $__env->make('components.breadcrumb', [
                'title' => 'Order Management',
                'subtitle' => 'Team Members',
                'breadcrumbs' => [
                    ['label' => 'Order Management', 'url' => route('ordermanagement.index')],
                    ['label' => 'Setup', 'url' => route('ordermanagement.index')],
                    ['label' => 'Team Members', 'url' => route('ordermanagement.setup.teammembers.index')],
                ],
            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
        <div class="col-md-8">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Team Members List</h6>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap w-100" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Team Name</th>
                                <th>Leader</th>
                                <th>Assistant</th>
                                <th>Members</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $teams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $team): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $leader = $team->members->where('is_leader', 1)->first();
                                    $assistant = $team->members->where('is_assistant', 1)->first();
                                    // Use ALL members for the list/count, but you might want to differentiate them in the tooltip
                                    $members = $team->members; 
                                ?>
                                <tr id="row-<?php echo e($team->id); ?>">
                                    <td><?php echo e($key + 1); ?></td>
                                    <td><?php echo e($team->team_name); ?></td>
                                    <td><?php echo e($leader && $leader->merchant ? $leader->merchant->name : 'N/A'); ?></td>
                                    <td><?php echo e($assistant && $assistant->merchant ? $assistant->merchant->name : 'N/A'); ?></td>
                                    <td>
                                        <?php if($members->count() > 0): ?>
                                            <span class="badge bg-info" data-bs-toggle="tooltip" title="<?php echo e($members->map(function($m) { 
                                                $name = $m->merchant ? $m->merchant->name : '';
                                                if($m->is_leader) $name .= ' (Leader)';
                                                if($m->is_assistant) $name .= ' (Assistant)';
                                                return $name;
                                            })->join(', ')); ?>">
                                                <?php echo e($members->count()); ?> Members
                                            </span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary">0 Members</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="square-switch">
                                            <input type="checkbox" id="switch-<?php echo e($team->id); ?>"
                                                class="toggle-status" data-id="<?php echo e($team->id); ?>"
                                                switch="bool" <?php echo e($team->is_active ? 'checked' : ''); ?> />
                                            <label for="switch-<?php echo e($team->id); ?>" data-on-label="Yes"
                                                data-off-label="No"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-soft-success waves-effect waves-light"
                                            style="padding: 4px 6px;" data-bs-toggle="modal"
                                            data-bs-target="#editModal<?php echo e($team->id); ?>"><i class="fas fa-edit"></i></a>
                                        
                                        <a href="#" class="btn btn-soft-danger waves-effect waves-light delete-item"
                                           data-id="<?php echo e($team->id); ?>" style="padding: 4px 6px;"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>

                                
                                <div class="modal fade" id="editModal<?php echo e($team->id); ?>" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Team Assignments</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="<?php echo e(route('ordermanagement.setup.teammembers.update', $team->id)); ?>" method="POST">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('PUT'); ?>
                                                    
                                                    <div class="mb-3">
                                                        <label class="form-label">Team</label>
                                                        <input type="text" class="form-control" value="<?php echo e($team->team_name); ?>" disabled>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Leader</label>
                                                        <select name="leader_id" class="form-control select2" style="width: 100%;">
                                                            <option value="">Select Leader</option>
                                                            <?php $__currentLoopData = $merchants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $merchant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($merchant->id); ?>" <?php echo e(($leader && $leader->merchant_id == $merchant->id) ? 'selected' : ''); ?>>
                                                                    <?php echo e($merchant->name); ?> (<?php echo e($merchant->employee_id); ?>)
                                                                </option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Assistant</label>
                                                        <select name="assistant_id" class="form-control select2" style="width: 100%;">
                                                            <option value="">Select Assistant</option>
                                                            <?php $__currentLoopData = $merchants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $merchant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($merchant->id); ?>" <?php echo e(($assistant && $assistant->merchant_id == $merchant->id) ? 'selected' : ''); ?>>
                                                                    <?php echo e($merchant->name); ?> (<?php echo e($merchant->employee_id); ?>)
                                                                </option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                    </div>
                                                    
                                                    <div class="mb-3">
                                                        <label class="form-label">Members</label>
                                                        <select name="member_ids[]" class="form-control select2" multiple="multiple" style="width: 100%;">
                                                            <?php $__currentLoopData = $merchants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $merchant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($merchant->id); ?>" 
                                                                    <?php echo e($members->contains('merchant_id', $merchant->id) ? 'selected' : ''); ?>>
                                                                    <?php echo e($merchant->name); ?> (<?php echo e($merchant->employee_id); ?>)
                                                                </option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                    </div>

                                                    <button type="submit" class="btn btn-primary btn-sm float-start">Save Changes</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card alert-info alert-top-border">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i class="mdi mdi-account-multiple-plus"></i> Assign Members to Team</h6>
                </div>
                <div class="card-body">
                    <form id="createForm" action="<?php echo e(route('ordermanagement.setup.teammembers.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        
                        <div class="mb-3">
                            <label class="form-label">Select Team <span class="text-danger">*</span></label>
                            <select name="team_id" class="form-control select2" required>
                                <option value="">Select Team</option>
                                <?php $__currentLoopData = $teams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($t->id); ?>" <?php echo e(old('team_id') == $t->id ? 'selected' : ''); ?>>
                                        <?php echo e($t->team_name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Leader</label>
                            <select name="leader_id" class="form-control select2">
                                <option value="">Select Leader</option>
                                <?php $__currentLoopData = $merchants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $merchant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($merchant->id); ?>" <?php echo e(old('leader_id') == $merchant->id ? 'selected' : ''); ?>>
                                        <?php echo e($merchant->name); ?> (<?php echo e($merchant->employee_id); ?>)
                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Assistant</label>
                            <select name="assistant_id" class="form-control select2">
                                <option value="">Select Assistant</option>
                                <?php $__currentLoopData = $merchants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $merchant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($merchant->id); ?>" <?php echo e(old('assistant_id') == $merchant->id ? 'selected' : ''); ?>>
                                        <?php echo e($merchant->name); ?> (<?php echo e($merchant->employee_id); ?>)
                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Members</label>
                            <select name="member_ids[]" class="form-control select2" multiple="multiple">
                                <?php $__currentLoopData = $merchants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $merchant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($merchant->id); ?>" <?php echo e((collect(old('member_ids'))->contains($merchant->id)) ? 'selected' : ''); ?>>
                                        <?php echo e($merchant->name); ?> (<?php echo e($merchant->employee_id); ?>)
                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary btn-sm float-start">Assign Members</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        $(document).ready(function() {
            // Init for Create form
            $('#createForm .select2').select2({
                placeholder: "Select...",
                allowClear: true,
                width: '100%'
            });

            // Init for Edit modals
            $('.modal').on('shown.bs.modal', function () {
                $(this).find('.select2').select2({
                    dropdownParent: $(this),
                    allowClear: true,
                    width: '100%'
                });
            });

            // Toggle Status
            $('.toggle-status').on('change', function() {
                let id = $(this).data('id');
                let status = $(this).is(':checked') ? 1 : 0;

                $.ajax({
                    url: '<?php echo e(route('ordermanagement.setup.teammembers.toggle')); ?>',
                    type: 'POST',
                    data: {
                        id: id,
                        status: status,
                        _token: '<?php echo e(csrf_token()); ?>'
                    },
                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.message);
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        toastr.error('Something went wrong!');
                    }
                });
            });

            // Delete (Clear Assignments)
            $(document).on('click', '.delete-item', function(e) {
                e.preventDefault();
                let id = $(this).data('id');
                Swal.fire({
                    title: 'Clear Assignments?',
                    text: "This will remove all members from this team. The team itself will remain.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, clear it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '<?php echo e(route('ordermanagement.setup.teammembers.delete')); ?>',
                            type: 'POST',
                            data: {
                                _token: '<?php echo e(csrf_token()); ?>',
                                id: id
                            },
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire(
                                        'Cleared!',
                                        response.message,
                                        'success'
                                    ).then(() => {
                                        location.reload();
                                    });
                                } else {
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
                    }
                });
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\garments_erp\Modules\OrderManagement\resources\views\setup\teammembers\index.blade.php ENDPATH**/ ?>