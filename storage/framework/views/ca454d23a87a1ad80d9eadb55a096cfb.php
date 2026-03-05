<?php $__env->startSection('title', 'INVENTORY'); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <?php echo $__env->make('components.breadcrumb', [
                'title' => 'INVENTORY',
                'subtitle' => 'Gate Out Challan Approve',
                'breadcrumbs' => [
                    ['label' => 'INVENTORY', 'url' => route('inventory.index')],
                    ['label' => 'Database', 'url' => route('inventory.index')],
                    ['label' => 'Gate Out Challan', 'url' => route('inventory.database.gateoutchallans.index')],
                ],
            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
        <div class="col-12 mb-3">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                <!-- Centered Title -->
                <h4 class="text-center flex-grow-1 order-1 order-md-0 mb-2 mb-md-0">
                    Gate Out Challan Approve
                </h4>

            </div>
        </div>
        <div class="col-md-3">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <i data-feather="list" width="16" height="16"></i> 
                        <h6 class="my-0 text-primary ms-2">Gate Out Challan List</h6>
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
                        <?php $__currentLoopData = $gateoutchallans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gateoutchallan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="list-group-item list-group-item-action p-2 border-0 pur-main" data-id="<?php echo e($gateoutchallan->id); ?>"><?php echo e($gateoutchallan->challan_date); ?> - <?php echo e($gateoutchallan->challan_no); ?></li>
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
                                        <h6 class="my-0 text-primary ms-2"> Input Parameters For Gate Out Challan..</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6"> 
                                    <table width="100%">
                                        <tr>
                                            <th width="35%">Challan No</th>
                                            <td width="65%">
                                                <input type="hidden" id="challan_no">
                                                :<span id="challan_no-txt"></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th width="35%">Challan Date</th>
                                            <td width="65%">
                                                :<span id="challan_date-txt"></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th width="35%">Challan By</th>
                                            <td width="65%">
                                                :<span id="challan_by-txt"></span>
                                            </td>
                                        </tr>
                                        <tr >
                                            <th width="35%">Purpose of Challan <span style="color: red">*</span></th>
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
                                            <th width="35%">Store <span style="color: red">*</span></th>
                                            <td width="65%">
                                                :<span id="store-txt"></span>
                                            </td>
                                        </tr>
                                        <tr >
                                            <th width="35%">Party <span style="color: red">*</span></th>
                                            <td width="65%">
                                                :<span id="party-txt"></span>
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
                <input type="hidden" id="u_challan_id">
                <div class="col-md-12">
                    <div class="card alert-info alert-top-border padding-card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="d-flex align-items-center">
                                        <i data-feather="list" width="16" height="16"></i> 
                                        <h6 class="my-0 text-primary ms-2"> Item Lists..</h6>
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
                                        <th width="10%">Unit</th>
                                        <th width="10%">Challan Unit</th>
                                        <th width="10%">Quantity</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="item-row">
                                   
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-success btn-sm float-end me-2 d-none" id="done-btn">
                                Done
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
                $('#u_challan_id').val('');
                $('#u_challan_date').val('');
                $('#u_challan_by').val('');
                $('#u_challan_by_id').val('');
                $('#u_purpose_id').val('');
                $('#u_org_id').val('');
                $('#u_store_id').val('');
                $('#u_party_id').val('');
                $('#u_note').val('');
                $('#item-row').html('');
                $('input[name="status"][value="1"]').prop('checked', true);
            })()

            // load Data
            function getChallanMain(id){
                $.ajax({
                    type: 'GET',
                    url: "<?php echo e(url('inventory/database/gateoutchallanapprv')); ?>/"+id,
                    success: function(data) {
                        console.log(data);
                        mainData = data.challanMain;
                        detailsData = data.challanDetails;

                        $('#challan_no').val(mainData.challan_no);
                        $('#challan_no-txt').text(mainData.challan_no);
                        $('#challan_date-txt').text(mainData.challan_date);
                        $('#challan_by-txt').text(mainData.challan_by.name);
                        $('#purpose-txt').text(mainData.purpose.purpose_name);
                        $('#organization-txt').text(mainData.organization.name);
                        $('#store-txt').text(mainData.store.name);
                        $('#party-txt').text(mainData.party.name);
                        $('#note-txt').text(mainData.note);

                        $('#u_challan_id').val(mainData.id);
                        $('#u_challan_date').val(mainData.challan_date);
                        $('#u_challan_by').val(mainData.challan_by.name);
                        $('#u_challan_by_id').val(mainData.challan_by_id);
                        $('#u_purpose_id').val(mainData.purpose_id);
                        $('#u_org_id').val(mainData.org_id);
                        $('#u_store_id').val(mainData.store_id);
                        $('#u_party_id').val(mainData.party_id);
                        $('#u_note').val(mainData.note);
                        
                        
                        if(mainData.is_approved == 1){
                            $('#done-btn').addClass('d-none');
                            if(mainData.is_gate_out == 1){
                                $('#undo-btn').addClass('d-none');
                            }else{
                                $('#undo-btn').removeClass('d-none');
                            }
                        }else{
                            $('#done-btn').removeClass('d-none');
                            $('#undo-btn').addClass('d-none');
                        }
                        
                        
                        $('#item-row').html('');
                        $.each(detailsData, function(key, value) {
                            let unit = data.units.find(u => u.id == value.item.unit_id);
                            let pur_units = data.units.filter(u => u.unit_standards == unit.unit_standards);
                            console.log(pur_units);
                            let element = '';
                            if(mainData.is_approved == 1){
                                element = 'N\\A';
                                if(value.is_rejected == 1){
                                    element = 'Rejected';
                                }
                            }else{
                                element = `<button type="button" data-id="${value.id}" id="update-item-${value.id}" class="btn btn-info btn-sm p-1 update-item">Update</button>
                                        <button type="button" data-id="${value.id}" id="remove-item-${value.id}" class="btn btn-danger btn-sm p-1 remove-item">Remove</button>`;
                            }
                                $('#item-row').append(`
                                <tr id="item-row-${value.id}">
                                    <td>${key + 1}</td>
                                    <td>${value.item.item_name}</td>
                                    <td>${value.item.unit.name}</td>
                                    <td width="10%">
                                        <select name="unit_id" class="form-control form-control-sm updt-enbl" data-id="${value.id}" id="unit_id_${value.id}" ${mainData.is_approved == 1 ? 'disabled' : ''}>
                                            <option value="">Select Unit</option>
                                            ${pur_units.map(x => `<option value="${x.id}" ${x.id == value.unit_id ? 'selected' : ''}>${x.name}</option>`).join('')}
                                        </select>
                                    </td>
                                    <td width="10%"><input type="text" class="form-control form-control-sm updt-enbl" data-id="${value.id}" id="challan_qty_${value.id}" value="${value.challan_qty?value.challan_qty:0}" ${mainData.is_approved == 1 ? 'disabled' : ''}></td>
                                    <td>
                                    ${element}
                                    </td>
                                </tr>
                            `);
                        });
                        $('.updt-enbl').off('change').on('change', function() {
                            let id = $(this).data('id');
                            console.log(id);
                            $('#update-item-'+id).prop('disabled', false);
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

            $("#done-btn").off('click').on('click',function() {
                let challan_id = $('#u_challan_id').val();
                $.ajax({
                    type: 'PUT',
                    url: "<?php echo e(url('inventory/database/gateoutchallanmains/multiplestatus')); ?>/"+challan_id,
                    data: {
                        is_approved: 1,
                        approved_by: "<?php echo e(Auth::user()->id); ?>",
                        approved_date: "<?php echo e(date('Y-m-d')); ?>",
                        _token: "<?php echo e(csrf_token()); ?>"
                    },
                    success: function(data) {
                        console.log(data);
                        getChallanMain(challan_id);
                        searchRequisition(2, '');
                        $('input[name="status"][value="2"]').prop('checked', true);
                        $('input[name="status"][value="1"]').prop('checked', false);
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            })

            $("#undo-btn").off('click').on('click',function() {
                let challan_id = $('#u_challan_id').val();
                $.ajax({
                    type: 'PUT',
                    url: "<?php echo e(url('inventory/database/gateoutchallanmains/multiplestatus')); ?>/"+challan_id,
                    data: {
                        is_approved: 0,
                        approved_by: "",
                        approved_date: "",
                        _token: "<?php echo e(csrf_token()); ?>"
                    },
                    success: function(data) {
                        console.log(data);
                        getChallanMain(challan_id);
                        searchRequisition(1, '');
                        $('input[name="status"][value="1"]').prop('checked', true);
                        $('input[name="status"][value="2"]').prop('checked', false);
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            })

            // Requisition Main Load
            $('.pur-main').off('click').on('click', function() {
                let id = $(this).data('id');
                $(".pur-main").removeClass("active");
                $(this).addClass("active");
                getChallanMain(id);
            });

            function searchRequisition(match, search) {
                let chalanNo = $('#challan_no').val();
                $.ajax({
                    type: 'PUT',
                    url: "<?php echo e(route('inventory.database.gateoutchallanapprv.search')); ?>",
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
                                $('#purrequisition-list').append(`<li class="list-group-item list-group-item-action p-2 border-0 pur-main ${chalanNo == value.challan_no ? 'active' : ''}" data-id="${value.id}">${value.challan_date} - ${value.challan_no}</li>`);
                            });
                        }
                        $('.pur-main').off('click').on('click', function() {
                            let id = $(this).data('id');
                            $(".pur-main").removeClass("active");
                            $(this).addClass("active");
                            getChallanMain(id);
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

            // Search Item Data

            $('#search_data').select2({
                    placeholder: 'Search for a Product',
                    minimumInputLength: 2,
                    ajax: {
                        type: 'PUT',
                        url: "<?php echo e(route('inventory.database.gateoutchallans.search')); ?>",
                        dataType: 'json',
                        delay: 250,
                        cache: true,
                        data: function (params) {
                            return {
                                search: params.term,
                                type:'search',
                                // match: $('input[name="match"]:checked').val(),
                                _token: "<?php echo e(csrf_token()); ?>"
                            };
                        },
                        processResults: function (data) {
                            return {
                                results: data.map(item => ({
                                    id: item.id,
                                    text: item.item_name,
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
            // Add Item
            $('#search_data').on('select2:select', function() {
                let itemId = $(this).val();
                let challan_no = $('#challan_no').val();
                console.log(itemId, challan_no);
                if(challan_no == '') {
                    $('#search_data').val('').trigger('change');
                    Swal.fire({
                        icon: 'error',
                        title: 'Error...',
                        text: 'Please select a requisition number!',
                    });
                    return;
                }

                $.ajax({
                    type: 'POST',
                    url: "<?php echo e(route('inventory.database.gateoutchallandetails.store')); ?>",
                    data: {
                        item_id: itemId,
                        challan_no: challan_no,
                        _token: "<?php echo e(csrf_token()); ?>"
                    },
                    success: function(data) {
                        console.log(data);
                        if(data.success){
                        $('#item-row').append(`
                         <tr class="p-0" id="item-row-${data.details.id}">
                            <td width="5%">1</td>
                            <td width="20%">${data.details.item.item_name}</td>
                            <td width="10%">${data.unit.name}</td>
                            <td width="10%">
                                <select name="unit_id" class="form-control form-control-sm updt-enbl" data-id="${data.details.id}" id="unit_id_${data.details.id}">
                                    <option value="">Select Unit</option>
                                    ${data.units.map(unit => `<option value="${unit.id}">${unit.name}</option>`).join('')}
                                </select>
                            </td>
                            <td width="10%"><input type="text" class="form-control form-control-sm updt-enbl" data-id="${data.details.id}" id="challan_qty_${data.details.id}" value="0"></td>

                            <td width="10%">
                                <button type="button" data-id="${data.details.id}" id="update-item-${data.details.id}" class="btn btn-info btn-sm p-1 update-item">Update</button>
                                <button type="button" data-id="${data.details.id}" id="remove-item-${data.details.id}" class="btn btn-danger btn-sm p-1 remove-item">Remove</button>
                            </td>
                        </tr>
                        `);
                        $('.updt-enbl').off('change').on('change', function() {
                            let id = $(this).data('id');
                            console.log(id);
                            $('#update-item-'+id).prop('disabled', false);
                        });
                        $('.update-item').off('click').on('click', function() {
                            let id = $(this).data('id');
                            updateItem(id);
                        });
                        $('.remove-item').off('click').on('click', function() {
                            let id = $(this).data('id');
                            removeItem(id);
                        });
                        $("#undo-btn").addClass('d-none');
                        $("#done-btn").removeClass('d-none');
                        }else{
                            toastr.error(data.message);
                        }                        
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            });
            // Update Item
            function updateItem(id){
                let unit_id = $('#unit_id_'+id).val();
                let challan_qty = $('#challan_qty_'+id).val();
                // console.log(unit_id, challan_qty,id);
                $.ajax({
                    type: 'PUT',
                    url: "<?php echo e(url('inventory/database/gateoutchallandetails')); ?>/"+id,
                    data: {
                        unit_id: unit_id,
                        challan_qty: challan_qty,
                        _token: "<?php echo e(csrf_token()); ?>"
                    },
                    success: function(data) {
                        if(data.success){
                            $('#unit_id_'+id).val(data.data.unit_id);
                            $('#challan_qty_'+id).val(Number(data.data.challan_qty).toFixed(2));
                            toastr.success('Item updated successfully');
                            $('#update-item-'+id).prop('disabled', true);
                        }else{
                            toastr.error(data.message);
                        }
                    },
                    error: function(data) {
                        console.log(data);
                        toastr.error('Something went wrong!');
                    }
                });
            }
            // Remove Item
            function removeItem(id){
                $.ajax({
                    type: 'DELETE',
                    url: "<?php echo e(url('inventory/database/gateoutchallandetails')); ?>"+"/"+id,
                    data: {
                        _token: "<?php echo e(csrf_token()); ?>"
                    },
                    success: function(data) {
                        console.log(data);
                        $('#item-row-'+id).remove();
                        toastr.success('Item removed successfully');
                    },
                    error: function(data) {
                        console.log(data);
                        toastr.error('Something went wrong!');
                    }
                });
            }
            
            
        });

       
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH H:\laragon\www\garments_erp\Modules\Inventory\resources\views\database\gateoutchallanapprv\index.blade.php ENDPATH**/ ?>