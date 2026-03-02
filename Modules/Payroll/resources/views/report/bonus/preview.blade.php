@extends('layouts.app')
@section('title', 'Payroll')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'Payroll',
                'subtitle' => 'Overtime',
                'breadcrumbs' => [
                    ['label' => 'Payroll', 'url' => route('payroll.index')],
                    ['label' => 'Report', 'url' => route('payroll.index')],
                    ['label' => 'Overtime', 'url' => route('payroll.report.bonus-report.index')],
                ],
            ])
        </div>
        <div class="col-lg-12 pr-0">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    @if ($title == 1)
                        <h6 class="my-0 text-primary text-center">Department-wise Bonus Report</h6>
                        <p class="ms-auto text-center">Date: </p>
                    @elseif($title == 2)
                        <h6 class="my-0 text-primary text-center">Individual Card Wise Monthly Bonus Report</h6>
                    @endif
                </div>
                @if ($title == 1)
                    <div class="card-body">
                        <div style="overflow-x: auto;">
                            <table class="table table-bordered table-hover table-striped" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="4%">SL</th>
                                        <th class="text-center" width="6%">Org</th>
                                        <th class="text-center" width="6%">Year</th>
                                        <th class="text-center" width="6%">Month</th>
                                        <th width="10%">Employee ID</th>
                                        <th width="15%">Name</th>
                                        <th width="12%">Department</th>
                                        <th width="12%">Designation</th>
                                        <th width="6%">Category</th>
                                        <th class="text-center" width="10%">Base Date</th>
                                        <th width="10%">Basic Salary</th>
                                        <th width="10%">Amount</th>
                                        <th width="10%">Percentage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($uniqueDepartments as $key => $department)
                                        <tr style="height: 40px; font-weight: bold; --bs-table-bg:#babcd8 !important;">
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td style="color: #5156be;">{{ $department }}</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        @php
                                            $bonuses = collect($datas)->where('department_id', $key)->all();
                                        @endphp
                                        @foreach ($bonuses as $bonus)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-center">{{ $bonus->short_name }}</td>
                                                <td class="text-center">{{ $bonus->year }}</td>
                                                <td class="text-center">{{ \Carbon\Carbon::create()->month($bonus->month)->format('F') }}</td>
                                                <td>{{ str_pad($bonus->employee_id, 8, '0', STR_PAD_LEFT) }}</td>
                                                <td>{{ $bonus->name }}</td>
                                                <td>{{ $bonus->department }}</td>
                                                <td>{{ $bonus->designation }}</td>
                                                <td class="text-center">{{ $bonus->category }}</td>
                                                <td class="text-center">{{ date('d-m-Y', strtotime($bonus->base_date)) }}</td>
                                                <td>{{ number_format($bonus->basic, 2) }}</td>
                                                <td>{{ number_format($bonus->amount, 2) }}</td>
                                                <td>{{ number_format($bonus->percentage, 2) }}</td>
                                                <td class="text-center"></td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @elseif ($title == 2)
                    <div class="card-body">
                        <div style="overflow-x: auto;">
                            <table style="width: 100%; text-align: center; font-weight: bold;">
                                <tr>
                                    <td colspan="10">
                                        Employee Name: {{ $datas->name }} <br>
                                        Employee ID: {{ str_pad($datas->employee_id, 8, '0', STR_PAD_LEFT) }} <br>
                                        Designation: {{ $datas->designation }} <br>
                                        Department: {{ $datas->department }} <br>
                                        Line: {{ $datas->line }} <br>
                                    </td>
                                </tr>
                            </table>
                            <table class="table table-bordered table-hover table-striped" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="4%">SL</th>
                                        <th class="text-center" width="6%">Org</th>
                                        <th class="text-center" width="6%">Year</th>
                                        <th class="text-center" width="6%">Month</th>
                                        <th width="12%">Department</th>
                                        <th width="12%">Designation</th>
                                        <th width="6%">Category</th>
                                        <th class="text-center" width="10%">Base Date</th>
                                        <th width="10%">Basic Salary</th>
                                        <th width="10%">Amount</th>
                                        <th width="10%">Percentage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">#</td>
                                        <td class="text-center">{{ $datas->short_name }}</td>
                                        <td class="text-center">{{ $datas->year }}</td>
                                        <td class="text-center">{{ \Carbon\Carbon::create()->month($datas->month)->format('F') }}</td>
                                        <td>{{ $datas->department }}</td>
                                        <td>{{ $datas->designation }}</td>
                                        <td class="text-center">{{ $datas->category }}</td>
                                        <td class="text-center">{{ date('d-m-Y', strtotime($datas->base_date)) }}</td>
                                        <td>{{ number_format($datas->basic, 2) }}</td>
                                        <td>{{ number_format($datas->amount, 2) }}</td>
                                        <td>{{ number_format($datas->percentage, 2) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('.table').DataTable({
            'paging': false,
            'searching': false,
            'ordering': false,
            'dom': 'Bfrtip',
            'buttons': [{
                'extend': 'excelHtml5',
                'title': 'Employee Listing',
                'filename': 'Employee Listing',
                'className': 'btn btn-info btn-sm'
            }]
        });
    </script>
@endpush
