@extends('layouts.app')
@section('title', 'Payroll')
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
                'title' => 'Payroll',
                'subtitle' => 'Advance',
                'breadcrumbs' => [
                    ['label' => 'Payroll', 'url' => route('payroll.index')],
                    ['label' => 'Database', 'url' => route('payroll.index')],
                    ['label' => 'Advance', 'url' => route('payroll.database.advance.index')],
                ],
            ])
        </div>
        <div class="col-12 mb-3">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                <h4 class="text-center flex-grow-1 order-1 order-md-0 mb-2 mb-md-0">
                    Employee Advance
                </h4>
            </div>
        </div>
        <div class="col-lg-9 pe-lg-0" style="margin:0px auto;">
            <div class="card alert-primary alert-top-border">
                <div class="card-header" style="padding: 15px 16px;">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Advance List</h6>
                </div>
                <div class="card-body" style="overflow-y: auto;">
                    <table id="datacom" class="table table-bordered table-striped" width="100%">
                        <thead>
                            <tr>
                                <th>Advance ID</th>
                                <th>Employee ID</th>
                                <th>Name</th>
                                <th>Department</th>
                                <th>Designation</th>
                                <th>Issue Date</th>
                                <th>R. Start Date</th>
                                <th>Advance</th>
                                <th>Installment</th>
                                <th>Balence</th>
                                <th>Refund</th>
                                <th>Reason</th>
                            </tr>
                        </thead>
                        <tbody >
                            @foreach ($advances as $key => $advance)
                                <tr>
                                    <td>{{ $advance->advance_id }}</td>
                                    <td>{{ str_pad($advance->employee_id, 6, '0', STR_PAD_LEFT) }}</td>
                                    <td>{{ $advance->employee->name }}</td>
                                    <td>{{ $advance->department->department }}</td>
                                    <td>{{ $advance->designation->designation }}</td>
                                    <td class="text-center">{{ $advance->issue_date }}</td>
                                    <td class="text-center">{{ $advance->refund_start_date }}</td>
                                    <td class="text-center">{{ $advance->advance_amount }}</td>
                                    <td class="text-center">{{ $advance->installment_size }}</td>
                                    <td class="text-center">{{ $advance->balance_amount }}</td>
                                    <td class="text-center">{{ $advance->refund_amount }}</td>
                                    <td>{{ $advance->reason }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-3" style="margin:0px auto;">
            <form action="{{ route('payroll.database.advance.store') }}" id="applicantForm" method="POST">
                @csrf
                <div class="card alert-primary alert-top-border">
                    <div class="card-header" style="padding: 15px 16px;">
                        <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Input Parameter For Advance</h6>
                    </div>
                    <div class="card-body" style="overflow-y: auto;">
                        <x-input-group name="employee_id" id="employee_id" label="Employee ID" type="text" class="form-control-sm" value="{{ old('employee_id') }}" placeholder="Employee ID" required />
                        <x-input-group name="name" label="Name" id="name" type="text" class="form-control-sm" value="{{ old('name') }}" placeholder="Name" required  readonly/>
                        <x-input-group name="designation" label="Designation" id="designation" type="text" class="form-control-sm" value="{{ old('designation') }}" placeholder="Designation" readonly/>
                        <x-input-group name="department" label="Department" id="department" type="text" class="form-control-sm" value="{{ old('department') }}" placeholder="Department" readonly/>
                        <x-input-group name="issue_date" label="Issue Date" id="issue_date" type="date" class="form-control-sm" value="{{ old('issue_date') }}" placeholder="Issue Date" required  readonly/>
                        <x-input-group name="refund_start_date" label="Refund Start Date" id="refund_start_date" type="date" class="form-control-sm" value="{{ old('refund_start_date') }}" placeholder="Refund Start Date" required />
                        <x-input-group name="advance_amount" label="Amount" id="advance_amount" type="number" class="form-control-sm" value="{{ old('advance_amount') }}" placeholder="Amount" required />
                        <x-input-group name="installment_size" label="Installment Size" id="installment_size" type="number" class="form-control-sm" value="{{ old('installment_size') }}" placeholder="Installment Size" required />
                        <x-input-group name="reason" label="Reason" id="reason" type="text" class="form-control-sm" value="{{ old('reason') }}" placeholder="Reason" required />
                    </div>
                    <div class="card-footer" style="padding:15px 16px;">
                        <x-primary-button id="submitBtn" class="btn-sm submitBtn float-end" type="submit">Submit</x-primary-button>
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
                    $("#designation").val('');
                    $("#department").val('');

                    if (response && Object.keys(response).length > 0) {
                        $("#name").val(response.name || '');
                        $("#designation").val(response.designation?.designation || '');
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
</script>
@endpush

