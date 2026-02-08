@extends('layouts.app')
@section('title', 'Payroll')

@push('styles')
    <style>
        .table-wrapper {
            overflow-x: auto;
            border-radius: 6px;
            border: 1px solid #e3e6e9;
            background: #fff;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
            color: #333;
            background: white;
        }

        th {
            background: #eef3f8;
            color: #1b3c74;
            font-weight: 600;
            padding: 6px;
            border: 1px solid #d5d8dc;
            text-align: center;
            vertical-align: middle;
            white-space: nowrap;
        }

        td {
            padding: 6px;
            border: 1px solid #e3e6e9;
            text-align: center;
            vertical-align: middle;
            white-space: nowrap;
            font-size: 12px;
        }

        tbody tr:nth-child(even) {
            background: #fafbfc;
        }

        tbody tr:hover {
            background: #eaf3ff;
            transition: 0.2s ease-in-out;
        }

        /* Nested table header */
        th table {
            border: none !important;
            width: 100%;
        }

        th table th {
            background: transparent;
            border: none;
            padding: 2px;
            font-size: 10px;
            color: #1b3c74;
        }

        /* Sticky header (optional) */
        thead th {
            position: sticky;
            top: 0;
            z-index: 3;
        }
    </style>
@endpush


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

        <div class="col-lg-12">
            <div class="card alert-primary alert-top-border padding-card">

                <div class="card-header text-center">
                    @if ($title == 1)
                        <h6 class="text-primary my-0">Department-wise Salary Report</h6>
                        <p class="text-muted mb-0">Month: {{ $monthName }}, {{ $year }}</p>
                    @endif
                </div>

                @if ($title == 1)
                    <div class="card-body">
                        <div class="table-wrapper">

                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Org</th>
                                        <th>Card</th>
                                        <th>Name</th>

                                        <th>
                                            <table>
                                                <tr>
                                                    <th>Grade</th>
                                                </tr>
                                                <tr>
                                                    <th>Designation</th>
                                                </tr>
                                            </table>
                                        </th>

                                        <th>
                                            <table>
                                                <tr>
                                                    <th>Join Date</th>
                                                </tr>
                                                <tr>
                                                    <th>Resign Date</th>
                                                </tr>
                                            </table>
                                        </th>
                                        <th>
                                            <table>
                                                <tr>
                                                    <th>WK</th>
                                                </tr>
                                                <tr>
                                                    <th>GWH</th>
                                                </tr>
                                            </table>
                                        </th>

                                        <th>
                                            <table>
                                                <tr>
                                                    <th colspan="4">Days Status</th>
                                                </tr>
                                                <tr>
                                                    <th>Days</th>
                                                    <th>PR</th>
                                                    <th>AB</th>
                                                    <th>Leave</th>
                                                </tr>
                                            </table>
                                        </th>
                                        <th>Basic</th>
                                        <th>House <br> Rent</th>

                                        <th>
                                            <table>
                                                <tr>
                                                    <th>Medical</th>
                                                </tr>
                                                <tr>
                                                    <th>Food</th>
                                                </tr>
                                            </table>
                                        </th>

                                        <th>
                                            <table>
                                                <tr>
                                                    <th>Conv.</th>
                                                </tr>
                                                <tr>
                                                    <th>Other</th>
                                                </tr>
                                            </table>
                                        </th>

                                        <th>Total <br> Salary</th>
                                        <th>Basic <br> Payable</th>
                                        <th>Attn. <br> Bonus</th>
                                        <th>Gross <br> Payable</th>
                                        <th>
                                            <table>
                                                <tr>
                                                    <th>L.Day</th>
                                                </tr>
                                                <tr>
                                                    <th>Att.</th>
                                                </tr>
                                            </table>
                                        </th>

                                        <th>
                                            <table>
                                                <tr>
                                                    <th colspan="3">Over Time</th>
                                                </tr>
                                                <tr>
                                                    <th>Hrs</th>
                                                    <th>Rate</th>
                                                    <th>Amount</th>
                                                </tr>
                                            </table>
                                        </th>

                                        <th>Arr. Amt</th>

                                        <th>
                                            <table>
                                                <tr>
                                                    <th>NT</th>
                                                    <th>IF</th>
                                                    <th>WK</th>
                                                </tr>
                                                <tr>
                                                    <th>TF</th>
                                                    <th>DN</th>
                                                    <th>Gvt</th>
                                                </tr>
                                            </table>
                                        </th>
                                        <th>
                                            <table style="width: 100%;">
                                                <tr>
                                                    <th colspan="4">Deduction</th>
                                                </tr>
                                                <tr>
                                                    <th width="25%">Advance</th>
                                                    <th width="25%">Absent</th>
                                                    <th width="25%">Other</th>
                                                    <th width="25%">Stm</th>
                                                </tr>
                                            </table>
                                        </th>
                                        <th>Total <br> Deduction</th>
                                        <th>Net <br> Payable</th>
                                        <th>Signature /<br> Account No</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($uniqueDepartments as $department)
                                       @php
                                           $orgName = optional($datas->first())->short_name;
                                           $salaries = collect($datas)->where('department', $department);
                                       @endphp
                                        <tr>
                                            <td colspan="24" style="font-weight: bold; text-align: left;">Department: {{ $department }}</td>
                                        </tr>
                                        @foreach($salaries as $salary)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $orgName }}</td>
                                                <td>{{ str_pad($salary->employee_id, 6, '0', STR_PAD_LEFT) }}</td>
                                                <td>{{ $salary->name }}</td>
                                                <td>
                                                    <table>
                                                        <tr>
                                                            <td>{{ $salary->grade }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>{{ $salary->designation }}</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td>
                                                    <table>
                                                        <tr>
                                                            <td>{{ date('d-m-Y', strtotime($salary->joining_date)) }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>-</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td>
                                                    <table>
                                                        <tr>
                                                            <td>{{ $salary->weekend_days }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>{{ $salary->general_holiday_days }}</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td>
                                                    <table>
                                                        <tr>
                                                            <td>{{ $salary->days }}</td>
                                                            <td>{{ $salary->days - $salary->absent_days }}</td>
                                                            <td>{{ $salary->absent_days }}</td>
                                                            <td>{{ $salary->leave_days }}</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td>{{ $salary->basic }}</td>
                                                <td>{{ $salary->home_allowance }}</td>
                                                <td>
                                                    <table>
                                                        <tr>
                                                            <td>{{ $salary->medical_allowance }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>{{ $salary->food_allowance }}</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td>
                                                    <table>
                                                        <tr>
                                                            <td>{{ $salary->conveyance }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>{{ $salary->other_allowance }}</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td>{{ $salary->gross_salary }}</td>
                                                <td>{{ $salary->basic }}</td>
                                                <td>{{ $salary->attendance_bonus }}</td>
                                                <td>{{ number_format($salary->gross_salary + $salary->attendance_bonus, 2) }}</td>
                                                <td>
                                                    <table>
                                                        <tr>
                                                            <td>{{ $salary->late_days }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>0</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td>
                                                    <table>
                                                        <tr>
                                                            <td>{{ $salary->total_ot_hour }}</td>
                                                            <td>{{ ($salary->total_ot_hour > 0) ? $salary->ot_rate : 0 }}</td>
                                                            <td>{{ ($salary->total_ot_hour > 0) ? $salary->total_ot_amount : 0 }}</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td>0</td>
                                                <td>
                                                    <table>
                                                        <tr>
                                                            <td>0</td>
                                                            <td>0</td>
                                                            <td>0</td>
                                                        </tr>
                                                        <tr>
                                                            <td>0</td>
                                                            <td>0</td>
                                                            <td>0</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td>
                                                    <table style="width: 100%;">
                                                        <tr>
                                                            <td width="25%">{{ $salary->advance_refund }}</td>
                                                            <td width="25%">{{ $salary->absent_deduction }}</td>
                                                            <td width="25%">{{ $salary->other_deduction }}</td>
                                                            <td width="25%">0</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td>{{ $salary->total_deduction }}</td>
                                                <td>{{ number_format($salary->total_net_payable, 2) }}</td>
                                                <td>{{ $salary->account_no }}</td>
                                            </tr>
                                        @endforeach
                                        <!-- Subtotal Row -->
                                        <tr style="font-weight:bold; background: #69b9f3;">
                                            <td colspan="8">Subtotal</td>
                                            <td>{{ number_format($salaries->sum('basic'), 2) }}</td>
                                            <td>{{ number_format($salaries->sum('home_allowance'), 2) }}</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>{{ number_format($salaries->sum('gross_salary'), 2) }}</td>
                                            <td>{{ number_format($salaries->sum('basic'), 2) }}</td>
                                            <td>{{ number_format($salaries->sum('attendance_bonus'), 2) }}</td>
                                            <td>{{ number_format($salaries->sum('gross_salary') + $salaries->sum('attendance_bonus'), 2) }}</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>{{ number_format($salaries->sum('total_deduction'), 2) }}</td>
                                            <td>{{ number_format($salaries->sum('total_net_payable'), 2) }}</td>
                                            <td></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
