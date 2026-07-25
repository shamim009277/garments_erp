@extends('layouts.app')
@section('title', 'HRIS')
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

        .card h2 {
            font-size: 2rem;
            font-weight: 700;
        }

        .fw-semibold {
            font-weight: 500 !important;
            font-size: 1rem !important;
        }

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
                <h4 class="mb-sm-0 font-size-18">HRIS | <span class="text-muted font-size-12">Dashbaord</span></h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i data-feather="home"
                                    class="icon-xs align-middle me-1"></i></a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">HRIS</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2 py-3"
                    style="padding:16px 20px">
                    <h2 style="padding:0px; margin:0px; font-size:18px;"><i data-feather="list" width="16"
                            height="16"></i> Dashboard Summary</h2>

                    <div class="filter-select" style="max-width: 400px;">
                        <x-select-input style="max-width: 400px !important;" name="org_id" id="org_id"
                            class="select2 w-100" :options="$organizations" :selected="$orgId" required />
                    </div>
                </div>

                <div class="card-body">
                    <div class="row row-cols-2 row-cols-md-4 row-cols-xl-6 g-3">
                        <!-- Total Employees -->
                        <div class="col">
                            <div class="card border-0 shadow-sm bg-primary bg-gradient text-white h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <small class="fw-semibold text-white-50">Total Employees</small>
                                            <h3 class="fw-bold mb-1" id="total-employees">{{ number_format($totalEmployees) }}</h3>
                                            <span class="badge bg-light text-primary">Total Employee</span>
                                        </div>
                                        <div class="fs-1 opacity-75">
                                            <i class="bx bx-group"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- New Joiners -->
                        <div class="col">
                            <div class="card border-0 shadow-sm bg-info bg-gradient text-white h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <small class="fw-semibold text-white-50">New Joiners</small>
                                            <h3 class="fw-bold mb-1" id="new-joiners">{{ number_format($newJoiners) }}</h3>
                                            <span class="badge bg-light text-info">This Month</span>
                                        </div>
                                        <div class="fs-1 opacity-75">
                                            <i class="bx bx-user-plus"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Resigned This Month -->
                        <div class="col">
                            <div class="card border-0 shadow-sm text-white h-100"
                                style="background:linear-gradient(135deg,#7b1fa2,#9c27b0);">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <small class="fw-semibold text-white-50">Resigned Employee</small>
                                            <h3 class="fw-bold mb-1" id="resigned-this-month">{{ number_format($resignedThisMonth) }}</h3>
                                            <span class="badge bg-light text-dark">This Month</span>
                                        </div>
                                        <div class="fs-1 opacity-75">
                                            <i class="bx bx-user-minus"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- New Applicants This Month -->
                        {{-- <div class="col">
                            <div class="card border-0 shadow-sm bg-success bg-gradient text-white h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <small class="fw-semibold text-white-50">New Applicants</small>
                                            <h3 class="fw-bold mb-1" id="new-applicants-this-month">{{ number_format($newApplicantsThisMonth) }}</h3>
                                            <span class="badge bg-light text-success">This Month</span>
                                        </div>
                                        <div class="fs-1 opacity-75">
                                            <i class="bx bx-file"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                        <!-- Companies -->
                        <div class="col">
                            <div class="card border-0 shadow-sm bg-dark bg-gradient text-white h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <small class="fw-semibold text-white-50">Companies</small>
                                            <h3 class="fw-bold mb-1 text-white-50" id="total-companies">{{ number_format($totalCompanies) }}</h3>
                                            <span class="badge bg-light text-dark">Total Company</span>
                                        </div>
                                        <div class="fs-1 opacity-75">
                                            <i class="bx bx-buildings"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Todays Attendence -->
                        <div class="col">
                            <div class="card border-0 shadow-sm text-white h-100"
                                style="background:linear-gradient(135deg,#2d8bff,#40c4ff);">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <small class="fw-semibold text-white-50">Todays Attendence</small>
                                            <div class="d-flex gap-3 mt-2">
                                                <span class="d-flex flex-column align-items-center">
                                                    <span class="fw-bold" id="today-present">{{ number_format($todayPresent) }}</span>
                                                    <small>Present</small>
                                                </span>
                                                <span class="d-flex flex-column align-items-center">
                                                    <span class="fw-bold" id="today-absent">{{ number_format($todayAbsent) }}</span>
                                                    <small>Absent</small>
                                                </span>
                                                <span class="d-flex flex-column align-items-center">
                                                    <span class="fw-bold" id="on-leave">{{ number_format($onLeave) }}</span>
                                                    <small>Leave</small>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="fs-1 opacity-75">
                                            <i class="bx bx-calendar-check"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- New Applicant -->
                        <div class="col">
                            <div class="card border-0 shadow-sm bg-success bg-gradient text-white h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <small class="fw-semibold text-white-50">New Applicant</small>
                                            <div class="d-flex gap-3 mt-2">
                                                <span class="d-flex flex-column align-items-center">
                                                    <span class="fw-bold" id="new-applicants-this-month">{{ number_format($newApplicantsThisMonth) }}</span>
                                                    <small>Apply</small>
                                                </span>
                                                <span class="d-flex flex-column align-items-center">
                                                    <span class="fw-bold" id="selected-count">{{ number_format($selectedCount) }}</span>
                                                    <small>Selected</small>
                                                </span>
                                                <span class="d-flex flex-column align-items-center">
                                                    <span class="fw-bold" id="rejected-count">{{ number_format($rejectedCount) }}</span>
                                                    <small>Rejected</small>
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
                    </div>
                </div>
            </div>
        </div>

        @php
            $totalChartEmployees = $companyWiseEmployees->sum('total');
            $totalChartCompanies = $companyWiseEmployees->count();
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
                            <h5 class="card-title mb-1">Company Wise Total Employee</h5>
                            <p class="text-muted mb-0 font-size-12">Active employees by organization</p>
                        </div>
                    </div>
                    <div class="text-end">
                        <span class="badge bg-primary" id="chart-total-employees">{{ number_format($totalChartEmployees) }} Total</span>
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
                            <i class="bx bx-pie-chart-alt-2"></i>
                        </div>
                        <div>
                            <h5 class="card-title mb-1">Company Wise Employee Movement</h5>
                            <p class="text-muted mb-0 font-size-12">Last Month vs Current Month Joining & Resign</p>
                        </div>
                    </div>
                    <div class="text-end">
                        <span class="badge bg-primary"> Total</span>
                        <div class="text-muted font-size-11 mt-1" id="movement-total-companies">
                            {{ Str::plural('Company', $totalChartCompanies) }}</div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="company-employee-movement-chart"></div>
                </div>
            </div>
        </div> <br>

        <!-- end col -->
        <div class="col-md-4 pe-md-0" style="margin-bottom:10px;">
            <div class="card dashboard-chart-card h-100">
                <div class="card-header border-bottom d-flex align-items-center justify-content-between flex-wrap gap-2">
                    <div class="d-flex align-items-center gap-3">
                        <div class="chart-icon-box">
                            <i class="bx bx-pie-chart-alt-2"></i>
                        </div>
                        <div>
                            <h5 class="card-title mb-1">Company Wise Punch vs Not Punch</h5>
                            <p class="text-muted mb-0 font-size-12">Active employees by organization</p>
                        </div>
                    </div>
                    <div class="text-end">
                        <span class="badge bg-primary"> Total</span>
                        <div class="text-muted font-size-11 mt-1"></div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="company-attendance-radar"></div>
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        let companyEmployeeChart;
        let companyMovementChart;
        let companyAttendanceChart;
        const chartColors = @json($chartColors);
        
        $(document).ready(function() {
            // Initialize charts
            initCharts(@json($companyWiseEmployees), @json($companyWiseMovement), @json($companyAttendance));
            
            // Add event listener to org dropdown: update via AJAX
            $('#org_id').on('select2:select change', function(e) {
                updateDashboard($(this).val());
            });
        });

        async function updateDashboard(orgId) {
            try {
                const response = await fetch('{{ route('hris.dashboard-data') }}?org_id=' + (orgId || ''));
                const data = await response.json();
                
                // Update cards
                document.getElementById('total-employees').textContent = data.totalEmployees.toLocaleString();
                document.getElementById('new-joiners').textContent = data.newJoiners.toLocaleString();
                document.getElementById('resigned-this-month').textContent = data.resignedThisMonth.toLocaleString();
                document.getElementById('new-applicants-this-month').textContent = data.newApplicantsThisMonth.toLocaleString();
                document.getElementById('total-companies').textContent = data.totalCompanies.toLocaleString();
                document.getElementById('today-present').textContent = data.todayPresent.toLocaleString();
                document.getElementById('today-absent').textContent = data.todayAbsent.toLocaleString();
                document.getElementById('on-leave').textContent = data.onLeave.toLocaleString();
                document.getElementById('selected-count').textContent = data.selectedCount.toLocaleString();
                document.getElementById('rejected-count').textContent = data.rejectedCount.toLocaleString();
                
                // Update chart totals
                const newTotalChartEmployees = data.companyWiseEmployees.reduce((sum, item) => sum + item.total, 0);
                const newTotalChartCompanies = data.companyWiseEmployees.length;
                document.getElementById('chart-total-employees').textContent = newTotalChartEmployees.toLocaleString() + ' Total';
                document.getElementById('chart-total-companies').textContent = newTotalChartCompanies + ' ' + (newTotalChartCompanies === 1 ? 'Company' : 'Companies');
                document.getElementById('movement-total-companies').textContent = newTotalChartCompanies + ' ' + (newTotalChartCompanies === 1 ? 'Company' : 'Companies');
                
                // Re-initialize charts with new data
                initCharts(data.companyWiseEmployees, data.companyWiseMovement, data.companyAttendance);
            } catch (error) {
                console.error('Error updating dashboard:', error);
            }
        }

        function initCharts(companyWiseEmployees, companyWiseMovement, companyAttendance) {
            // Company Employee Chart
            const totalEmployees = companyWiseEmployees.reduce((sum, item) => sum + item.total, 0);
            const totalCompanies = companyWiseEmployees.length;
            
            const labels = companyWiseEmployees.map(item => item.short_name);
            const series = companyWiseEmployees.map(item => item.total);

            const chartEl1 = document.querySelector('#company-employee-chart');

            if (!series.length) {
                chartEl1.innerHTML = `
                    <div class="text-center text-muted py-5">
                        <i class="bx bx-pie-chart-alt-2 font-size-24 d-block mb-2"></i>
                        No employee data available
                    </div>
                `;
            } else {
                const options1 = {
                    series: series,
                    chart: {
                        type: 'donut',
                        height: 300,
                        fontFamily: 'inherit',
                    },
                    labels: labels,
                    colors: chartColors,
                    legend: {
                        show: false,
                    },
                    stroke: {
                        width: 2,
                        colors: ['#fff'],
                    },
                    plotOptions: {
                        pie: {
                            dataLabels: {
                                offset: -8
                            },
                            donut: {
                                size: '72%',
                                labels: {
                                    show: true,
                                    name: {
                                        show: true,
                                        fontSize: '14px',
                                        color: '#74788d',
                                        offsetY: -8,
                                    },
                                    value: {
                                        show: true,
                                        fontSize: '22px',
                                        fontWeight: 700,
                                        color: '#343a40',
                                        offsetY: 8,
                                        formatter: function(val) {
                                            return Number(val).toLocaleString();
                                        },
                                    },
                                    total: {
                                        show: true,
                                        label: 'Total Employees',
                                        fontSize: '13px',
                                        color: '#74788d',
                                        formatter: function() {
                                            return totalEmployees.toLocaleString();
                                        },
                                    },
                                },
                            },
                        },
                    },
                    dataLabels: {
                        enabled: true,
                        formatter: function(percentage, opts) {
                            const value = opts.w.config.series[opts.seriesIndex];
                            return [
                                value.toLocaleString(),
                                `${percentage.toFixed(1)}%`
                            ];
                        },
                        style: {
                            fontSize: '11px',
                            fontWeight: '600',
                            colors: ['#ffffff']
                        },
                        background: { enabled: false },
                        dropShadow: { enabled: false }
                    },
                    tooltip: {
                        y: {
                            formatter: function(value, opts) {
                                const percentage = opts.w.globals.seriesPercent[opts.seriesIndex][0];
                                return `${value.toLocaleString()} Employees (${percentage.toFixed(1)}%)`;
                            }
                        }
                    },
                    responsive: [{
                        breakpoint: 768,
                        options: {
                            chart: { height: 260 },
                            dataLabels: { style: { fontSize: '10px' } }
                        }
                    }]
                };
                if (companyEmployeeChart) {
                    companyEmployeeChart.destroy();
                }
                companyEmployeeChart = new ApexCharts(chartEl1, options1);
                companyEmployeeChart.render();
            }

            // Company Movement Chart
            const chartEl2 = document.querySelector('#company-employee-movement-chart');
            if (!companyWiseMovement.length) {
                chartEl2.innerHTML = `
                    <div class="text-center text-muted py-5">
                        <i class="bx bx-bar-chart-alt-2 font-size-24 d-block mb-2"></i>
                        No employee movement data available
                    </div>
                `;
            } else {
                const categories = companyWiseMovement.map(item => item.short_name);
                const lastJoining = companyWiseMovement.map(item => item.last_month_joining);
                const currentJoining = companyWiseMovement.map(item => item.current_month_joining);
                const lastResigned = companyWiseMovement.map(item => item.last_month_resigned);
                const currentResigned = companyWiseMovement.map(item => item.current_month_resigned);

                const options2 = {
                    series: [{
                            name: 'Last Month Joining',
                            data: lastJoining
                        },
                        {
                            name: 'Present Month Joining',
                            data: currentJoining
                        },
                        {
                            name: 'Last Month Resigned',
                            data: lastResigned
                        },
                        {
                            name: 'Present Month Resigned',
                            data: currentResigned
                        }
                    ],
                    chart: {
                        type: 'bar',
                        height: 420,
                        fontFamily: 'inherit',
                        toolbar: { show: false }
                    },
                    colors: [
                        chartColors[0],
                        chartColors[1],
                        chartColors[2],
                        chartColors[3]
                    ],
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            columnWidth: '55%',
                            borderRadius: 4,
                            borderRadiusApplication: 'end',
                            dataLabels: { position: 'top' }
                        }
                    },
                    dataLabels: {
                        enabled: true,
                        offsetY: -18,
                        style: {
                            fontSize: '11px',
                            fontWeight: '600',
                            colors: ['#495057']
                        },
                        formatter: function(val) { return val; }
                    },
                    stroke: {
                        show: true,
                        width: 1,
                        colors: ['transparent']
                    },
                    xaxis: {
                        categories: categories,
                        labels: {
                            rotate: -45,
                            rotateAlways: false,
                            trim: false,
                            style: { fontSize: '12px' }
                        }
                    },
                    yaxis: {
                        title: { text: 'Employees' },
                        forceNiceScale: true,
                        labels: { formatter: function(val) { return Math.round(val); } }
                    },
                    legend: {
                        position: 'top',
                        horizontalAlign: 'center',
                        fontSize: '13px'
                    },
                    grid: {
                        borderColor: '#f1f1f1',
                        strokeDashArray: 4
                    },
                    tooltip: {
                        shared: true,
                        intersect: false,
                        y: {
                            formatter: function(val) { return val + ' Employees'; }
                        }
                    }
                };
                if (companyMovementChart) {
                    companyMovementChart.destroy();
                }
                companyMovementChart = new ApexCharts(chartEl2, options2);
                companyMovementChart.render();
            }

            // Company Attendance Radar Chart
            const chartEl3 = document.querySelector('#company-attendance-radar');
            const options3 = {
                chart: {
                    type: 'radar',
                    height: 450,
                    toolbar: { show: false }
                },
                series: [
                    {
                        name: 'Total Employee',
                        data: companyAttendance.map(item => item.total_employee)
                    },
                    {
                        name: 'Punched',
                        data: companyAttendance.map(item => item.punched_employee)
                    },
                    {
                        name: 'Not Punched',
                        data: companyAttendance.map(item => item.not_punched)
                    }
                ],
                labels: companyAttendance.map(item => item.company),
                colors: ['#556EE6', '#34C38F', '#F46A6A'],
                stroke: { width: 2 },
                fill: { opacity: 0.18 },
                markers: {
                    size: 5,
                    strokeWidth: 2,
                    hover: { size: 8 }
                },
                dataLabels: {
                    enabled: true,
                    formatter: function (val) { return Math.round(val); },
                    style: {
                        fontSize: '11px',
                        fontWeight: '600',
                        colors: ['#495057']
                    },
                    offsetY: -8
                },
                plotOptions: {
                    radar: {
                        size: 150,
                        polygons: {
                            strokeColors: '#e9ecef',
                            connectorColors: '#e9ecef',
                            fill: { colors: ['#f8f9fa', '#ffffff'] }
                        }
                    }
                },
                yaxis: {
                    show: true,
                    tickAmount: 5,
                    labels: { formatter: function (val) { return Math.round(val); } }
                },
                legend: {
                    position: 'bottom',
                    horizontalAlign: 'center',
                    fontSize: '13px'
                },
                tooltip: {
                    shared: true,
                    intersect: false,
                    custom: function ({ dataPointIndex }) {
                        const row = companyAttendance[dataPointIndex];
                        return `
                            <div style="padding:12px;min-width:220px;">
                                <strong>${row.company}</strong>
                                <hr style="margin:8px 0;">
                                <div>Total Employee : <b>${row.total_employee}</b></div>
                                <div>Punched : <b>${row.punched_employee}</b></div>
                                <div>Not Punched : <b>${row.not_punched}</b></div>
                                <div>Attendance : <b>${row.attendance_rate}%</b></div>
                            </div>
                        `;
                    }
                }
            };
            if (companyAttendanceChart) {
                companyAttendanceChart.destroy();
            }
            companyAttendanceChart = new ApexCharts(chartEl3, options3);
            companyAttendanceChart.render();
        }
    </script>
@endpush
