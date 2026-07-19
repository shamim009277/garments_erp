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

        .fw-semibold{
            font-weight: 500 !important;
            font-size: 1rem !important;
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
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i data-feather="home" class="icon-xs align-middle me-1"></i></a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">HRIS</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row row-cols-2 row-cols-md-4 row-cols-xl-8 g-3">

    <!-- Total Employees -->
    <div class="col">
        <div class="card border-0 shadow-sm bg-primary bg-gradient text-white h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="fw-semibold text-white-50">Total Employees</small>
                        <h3 class="fw-bold mb-1">1,258</h3>
                        <span class="badge bg-light text-primary">Total Employee</span>
                    </div>
                    <div class="fs-1 opacity-75">
                        <i class="bx bx-group"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Present Today -->
    <div class="col">
        <div class="card border-0 shadow-sm bg-success bg-gradient text-white h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="fw-semibold text-white-50">Present Today</small>
                        <h3 class="fw-bold mb-1">1,182</h3>
                        <span class="badge bg-light text-success">Today Present</span>
                    </div>
                    <div class="fs-1 opacity-75">
                        <i class="bx bx-user-check"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Absent Today -->
    <div class="col">
        <div class="card border-0 shadow-sm bg-danger bg-gradient text-white h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="fw-semibold text-white-50">Absent Today</small>
                        <h3 class="fw-bold mb-1">76</h3>
                        <span class="badge bg-light text-danger">Today Absent</span>
                    </div>
                    <div class="fs-1 opacity-75">
                        <i class="bx bx-user-x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- On Leave -->
    <div class="col">
        <div class="card border-0 shadow-sm bg-warning bg-gradient text-dark h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="fw-semibold opacity-75">On Leave</small>
                        <h3 class="fw-bold mb-1">18</h3>
                        <span class="badge bg-light text-warning">Leave</span>
                    </div>
                    <div class="fs-1 opacity-75">
                        <i class="bx bx-calendar"></i>
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
                        <h3 class="fw-bold mb-1">24</h3>
                        <span class="badge bg-light text-info">This Month</span>
                    </div>
                    <div class="fs-1 opacity-75">
                        <i class="bx bx-user-plus"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Birthday Today -->
    <div class="col">
        <div class="card border-0 shadow-sm text-white h-100" style="background:linear-gradient(135deg,#7b1fa2,#9c27b0);">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="fw-semibold text-white-50">Birthday Today</small>
                        <h3 class="fw-bold mb-1">9</h3>
                        <span class="badge bg-light text-dark">Today's Birthday</span>
                    </div>
                    <div class="fs-1 opacity-75">
                        <i class="bx bx-cake"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Late Employees -->
    <div class="col">
        <div class="card border-0 shadow-sm text-white h-100" style="background:linear-gradient(135deg,#ef6c00,#fb8c00);">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="fw-semibold text-white-50">Late Employees</small>
                        <h3 class="fw-bold mb-1">32</h3>
                        <span class="badge bg-light text-dark">Late Today</span>
                    </div>
                    <div class="fs-1 opacity-75">
                        <i class="bx bx-time-five"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Companies -->
    <div class="col">
        <div class="card border-0 shadow-sm bg-dark bg-gradient text-white h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="fw-semibold text-white-50">Companies</small>
                        <h3 class="fw-bold mb-1 text-white-50">5</h3>
                        <span class="badge bg-light text-dark">Total Company</span>
                    </div>
                    <div class="fs-1 opacity-75">
                        <i class="bx bx-buildings"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>



                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-5">
                            <div class="card card-h-100">
                                <div class="card-body">

                                    <div id="company-employee-chart"></div>

                                </div>
                            </div>
                        </div>
                        <!-- end col -->
                        <div class="col-xl-7">
                            <div class="row">
                                <div class="col-xl-8">
                                    <!-- card -->
                                    <div class="card card-h-100">
                                        <!-- card body -->
                                        <div class="card-body">

                                        </div>
                                    </div>
                                </div>
                                <!-- end col -->
                            </div>
                            <!-- end row -->
                        </div>
                        <!-- end col -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="{{ asset('build-hris/assets/dashboard-c8fa7329.js') }}"></script>
@endpush
