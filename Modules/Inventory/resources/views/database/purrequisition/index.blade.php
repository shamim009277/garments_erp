@extends('layouts.app')
@section('title', 'INVENTORY')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'INVENTORY',
                'subtitle' => 'Purchase Requisition',
                'breadcrumbs' => [
                    ['label' => 'INVENTORY', 'url' => route('inventory.index')],
                    ['label' => 'Database', 'url' => route('inventory.index')],
                    ['label' => 'Purchase Requisition', 'url' => route('inventory.database.purrequisitions.index')],
                ],
            ])
        </div>
        <div class="col-12 mb-3">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                <!-- Centered Title -->
                <h4 class="text-center flex-grow-1 order-1 order-md-0 mb-2 mb-md-0">
                    Purchase Requisition
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
                        @foreach ($purrequisitions as $purrequisition)
                            <li class="list-group-item list-group-item-action p-2 border-0 pur-main" data-id="{{ $purrequisition->id }}">{{ $purrequisition->req_date }} - {{ $purrequisition->requisition_no }}</li>
                        @endforeach
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
                                <div class="col-sm-6">
                                    <x-primary-button class="btn-sm me-2" id="addBtn">Add New</x-primary-button>
                                    <x-info-button  class="btn-sm me-2" id="updateBtn">Update</x-info-button>
                                    <button type="button" class="btn btn-sm btn-danger me-2 float-end" id="deleteBtn">
                                        <i data-feather="trash-2" width="14" height="14"></i> Delete
                                    </button>
                                    <a type="button" class="btn btn-sm btn-warning me-2 float-end" href="" target="_blank" id="printBtn">
                                        <i data-feather="printer" width="14" height="14"></i> Print
                                    </a>
                                     <!-- Add Modal Start  -->
                                    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="addModalLabel">Add New Purchase Requisition</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form id="addFormMain" action="{{ route('inventory.database.purrequisitionmains.store') }}" method="POST">
                                                    <div class="modal-body">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <table width="100%">
                                                                    <tr>
                                                                        <th width="35%">Requisition Date</th>
                                                                        <td width="65%">
                                                                            <x-text-input id="req_date" name="req_date" class="form-control w-100" type="date" readonly :value="$today_date" required />
                                                                        </td>
                                                                    </tr>
                                                                    <tr >
                                                                        <th width="35%">Required By</th>
                                                                        <td width="65%">
                                                                            <x-text-input id="required_by" name="required_by" class="form-control w-100" type="text" readonly :value="Auth::user()->name" required />
                                                                            <x-text-input id="required_by_id" name="required_by_id" class="form-control w-100" type="text" :value="Auth::user()->id" hidden />
                                                                        </td>
                                                                    </tr>
                                                                    <tr >
                                                                        <th width="35%">Purpose of Requisition <span style="color: red">*</span></th>
                                                                        <td width="65%">
                                                                            <x-text-input id="purpose" name="purpose" class="form-control w-100" type="text" :value="old('purpose')" required />
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <table width="100%">
                                                                    <tr >
                                                                        <th width="35%">Organization <span style="color: red">*</span></th>
                                                                        <td width="65%">
                                                                            <x-select-input name="organization_id" :options="$organizations->pluck('name', 'id')" :selected="old('organization_id')" required />
                                                                        </td>
                                                                    </tr>
                                                                    <tr >
                                                                        <th width="35%">Receiving Store <span style="color: red">*</span></th>
                                                                        <td width="65%">
                                                                            <x-select-input name="store_id" :options="$store_locations->pluck('name', 'id')" :selected="old('store_id')" required />
                                                                        </td>
                                                                    </tr>
                                                                    <tr >
                                                                        <th width="35%">Note</th>
                                                                        <td width="65%">
                                                                            <x-text-input id="note" name="note" class="form-control w-100" type="text" :value="old('note')" />
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary waves-effect btn-sm" data-bs-dismiss="modal">Close</button>
                                                        <x-primary-button class="float-start btn-sm" id="submitBtnMain">Save</x-primary-button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                     <!-- Add Modal End -->
                                     <!-- Update Modal Start -->
                                    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="updateModalLabel">Update Purchase Requisition</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form id="updateFormMain" >
                                                    <div class="modal-body">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <table width="100%">
                                                                    <tr>
                                                                        <th width="35%">Requisition Date</th>
                                                                        <td width="65%">
                                                                            <input type="hidden" id="u_req_id" name="u_req_id">
                                                                            <x-text-input id="u_req_date" name="req_date" class="form-control w-100" type="date" readonly :value="$today_date" required />
                                                                        </td>
                                                                    </tr>
                                                                    <tr >
                                                                        <th width="35%">Required By</th>
                                                                        <td width="65%">
                                                                            <x-text-input id="u_required_by" name="required_by" class="form-control w-100" type="text" readonly :value="Auth::user()->name" required />
                                                                            <x-text-input id="u_required_by_id" name="required_by_id" class="form-control w-100" type="text" readonly :value="Auth::user()->id" hidden />
                                                                        </td>
                                                                    </tr>
                                                                    <tr >
                                                                        <th width="35%">Purpose of Requisition <span style="color: red">*</span></th>
                                                                        <td width="65%">
                                                                            <x-text-input id="u_purpose" name="purpose" class="form-control w-100" type="text" :value="old('purpose')" required />
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <table width="100%">
                                                                    <tr >
                                                                        <th width="35%">Organization <span style="color: red">*</span></th>
                                                                        <td width="65%">
                                                                            <x-select-input id="u_organization_id" name="organization_id" :options="$organizations->pluck('name', 'id')" :selected="old('organization_id')" required />
                                                                        </td>
                                                                    </tr>
                                                                    <tr >
                                                                        <th width="35%">Receiving Store <span style="color: red">*</span></th>
                                                                        <td width="65%">
                                                                            <x-select-input id="u_store_id" name="store_id" :options="$store_locations->pluck('name', 'id')" :selected="old('store_id')" required />
                                                                        </td>
                                                                    </tr>
                                                                    <tr >
                                                                        <th width="35%">Note</th>
                                                                        <td width="65%">
                                                                            <x-text-input id="u_note" name="note" class="form-control w-100" type="text" :value="old('note')" />
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary waves-effect btn-sm" data-bs-dismiss="modal">Close</button>
                                                        <x-primary-button class="float-start btn-sm" id="submitBtnUpdateMain">Save</x-primary-button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                     <!-- Update Modal End -->
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
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="d-flex align-items-center">
                                        <i data-feather="list" width="16" height="16"></i> 
                                        <h6 class="my-0 text-primary ms-2"> Item Entry Lists..</h6>
                                    </div>
                                    <br>
                                    <select name="item_id" class="form-control form-control-sm w-100 w-sm-50" id="search_data"  placeholder="Select Item">
                                        <option value="">Select Item</option>
                                    </select>
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
                                        <th width="10%">Purchase Unit</th>
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
@endsection
@push('scripts')
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

            function validateItem(){
                let statusChange = false;
                $(".updt-enbl").each(function(){
                    if($(this).hasClass('is-valid')||$(this).hasClass('is-invalid')){
                        statusChange = true;
                    }
                });
                return statusChange;
            }
            // load Data
            function getReqMain(id){
                $.ajax({
                    type: 'GET',
                    url: "{{ url('inventory/database/purrequisitionmains') }}/"+id,
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
                        $('#printBtn').attr('href', '{{ url('inventory/database/purrequisitions/pdf') }}/'+id);
                        if(mainData.is_done == 1){
                            $('#done-btn').addClass('d-none');
                            if(mainData.is_forward == 1){
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
                            if(mainData.is_done == 1){
                                element = 'N\\A';
                                if(value.is_rejected == 1){
                                    element = 'Rejected';
                                }
                            }else{
                                element = `<button type="button" data-id="${value.id}" id="update-item-${value.id}" class="btn btn-info btn-sm p-1 update-item" disabled>Update</button>
                                        <button type="button" data-id="${value.id}" id="remove-item-${value.id}" class="btn btn-danger btn-sm p-1 remove-item">Remove</button>`;
                            }
                            let unitClass = '';
                            if(value.pur_unit_id == null || value.pur_unit_id == undefined || value.pur_unit_id == '' || value.pur_unit_id == 0){
                                unitClass = 'is-invalid';
                            }
                            let reqQtyClass = '';
                            if(value.req_qty == null || value.req_qty == undefined || value.req_qty == '' || value.req_qty <= 0){
                                reqQtyClass = 'is-invalid';
                            }
                                $('#item-row').append(`
                                <tr id="item-row-${value.id}">
                                    <td>${key + 1}</td>
                                    <td>${value.item.item_name}</td>
                                    <td>${unit.name}</td>
                                    <td width="10%">
                                        <select name="unit_id" class="form-control form-control-sm updt-enbl ${unitClass}" data-id="${value.id}" id="unit_id_${value.id}" ${mainData.is_done == 1 ? 'disabled' : ''}>
                                            <option value="">Select Unit</option>
                                            ${pur_units.map(x => `<option value="${x.id}" ${x.id == value.pur_unit_id ? 'selected' : ''}>${x.name}</option>`).join('')}
                                        </select>
                                    </td>
                                    <td width="10%"><input type="text" class="form-control form-control-sm updt-enbl ${reqQtyClass}" data-id="${value.id}" id="req_qty_${value.id}" value="${value.req_qty?value.req_qty:0}" ${mainData.is_done == 1 ? 'disabled' : ''}></td>
                                    <td>
                                    ${element}
                                    </td>
                                </tr>
                            `);
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

            // Add Main Part

            $('#addBtn').off('click').on('click',function() {
                $('#addModal').modal('show');
            });

            
            $('#addFormMain').submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                submitBtnMain.disabled = true;
                submitBtnMain.innerHTML = 'Saving...';
                $.ajax({
                    url: '{{ route('inventory.database.purrequisitionmains.store') }}',
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

                            $('#requisition_no-txt').text(response.data.requisition_no);
                            $('#req_no').val(response.data.requisition_no);
                            $('#requisition_date-txt').text(response.data.req_date);
                            $('#purpose-txt').text(response.data.purpose);
                            $('#note-txt').text(response.data.note);
                            $('#required_by-txt').text(response.data.required_by.name);
                            $('#organization-txt').text(response.data.organization.name);
                            $('#store-txt').text(response.data.store.name);
                            $('#u_req_id').val(response.data.id);
                            $('#u_req_date').val(response.data.req_date);
                            $('#u_required_by').val(response.data.required_by.name);
                            $('#u_required_by_id').val(response.data.required_by_id);
                            $('#u_purpose').val(response.data.purpose);
                            $('#u_organization_id').val(response.data.organization_id);
                            $('#u_store_id').val(response.data.store_id);
                            $('#u_note').val(response.data.note);
                            $('#done-btn').removeClass('d-none');
                            $('#undo-btn').addClass('d-none');
                            $('#item-row').html('');
                            $('input[name="status"][value="1"]').prop('checked', true);
                            $('input[name="status"][value="2"]').prop('checked', false);
                            searchRequisition(1, '');
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



            $("#done-btn").off('click').on('click',function() {
                let req_id = $('#u_req_id').val();
                if(validateItem()){
                    Swal.fire({
                                icon: 'error',
                                title: 'Error...',
                                text: 'Please update all items',
                            });
                    return;
                }
                $.ajax({
                    type: 'PUT',
                    url: "{{ url('inventory/database/purrequisitionmains/multiplestatus') }}/"+req_id,
                    data: {
                        is_done: 1,
                        done_by_id: "{{ Auth::user()->id }}",
                        done_date: "{{ date('Y-m-d') }}",
                        _token: "{{ csrf_token() }}"
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

            $("#undo-btn").off('click').on('click',function() {
                let req_id = $('#u_req_id').val();
                $.ajax({
                    type: 'PUT',
                    url: "{{ url('inventory/database/purrequisitionmains/multiplestatus') }}/"+req_id,
                    data: {
                        is_done: 0,
                        done_by_id: "",
                        done_date: "",
                        _token: "{{ csrf_token() }}"
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

            // Update Main Starts
            $("#updateBtn").off('click').on('click',function() {
                $("#updateModal").modal('show');
            })
            $('#updateFormMain').on('submit', function(e) {
                e.preventDefault();
                let id = $('#u_req_id').val();
                let reqDate = $('#u_req_date').val();
                let requiredBy = $('#u_required_by').val();
                let requiredById = $('#u_required_by_id').val();
                let purpose = $('#u_purpose').val();
                let organizationId = $('#u_organization_id').val();
                let storeId = $('#u_store_id').val();
                let note = $('#u_note').val();
                submitBtnUpdateMain.disabled = true;
                submitBtnUpdateMain.innerHTML = 'Updating...';
                $.ajax({
                    url: '{{ url('inventory/database/purrequisitionmains') }}/'+id,
                    type: 'PUT',
                    data: {
                        id: id,
                        req_date: reqDate,
                        required_by: requiredBy,
                        required_by_id: requiredById,
                        purpose: purpose,
                        organization_id: organizationId,
                        store_id: storeId,
                        note: note,
                        _token: '{{ csrf_token() }}'
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

                            $('#requisition_no-txt').text(response.data.requisition_no);
                            $('#requisition_date-txt').text(response.data.req_date);
                            $('#purpose-txt').text(response.data.purpose);
                            $('#note-txt').text(response.data.note);
                            $('#required_by-txt').text(response.data.required_by.name);
                            $('#organization-txt').text(response.data.organization.name);
                            $('#store-txt').text(response.data.store.name);
                            
                            $('#u_req_id').val(response.data.id);
                            $('#u_req_date').val(response.data.req_date);
                            $('#u_required_by').val(response.data.required_by.name);
                            $('#u_required_by_id').val(response.data.required_by_id);
                            $('#u_purpose').val(response.data.purpose);
                            $('#u_organization_id').val(response.data.organization_id);
                            $('#u_store_id').val(response.data.store_id);
                            $('#u_note').val(response.data.note);
                        } else {
                                Swal.fire({
                                icon: 'error',
                                title: 'Error...',
                                text: response.message,
                            });
                        }
                        submitBtnUpdateMain.disabled = false;
                        submitBtnUpdateMain.innerHTML = 'Update';
                        $("#updateModal").modal('hide');
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

            // Delete Requisition Main
            $(document).on('click', '#deleteBtn', function(e) {
                e.preventDefault();
                let purMainId = $('#u_req_id').val();
                if(purMainId == null || purMainId == undefined || purMainId == ''){
                    Swal.fire({
                        title: 'Error!',
                        text: "Requisition Main not found!",
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    });
                }else{
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
                            url: '{{ url('inventory/database/purrequisitionmains') }}/'+purMainId,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}',
                                id: purMainId
                            },
                            success: function(response) {
                                if(response.success){
                                    Swal.fire(
                                        'Deleted!',
                                        'Requisition Main has been deleted.',
                                        'success'
                                    );
                                    window.location.reload();
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
                            'Requisition Main has not been deleted.',
                            'error'
                        );
                    }
                });}
            });
            // Requisition Main Load
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
                    url: "{{ route('inventory.database.purrequisitionmains.search') }}",
                    data: {
                        search: search,
                        match: match,
                        _token: "{{ csrf_token() }}"
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

            // Search Item Data

            $('#search_data').select2({
                    placeholder: 'Search for a Product',
                    minimumInputLength: 2,
                    ajax: {
                        type: 'PUT',
                        url: "{{ route('inventory.database.purrequisitions.search') }}",
                        dataType: 'json',
                        delay: 250,
                        cache: true,
                        data: function (params) {
                            return {
                                search: params.term,
                                type:'search',
                                // match: $('input[name="match"]:checked').val(),
                                _token: "{{ csrf_token() }}"
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
                let req_no = $('#req_no').val();
                console.log(itemId, req_no);
                if(req_no == '') {
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
                    url: "{{ route('inventory.database.purrequisitiondetails.store') }}",
                    data: {
                        item_id: itemId,
                        req_no: req_no,
                        _token: "{{ csrf_token() }}"
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
                                <select name="unit_id" class="form-control form-control-sm updt-enbl is-invalid" data-id="${data.details.id}" id="unit_id_${data.details.id}">
                                    <option value="">Select Unit</option>
                                    ${data.units.map(unit => `<option value="${unit.id}">${unit.name}</option>`).join('')}
                                </select>
                            </td>
                            <td width="10%"><input type="text" class="form-control form-control-sm updt-enbl is-invalid" data-id="${data.details.id}" id="req_qty_${data.details.id}" value="0"></td>

                            <td width="10%">
                                <button type="button" data-id="${data.details.id}" id="update-item-${data.details.id}" class="btn btn-info btn-sm p-1 update-item" disabled>Update</button>
                                <button type="button" data-id="${data.details.id}" id="remove-item-${data.details.id}" class="btn btn-danger btn-sm p-1 remove-item" >Remove</button>
                            </td>
                        </tr>
                        `);
                        $('.updt-enbl').off('change').on('change', function() {
                            let id = $(this).data('id');
                            let value = $(this).val();
                            if(value == '' || value == null || value == undefined || value == 0){
                                $(this).removeClass('is-valid');
                                $(this).addClass('is-invalid');
                            }else{
                                $(this).removeClass('is-invalid');
                                $(this).addClass('is-valid');
                            }
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
                let reqQty = $('#req_qty_'+id).val();
                let unitId = $('#unit_id_'+id).val();

                $.ajax({
                    type: 'PUT',
                    url: "{{ url('inventory/database/purrequisitiondetails') }}/"+id,
                    data: {
                        req_qty: reqQty,
                        for_qty: reqQty,
                        app_qty: reqQty,
                        final_app_qty: reqQty,
                        pur_unit_id: unitId,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        if(data.success){
                            $('#req_qty_'+id).val(Number(data.data.req_qty).toFixed(2));
                            $('#unit_id_'+id).val(data.data.pur_unit_id);
                            $('#req_qty_'+id).removeClass('is-valid');
                            $('#unit_id_'+id).removeClass('is-valid');
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
                    url: "{{ url('inventory/database/purrequisitiondetails') }}"+"/"+id,
                    data: {
                        _token: "{{ csrf_token() }}"
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
            
            $('[data-toggle="tooltip"]').tooltip()

        });

    </script>
@endpush
