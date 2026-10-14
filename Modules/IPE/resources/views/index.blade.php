@extends('layouts.app')
@section('title', 'IPE')
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
                <h4 class="mb-sm-0 font-size-18">IPE | <span class="text-muted font-size-12">Dashboard</span></h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i data-feather="home" class="icon-xs align-middle me-1"></i></a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">IPE</a></li>
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
                        <h2 style="padding:0px; margin:0px; font-size:18px;">IPE Overview</h2>
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
                    <div class="row row-cols-2 row-cols-md-4 row-cols-xl-5 g-3">

                        <!-- 1. Total Applicants -->
                        <div class="col">
                            <div class="card border-0 shadow-sm text-white h-100" style="background:linear-gradient(135deg,#a21f76,#cb49e2);">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <small class="fw-semibold text-white-100">Total Applicants</small>
                                            <h3 class="fw-bold mb-1" id="total-applicants">{{ number_format($totalApplicants, 0) }}</h3>
                                            <div class="d-flex gap-2 align-items-center flex-wrap">
                                                <span class="badge bg-light text-dark">{{ $currentMonthName }}</span>
                                                @php
                                                    $d = $totalApplicantsDiff;
                                                    $cls = $d > 0 ? 'trend-up' : ($d < 0 ? 'trend-down' : 'trend-flat');
                                                    $ic  = $d > 0 ? 'bx-trending-up' : ($d < 0 ? 'bx-trending-down' : 'bx-minus');
                                                @endphp
                                                <span class="diff-trend {{ $cls }}" id="total-applicants-diff-badge">
                                                    <i class="bx {{ $ic }}"></i> {{ $d > 0 ? '+' : '' }}{{ $d }}%
                                                </span>
                                            </div>
                                        </div>
                                        <div class="fs-1 opacity-75">
                                            <i class="bx bx-user-plus"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 2. Assessments Completed -->
                        <div class="col">
                            <div class="card border-0 shadow-sm text-white h-100" style="background:linear-gradient(135deg,#6359f5,#859403);">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <small class="fw-semibold text-white-100">Assessments Completed</small>
                                            <h3 class="fw-bold mb-1" id="completed-assessments">{{ number_format($completedAssessments, 0) }}</h3>
                                            <div class="d-flex gap-2 align-items-center flex-wrap">
                                                <span class="badge bg-light text-primary">{{ $currentMonthName }}</span>
                                                @php
                                                    $d = $completedAssessmentsDiff;
                                                    $cls = $d > 0 ? 'trend-up' : ($d < 0 ? 'trend-down' : 'trend-flat');
                                                    $ic  = $d > 0 ? 'bx-trending-up' : ($d < 0 ? 'bx-trending-down' : 'bx-minus');
                                                @endphp
                                                <span class="diff-trend {{ $cls }}" id="completed-assessments-diff-badge">
                                                    <i class="bx {{ $ic }}"></i> {{ $d > 0 ? '+' : '' }}{{ $d }}%
                                                </span>
                                            </div>
                                        </div>
                                        <div class="fs-1 opacity-75">
                                            <i class="bx bx-check-shield"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 3. Assessments Pending -->
                        <div class="col">
                            <div class="card border-0 shadow-sm text-white h-100" style="background:linear-gradient(135deg,#f143cc,#f1591c);">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <small class="fw-semibold text-white-100">Assessments Pending</small>
                                            <h3 class="fw-bold mb-1" id="pending-assessments">{{ number_format($pendingAssessments, 0) }}</h3>
                                            <div class="d-flex gap-2 align-items-center flex-wrap">
                                                <span class="badge bg-light text-info">{{ $currentMonthName }}</span>
                                                @php
                                                    $d = $pendingAssessmentsDiff;
                                                    $cls = $d > 0 ? 'trend-down' : ($d < 0 ? 'trend-up' : 'trend-flat');
                                                    $ic  = $d > 0 ? 'bx-trending-up' : ($d < 0 ? 'bx-trending-down' : 'bx-minus');
                                                @endphp
                                                <span class="diff-trend {{ $cls }}" id="pending-assessments-diff-badge">
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

                        <!-- 4. Selected Applicants -->
                        <div class="col">
                            <div class="card border-0 shadow-sm text-white h-100" style="background:linear-gradient(135deg,#11998e,#38ef7d);">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <small class="fw-semibold text-white-100">Selected Applicants</small>
                                            <h3 class="fw-bold mb-1" id="selected-applicants">{{ number_format($selectedApplicants, 0) }}</h3>
                                            <div class="d-flex gap-2 align-items-center flex-wrap">
                                                <span class="badge bg-light text-dark">{{ $currentMonthName }}</span>
                                                @php
                                                    $d = $selectedApplicantsDiff;
                                                    $cls = $d > 0 ? 'trend-up' : ($d < 0 ? 'trend-down' : 'trend-flat');
                                                    $ic  = $d > 0 ? 'bx-trending-up' : ($d < 0 ? 'bx-trending-down' : 'bx-minus');
                                                @endphp
                                                <span class="diff-trend {{ $cls }}" id="selected-applicants-diff-badge">
                                                    <i class="bx {{ $ic }}"></i> {{ $d > 0 ? '+' : '' }}{{ $d }}%
                                                </span>
                                            </div>
                                        </div>
                                        <div class="fs-1 opacity-75">
                                            <i class="bx bx-user-check"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 5. Rejected Applicants -->
                        <div class="col">
                            <div class="card border-0 shadow-sm text-white h-100" style="background:linear-gradient(135deg,#ee8610,#e84118);">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <small class="fw-semibold text-white-100">Rejected Applicants</small>
                                            <h3 class="fw-bold mb-1" id="rejected-applicants">{{ number_format($rejectedApplicants, 0) }}</h3>
                                            <div class="d-flex gap-2 align-items-center flex-wrap">
                                                <span class="badge bg-light text-dark">{{ $currentMonthName }}</span>
                                                @php
                                                    $d = $rejectedApplicantsDiff;
                                                    $cls = $d > 0 ? 'trend-down' : ($d < 0 ? 'trend-up' : 'trend-flat');
                                                    $ic  = $d > 0 ? 'bx-trending-up' : ($d < 0 ? 'bx-trending-down' : 'bx-minus');
                                                @endphp
                                                <span class="diff-trend {{ $cls }}" id="rejected-applicants-diff-badge">
                                                    <i class="bx {{ $ic }}"></i> {{ $d > 0 ? '+' : '' }}{{ $d }}%
                                                </span>
                                            </div>
                                        </div>
                                        <div class="fs-1 opacity-75">
                                            <i class="bx bx-user-x"></i>
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
                            <h5 class="card-title mb-1">Company Wise Applicants</h5>
                            <p class="text-muted mb-0 font-size-12">Total Applicants Requiring IPE ({{ $currentMonthName }})</p>
                        </div>
                    </div>
                    <div class="text-end">
                        <div class="d-flex flex-column gap-1 align-items-end">
                            <span class="badge bg-primary" id="chart-total-applicants">{{ number_format($totalChartApplicants) }} Total Applicants</span>
                            <span class="badge bg-success" id="chart-total-completed">{{ number_format($totalChartCompleted) }} Completed</span>
                        </div>
                        <div class="text-muted font-size-11 mt-1" id="chart-total-companies">{{ $totalChartCompanies }}
                            {{ Str::plural('Company', $totalChartCompanies) }}</div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="company-applicant-chart"></div>
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
                            <h5 class="card-title mb-1">Company Wise Applicants (Last Month vs Current)</h5>
                            <p class="text-muted mb-0 font-size-12" id="applicant-chart-subtitle">{{ $prevMonthName }} vs {{ $currentMonthName }} — Applicants Comparison</p>
                        </div>
                    </div>
                    <div class="text-end">
                        <span class="badge bg-success" id="chart-total-applicants-bar">{{ number_format($totalChartApplicants) }} Total</span>
                        <div class="text-muted font-size-11 mt-1" id="applicant-total-companies">{{ $totalChartCompanies }}
                            {{ Str::plural('Company', $totalChartCompanies) }}</div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="company-applicant-bar-chart"></div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        let companyApplicantChart;
        let companyApplicantBarChart;
        const chartColors = @json($chartColors);

        window.__ipeMonthLabels = window.__ipeMonthLabels || {};
        window.__ipeMonthLabels.current = @json($currentMonthName);
        window.__ipeMonthLabels.prev    = @json($prevMonthName);

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
            initCharts(@json($companyWiseIPE));

            $('#org_id').on('select2:select change', function(e) {
                updateDashboard($(this).val());
            });
        });

        async function updateDashboard(orgId) {
            try {
                const response = await fetch('{{ route('ipe.dashboard-data') }}?org_id=' + (orgId || ''));
                const d = await response.json();

                document.getElementById('total-applicants').textContent        = fmtNum(d.totalApplicants);
                document.getElementById('completed-assessments').textContent  = fmtNum(d.completedAssessments);
                document.getElementById('pending-assessments').textContent    = fmtNum(d.pendingAssessments);
                document.getElementById('selected-applicants').textContent    = fmtNum(d.selectedApplicants);
                document.getElementById('rejected-applicants').textContent    = fmtNum(d.rejectedApplicants);
                document.getElementById('period-label').textContent           = 'For ' + d.currentMonthName + ' • vs ' + d.prevMonthName;
                document.getElementById('applicant-chart-subtitle').textContent = d.prevMonthName + ' vs ' + d.currentMonthName + ' — Applicants Comparison';

                setDiffBadge('total-applicants-diff-badge',        d.totalApplicantsDiff,       false);
                setDiffBadge('completed-assessments-diff-badge',   d.completedAssessmentsDiff,  false);
                setDiffBadge('pending-assessments-diff-badge',     d.pendingAssessmentsDiff,    true);
                setDiffBadge('selected-applicants-diff-badge',     d.selectedApplicantsDiff,    false);
                setDiffBadge('rejected-applicants-diff-badge',     d.rejectedApplicantsDiff,    true);

                window.__ipeMonthLabels.current = d.currentMonthName;
                window.__ipeMonthLabels.prev    = d.prevMonthName;

                const newTotalChartApplicants  = d.companyWiseIPE.reduce((s, i) => s + (Number(i.total_applicants) || 0), 0);
                const newTotalChartCompleted   = d.companyWiseIPE.reduce((s, i) => s + (Number(i.completed_assessments) || 0), 0);
                const newTotalChartCompanies   = d.companyWiseIPE.length;
                document.getElementById('chart-total-applicants').textContent     = fmtNum(newTotalChartApplicants) + ' Total Applicants';
                document.getElementById('chart-total-completed').textContent      = fmtNum(newTotalChartCompleted) + ' Completed';
                document.getElementById('chart-total-companies').textContent      = newTotalChartCompanies + ' ' + (newTotalChartCompanies === 1 ? 'Company' : 'Companies');
                document.getElementById('applicant-total-companies').textContent  = newTotalChartCompanies + ' ' + (newTotalChartCompanies === 1 ? 'Company' : 'Companies');
                document.getElementById('chart-total-applicants-bar').textContent = fmtNum(newTotalChartApplicants) + ' Total';

                initCharts(d.companyWiseIPE);
            } catch (error) {
                console.error('Error updating IPE dashboard:', error);
            }
        }

        function initCharts(companyWiseIPE) {
            if (!Array.isArray(companyWiseIPE)) companyWiseIPE = [];

            const totalApplicants = companyWiseIPE.reduce((s, i) => s + (Number(i.total_applicants) || 0), 0);
            const totalCompleted  = companyWiseIPE.reduce((s, i) => s + (Number(i.completed_assessments) || 0), 0);
            const totalCompanies  = companyWiseIPE.length;

            const donutLabels  = companyWiseIPE.map(i => i.short_name || i.name);
            const donutSeries  = companyWiseIPE.map(i => Number(i.total_applicants) || 0);
            const barLabels    = companyWiseIPE.map(i => i.short_name || i.name);

            const currentMonthLabel = window.__ipeMonthLabels?.current || 'This Month';
            const prevMonthLabel    = window.__ipeMonthLabels?.prev    || 'Last Month';
            const barSeries    = [
                {
                    name: currentMonthLabel,
                    data: companyWiseIPE.map(i => Number(i.total_applicants) || 0),
                },
                {
                    name: prevMonthLabel,
                    data: companyWiseIPE.map(i => Number(i.total_applicants_prev) || 0),
                },
            ];

            // ========== Donut: Company Wise Applicants ==========
            const donutEl = document.querySelector('#company-applicant-chart');
            if (donutEl) {
                if (companyApplicantChart) { try { companyApplicantChart.destroy(); } catch(e) {} companyApplicantChart = null; }
                if (!donutSeries.length || donutSeries.every(v => v === 0)) {
                    donutEl.innerHTML = `
                        <div class="text-center text-muted py-5">
                            <i class="bx bx-pie-chart-alt-2 font-size-24 d-block mb-2"></i>
                            No applicant data available
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
                                            formatter: function(val) { return Number(val).toLocaleString() + ' Apps'; },
                                        },
                                        total: {
                                            show: true,
                                            label: 'Completed',
                                            fontSize: '11px',
                                            color: '#556ee6',
                                            offsetY: 22,
                                            formatter: function() { return fmtNum(totalCompleted); },
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
                                const pct = totalApplicants > 0 ? ((v / totalApplicants) * 100).toFixed(1) : 0;
                                const comp = companyWiseIPE[idx]?.completed_assessments || 0;
                                return pct + '%\n' + fmtNum(comp) + ' Done';
                            },
                        },
                        tooltip: {
                            y: {
                                formatter: function(val, { seriesIndex }) {
                                    const name = donutLabels[seriesIndex];
                                    const appCount = Number(donutSeries[seriesIndex]);
                                    const comp = companyWiseIPE[seriesIndex]?.completed_assessments || 0;
                                    const pend = companyWiseIPE[seriesIndex]?.pending_assessments || 0;
                                    return fmtNum(appCount) + ' Applicants | ' + fmtNum(comp) + ' Done | ' + fmtNum(pend) + ' Pending';
                                },
                            },
                        },
                    };
                    companyApplicantChart = new ApexCharts(donutEl, donutOptions);
                    companyApplicantChart.render();
                }
            }

            // ========== Bar: Company Wise Applicants ==========
            const barEl = document.querySelector('#company-applicant-bar-chart');
            if (barEl) {
                if (companyApplicantBarChart) { try { companyApplicantBarChart.destroy(); } catch(e) {} companyApplicantBarChart = null; }
                if (!barLabels.length || (barSeries[0].data.every(v => v === 0) && barSeries[1].data.every(v => v === 0))) {
                    barEl.innerHTML = `
                        <div class="text-center text-muted py-5">
                            <i class="bx bx-bar-chart-alt-2 font-size-24 d-block mb-2"></i>
                            No applicant data available
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
                        colors: ['#a21f76', '#e0b2ea'],
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
                                    if (val >= 1000) return (val / 1000).toFixed(0) + 'K';
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
                                    const apps = Number(val);
                                    const row = companyWiseIPE[dataPointIndex];
                                    const comp = seriesIndex === 0
                                        ? (row?.completed_assessments || 0)
                                        : (row?.completed_assessments_prev || 0);
                                    const pend = seriesIndex === 0
                                        ? (row?.pending_assessments || 0)
                                        : (row?.pending_assessments_prev || 0);
                                    return fmtNum(apps) + ' Applicants • ' + fmtNum(comp) + ' Done • ' + fmtNum(pend) + ' Pending';
                                },
                            },
                        },
                    };
                    companyApplicantBarChart = new ApexCharts(barEl, barOptions);
                    companyApplicantBarChart.render();
                }
            }
        }
    </script>
@endpush
