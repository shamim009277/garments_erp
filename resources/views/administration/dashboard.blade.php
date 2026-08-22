
@extends('layouts.app')
@section('title', 'Administration')
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

        .card h3 {
            font-size: 1.5rem;
            font-weight: 700;
        }

        .fw-semibold {
            font-weight: 500 !important;
            font-size: 1rem !important;
        }

        .stat-inline {
            display: flex;
            align-items: stretch;
            justify-content: space-between;
            gap: 6px;
            margin-top: 8px;
        }

        .stat-inline .stat-col {
            flex: 1 1 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 5px 8px;
            border-radius: 6px;
            gap: 4px;
        }

        .stat-inline .stat-col.stat-active {
            background: rgba(46, 213, 115, 0.22);
            border: 1px solid rgba(46, 213, 115, 0.35);
        }

        .stat-inline .stat-col.stat-inactive {
            background: rgba(255, 71, 87, 0.2);
            border: 1px solid rgba(255, 71, 87, 0.35);
        }

        .stat-inline .stat-col .stat-label {
            font-size: 0.72rem;
            font-weight: 600;
            white-space: nowrap;
            display: inline-flex;
            align-items: center;
        }

        .stat-inline .stat-col.stat-active .stat-label   { color: #a8ffcf; }
        .stat-inline .stat-col.stat-inactive .stat-label { color: #ffb3ba; }

        .stat-inline .stat-col .stat-label i { font-size: 0.85rem; }
        .stat-inline .stat-col.stat-active .stat-label i   { color: #52ff9e; }
        .stat-inline .stat-col.stat-inactive .stat-label i { color: #ff6b7a; }

        .stat-inline .stat-col .stat-value {
            font-size: 0.85rem;
            font-weight: 700;
            color: #fff;
        }

        .stat-card-body {
            padding: 14px 16px !important;
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
    </style>
@endpush
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Administration | <span class="text-muted font-size-12">Dashboard</span></h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i data-feather="home" class="icon-xs align-middle me-1"></i></a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Administration</a></li>
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
                        <h2 style="padding:0px; margin:0px; font-size:18px;">Administration Overview</h2>
                        <p class="mb-0 mt-1 text-muted font-size-12">
                            System-wide statistics summary
                        </p>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 g-3">

                        <!-- 1. Total Modules -->
                        <div class="col">
                            <div class="card border-0 shadow-sm text-white h-100" style="background:linear-gradient(135deg,#7b1fa2,#9c27b0);">
                                <div class="card-body stat-card-body">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="flex-grow-1">
                                            <small class="fw-semibold text-white-100">Total Modules</small>
                                            <h3 class="fw-bold mb-0">{{ number_format($modules['total'], 0) }}</h3>
                                            <div class="stat-inline">
                                                <div class="stat-col stat-active">
                                                    <span class="stat-label"><i class="bx bx-check-circle me-1"></i> Active</span>
                                                    <span class="stat-value">{{ number_format($modules['active'], 0) }}</span>
                                                </div>
                                                <div class="stat-col stat-inactive">
                                                    <span class="stat-label"><i class="bx bx-x-circle me-1"></i> Inactive</span>
                                                    <span class="stat-value">{{ number_format($modules['inactive'], 0) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="fs-1 opacity-75 ms-2">
                                            <i class="bx bx-collection"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 2. Total Menus -->
                        <div class="col">
                            <div class="card border-0 shadow-sm bg-primary bg-gradient text-white h-100">
                                <div class="card-body stat-card-body">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="flex-grow-1">
                                            <small class="fw-semibold text-white-100">Total Menus</small>
                                            <h3 class="fw-bold mb-0">{{ number_format($menus['total'], 0) }}</h3>
                                            <div class="stat-inline">
                                                <div class="stat-col stat-active">
                                                    <span class="stat-label"><i class="bx bx-check-circle me-1"></i> Active</span>
                                                    <span class="stat-value">{{ number_format($menus['active'], 0) }}</span>
                                                </div>
                                                <div class="stat-col stat-inactive">
                                                    <span class="stat-label"><i class="bx bx-x-circle me-1"></i> Inactive</span>
                                                    <span class="stat-value">{{ number_format($menus['inactive'], 0) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="fs-1 opacity-75 ms-2">
                                            <i class="bx bx-menu"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 3. Total Users -->
                        <div class="col">
                            <div class="card border-0 shadow-sm text-white h-100" style="background:linear-gradient(135deg,#11998e,#38ef7d);">
                                <div class="card-body stat-card-body">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="flex-grow-1">
                                            <small class="fw-semibold text-white-100">Total Users</small>
                                            <h3 class="fw-bold mb-0">{{ number_format($users['total'], 0) }}</h3>
                                            <div class="stat-inline">
                                                <div class="stat-col stat-active">
                                                    <span class="stat-label"><i class="bx bx-check-circle me-1"></i> Active</span>
                                                    <span class="stat-value">{{ number_format($users['active'], 0) }}</span>
                                                </div>
                                                <div class="stat-col stat-inactive">
                                                    <span class="stat-label"><i class="bx bx-x-circle me-1"></i> Inactive</span>
                                                    <span class="stat-value">{{ number_format($users['inactive'], 0) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="fs-1 opacity-75 ms-2">
                                            <i class="bx bx-user"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 4. Total Roles -->
                        <div class="col">
                            <div class="card border-0 shadow-sm text-white h-100" style="background:linear-gradient(135deg,#ee8610,#e84118);">
                                <div class="card-body stat-card-body">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="flex-grow-1">
                                            <small class="fw-semibold text-white-100">Total Roles</small>
                                            <h3 class="fw-bold mb-0">{{ number_format($roles['total'], 0) }}</h3>
                                            <div class="stat-inline">
                                                <div class="stat-col stat-active">
                                                    <span class="stat-label"><i class="bx bx-check-circle me-1"></i> Active</span>
                                                    <span class="stat-value">{{ number_format($roles['active'], 0) }}</span>
                                                </div>
                                                <div class="stat-col stat-inactive">
                                                    <span class="stat-label"><i class="bx bx-x-circle me-1"></i> Inactive</span>
                                                    <span class="stat-value">{{ number_format($roles['inactive'], 0) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="fs-1 opacity-75 ms-2">
                                            <i class="bx bx-user-check"></i>
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
