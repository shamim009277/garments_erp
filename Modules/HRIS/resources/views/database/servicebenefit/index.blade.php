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
                <div class="card-header" style="padding: 15px 16px;"><h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Service Benefit List</h6></div>
                <div class="card-body" style="overflow-y: auto;">
                    <table id="datacom" class="table table-bordered table-striped" width="100%">
                        <thead>
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
                                <th>For Pay</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody >

                        </tbody>
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

    $(document).on('click', '.delete-advance', function(e) {
        e.preventDefault();
        let advanceId = $(this).data('id');
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
                    url: '{{ route('payroll.database.advance.delete') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: advanceId
                    },
                    success: function(response) {
                        if(response.success == true){
                            Swal.fire(
                                'Deleted!',
                                'Advance has been deleted.',
                                'success'
                            );
                            $('#row-' + advanceId).remove();
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

