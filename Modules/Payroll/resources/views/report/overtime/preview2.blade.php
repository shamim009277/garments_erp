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
                    ['label' => 'Overtime', 'url' => route('payroll.report.overtime-report.index')],
                ],
            ])
        </div>
        <div class="col-lg-12 pr-0">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    @if ($title == 3)
                        <h6 class="my-0 text-primary text-center">Department-wise Monthly Total Overtime</h6>
                        <p class="ms-auto text-center" style="padding-bottom:0px;margin-bottom:0px;">Month: {{ $monthName }}, {{ $year }}</p>
                        <p class="ms-auto text-center" style="padding-top:0px;">Organization: {{ $organization }}</p>
                    @endif
                </div>
                @if ($title == 3)
                    <div class="card-body">
                        <div style="overflow-x: auto;">
                            <table class="table table-bordered table-hover table-striped" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th width="5%">SL</th>
                                        <th width="10%">Employee ID</th>
                                        <th width="15%">Employee Name</th>
                                        <th width="15%">Department</th>
                                        <th width="15%">Designation</th>
                                        <th width="10%" class="text-center">Category</th>
                                        <th width="10%" class="text-center">Total OT Hour</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @php
                                        $grandTotal = 0;
                                    @endphp

                                    @foreach ($sectionGrouped as $section => $overtimes)
                                        @php
                                            $sectionDepartment = $overtimes->groupBy('department');
                                            $sectionTotal = 0;
                                        @endphp

                                        @foreach ($sectionDepartment as $department => $datas)
                                            @php
                                                $deptTotal = $datas->sum('total_ot');
                                                $sectionTotal += $deptTotal;
                                                $grandTotal += $deptTotal; // ✅ grand total
                                            @endphp

                                            {{-- Header --}}
                                            <tr style="height: 40px; font-weight: bold; background:#babcd8;">
                                                <td colspan="7">
                                                    Department: <span style="color:#5156be;">{{ $section }}</span>
                                                    &nbsp;&nbsp;
                                                    Section: <span style="color:#5156be;">{{ $department }}</span>
                                                </td>
                                            </tr>

                                            {{-- Employee Rows --}}
                                            @foreach ($datas as $data)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ str_pad($data->employee_id, 8, '0', STR_PAD_LEFT) }}</td>
                                                    <td>{{ $data->name }}</td>
                                                    <td>{{ $data->department }}</td>
                                                    <td>{{ $data->designation }}</td>
                                                    <td class="text-center">{{ $data->category_code }}</td>
                                                    <td class="text-center">{{ $data->total_ot }}</td>
                                                </tr>
                                            @endforeach

                                            {{-- Department Summary --}}
                                            <tr>
                                                <td colspan="6" style="background:#032a52;color:#8f0808;">
                                                    <strong>Department Summary ({{ $department }})</strong>
                                                </td>
                                                <td class="text-center" style="background:#032a52;color:#8f0808;">
                                                    <strong>{{ $deptTotal }}</strong>
                                                </td>
                                            </tr>
                                        @endforeach

                                        {{-- Section Summary --}}
                                        <tr>
                                            <td colspan="6">
                                                <strong>Section Summary ({{ $section }})</strong>
                                            </td>
                                            <td class="text-center">
                                                <strong>{{ $sectionTotal }}</strong>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                                {{-- ✅ Grand Total --}}
                                <tfoot>
                                    <tr>
                                        <th colspan="6" class="text-right" style="background-color: rgb(213, 139, 2); color:black">Total Overtime Hour</th>
                                        <th class="text-center" style="background-color: rgb(213, 139, 2); color:black">{{ $grandTotal }}</th>
                                    </tr>
                                </tfoot>

                            </table>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
