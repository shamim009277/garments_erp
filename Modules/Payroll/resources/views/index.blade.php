@extends('layouts.app')
@section('title', 'Payroll')
@push('styles')
    <style>
        .card {
            border-radius: 8px;
            transition: all .2s ease;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, .15);
        }

        .card .badge {
            padding: 6px 10px;
            font-weight: 500;
        }

        .card h3 {
            font-size: 1.6rem;
            font-weight: 700;
        }

        .fw-semibold {
            font-weight: 500 !important;
            font-size: 1rem !important;
        }

        .diff-trend {
            display: inline-flex;
            align-items: center;
            gap: 2px;
            padding: 4px 8px;
            border-radius: 20px;
            font-size: 0.72rem;
            font-weight: 600;
            background: rgba(255, 255, 255, 0.18);
            color: #fff;
        }

        .diff-trend.trend-up   { color: #e6ffe6; }
        .diff-trend.trend-down { color: #ffe6e6; }
        .diff-trend.trend-flat { color: #fff; }

        .dashboard-chart-card {
            border: 1px solid #e9ecef !important;
            box-shadow: 0 1px 2px rgba(56, 65, 74, 0.08) !important;
        }

        .dashboard-chart-card:hover {
            transform: none;
            box-shadow: 0 1px 2px rgba(56, 65, 74, 0.08) !important;
        }

        .dashboard-chart-card .card-header {
            padding: 16px 20px;
            background: #fff;
        }

        .dashboard-chart-card .chart-icon-box {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(85, 110, 230, 0.12);
            color: #556ee6;
            font-size: 22px;
        }

        .dashboard-chart-card .company-legend-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 8px 10px;
            border-radius: 6px;
            background: #f8f9fa;
            margin-bottom: 8px;
        }

        .dashboard-chart-card .company-legend-item:last-child {
            margin-bottom: 0;
        }

        .dashboard-chart-card .legend-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 8px;
        }
    </style>
@endpush
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Payroll | <span class="text-muted font-size-12">Dashboard</span></h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i data-feather="home" class="icon-xs align-middle me-1"></i></a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Payroll</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card dashboard-chart-card">
                <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2 py-3"
                    style="padding:16px 20px">
                    <div>
                        <h2 style="padding:0px; margin:0px; font-size:18px;">৳ Payroll Overview</h2>
                        <p class="mb-0 mt-1 text-muted font-size-12" id="period-label">
                            For {{ $currentMonthName }} • vs {{ $prevMonthName }}
                        </p>
                    </div>
                    <div class="filter-select" style="max-width: 400px;">
                        <x-select-input style="max-width: 400px !important;" name="org_id" id="org_id"
                            class="select2 w-100" :options="$organizations" :selected="$orgId" required />
                    </div>
                </div>

                <div class="card-body">
                    <div class="row row-cols-2 row-cols-md-4 row-cols-xl-6 g-3">

                        <!-- 1. Total Net Salary -->
                        <div class="col">
                            <div class="card border-0 shadow-sm text-white h-100" style="background:linear-gradient(135deg,#7b1fa2,#9c27b0);">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <small class="fw-semibold text-white-100">Net Salary</small>
                                            <h3 class="fw-bold mb-1" id="net-payable">৳ {{ number_format($netPayable, 0) }}</h3>
                                            <div class="d-flex gap-2 align-items-center flex-wrap">
                                                <span class="badge bg-light text-dark">{{ $currentMonthName }}</span>
                                                @php
                                                    $d = $netPayableDiff;
                                                    $cls = $d > 0 ? 'trend-up' : ($d < 0 ? 'trend-down' : 'trend-flat');
                                                    $ic  = $d > 0 ? 'bx-trending-up' : ($d < 0 ? 'bx-trending-down' : 'bx-minus');
                                                @endphp
                                                <span class="diff-trend {{ $cls }}" id="net-diff-badge">
                                                    <i class="bx {{ $ic }}"></i> {{ $d > 0 ? '+' : '' }}{{ $d }}%
                                                </span>
                                            </div>
                                        </div>
                                        <div class="fs-1 opacity-75">
                                            <i class="bx bx-wallet"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 2. Total Gross Salary -->
                        <div class="col">
                            <div class="card border-0 shadow-sm bg-primary bg-gradient text-white h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <small class="fw-semibold text-white-100">Gross Salary</small>
                                            <h3 class="fw-bold mb-1" id="gross-payable">৳ {{ number_format($grossPayable, 0) }}</h3>
                                            <div class="d-flex gap-2 align-items-center flex-wrap">
                                                <span class="badge bg-light text-primary">{{ $currentMonthName }}</span>
                                                @php
                                                    $d = $grossPayableDiff;
                                                    $cls = $d > 0 ? 'trend-up' : ($d < 0 ? 'trend-down' : 'trend-flat');
                                                    $ic  = $d > 0 ? 'bx-trending-up' : ($d < 0 ? 'bx-trending-down' : 'bx-minus');
                                                @endphp
                                                <span class="diff-trend {{ $cls }}" id="gross-diff-badge">
                                                    <i class="bx {{ $ic }}"></i> {{ $d > 0 ? '+' : '' }}{{ $d }}%
                                                </span>
                                            </div>
                                        </div>
                                        <div class="fs-1 opacity-75">
                                            <i class="bx bx-money"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 3. Total OT Amount -->
                        <div class="col">
                            <div class="card border-0 shadow-sm bg-info bg-gradient text-white h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <small class="fw-semibold text-white-100">Overtime Amount</small>
                                            <h3 class="fw-bold mb-1" id="ot-amount">৳ {{ number_format($totalOtAmount, 0) }}</h3>
                                            <div class="d-flex gap-2 align-items-center flex-wrap">
                                                <span class="badge bg-light text-info">{{ $currentMonthName }}</span>
                                                @php
                                                    $d = $totalOtAmountDiff;
                                                    $cls = $d > 0 ? 'trend-up' : ($d < 0 ? 'trend-down' : 'trend-flat');
                                                    $ic  = $d > 0 ? 'bx-trending-up' : ($d < 0 ? 'bx-trending-down' : 'bx-minus');
                                                @endphp
                                                <span class="diff-trend {{ $cls }}" id="ot-amount-diff-badge">
                                                    <i class="bx {{ $ic }}"></i> {{ $d > 0 ? '+' : '' }}{{ $d }}%
                                                </span>
                                            </div>
                                        </div>
                                        <div class="fs-1 opacity-75">
                                            <i class="bx bx-time-five"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 4. Advance Deduction -->
                        <div class="col">
                            <div class="card border-0 shadow-sm text-white h-100" style="background:linear-gradient(135deg,#a2951f,#70b027);">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <small class="fw-semibold text-white-100">Advance Deduction</small>
                                            <h3 class="fw-bold mb-1" id="advance-amount">৳ {{ number_format($advanceAmount, 0) }}</h3>
                                            <div class="d-flex gap-2 align-items-center flex-wrap">
                                                <span class="badge bg-light text-dark">{{ $currentMonthName }}</span>
                                                @php
                                                    $d = $advanceAmountDiff;
                                                    $cls = $d > 0 ? 'trend-down' : ($d < 0 ? 'trend-up' : 'trend-flat');
                                                    $ic  = $d > 0 ? 'bx-trending-up' : ($d < 0 ? 'bx-trending-down' : 'bx-minus');
                                                @endphp
                                                <span class="diff-trend {{ $cls }}" id="advance-diff-badge">
                                                    <i class="bx {{ $ic }}"></i> {{ $d > 0 ? '+' : '' }}{{ $d }}%
                                                </span>
                                            </div>
                                        </div>
                                        <div class="fs-1 opacity-75">
                                            <i class="bx bx-credit-card-front"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 5. Total Deduction -->
                        <div class="col">
                            <div class="card border-0 shadow-sm text-white h-100" style="background:linear-gradient(135deg,#f19021,#760399);">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <small class="fw-semibold text-white-100">Deduction</small>
                                            <h3 class="fw-bold mb-1" id="total-deduction">৳ {{ number_format($totalDeduction, 0) }}</h3>
                                            <div class="d-flex gap-2 align-items-center flex-wrap">
                                                <span class="badge bg-light text-dark">{{ $currentMonthName }}</span>
                                                @php
                                                    $d = $totalDeductionDiff;
                                                    $cls = $d > 0 ? 'trend-down' : ($d < 0 ? 'trend-up' : 'trend-flat');
                                                    $ic  = $d > 0 ? 'bx-trending-up' : ($d < 0 ? 'bx-trending-down' : 'bx-minus');
                                                @endphp
                                                <span class="diff-trend {{ $cls }}" id="deduction-diff-badge">
                                                    <i class="bx {{ $ic }}"></i> {{ $d > 0 ? '+' : '' }}{{ $d }}%
                                                </span>
                                            </div>
                                        </div>
                                        <div class="fs-1 opacity-75">
                                            <i class="bx bx-credit-card-front"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 6. Total OT Hours -->
                        <div class="col">
                            <div class="card border-0 shadow-sm text-white h-100"
                                style="background:linear-gradient(135deg,#2d8bff,#40c4ff);">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <small class="fw-semibold text-white-100">Overtime Hours</small>
                                            <h3 class="fw-bold mb-1" id="ot-hours">{{ number_format($totalOtHour, 0) }}</h3>
                                            <div class="d-flex gap-2 align-items-center flex-wrap">
                                                <span class="badge bg-light text-dark">{{ $currentMonthName }}</span>
                                                @php
                                                    $d = $totalOtHourDiff;
                                                    $cls = $d > 0 ? 'trend-up' : ($d < 0 ? 'trend-down' : 'trend-flat');
                                                    $ic  = $d > 0 ? 'bx-trending-up' : ($d < 0 ? 'bx-trending-down' : 'bx-minus');
                                                @endphp
                                                <span class="diff-trend {{ $cls }}" id="ot-hours-diff-badge">
                                                    <i class="bx {{ $ic }}"></i> {{ $d > 0 ? '+' : '' }}{{ $d }}%
                                                </span>
                                            </div>
                                        </div>
                                        <div class="fs-1 opacity-75">
                                            <i class="bx bx-timer"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        @php
            $chartColors = ['#556ee6', '#34c38f', '#f46a6a', '#f1b44c', '#50a5f1', '#343a40', '#9c27b0', '#ef6c00'];
        @endphp

        <div class="col-md-4 pe-md-0" style="margin-bottom:10px;">
            <div class="card dashboard-chart-card h-100">
                <div class="card-header border-bottom d-flex align-items-center justify-content-between flex-wrap gap-2">
                    <div class="d-flex align-items-center gap-3">
                        <div class="chart-icon-box">
                            <i class="bx bx-pie-chart-alt-2"></i>
                        </div>
                        <div>
                            <h5 class="card-title mb-1">Company Wise Processed Employee & Salary</h5>
                            <p class="text-muted mb-0 font-size-12">Employees + Net Salary from Process Salary ({{ $currentMonthName }})</p>
                        </div>
                    </div>
                    <div class="text-end">
                        <div class="d-flex flex-column gap-1 align-items-end">
                            <span class="badge bg-primary" id="chart-total-employees">{{ number_format($totalChartEmployees) }} Total Employees</span>
                            <span class="badge bg-success" id="chart-total-salary-donut">৳ {{ number_format($totalChartNetPayable, 0) }} Net Salary</span>
                        </div>
                        <div class="text-muted font-size-11 mt-1" id="chart-total-companies">{{ $totalChartCompanies }}
                            {{ Str::plural('Company', $totalChartCompanies) }}</div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="company-employee-chart"></div>
                </div>
            </div>
        </div>

        <div class="col-md-8" style="margin-bottom:10px;">
            <div class="card dashboard-chart-card h-100">
                <div class="card-header border-bottom d-flex align-items-center justify-content-between flex-wrap gap-2">
                    <div class="d-flex align-items-center gap-3">
                        <div class="chart-icon-box">
                            <i class="bx bx-bar-chart-alt-2"></i>
                        </div>
                        <div>
                            <h5 class="card-title mb-1">Company Wise Net Payable Salary (Last Month vs Current)</h5>
                            <p class="text-muted mb-0 font-size-12" id="salary-chart-subtitle">{{ $prevMonthName }} vs {{ $currentMonthName }} — Net Salary Comparison</p>
                        </div>
                    </div>
                    <div class="text-end">
                        <span class="badge bg-success" id="chart-total-salary">৳ {{ number_format($totalChartNetPayable, 0) }} Total</span>
                        <div class="text-muted font-size-11 mt-1" id="salary-total-companies">{{ $totalChartCompanies }}
                            {{ Str::plural('Company', $totalChartCompanies) }}</div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="company-salary-chart"></div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        let companyEmployeeChart;
        let companySalaryChart;
        const chartColors = @json($chartColors);

        window.__payrollMonthLabels = window.__payrollMonthLabels || {};
        window.__payrollMonthLabels.current = @json($currentMonthName);
        window.__payrollMonthLabels.prev    = @json($prevMonthName);

        function fmtTaka(n) { return '৳ ' + Number(n).toLocaleString(undefined, { maximumFractionDigits: 0 }); }
        function fmtNum(n)  { return Number(n).toLocaleString(); }

        function setDiffBadge(badgeId, pct, reverseColors) {
            const el = document.getElementById(badgeId);
            if (!el) return;
            let cls, ic;
            if (reverseColors) {
                cls = pct > 0 ? 'trend-down' : (pct < 0 ? 'trend-up'   : 'trend-flat');
            } else {
                cls = pct > 0 ? 'trend-up'   : (pct < 0 ? 'trend-down' : 'trend-flat');
            }
            ic = pct > 0 ? 'bx-trending-up' : (pct < 0 ? 'bx-trending-down' : 'bx-minus');
            el.className = 'diff-trend ' + cls;
            el.innerHTML = '<i class="bx ' + ic + '"></i> ' + (pct > 0 ? '+' : '') + pct + '%';
        }

        $(document).ready(function() {
            initCharts(@json($companyWisePayroll));

            $('#org_id').on('select2:select change', function(e) {
                updateDashboard($(this).val());
            });
        });

        async function updateDashboard(orgId) {
            try {
                const response = await fetch('{{ route('payroll.dashboard-data') }}?org_id=' + (orgId || ''));
                const d = await response.json();

                document.getElementById('net-payable').textContent       = fmtTaka(d.netPayable);
                document.getElementById('gross-payable').textContent     = fmtTaka(d.grossPayable);
                document.getElementById('ot-amount').textContent         = fmtTaka(d.totalOtAmount);
                document.getElementById('advance-amount').textContent    = fmtTaka(d.advanceAmount);
                document.getElementById('total-deduction').textContent   = fmtTaka(d.totalDeduction);
                document.getElementById('ot-hours').textContent          = fmtNum(d.totalOtHour);
                document.getElementById('period-label').textContent      = 'For ' + d.currentMonthName + ' • vs ' + d.prevMonthName;
                document.getElementById('salary-chart-subtitle').textContent = d.prevMonthName + ' vs ' + d.currentMonthName + ' — Net Salary Comparison';

                setDiffBadge('net-diff-badge',          d.netPayableDiff,       false);
                setDiffBadge('gross-diff-badge',        d.grossPayableDiff,     false);
                setDiffBadge('ot-amount-diff-badge',    d.totalOtAmountDiff,    false);
                setDiffBadge('advance-diff-badge',      d.advanceAmountDiff,    true);
                setDiffBadge('deduction-diff-badge',    d.totalDeductionDiff,   true);
                setDiffBadge('ot-hours-diff-badge',     d.totalOtHourDiff,      false);

                window.__payrollMonthLabels.current = d.currentMonthName;
                window.__payrollMonthLabels.prev    = d.prevMonthName;

                const newTotalChartEmployees  = d.companyWisePayroll.reduce((s, i) => s + (Number(i.employee_count) || 0), 0);
                const newTotalChartNetPayable = d.companyWisePayroll.reduce((s, i) => s + (Number(i.net_payable)    || 0), 0);
                const newTotalChartCompanies  = d.companyWisePayroll.length;
                document.getElementById('chart-total-employees').textContent     = fmtNum(newTotalChartEmployees) + ' Total Employees';
                document.getElementById('chart-total-salary-donut').textContent  = fmtTaka(newTotalChartNetPayable) + ' Net Salary';
                document.getElementById('chart-total-companies').textContent     = newTotalChartCompanies + ' ' + (newTotalChartCompanies === 1 ? 'Company' : 'Companies');
                document.getElementById('salary-total-companies').textContent    = newTotalChartCompanies + ' ' + (newTotalChartCompanies === 1 ? 'Company' : 'Companies');
                document.getElementById('chart-total-salary').textContent        = fmtTaka(newTotalChartNetPayable) + ' Total';

                initCharts(d.companyWisePayroll);
            } catch (error) {
                console.error('Error updating payroll dashboard:', error);
            }
        }

        function initCharts(companyWisePayroll) {
            if (!Array.isArray(companyWisePayroll)) companyWisePayroll = [];

            const totalEmployees = companyWisePayroll.reduce((s, i) => s + (Number(i.employee_count) || 0), 0);
            const totalNetSalary = companyWisePayroll.reduce((s, i) => s + (Number(i.net_payable)    || 0), 0);
            const totalCompanies = companyWisePayroll.length;

            const donutLabels  = companyWisePayroll.map(i => i.short_name || i.name);
            const donutSeries  = companyWisePayroll.map(i => Number(i.employee_count) || 0);
            const barLabels    = companyWisePayroll.map(i => i.short_name || i.name);
            const totalNetSalaryCur  = Number(totalNetSalary);
            const totalNetSalaryPrev = companyWisePayroll.reduce((s, i) => s + (Number(i.net_payable_prev) || 0), 0);

            const currentMonthLabel = window.__payrollMonthLabels?.current || 'This Month';
            const prevMonthLabel    = window.__payrollMonthLabels?.prev    || 'Last Month';
            const barSeries    = [
                {
                    name: currentMonthLabel,
                    data: companyWisePayroll.map(i => Number(i.net_payable) || 0),
                },
                {
                    name: prevMonthLabel,
                    data: companyWisePayroll.map(i => Number(i.net_payable_prev) || 0),
                },
            ];

            // ========== Donut: Company Wise Employee ==========
            const donutEl = document.querySelector('#company-employee-chart');
            if (donutEl) {
                if (companyEmployeeChart) { try { companyEmployeeChart.destroy(); } catch(e) {} companyEmployeeChart = null; }
                if (!donutSeries.length || donutSeries.every(v => v === 0)) {
                    donutEl.innerHTML = `
                        <div class="text-center text-muted py-5">
                            <i class="bx bx-pie-chart-alt-2 font-size-24 d-block mb-2"></i>
                            No processed employee data available
                        </div>`;
                } else {
                    const donutOptions = {
                        series: donutSeries,
                        chart: {
                            type: 'donut',
                            height: 300,
                            fontFamily: 'inherit',
                        },
                        labels: donutLabels,
                        colors: chartColors,
                        legend: { show: false },
                        stroke: { width: 2, colors: ['#fff'] },
                        plotOptions: {
                            pie: {
                                dataLabels: { offset: -8 },
                                donut: {
                                    size: '68%',
                                    labels: {
                                        show: true,
                                        name: {
                                            show: true, fontSize: '12px', color: '#74788d', offsetY: -14,
                                        },
                                        value: {
                                            show: true, fontSize: '20px', fontWeight: 700, color: '#343a40', offsetY: -2,
                                            formatter: function(val) { return Number(val).toLocaleString() + ' Emps'; },
                                        },
                                        total: {
                                            show: true,
                                            label: 'Salary Total',
                                            fontSize: '11px',
                                            color: '#556ee6',
                                            offsetY: 22,
                                            formatter: function() { return fmtTaka(totalNetSalaryCur); },
                                        },
                                    },
                                },
                            },
                        },
                        dataLabels: {
                            enabled: true,
                            style: { fontSize: '10px', fontWeight: 600 },
                            dropShadow: { enabled: false },
                            formatter: function(val, opts) {
                                const idx = opts.seriesIndex;
                                const v = Number(opts.w.globals.series[idx]);
                                const pct = totalEmployees > 0 ? ((v / totalEmployees) * 100).toFixed(1) : 0;
                                const np = companyWisePayroll[idx]?.net_payable || 0;
                                if (np >= 1000000) return pct + '%\n' + (np/1000000).toFixed(1) + 'M';
                                if (np >= 1000)    return pct + '%\n' + (np/1000).toFixed(0) + 'K';
                                return pct + '%';
                            },
                        },
                        tooltip: {
                            y: {
                                formatter: function(val, { seriesIndex }) {
                                    const name = donutLabels[seriesIndex];
                                    const empCount = Number(donutSeries[seriesIndex]);
                                    const np = companyWisePayroll[seriesIndex]?.net_payable || 0;
                                    return fmtNum(empCount) + ' Employees | ' + fmtTaka(np) + ' Net Salary';
                                },
                            },
                        },
                    };
                    companyEmployeeChart = new ApexCharts(donutEl, donutOptions);
                    companyEmployeeChart.render();
                }
            }

            // ========== Bar: Company Wise Net Salary ==========
            const barEl = document.querySelector('#company-salary-chart');
            if (barEl) {
                if (companySalaryChart) { try { companySalaryChart.destroy(); } catch(e) {} companySalaryChart = null; }
                if (!barLabels.length || (barSeries[0].data.every(v => v === 0) && barSeries[1].data.every(v => v === 0))) {
                    barEl.innerHTML = `
                        <div class="text-center text-muted py-5">
                            <i class="bx bx-bar-chart-alt-2 font-size-24 d-block mb-2"></i>
                            No salary data available
                        </div>`;
                } else {
                    const barOptions = {
                        series: barSeries,
                        chart: {
                            type: 'bar',
                            height: 360,
                            fontFamily: 'inherit',
                            toolbar: { show: false },
                        },
                        colors: ['#556ee6', '#b4c2ff'],
                        plotOptions: {
                            bar: {
                                columnWidth: '60%',
                                borderRadius: 3,
                                dataLabels: { position: 'top' },
                                distributed: false,
                            },
                        },
                        dataLabels: {
                            enabled: true,
                            offsetY: -20,
                            style: { fontSize: '10px', fontWeight: 600, colors: ['#495057'] },
                            formatter: function(val) {
                                if (val === 0) return '';
                                if (val >= 1000000) return (val / 1000000).toFixed(1) + 'M';
                                if (val >= 1000)    return (val / 1000).toFixed(0)    + 'K';
                                return Number(val).toLocaleString();
                            },
                        },
                        xaxis: {
                            categories: barLabels,
                            axisBorder: { show: false },
                            axisTicks: { show: false },
                            labels: { style: { fontSize: '12px', colors: '#74788d' } },
                        },
                        yaxis: {
                            labels: {
                                style: { fontSize: '11px', colors: '#74788d' },
                                formatter: function(val) {
                                    if (val >= 10000000) return (val / 10000000).toFixed(1) + 'Cr';
                                    if (val >= 100000)    return (val / 100000).toFixed(1)    + 'L';
                                    if (val >= 1000)      return (val / 1000).toFixed(0)      + 'K';
                                    return Number(val).toLocaleString();
                                },
                            },
                        },
                        grid: { borderColor: '#f1f3f9' },
                        legend: {
                            show: true,
                            position: 'top',
                            horizontalAlign: 'right',
                            fontSize: '12px',
                            fontWeight: 500,
                            markers: { width: 12, height: 12, radius: 3 },
                            itemMargin: { horizontal: 12, vertical: 0 },
                        },
                        tooltip: {
                            shared: true,
                            intersect: false,
                            y: {
                                formatter: function(val, { seriesIndex, dataPointIndex }) {
                                    const np = Number(val);
                                    const row = companyWisePayroll[dataPointIndex];
                                    const empCount = seriesIndex === 0
                                        ? (row?.employee_count || 0)
                                        : (row?.employee_count_prev || 0);
                                    return fmtTaka(np) + ' • ' + fmtNum(empCount) + ' Employees';
                                },
                            },
                        },
                    };
                    companySalaryChart = new ApexCharts(barEl, barOptions);
                    companySalaryChart.render();
                }
            }
        }
    </script>
@endpush
