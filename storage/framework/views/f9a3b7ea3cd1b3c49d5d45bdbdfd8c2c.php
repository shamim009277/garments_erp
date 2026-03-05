<?php $__env->startSection('title', 'INVENTORY'); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <?php echo $__env->make('components.breadcrumb', [
                'title' => 'INVENTORY',
                'subtitle' => 'Requisition Final Approval',
                'breadcrumbs' => [
                    ['label' => 'INVENTORY', 'url' => route('inventory.index')],
                    ['label' => 'Database', 'url' => route('inventory.index')],
                    ['label' => 'Requisition Final Approval', 'url' => route('inventory.database.reqfinalapproval.index')],
                ],
            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
        <div class="col-12 mb-3">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                <!-- Centered Title -->
                <h4 class="text-center flex-grow-1 order-1 order-md-0 mb-2 mb-md-0">
                    Requisition Final Approval
                </h4>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <i data-feather="list" width="16" height="16"></i> 
                        <h6 class="my-0 text-primary ms-2">Purchase Requisition List</h6>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="input-group">
                                <input type="text" name="search" id="search"  class="form-control form-control-sm" placeholder="Search here...">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                            </div>
                        </div>
                        <div class="col-sm-12 d-flex align-items-center mt-2">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="pending" value="1" checked>
                                <label class="form-check-label" for="pending">PENDING</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="done" value="2">
                                <label class="form-check-label" for="done">DONE</label>
                            </div>
                        </div>
                        
                    </div>
                    
                    
                </div>
                <div class="card-body">
                    <ul class="list-group" style="min-height: 650px; overflow-y: auto;" id="purrequisition-list">
                        <?php $__currentLoopData = $purrequisitions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $purrequisition): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="list-group-item list-group-item-action p-2 border-0 pur-main" data-id="<?php echo e($purrequisition->id); ?>"><?php echo e($purrequisition->req_date); ?> - <?php echo e($purrequisition->requisition_no); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-12">
                    <div class="card alert-info alert-top-border padding-card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="d-flex align-items-center">
                                        <i data-feather="list" width="16" height="16"></i> 
                                        <h6 class="my-0 text-primary ms-2"> Input Parameters For Purchase Requisition..</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6"> 
                                    <table width="100%">
                                        <tr>
                                            <th width="35%">Requisition No</th>
                                            <td width="65%">
                                                <input type="hidden" id="req_no">
                                                <input type="hidden" id="u_req_id" name="u_req_id">
                                                :<span id="requisition_no-txt"></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th width="35%">Requisition Date</th>
                                            <td width="65%">
                                                :<span id="requisition_date-txt"></span>
                                            </td>
                                        </tr>
                                        <tr >
                                            <th width="35%">Required By</th>
                                            <td width="65%">
                                                :<span id="required_by-txt"></span>
                                            </td>
                                        </tr>
                                        <tr >
                                            <th width="35%">Purpose of Requisition <span style="color: red">*</span></th>
                                            <td width="65%">
                                                :<span id="purpose-txt"></span>
                                                
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-sm-6">
                                    <table width="100%">
                                        <tr >
                                            <th width="35%">Organization <span style="color: red">*</span></th>
                                            <td width="65%">
                                                :<span id="organization-txt"></span>
                                            </td>
                                        </tr>
                                        <tr >
                                            <th width="35%">Receiving Store <span style="color: red">*</span></th>
                                            <td width="65%">
                                                :<span id="store-txt"></span>
                                            </td>
                                        </tr>
                                        <tr >
                                            <th width="35%">Note</th>
                                            <td width="65%">
                                                :<span id="note-txt"></span>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card alert-info alert-top-border padding-card">
                        <div class="card-header">
                        </div>
                        <div class="card-body" style="min-height: 300px;">
                            <table class="table table-bordered dt-responsive  nowrap w-100 text-center p-2" width="100%">
                                <thead>
                                    <tr class="p-0">
                                        <th width="5%">#SL</th>
                                        <th width="20%">Name</th>
                                        <th width="10%">Unit</th>
                                        <th width="10%">Purchase Unit</th>
                                        <th width="10%">Approved Quantity</th>
                                        <th width="10%">Final Approved Quantity</th>
                                        <th width="10%">Approximate Price</th>
                                        <th width="10%">Total</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="item-row">
                                   
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-success btn-sm float-end me-2 d-none" id="done-btn">
                                Forward
                            </button>
                            <button type="button" class="btn btn-danger btn-sm float-end me-2 d-none" id="undo-btn">
                                Undo
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script>
        $(document).ready(function() {


            (function(){
                $('#req_no').val('');
                $('#u_req_id').val('');
                $('#u_req_date').val('');
                $('#u_required_by').val('');
                $('#u_required_by_id').val('');
                $('#u_purpose').val('');
                $('#u_organization_id').val('');
                $('#u_store_id').val('');
                $('#u_note').val('');
                $('#search_data').val('');
                $('#item-row').html('');
                $('input[name="status"][value="1"]').prop('checked', true);

            })()


            $("#done-btn").click(function() {
                let req_id = $('#u_req_id').val();
                $.ajax({
                    type: 'PUT',
                    url: "<?php echo e(url('inventory/database/reqfinalapproval/multiplestatus')); ?>/"+req_id,
                    data: {
                        is_fapproved: 1,
                        _token: "<?php echo e(csrf_token()); ?>"
                    },
                    success: function(data) {
                        console.log(data);
                        getReqMain(req_id);
                        searchRequisition(2, '');
                        $('input[name="status"][value="2"]').prop('checked', true);
                        $('input[name="status"][value="1"]').prop('checked', false);
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            })



            $("#undo-btn").click(function() {
                let req_id = $('#u_req_id').val();
                $.ajax({
                    type: 'PUT',
                    url: "<?php echo e(url('inventory/database/reqfinalapproval/multiplestatus')); ?>/"+req_id,
                    data: {
                        is_fapproved: 0,
                        _token: "<?php echo e(csrf_token()); ?>"
                    },
                    success: function(data) {
                        console.log(data);
                        getReqMain(req_id);
                        searchRequisition(1, '');
                        $('input[name="status"][value="1"]').prop('checked', true);
                        $('input[name="status"][value="2"]').prop('checked', false);
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            })


            function updateItem(id){
                let for_qty = $('#for_qty_'+id).val();
                let aprx_priced = $('#aprx_priced_'+id).val();
                let total_value = Number(for_qty) * Number(aprx_priced);
                $.ajax({
                    type: 'PUT',
                    url: "<?php echo e(url('inventory/database/purrequisitiondetails')); ?>/"+id,
                    data: {
                        final_app_qty: for_qty,
                        aprx_priced: aprx_priced,
                        total_value: total_value,
                        _token: "<?php echo e(csrf_token()); ?>"
                    },
                    success: function(data) {
                        console.log(data);
                        $('#for_qty_'+id).val(Number(data.data.final_app_qty).toFixed(2));
                        $('#aprx_priced_'+id).val(Number(data.data.aprx_priced).toFixed(2));
                        $('#total_value_'+id).text(Number(data.data.total_value).toFixed(2));
                        toastr.success('Item updated successfully');
                    },
                    error: function(data) {
                        console.log(data);
                        toastr.error('Something went wrong!');
                    }
                });
            }


            function removeItem(id){
                let req_id = $('#u_req_id').val();
                $.ajax({
                    type: 'PUT',
                    url: "<?php echo e(url('inventory/database/purrequisitiondetails')); ?>/"+id,
                    data: {
                        is_rejected: 1,
                        rejected_stage: 3,
                        rejected_date: "<?php echo e($today_date); ?>",
                        rejected_by: "<?php echo e(Auth::user()->id); ?>",
                        _token: "<?php echo e(csrf_token()); ?>"
                    },
                    success: function(data) {
                        console.log(data);
                        getReqMain(req_id);
                        toastr.success('Item updated successfully');
                    },
                    error: function(data) {
                        console.log(data);
                        toastr.error('Something went wrong!');
                    }
                });
            }

            function allowItem(id){
                let req_id = $('#u_req_id').val();
                $.ajax({
                    type: 'PUT',
                    url: "<?php echo e(url('inventory/database/purrequisitiondetails')); ?>/"+id,
                    data: {
                        is_rejected: 0,
                        rejected_stage: 0,
                        rejected_date: "",
                        rejected_by: "",
                        _token: "<?php echo e(csrf_token()); ?>"
                    },
                    success: function(data) {
                        console.log(data);
                        getReqMain(req_id);
                        toastr.success('Item updated successfully');
                    },
                    error: function(data) {
                        console.log(data);
                        toastr.error('Something went wrong!');
                    }
                });
            }


          

            function getReqMain(id){
                $.ajax({
                    type: 'GET',
                    url: "<?php echo e(url('inventory/database/purrequisitionmains')); ?>/"+id,
                    success: function(data) {
                        console.log(data);
                        mainData = data.reqMain;
                        detailsData = data.reqDetails;
                        $('#requisition_no-txt').text(mainData.requisition_no);
                        $('#req_no').val(mainData.requisition_no);
                        $('#requisition_date-txt').text(mainData.req_date);
                        $('#required_by-txt').text(mainData.required_by.name);
                        $('#purpose-txt').text(mainData.purpose);
                        $('#organization-txt').text(mainData.organization.name);
                        $('#store-txt').text(mainData.store.name);
                        $('#note-txt').text(mainData.note);
                        $('#u_req_id').val(mainData.id);
                        $('#u_req_date').val(mainData.req_date);
                        $('#u_required_by').val(mainData.required_by.name);
                        $('#u_required_by_id').val(mainData.required_by_id);
                        $('#u_purpose').val(mainData.purpose);
                        $('#u_organization_id').val(mainData.organization_id);
                        $('#u_store_id').val(mainData.store_id);
                        $('#u_note').val(mainData.note);
                        if(mainData.is_fapproved == 1){
                            $('#done-btn').addClass('d-none');
                            $('#undo-btn').removeClass('d-none');
                        }else{
                            $('#done-btn').removeClass('d-none');
                            $('#undo-btn').addClass('d-none');
                        }
                        
                        
                        $('#item-row').html('');
                        $.each(detailsData, function(key, value) {
                            let unit = data.units.find(u => u.id == value.item.unit_id);
                            let pur_units = data.units.filter(u => u.unit_standards == unit.unit_standards);
                            console.log(pur_units);
                            if(value.is_rejected == 1 && value.rejected_stage != 3){
                                
                            }else{
                                if(mainData.is_fapproved == 1){
                                    if(value.is_rejected == 1){
                                        element = 'Rejected';
                                    }else{
                                        element = 'N\\A';
                                    }
                                }else if(mainData.is_fapproved == 0){
                                    if(value.rejected_stage == 3){
                                        element = `<button type="button" data-id="${value.id}" class="btn btn-success btn-sm p-1 allow-item">Allow</button>`;
                                    }else{
                                        element = `<button type="button" data-id="${value.id}" class="btn btn-info btn-sm p-1 update-item">Update</button>
                                            <button type="button" data-id="${value.id}" class="btn btn-danger btn-sm p-1 remove-item">Reject</button>`;
                                    }
                                }
                                $('#item-row').append(`
                                <tr>
                                    <td>${key + 1}</td>
                                    <td>${value.item.item_name}</td>
                                    <td>${unit.name}</td>
                                    <td>${value.pur_unit.name}</td>
                                    <td>${value.app_qty?value.app_qty:0}</td>
                                    <td><input type="text" class="form-control form-control-sm fupdate-item" data-id="${value.id}" id="for_qty_${value.id}" value="${value.final_app_qty?value.final_app_qty:0}"></td>
                                    <td><input type="text" class="form-control form-control-sm fupdate-item" data-id="${value.id}" id="aprx_priced_${value.id}" value="${value.aprx_priced?value.aprx_priced:0}"></td>
                                    <td id="total_value_${value.id}">${value.total_value?value.total_value:0}</td>
                                    <td>
                                        ${element}
                                    </td>
                                </tr>
                            `);
                            }
                        });
                        $('.fupdate-item').off('keyup').on('keyup', function() {
                            let id = $(this).data('id');
                            let for_qty = $('#for_qty_'+id).val();
                            let aprx_priced = $('#aprx_priced_'+id).val();
                            let total_value = Number(for_qty) * Number(aprx_priced);
                            $('#total_value_'+id).text(total_value.toFixed(2));
                        });

                        $('.fupdate-item').off('onchange').on('onchange', function() {
                            let id = $(this).data('id');
                            let for_qty = $('#for_qty_'+id).val();
                            let aprx_priced = $('#aprx_priced_'+id).val();
                            let total_value = Number(for_qty) * Number(aprx_priced);
                            $('#total_value_'+id).text(total_value.toFixed(2));
                        });

                        $('.update-item').off('click').on('click', function() {
                            let id = $(this).data('id');
                            updateItem(id);
                        });

                        $('.remove-item').off('click').on('click', function() {
                            let id = $(this).data('id');
                            removeItem(id);
                        });
                        $('.allow-item').off('click').on('click', function() {
                            let id = $(this).data('id');
                            allowItem(id);
                        });
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            }

            $('.pur-main').off('click').on('click', function() {
                let id = $(this).data('id');
                $(".pur-main").removeClass("active");
                $(this).addClass("active");
                getReqMain(id);
            });

            function searchRequisition(match, search) {
                let reqNo = $('#req_no').val();
                $.ajax({
                    type: 'PUT',
                    url: "<?php echo e(route('inventory.database.reqfinalapproval.search')); ?>",
                    data: {
                        search: search,
                        match: match,
                        _token: "<?php echo e(csrf_token()); ?>"
                    },
                    success: function(data) {
                        console.log(data);
                        $('#purrequisition-list').empty();
                        if(data.length == 0) {
                            $('#purrequisition-list').append('<li class="list-group-item list-group-item-action p-2 border-0 text-center">No Data Found</li>');
                        }else{
                            $.each(data, function(key, value) {
                                $('#purrequisition-list').append(`<li class="list-group-item list-group-item-action p-2 border-0 pur-main ${reqNo == value.requisition_no ? 'active' : ''}" data-id="${value.id}">${value.req_date} - ${value.requisition_no}</li>`);
                            });
                        }
                        $('.pur-main').off('click').on('click', function() {
                            let id = $(this).data('id');
                            $(".pur-main").removeClass("active");
                            $(this).addClass("active");
                            getReqMain(id);
                        });
                        // $('#search_data').html(data);
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            }

            $('#search').on('keyup', function() {
                let search = $(this).val();
                if(search.length >= 3 && search != '' && search != null) {
                    searchRequisition(3, search);
                }else{
                    let match = $('input[name="status"]:checked').val();
                    searchRequisition(match, search);
                }
            });


            $('input[name="status"]').off('change').on('change', function() {
                let match = $('input[name="status"]:checked').val();
                searchRequisition(match, '');
            }); 

           
            
            $('[data-toggle="tooltip"]').tooltip()

    
            

            $('.forapppannel-toggle').on('change', function() {
                let id = $(this).data('id');
                let status = $(this).is(':checked') ? 1 : 0;
                $.ajax({
                    url: '<?php echo e(route('inventory.setup.forapppannel.toggle')); ?>',
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
        });

        $(document).on('click', '.delete-forapppannel', function(e) {
            e.preventDefault();
            let forapppannelId = $(this).data('id');
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
                        url: '<?php echo e(route('inventory.setup.forapppannel.delete')); ?>',
                        type: 'POST',
                        data: {
                            _token: '<?php echo e(csrf_token()); ?>',
                            id: forapppannelId
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                'Forward Approve Pannel has been deleted.',
                                'success'
                            );
                            $('#row-' + forapppannelId).remove();
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
                        'Forward Approve Pannel has not been deleted.',
                        'error'
                    );
                }
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\garments_erp\Modules\Inventory\resources\views\database\reqfinalapproval\index.blade.php ENDPATH**/ ?>