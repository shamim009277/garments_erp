<?php $__env->startSection('title', 'INVENTORY'); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <?php echo $__env->make('components.breadcrumb', [
                'title' => 'INVENTORY',
                'subtitle' => 'Quality (Gate)',
                'breadcrumbs' => [
                    ['label' => 'INVENTORY', 'url' => route('inventory.index')],
                    ['label' => 'Database', 'url' => route('inventory.index')],
                    ['label' => 'Purchase MRR', 'url' => route('inventory.database.gatepurmrr.index')],
                ],
            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
        <div class="col-12 mb-3">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                <!-- Centered Title -->
                <h4 class="text-center flex-grow-1 order-1 order-md-0 mb-2 mb-md-0">
                    Quality (Gate)
                </h4>

            </div>
        </div>
        <div class="col-md-3">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <i data-feather="list" width="16" height="16"></i> 
                        <h6 class="my-0 text-primary ms-2">Purchase MRR List</h6>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="input-group">
                                <input type="text" name="search" id="search"  class="form-control form-control-sm" placeholder="Search here...">
                                <input type="hidden" id="u_mrr_id" name="u_mrr_id">

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
                    <ul class="list-group" style="min-height: 650px; overflow-y: auto;" id="gatepurmrr-list">
                        <?php $__currentLoopData = $gatepurmrrs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gatepurmrr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="list-group-item list-group-item-action p-2 border-0 pur-main" data-id="<?php echo e($gatepurmrr->id); ?>"><?php echo e($gatepurmrr->mrr_date); ?> - <?php echo e($gatepurmrr->mrr_no); ?></li>
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
                                        <h6 class="my-0 text-primary ms-2"> Information For Purchase Mrr..</h6>
                                    </div>
                                    
                                </div>
                                <div class="col-sm-6">
                                   
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6"> 
                                    <table width="100%">
                                        <tr>
                                            <th width="35%">Mrr No</th>
                                            <td width="65%">
                                                <input type="hidden" id="mrr_no">
                                                :<span id="mrr_no-txt"></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th width="35%">Mrr Date</th>
                                            <td width="65%">
                                                :<span id="mrr_date-txt"></span>
                                            </td>
                                        </tr>
                                        <tr >
                                            <th width="35%">Gate Entry By</th>
                                            <td width="65%">
                                                :<span id="gate_entry_by-txt"></span>
                                            </td>
                                        </tr>
                                        <tr >
                                            <th width="35%">Received By</th>
                                            <td width="65%">
                                                :<span id="received_by-txt"></span>
                                            </td>
                                        </tr>
                                        <tr >
                                            <th width="35%">Vehicle No</th>
                                            <td width="65%">
                                                :<span id="vehicle_no-txt"></span>
                                                
                                            </td>
                                        </tr>
                                        <tr >
                                            <th width="35%">Driver Name</th>
                                            <td width="65%">
                                                :<span id="driver_name-txt"></span>
                                                
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-sm-6">
                                    <table width="100%">
                                        <tr >
                                            <th width="35%">Organization</th>
                                            <td width="65%">
                                                :<span id="organization-txt"></span>
                                            </td>
                                        </tr>
                                        <tr >
                                            <th width="35%">Supplier</th>
                                            <td width="65%">
                                                :<span id="supplier-txt"></span>
                                            </td>
                                        </tr>
                                        <tr >
                                            <th width="35%">Act Challan No</th>
                                            <td width="65%">
                                                :<span id="act_challan_no-txt"></span>
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
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="d-flex align-items-center">
                                        <i data-feather="list" width="16" height="16"></i> 
                                        <h6 class="my-0 text-primary ms-2">Received Item Lists..</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" style="min-height: 385px;">
                            <table class="table table-bordered dt-responsive  nowrap w-100 text-center p-2" width="100%">
                                <thead>
                                    <tr class="p-0">
                                        <th width="5%">#SL</th>
                                        <th width="20%">Name</th>
                                        <th width="10%">Receive Qty</th>
                                        <th width="10%">Unit</th>
                                        <th width="10%">Check Qty</th>
                                        <th width="10%">Pass Qty</th>
                                        <th width="10%">Note</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="detail-item-row">
                                    
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                                <button type="button" class="btn btn-success btn-sm float-end me-2 d-none" id="done-btn">
                                    Send To Store
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
                $('#mrr_no').val('');
                $('#u_mrr_id').val('');
                $('#u_mrr_date').val('');
                $('#u_gate_entry_by').val('');
                $('#u_gate_entry_by_id').val('');
                $('#u_received_by').val('');
                $('#u_received_by_id').val('');
                $('#u_organization_id').val('');
                $('#u_supplier_id').val('');
                $('#u_act_challan_no').val('');
                $('#u_note').val('');
                $('#search_data').val('');
                $('#item-row').html('');
                $('input[name="status"][value="1"]').prop('checked', true);
            })()


            function updateItem(id){
                let check_qty = $('#check_qty_'+id).val();
                let pass_qty = $('#pass_qty_'+id).val();
                let note = $('#note_'+id).val();
                $.ajax({
                    type: 'PUT',
                    url: "<?php echo e(url('inventory/database/gatequality')); ?>/"+id,
                    data: {
                        check_qty: check_qty,
                        pass_qty: pass_qty,
                        is_qa_pass: 1,
                        qa_check_by: "<?php echo e(Auth::user()->id); ?>",
                        qa_check_date: "<?php echo e($today_date); ?>",
                        note: note,
                        _token: "<?php echo e(csrf_token()); ?>"
                    },
                    success: function(data) {
                        console.log(data);
                        // $('#check_qty_'+id).val(Number(data.data.check_qty).toFixed(2));
                        // $('#pass_qty_'+id).val(Number(data.data.pass_qty).toFixed(2));
                        // $('#note_'+id).val(data.data.note);
                        $('#update-item-'+id).hide();
                        $('#remove-item-'+id).show();
                        toastr.success('Item updated successfully');
                    },
                    error: function(data) {
                        console.log(data);
                        toastr.error('Something went wrong!');
                    }
                });
            }

            function removeItem(id){

                let check_qty = $('#check_qty_'+id).val();
                let pass_qty = $('#pass_qty_'+id).val();
                let note = $('#note_'+id).val();
                $.ajax({
                    type: 'PUT',
                    url: "<?php echo e(url('inventory/database/gatequality')); ?>/"+id,
                    data: {
                        check_qty: check_qty,
                        pass_qty: pass_qty,
                        is_qa_pass: 0,
                        qa_check_by: "<?php echo e(Auth::user()->id); ?>",
                        qa_check_date: "<?php echo e($today_date); ?>",
                        note: note,
                        _token: "<?php echo e(csrf_token()); ?>"
                    },
                    success: function(data) {
                        console.log(data);
                        // $('#check_qty_'+id).val(Number(data.data.check_qty).toFixed(2));
                        // $('#pass_qty_'+id).val(Number(data.data.pass_qty).toFixed(2));
                        // $('#note_'+id).val(data.data.note);
                        $('#update-item-'+id).show();
                        $('#remove-item-'+id).hide();
                        toastr.success('Item updated successfully');
                    },
                    error: function(data) {
                        console.log(data);
                        toastr.error('Something went wrong!');
                    }
                });
            }

            function getMrrMain(id){
                $.ajax({
                    type: 'GET',
                    url: "<?php echo e(url('inventory/database/gatepurmrrmains')); ?>/"+id,
                    success: function(data) {
                        console.log(data);
                        mainData = data.reqMain;
                        detailsData = data.reqDetails;
                        $('#mrr_no-txt').text(mainData.mrr_no);
                            $('#mrr_no').val(mainData.mrr_no);
                            $('#mrr_date-txt').text(mainData.mrr_date);
                            $('#gate_entry_by-txt').text(mainData.gate_entry.name);
                            $('#received_by-txt').text(mainData.received_by.name);
                            $('#vehicle_no-txt').text(mainData.vehicle_no);
                            $('#driver_name-txt').text(mainData.driver_name);
                            $('#organization-txt').text(mainData.organization.name);
                            $('#supplier-txt').text(mainData.supplier.name);
                            $('#act_challan_no-txt').text(mainData.act_challan_no);
                            $('#note-txt').text(mainData.note);
                           
                            $('#u_mrr_id').val(mainData.id);
                            $('#u_mrr_date').val(mainData.mrr_date);
                            $('#u_gate_entry_by').val(mainData.gate_entry.name);
                            $('#u_gate_entry_by_id').val(mainData.gate_entry_id);
                            $('#u_received_by').val(mainData.received_by.name);
                            $('#u_received_by_id').val(mainData.received_by_id);
                            $('#u_vehicle_no').val(mainData.vehicle_no);
                            $('#u_driver_name').val(mainData.driver_name);
                            $('#u_act_challan_no').val(mainData.act_challan_no);
                            $('#u_supplier_id').val(mainData.supplier_id);
                            $('#u_organization_id').val(mainData.organization_id);
                            $('#u_note').val(mainData.note);
                            
                            $('#search_data').val('').trigger('change');

                            if(mainData.is_qa_checked == 1){
                                $('#done-btn').addClass('d-none');
                                $('#undo-btn').removeClass('d-none');
                            }else{
                                $('#done-btn').removeClass('d-none');
                                $('#undo-btn').addClass('d-none');
                            }
                        
                        $('#detail-item-row').html('');
                        $.each(detailsData, function(key, x) {
                            let btnElement = mainData.is_qa_checked == 1 ? 'N\\A' : `<button type="button" data-id="${x.id}"   class="btn btn-info btn-sm p-1 update-item" id="update-item-${x.id}" style="display: ${x.is_qa_pass == 0 ? 'block' : 'none' };">Pass</button>

                                       <button type="button" data-id="${x.id}"   class="btn btn-danger btn-sm p-1 remove-item" id="remove-item-${x.id}" style="display: ${x.is_qa_pass == 0 ? 'none' : 'block' };">Fail</button>
                                    `;
                            $('#detail-item-row').append(`
                                <tr class="p-0" id="detail-item-row-${x.id}">
                                    <td width="5%">#</td>
                                    <td width="20%">${x.item.item_name}</td>
                                    <td width="10%">${x.received_qty}</td>
                                    <td width="10%">${x.req_unit.name}</td>
                                    <td width="10%">
                                        <input type="text" class="form-control form-control-sm" id="check_qty_${x.id}" name="" value="${x.check_qty??0}">
                                    </td>
                                    <td width="10%">
                                        <input type="text" class="form-control form-control-sm" id="pass_qty_${x.id}" name="" value="${x.pass_qty??0}">
                                    </td>
                                    <td width="10%">
                                        <input type="text" class="form-control form-control-sm" id="note_${x.id}" name="" value="${x.note != null ? x.note: "" }">
                                    </td>
                                    <td width="10%">
                                       ${btnElement}
                                       </td>
                                </tr>
                                `);
                        });

                        $('.update-item').off('click').on('click', function() {
                            let id = $(this).data('id');
                            updateItem(id);
                        });

                        $('.remove-item').off('click').on('click', function() {
                            let id = $(this).data('id');
                            removeItem(id);
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
                getMrrMain(id);
            });


            $("#done-btn").off('click').on('click',function() {
                let req_id = $('#u_mrr_id').val();
                $.ajax({
                    type: 'PUT',
                    url: "<?php echo e(url('inventory/database/gatepurmrrmains/multiplestatus')); ?>/"+req_id,
                    data: {
                        is_qa_checked: 1,
                        qa_checked_by: "<?php echo e(Auth::user()->id); ?>",
                        qa_checked_date: "<?php echo e(date('Y-m-d')); ?>",
                        _token: "<?php echo e(csrf_token()); ?>"
                    },
                    success: function(data) {
                        console.log(data);
                        getMrrMain(req_id);
                        searchGatePurMrr(2, '');
                        $('input[name="status"][value="2"]').prop('checked', true);
                        $('input[name="status"][value="1"]').prop('checked', false);
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            })


            $("#undo-btn").off('click').on('click',function() {
                let req_id = $('#u_mrr_id').val();
                $.ajax({
                    type: 'PUT',
                    url: "<?php echo e(url('inventory/database/gatepurmrrmains/multiplestatus')); ?>/"+req_id,
                    data: {
                        is_qa_checked: 0,
                        qa_checked_by: "",
                        qa_checked_date: "",
                        _token: "<?php echo e(csrf_token()); ?>"
                    },
                    success: function(data) {
                        console.log(data);
                        getMrrMain(req_id);
                        searchGatePurMrr(1, '');
                        $('input[name="status"][value="1"]').prop('checked', true);
                        $('input[name="status"][value="2"]').prop('checked', false);
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            })

            function searchGatePurMrr(match, search) {
                let reqNo = $('#mrr_no').val();
                $.ajax({
                    type: 'PUT',
                    url: "<?php echo e(route('inventory.database.gatequality.search')); ?>",
                    data: {
                        search: search,
                        match: match,
                        _token: "<?php echo e(csrf_token()); ?>"
                    },
                    success: function(data) {
                        console.log(data);
                        $('#gatepurmrr-list').empty();
                        if(data.length == 0) {
                            $('#gatepurmrr-list').append('<li class="list-group-item list-group-item-action p-2 border-0 text-center">No Data Found</li>');
                        }else{
                            $.each(data, function(key, value) {
                                $('#gatepurmrr-list').append(`<li class="list-group-item list-group-item-action p-2 border-0 pur-main ${reqNo == value.mrr_no ? 'active' : ''}" data-id="${value.id}">${value.mrr_date} - ${value.mrr_no}</li>`);
                            });
                        }
                        $('.pur-main').off('click').on('click', function() {
                            let id = $(this).data('id');
                            $(".pur-main").removeClass("active");
                            $(this).addClass("active");
                            getMrrMain(id);
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
                    searchGatePurMrr(3, search);
                }else{
                    let match = $('input[name="status"]:checked').val();
                    searchGatePurMrr(match, search);
                }
            });


            $('input[name="status"]').off('change').on('change', function() {
                let match = $('input[name="status"]:checked').val();
                searchGatePurMrr(match, '');
            }); 

            $('#search_data').select2({
                    placeholder: 'Search for a Requisition',
                    minimumInputLength: 2,
                    ajax: {
                        type: 'PUT',
                        url: "<?php echo e(route('inventory.database.gatepurmrr.search')); ?>",
                        dataType: 'json',
                        delay: 250,
                        cache: true,
                        data: function (params) {
                            return {
                                search: params.term,
                                mrr_id : $('#u_mrr_id').val(),
                                type:'search',
                                // match: $('input[name="match"]:checked').val(),
                                _token: "<?php echo e(csrf_token()); ?>"
                            };
                        },
                        processResults: function (data) {
                            return {
                                results: data.map(item => ({
                                    id: item.id,
                                    text: item.requisition_no,
                                }))
                            };
                        }
                    },
                    templateResult: function (data) {
                        if (!data.id) return data.text;
                        return $(`
                            <div>
                                <strong>${data.text}</strong>
                            </div>
                        `);
                    },

                    templateSelection: function (data) {
                        if (!data.id) return data.text;
                        return `${data.text}`;
                    }
            });

            $('#search_data').on('select2:select', function() {
                let itemId = $(this).val();
                let mrr_id = $('#u_mrr_id').val();
                console.log(itemId, mrr_id);
                $('#item-row').html('');
                if(mrr_id == '') {
                    $('#search_data').val('').trigger('change');
                    Swal.fire({
                        icon: 'error',
                        title: 'Error...',
                        text: 'Please select a Mrr number!',
                    });
                    return;
                }
                $.ajax({
                    type: 'PUT',
                    url: "<?php echo e(url('inventory/database/gatepurmrr/reqmains')); ?>",
                    data: {
                        id: itemId,
                        mrr_id: mrr_id,
                        _token: "<?php echo e(csrf_token()); ?>"
                    },
                    success: function(data) {
                        console.log(data);
                        $.each(data.reqDetails, function(key, x) {
                            if(x.is_rejected == 1 || x.pur_stage == 2){
                                
                            }else{

                                $('#item-row').append(`
                                    <tr class="p-0" id="item-row-${x.item_id}">
                                        <td width="5%">${key + 1}</td>
                                        <td width="20%">${x.item.item_name}</td>
                                        <td width="10%">${x.final_app_qty}</td>
                                        <td width="10%">${x.remain_qty}</td>
                                        <td width="10%">${x.pur_unit.name}</td>
                                        <td width="10%">
                                            <input type="text" class="form-control form-control-sm is-invalid updt-enbl" data-pur-detail-id="${x.id}" data-id="${x.item_id}" id="receive_qty_${x.item_id}" name="" value="0">
                                        </td>
                                        <td width="10%">
                                            <input type="text" class="form-control form-control-sm" id="note_${x.item_id}" name="" value="">
                                        </td>
                                        <td width="10%">
                                            <button type="button" data-id="${x.item_id}"  id="update-item-${x.item_id}" class="btn btn-info btn-sm p-1 receive-item">Receive</button>
                                        </td>
                                    </tr>
                                    `);
                            }
                        
                    });

                    $('.updt-enbl').off('change').on('change', function() {
                        let id = $(this).data('id');
                        let value = $(this).val();
                        if(value == '' || value == null || value == undefined || value == 0 || value <= 0){
                            $(this).removeClass('is-valid');
                            $(this).addClass('is-invalid');
                        }else{
                            $(this).removeClass('is-invalid');
                            $(this).addClass('is-valid');
                        }
                    });


                    $('.receive-item').off('click').on('click', function() {
                        let itemId = $(this).data('id');
                        receiveItem(itemId);
                    });

                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            });

            function receiveItem(itemId) {
                let mrrId = $('#u_mrr_id').val();
                if(mrrId == '') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error...',
                        text: 'Please select a requisition number!',
                    });
                    return;
                }
                let receiveQty = $('#receive_qty_' + itemId).val();
                if(receiveQty == '' || receiveQty == null || receiveQty == undefined || receiveQty == 0 || receiveQty <= 0){
                    Swal.fire({
                        icon: 'error',
                        title: 'Error...',
                        text: 'Please enter a valid quantity!',
                    });
                    return;
                }
                let note = $('#note_' + itemId).val();
                let reqMainId = $('#search_data').val();
                let reqDetailId = $('#receive_qty_' + itemId).data('pur-detail-id');
                console.log(itemId, mrrId, receiveQty, note, reqMainId, reqDetailId);
                $.ajax({
                    type: 'POST',
                    url: "<?php echo e(route('inventory.database.gatepurmrrdetails.store')); ?>",
                    data: {
                        mrr_id: mrrId,
                        item_id: itemId,
                        received_qty: receiveQty,
                        note: note,
                        req_main_id: reqMainId,
                        req_detail_id: reqDetailId,
                        _token: "<?php echo e(csrf_token()); ?>"
                    },
                    success: function(data) {
                        console.log(data);
                        if(data.success == false){
                            Swal.fire({
                                icon: 'error',
                                title: 'Error...',
                                text: data.message,
                            });
                            return;   
                        }
                        $('#item-row-' + itemId).remove();
                        Swal.fire({
                            icon: 'success',
                            title: 'Success...',
                            text: 'Item received successfully!',
                        });
                        let x = data.message;
                        $('#detail-item-row').append(`
                         <tr class="p-0" id="detail-item-row-${x.id}">
                            <td width="5%">#</td>
                            <td width="20%">${x.req_main.requisition_no}</td>
                            <td width="20%">${x.item.item_name}</td>
                            <td width="10%">${x.req_qty}</td>
                            <td width="10%">${x.req_unit.name}</td>
                            <td width="10%">
                                <input type="text" class="form-control form-control-sm" id="receive_qty_${x.id}" name="" value="${x.received_qty}">
                            </td>
                            <td width="10%">
                                <input type="text" class="form-control form-control-sm" id="note_${x.id}" name="" value="${x.note != null ? x.note: "" }">
                            </td>
                            <td width="10%">
                                <button type="button" data-id="${x.id}"   class="btn btn-info btn-sm p-1 update-item">Update</button>
                                <button type="button" data-id="${x.id}"   class="btn btn-danger btn-sm p-1 remove-item">Remove</button>
                            </td>
                        </tr>
                        `);

                        $('.update-item').off('click').on('click', function() {
                            let id = $(this).data('id');
                            updateItem(id);
                        });

                        $('.remove-item').off('click').on('click', function() {
                            let id = $(this).data('id');
                            removeItem(id);
                        });
                    },
                    error: function(data) {
                        console.log(data);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error...',
                            text: 'Item received failed!',
                        });
                    }
                });
            }
            
            $('#addFormMain').submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                submitBtnMain.disabled = true;
                submitBtnMain.innerHTML = 'Saving...';
                $.ajax({
                    url: '<?php echo e(route('inventory.database.gatepurmrrmains.store')); ?>',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            $('#addModal').modal('hide');
                            $('#addFormMain')[0].reset();
                            Swal.fire({
                                icon: 'success',
                                title: 'Success...',
                                text: response.message,
                            });
                            console.log(response.data);

                            $('#mrr_no-txt').text(response.data.mrr_no);
                            $('#mrr_no').val(response.data.mrr_no);
                            $('#mrr_date-txt').text(response.data.mrr_date);
                            $('#gate_entry_by-txt').text(response.data.gate_entry.name);
                            $('#received_by-txt').text(response.data.received_by.name);
                            $('#vehicle_no-txt').text(response.data.vehicle_no);
                            $('#driver_name-txt').text(response.data.driver_name);
                            $('#organization-txt').text(response.data.organization.name);
                            $('#supplier-txt').text(response.data.supplier.name);
                            $('#act_challan_no-txt').text(response.data.act_challan_no);
                            $('#note-txt').text(response.data.note);
                           
                            $('#u_mrr_id').val(response.data.id);
                            $('#u_mrr_date').val(response.data.mrr_date);
                            $('#u_gate_entry_by_id').val(response.data.gate_entry_id);
                            $('#u_received_by_id').val(response.data.received_by_id);
                            $('#u_vehicle_no').val(response.data.vehicle_no);
                            $('#u_driver_name').val(response.data.driver_name);
                            $('#u_act_challan_no').val(response.data.act_challan_no);
                            $('#u_supplier_id').val(response.data.supplier_id);
                            $('#u_organization_id').val(response.data.organization_id);
                            $('#u_note').val(response.data.note);
                            searchGatePurMrr(1, '');
                            // $('#purrequisitionList').DataTable().ajax.reload();
                        } else {
                                Swal.fire({
                                icon: 'error',
                                title: 'Error...',
                                text: response.message,
                            });
                        }
                        submitBtnMain.disabled = false;
                        submitBtnMain.innerHTML = 'Save';
                    },
                    error: function(response) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error...',
                            text: response.responseJSON.message,
                        });
                        submitBtnMain.disabled = false;
                        submitBtnMain.innerHTML = 'Save';
                    }
                });
            });


            $('#updateFormMain').on('submit', function(e) {
                e.preventDefault();
                let id = $('#u_mrr_id').val();
                let mrrDate = $('#u_mrr_date').val();
                let gateEntryById = $('#u_gate_entry_by_id').val();
                let receivedById = $('#u_received_by_id').val();
                let vehicleNo = $('#u_vehicle_no').val();
                let driverName = $('#u_driver_name').val();
                let actChallanNo = $('#u_act_challan_no').val();
                let supplierId = $('#u_supplier_id').val();
                let organizationId = $('#u_organization_id').val();
                let note = $('#u_note').val();
                submitBtnUpdateMain.disabled = true;
                submitBtnUpdateMain.innerHTML = 'Updating...';
                $.ajax({
                    url: '<?php echo e(url('inventory/database/gatepurmrrmains')); ?>/'+id,
                    type: 'PUT',
                    data: {
                        id: id,
                        mrr_date: mrrDate,
                        gate_entry_id: gateEntryById,
                        received_by_id: receivedById,
                        vehicle_no: vehicleNo,
                        driver_name: driverName,
                        act_challan_no: actChallanNo,
                        supplier_id: supplierId,
                        organization_id: organizationId,
                        note: note,
                        _token: '<?php echo e(csrf_token()); ?>'
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#updateModal').modal('hide');
                            $('#updateFormMain')[0].reset();
                            Swal.fire({
                                icon: 'success',
                                title: 'Success...',
                                text: response.message,
                            });
                            console.log(response.data);
                            $('#mrr_no-txt').text(response.data.mrr_no);
                            $('#mrr_no').val(response.data.mrr_no);
                            $('#mrr_date-txt').text(response.data.mrr_date);
                            $('#gate_entry_by-txt').text(response.data.gate_entry.name);
                            $('#received_by-txt').text(response.data.received_by.name);
                            $('#vehicle_no-txt').text(response.data.vehicle_no);
                            $('#driver_name-txt').text(response.data.driver_name);
                            $('#organization-txt').text(response.data.organization.name);
                            $('#supplier-txt').text(response.data.supplier.name);
                            $('#act_challan_no-txt').text(response.data.act_challan_no);
                            $('#note-txt').text(response.data.note);
                           
                            $('#u_mrr_id').val(response.data.id);
                            $('#u_mrr_date').val(response.data.mrr_date);
                            $('#u_gate_entry_by_id').val(response.data.gate_entry_id);
                            $('#u_received_by_id').val(response.data.received_by_id);
                            $('#u_vehicle_no').val(response.data.vehicle_no);
                            $('#u_driver_name').val(response.data.driver_name);
                            $('#u_act_challan_no').val(response.data.act_challan_no);
                            $('#u_supplier_id').val(response.data.supplier_id);
                            $('#u_organization_id').val(response.data.organization_id);
                            $('#u_note').val(response.data.note);
                            // $('#purrequisitionList').DataTable().ajax.reload();
                        } else {
                                Swal.fire({
                                icon: 'error',
                                title: 'Error...',
                                text: response.message,
                            });
                        }
                        submitBtnUpdateMain.disabled = false;
                        submitBtnUpdateMain.innerHTML = 'Update';
                    },
                    error: function(response) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error...',
                            text: response.responseJSON.message,
                        });
                        submitBtnUpdateMain.disabled = false;
                        submitBtnUpdateMain.innerHTML = 'Update';
                    }
                });
            });

            
        });

       
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH H:\laragon\www\garments_erp\Modules\Inventory\resources\views\database\qualitygate\index.blade.php ENDPATH**/ ?>