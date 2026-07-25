@extends('layouts.app')
@section('title', 'Payroll')
@push('styles')
    <style>
        .payroll-card {
            border-radius: 12px !important;
            border: none !important;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08) !important;
            transition: all .25s ease;
            overflow: hidden;
            color: #fff !important;
        }
        .payroll-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 28px rgba(0, 0, 0, 0.16) !important;
        }
        .payroll-card .card-body { padding: 20px; background: transparent !important; }

        .payroll-card.bg-purple-gradient  { background: linear-gradient(135deg,#7b1fa2,#9c27b0); }
        .payroll-card.bg-primary-gradient { background: linear-gradient(135deg,#556ee6,#7b8bf0); }
        .payroll-card.bg-info-gradient    { background: linear-gradient(135deg,#50a5f1,#6bb7f4); }
        .payroll-card.bg-warning-gradient { background: linear-gradient(135deg,#f1b44c,#f5c46d); }
        .payroll-card.bg-dark-gradient    { background: linear-gradient(135deg,#1a2332,#343a40); }
        .payroll-card.bg-cyan-gradient    { background: linear-gradient(135deg,#2d8bff,#40c4ff); }
        .payroll-card.bg-danger-gradient  { background: linear-gradient(135deg,#f46a6a,#f78787); }

        .payroll-icon-box {
            width: 48px; height: 48px; border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            background: rgba(255,255,255,0.15) !important;
            color: #fff !important;
            font-size: 24px; flex-shrink: 0;
        }

        .payroll-card .card-label {
            font-size: 0.82rem; font-weight: 500;
            color: rgba(255,255,255,0.75) !important;
            letter-spacing: 0.2px;
        }

        .payroll-card .card-value {
            font-size: 1.7rem; font-weight: 700;
            color: #fff !important; line-height: 1.2;
        }

        .trend-badge {
            display: inline-flex; align-items: center; gap: 3px;
            padding: 4px 9px; border-radius: 20px;
            font-size: 0.72rem; font-weight: 600;
            background: rgba(255,255,255,0.18);
            color: #fff;
        }
        .trend-up   { color: #e6ffe6; }
        .trend-down { color: #ffe6e6; }
        .trend-flat { color: #fff; }

        .dashboard-summary-card {
            border: 1px solid #eef0f3 !important;
            box-shadow: 0 1px 2px rgba(56, 65, 74, 0.05) !important;
            border-radius: 12px !important;
        }
        .dashboard-summary-card .card-header {
            border-bottom: 1px solid #eef0f3 !important;
            padding: 16px 20px; background: #fff;
            border-radius: 12px 12px 0 0 !important;
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
            <div class="card dashboard-summary-card">
                <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2">
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
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-6 g-3">

                        <!-- 1. Net Salary -->
                        <div class="col">
                            <div class="payroll-card card bg-purple-gradient text-white h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <div class="card-label">Total Net Salary</div>
                                            <div class="card-value" id="net-payable">
                                                ৳ {{ number_format($netPayable, 0) }}
                                            </div>
                                        </div>
                                        <div class="payroll-icon-box opacity-75"><i class="bx bx-wallet"></i></div>
                                    </div>
                                    <div class="mt-3 d-flex align-items-center gap-2 flex-wrap">
                                        @php
                                            $d = $netPayableDiff;
                                            $cls = $d > 0 ? 'trend-up' : ($d < 0 ? 'trend-down' : 'trend-flat');
                                            $ic  = $d > 0 ? 'bx-trending-up' : ($d < 0 ? 'bx-trending-down' : 'bx-minus');
                                        @endphp
                                        <span class="trend-badge {{ $cls }}" id="net-diff-badge">
                                            <i class="bx {{ $ic }}"></i> {{ $d > 0 ? '+' : '' }}{{ $d }}%
                                        </span>
                                        <small style="color:rgba(255,255,255,0.65); font-weight:600;">vs Last Month</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 2. Gross Salary -->
                        <div class="col">
                            <div class="payroll-card card bg-primary-gradient text-white h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <div class="card-label">Total Gross Salary</div>
                                            <div class="card-value" id="gross-payable">
                                                ৳ {{ number_format($grossPayable, 0) }}
                                            </div>
                                        </div>
                                        <div class="payroll-icon-box opacity-75"><i class="bx bx-money"></i></div>
                                    </div>
                                    <div class="mt-3 d-flex align-items-center gap-2 flex-wrap">
                                        @php
                                            $d = $grossPayableDiff;
                                            $cls = $d > 0 ? 'trend-up' : ($d < 0 ? 'trend-down' : 'trend-flat');
                                            $ic  = $d > 0 ? 'bx-trending-up' : ($d < 0 ? 'bx-trending-down' : 'bx-minus');
                                        @endphp
                                        <span class="trend-badge {{ $cls }}" id="gross-diff-badge">
                                            <i class="bx {{ $ic }}"></i> {{ $d > 0 ? '+' : '' }}{{ $d }}%
                                        </span>
                                        <small style="color:rgba(255,255,255,0.65); font-weight:600;">vs Last Month</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 3. Total OT Amount -->
                        <div class="col">
                            <div class="payroll-card card bg-info-gradient text-white h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <div class="card-label">Total Overtime Amount</div>
                                            <div class="card-value" id="ot-amount">
                                                ৳ {{ number_format($totalOtAmount, 0) }}
                                            </div>
                                        </div>
                                        <div class="payroll-icon-box opacity-75"><i class="bx bx-time-five"></i></div>
                                    </div>
                                    <div class="mt-3 d-flex align-items-center gap-2 flex-wrap">
                                        @php
                                            $d = $totalOtAmountDiff;
                                            $cls = $d > 0 ? 'trend-up' : ($d < 0 ? 'trend-down' : 'trend-flat');
                                            $ic  = $d > 0 ? 'bx-trending-up' : ($d < 0 ? 'bx-trending-down' : 'bx-minus');
                                        @endphp
                                        <span class="trend-badge {{ $cls }}" id="ot-amount-diff-badge">
                                            <i class="bx {{ $ic }}"></i> {{ $d > 0 ? '+' : '' }}{{ $d }}%
                                        </span>
                                        <small style="color:rgba(255,255,255,0.65); font-weight:600;">vs Last Month</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 4. Advance Deduction -->
                        <div class="col">
                            <div class="payroll-card card bg-warning-gradient text-white h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <div class="card-label">Advance Deduction</div>
                                            <div class="card-value" id="advance-amount">
                                                ৳ {{ number_format($advanceAmount, 0) }}
                                            </div>
                                        </div>
                                        <div class="payroll-icon-box opacity-75"><i class="bx bx-credit-card-front"></i></div>
                                    </div>
                                    <div class="mt-3 d-flex align-items-center gap-2 flex-wrap">
                                        @php
                                            $d = $advanceAmountDiff;
                                            $cls = $d > 0 ? 'trend-down' : ($d < 0 ? 'trend-up' : 'trend-flat');
                                            $ic  = $d > 0 ? 'bx-trending-up' : ($d < 0 ? 'bx-trending-down' : 'bx-minus');
                                        @endphp
                                        <span class="trend-badge {{ $cls }}" id="advance-diff-badge">
                                            <i class="bx {{ $ic }}"></i> {{ $d > 0 ? '+' : '' }}{{ $d }}%
                                        </span>
                                        <small style="color:rgba(255,255,255,0.65); font-weight:600;">vs Last Month</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 5. Total Deduction -->
                        <div class="col">
                            <div class="payroll-card card bg-dark-gradient text-white h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <div class="card-label">Total Deduction</div>
                                            <div class="card-value" id="total-deduction">
                                                ৳ {{ number_format($totalDeduction, 0) }}
                                            </div>
                                        </div>
                                        <div class="payroll-icon-box opacity-75"><i class="bx bx-scissors"></i></div>
                                    </div>
                                    <div class="mt-3 d-flex align-items-center gap-2 flex-wrap">
                                        @php
                                            $d = $totalDeductionDiff;
                                            $cls = $d > 0 ? 'trend-down' : ($d < 0 ? 'trend-up' : 'trend-flat');
                                            $ic  = $d > 0 ? 'bx-trending-up' : ($d < 0 ? 'bx-trending-down' : 'bx-minus');
                                        @endphp
                                        <span class="trend-badge {{ $cls }}" id="deduction-diff-badge">
                                            <i class="bx {{ $ic }}"></i> {{ $d > 0 ? '+' : '' }}{{ $d }}%
                                        </span>
                                        <small style="color:rgba(255,255,255,0.65); font-weight:600;">vs Last Month</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 6. Total OT Hours -->
                        <div class="col">
                            <div class="payroll-card card bg-cyan-gradient text-white h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <div class="card-label">Total OT Hours</div>
                                            <div class="card-value" id="ot-hours">
                                                {{ number_format($totalOtHour, 0) }}
                                            </div>
                                        </div>
                                        <div class="payroll-icon-box opacity-75"><i class="bx bx-timer"></i></div>
                                    </div>
                                    <div class="mt-3 d-flex align-items-center gap-2 flex-wrap">
                                        @php
                                            $d = $totalOtHourDiff;
                                            $cls = $d > 0 ? 'trend-up' : ($d < 0 ? 'trend-down' : 'trend-flat');
                                            $ic  = $d > 0 ? 'bx-trending-up' : ($d < 0 ? 'bx-trending-down' : 'bx-minus');
                                        @endphp
                                        <span class="trend-badge {{ $cls }}" id="ot-hours-diff-badge">
                                            <i class="bx {{ $ic }}"></i> {{ $d > 0 ? '+' : '' }}{{ $d }}%
                                        </span>
                                        <small style="color:rgba(255,255,255,0.65); font-weight:600;">vs Last Month</small>
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
        el.className = 'trend-badge ' + cls;
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
