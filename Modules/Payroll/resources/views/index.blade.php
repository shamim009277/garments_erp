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
                        <h2 style="padding:0px; margin:0px; font-size:18px;"><i data-feather="dollar-sign" width="16" height="16"></i> Payroll Overview</h2>
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
    </div>
@endsection

@push('scripts')
<script>
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

            setDiffBadge('net-diff-badge',          d.netPayableDiff,       false);
            setDiffBadge('gross-diff-badge',        d.grossPayableDiff,     false);
            setDiffBadge('ot-amount-diff-badge',    d.totalOtAmountDiff,    false);
            setDiffBadge('advance-diff-badge',      d.advanceAmountDiff,    true);
            setDiffBadge('deduction-diff-badge',    d.totalDeductionDiff,   true);
            setDiffBadge('ot-hours-diff-badge',     d.totalOtHourDiff,      false);
        } catch (error) {
            console.error('Error updating payroll dashboard:', error);
        }
    }
</script>
@endpush
