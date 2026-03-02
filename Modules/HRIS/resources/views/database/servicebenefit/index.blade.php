@extends('layouts.app')
@section('title', 'HRIS')
@section('content')
@push('styles')
<style>
.table, tr, th, td {
    border: none !important;
    border-collapse: collapse;
}
</style>
@endpush
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'HRIS',
                'subtitle' => 'Service Benefit',
                'breadcrumbs' => [
                    ['label' => 'HRIS', 'url' => route('hris.index')],
                    ['label' => 'Database', 'url' => route('hris.index')],
                    ['label' => 'Service Benefit', 'url' => route('hris.database.servicebenefit.index')],
                ],
            ])
        </div>
        <div class="col-12 mb-3">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                <h4 class="text-center flex-grow-1 order-1 order-md-0 mb-2 mb-md-0">Service Benefit</h4>
            </div>
        </div>
        <div class="col-lg-9 pe-lg-0" style="margin:0px auto;">
            <div class="card alert-primary alert-top-border">
                <div class="card-header" style="padding: 15px 16px;"><h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Service Benefit List For : {{ $monthYear }}</h6></div>
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
                            @foreach($servicebenfits as $key => $servicebenefit)
                                <tr id="row_{{ $servicebenefit->id }}">
                                    <td>{{ $key + 1 }}</td>
                                    <td style="width:100px;">
                                        <div style="display:flex; align-items:center; gap:8px;">
                                            <input type="checkbox"
                                                class="row_checkbox"
                                                name="servicebenefit_id[]"
                                                value="{{ $servicebenefit->id }}" style="display:block !important;">
                                            <span>{{ str_pad($servicebenefit->employee_id, 8, '0', STR_PAD_LEFT) }}</span>
                                        </div>
                                    </td>
                                    <td>{{ $servicebenefit->employee->name }}</td>
                                    <td>{{ $servicebenefit->department->department }}</td>
                                    <td class='text-center'>{{ $servicebenefit->category }}</td>
                                    <td>{{ date('d-m-Y', strtotime($servicebenefit->joining_date)) }}</td>
                                    <td>{{ date('d-m-Y', strtotime($servicebenefit->leaving_date)) }}</td>
                                    <td>{!! \Carbon\Carbon::parse($servicebenefit->joining_date)->diff(\Carbon\Carbon::parse($servicebenefit->leaving_date))->format('%y|%m|%d'); !!}</td>
                                    <td>{{ $servicebenefit->paydays }}</td>
                                    <td>{{ $servicebenefit->basic }}</td>
                                    <td>{{ $servicebenefit->rate }}</td>
                                    <td>{{ $servicebenefit->amount }}</td>
                                    <td>{{ $servicebenefit->stamp }}</td>
                                    <td>{{ $servicebenefit->net_payable }}</td>
                                    <td class='text-center'>{{ $servicebenefit->for_pay }}</td>
                                    <td class="statusCell">
                                        {{ $servicebenefit->status == 'Y' ? 'Paid' : 'Unpaid'}}
                                    </td>
                                    <td class="text-center">
                                        <a href="#" class="btn btn-soft-danger waves-effect waves-light delete-servicebenefit" data-id="{{ $servicebenefit->id }}" style="padding: 4px 6px;"><i class="fas fa-trash"></i></a>
                                    </td>
                              </tr>
                        @endforeach
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
                                                    <x-select-input-group name="status" label="Payment Status" :options="['Y' => 'Paid', 'N' => 'Unpaid']"  required />
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary waves-effect btn-sm" data-bs-dismiss="modal">Close</button>
                                                    <x-primary-button id="submitBtn" class="float-start btn-sm submitBtn">Save changes</x-primary-button>
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
            <form action="{{ route('hris.database.servicebenefit.store') }}" id="applicantForm" method="POST">
                @csrf
                <div class="card alert-primary alert-top-border">
                    <div class="card-header" style="padding: 15px 16px;">
                        <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Input Parameter For Service Benefit</h6>
                    </div>
                    <div class="card-body" style="overflow-y: auto;">
                        <label for="Organization">Organization</label>
                        <x-select-input name="org_id" id="org_id" class="select2" :options="$organizations" :selected="selected_org($organizations)" required /><br><br>
                        <x-input-group name="employee_id" id="employee_id" label="Employee ID" type="text" class="form-control-sm" value="{{ old('employee_id') }}" placeholder="Employee ID" />
                        <x-input-group name="name" label="Name" id="name" type="text" class="form-control-sm" value="{{ old('name') }}" placeholder="Name" required  readonly/>
                        <x-input-group name="department" label="Department" id="department" type="text" class="form-control-sm" value="{{ old('department') }}" placeholder="Department" readonly/>
                        <x-input-group name="start_date" label="Start Date" id="start_date" type="date" class="form-control-sm" value="{{ $startDate }}" placeholder="Start Date" required/>
                        <x-input-group name="end_date" label="End Date" id="end_date" type="date" class="form-control-sm" value="{{ $endDate }}" placeholder="End Date" required/>
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
                        <x-primary-button id="submitBtn" class="btn-sm submitBtn float-end" type="submit">Generate</x-primary-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
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
                    url: "{{ route('payroll.database.advance.employee.info') }}",
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
                    url: '{{ route('hris.database.servicebenefit.delete') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
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
            url: '{{ route('hris.database.servicebenefit.status.update') }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
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
                    url: '{{ route('hris.database.servicebenefit.confirm') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
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
@endpush

