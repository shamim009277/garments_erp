@extends('layouts.app')
@section('title', 'HRIS')
@push('styles')
    <style>
        input[type="checkbox"] {
            display: inline-block !important;
            opacity: 1 !important;
        }
    </style>
@endpush
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'HRIS',
                'subtitle' => 'Increment Enforce',
                'breadcrumbs' => [
                    ['label' => 'HRIS', 'url' => route('hris.index')],
                    ['label' => 'Database', 'url' => route('hris.index')],
                    ['label' => 'Increment Enforce', 'url' => route('hris.database.increment-enforce.index')],
                ],
            ])
        </div>
        <div class="col-12 mb-3">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                <!-- Centered Title -->
                <h4 class="text-center flex-grow-1 order-1 order-md-0 mb-2 mb-md-0">
                   Increment Enforce
                </h4>
            </div>
        </div>
        <div class="col-lg-12" style="margin:0px auto">
            <form action="{{ route('hris.database.bulk-increment.store') }}" method="POST">
                @csrf
                <div class="card alert-primary alert-top-border padding-card">
                    <div class="card-header">
                        <h6 class="my-0 text-primary"> <i data-feather="list" width="18" height="18"></i> Increment Enforce</h6>
                    </div>
                    <div style="overflow-x: auto;">
                        <div class="card-body">
                            <table id="datacom" class="table table-sm table-bordered table-hover table-striped" width="100%">
                                <thead>
                                    <tr>
                                        <th>EmpID</th>
                                        <th>Name</th>
                                        <th>Designation</th>
                                        <th>New Designation</th>
                                        <th>Department</th>
                                        <th style="text-align: center;">Line</th>
                                        <th style="text-align: center;">Unit</th>
                                        <th>Joining Date</th>
                                        <th style="text-align: center;">Gross</th>
                                        <th style="text-align: center;">Basic</th>
                                        <th style="text-align: center;">H/Rent</th>
                                        <th style="text-align: center;">Medical</th>
                                        <th>Inc. Date</th>
                                        <th>Eff. Date</th>
                                        <th>Arr. Date</th>
                                        <th style="text-align: center;">Source</th>
                                        <th style="text-align: center;">Value </th>
                                        <th style="text-align: center;">Amount</th>
                                        <th style="text-align: center;">HR % Basic</th>
                                        <th>Type</th>
                                        <th>Remarks</th>
                                    </tr>
                                </thead>

                                <tbody id="increment_enforce_table_body">
                                     @foreach($datas as $data)
                                        <tr>
                                            <td>
                                                <input type="checkbox" class="form-check-input employee" name="employee_ids[]" value="{{ $data->employee_id }}">
                                                {{ str_pad($data->employee_id, 6, '0', STR_PAD_LEFT) }}
                                            </td>
                                            <td>{{ $data->employeeBasic->name }}</td>
                                            <td>{{ $data->designation->designation??'-' }}</td>
                                            <td>{{ $data->new_designation->designation??'-' }}</td>
                                            <td>{{ $data->department->department??'-' }}</td>
                                            <td style="text-align: center;">{{ $data->line??'-' }}</td>
                                            <td style="text-align: center;">{{ $data->unit??'-' }}</td>
                                            <td style="text-align: center;">{{ $data->employeeBasic->joining_date }}</td>
                                            <td style="text-align: center;">{{ $data->gross_salary }}</td>
                                            <td style="text-align: center;">{{ $data->basic }}</td>
                                            <td style="text-align: center;">{{ $data->house_rent_basic }}</td>
                                            <td style="text-align: center;">{{ $data->medical_allowance }}</td>
                                            <td style="text-align: center;">{{ $data->increment_date }}</td>
                                            <td style="text-align: center;">{{ $data->effective_date }}</td>
                                            <td style="text-align: center;">{{ $data->arrear_upto_date }}</td>
                                            <td style="text-align: center;">{{ $data->increment_source }}</td>
                                            <td style="text-align: center;">{{ $data->increment_value }}</td>
                                            <td style="text-align: center;">{{ $data->amount }}</td>
                                            <td style="text-align: center;">{{ $data->house_rent_basic }}</td>
                                            <td>-</td>
                                            <td>{{ $data->remarks }}</td>
                                        </tr>
                                     @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card-footer" style="padding:10px 20px;">
                        <div class="d-flex justify-content-between flex-wrap gap-2">
                            <!-- Left Side Buttons -->
                            <div class="d-flex gap-2">
                                <button type="button" class="btn btn-sm btn-outline-success" id="check_all">
                                    <i data-feather="check-square" width="14" height="14"></i> Check All
                                </button>

                                <button type="button" class="btn btn-sm btn-outline-primary" id="uncheck_all">
                                    <i data-feather="x-square" width="14" height="14"></i> Uncheck All
                                </button>
                            </div>

                            <!-- Right Side Buttons -->
                            <div class="d-flex gap-2">
                                <button type="button" class="btn btn-sm btn-danger" id="discardBtn" disabled>
                                    <i data-feather="log-out" width="14" height="14"></i> Discart
                                </button>

                                <x-primary-button id="submitBtn" type="button" class="btn btn-sm btn-primary submitBtn" disabled>
                                    Enforce
                                </x-primary-button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
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

    $('#check_all').on('click', function () {
        let checkboxes = $('.employee');

        if (checkboxes.length > 0) {
            checkboxes.prop('checked', true);
            $('#check_all').prop('disabled', true);
            $('#uncheck_all').prop('disabled', false);
            handleAddUser();
        } else {
            toastr.error('No found to check all');
        }
    });

    $('#uncheck_all').on('click', function () {
        let checkboxes = $('.employee');

        if (checkboxes.length > 0) {
            checkboxes.prop('checked', false);
            $('#check_all').prop('disabled', false);
            $('#uncheck_all').prop('disabled', true);
            handleAddUser();
        } else {
            toastr.error('No found to uncheck all');
        }
    });

    $(document).on('change', '.employee', function () {
        handleAddUser();
    });

    function handleAddUser() {
        let checkedCount = $('.employee:checked').length;
        if (checkedCount > 0) {
            $('.submitBtn').prop('disabled', false);
        } else {
            $('.submitBtn').prop('disabled', true);
        }
    }
</script>
@endpush
