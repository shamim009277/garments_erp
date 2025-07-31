@extends('layouts.app')
@section('title', 'HRIS')
@section('styles')
    <style>
        .table, tr, th, td {
            border: none !important;
            border-collapse: collapse;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            @include('components.breadcrumb', [
                'title' => 'HRIS',
                'subtitle' => 'Employee',
                'breadcrumbs' => [
                    ['label' => 'HRIS', 'url' => route('hris.index')],
                    ['label' => 'Database', 'url' => route('hris.index')],
                    ['label' => 'Employee', 'url' => route('hris.database.employee.index')],
                ],
            ])
        </div>

        <div class="col-lg-12 mb-3">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                <!-- Title -->
                <h4 class="text-center flex-grow-1 order-1 order-md-0 mb-2 mb-md-0">Employee | ID : {{ $employee->employee_id }}</h4>
                <!-- Search Form -->
                <form class="d-flex order-0 order-md-1 mb-2 mb-md-0 me-md-2" style="max-width: 400px;" role="search">
                    <input class="form-control form-control-sm me-2" type="search" placeholder="Applicant Card No ..." aria-label="Search">
                    <button class="btn btn-sm btn-primary d-flex align-items-center" type="submit">
                        <i data-feather="search" width="14" height="14" class="me-1"></i> Search
                    </button>
                </form>

                <!-- Back Button -->
                <a href="{{ route('hris.database.employee.index') }}" class="btn btn-sm btn-info d-flex align-items-center order-2 order-md-2">
                    <i data-feather="arrow-left" width="14" height="14" class="me-1"></i> Back
                </a>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="card alert-primary alert-top-border">
                <div class="card-body px-0 py-0" style="min-height: 500px;">
                    <ul class="nav nav-tabs nav-tabs-custom" role="tablist" style="background-color: #5559ca; color: white;border-radius: 0px !important;">
                        <li class="nav-item">
                            <a href="{{ route('hris.database.employee.show', ['employee' => $employee->id,'tab' => 1]) }}" class="nav-link border-none {{ $tab == 1 ? 'active' : '' }}" title="Basic" role="tab" style="hover: white !important;">
                                <span class="d-block d-sm-none"><i class="fa fa-user"></i></span>
                                <span class="d-none d-sm-block">Basic</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('hris.database.employee.show', ['employee' => $employee->id,'tab' => 2]) }}" class="nav-link border-none {{ $tab == 2 ? 'active' : '' }}" title="Salary Info" role="tab">
                                <span class="d-block d-sm-none"><i class="fa fa-credit-card"></i></span>
                                <span class="d-none d-sm-block">Salary Info</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('hris.database.employee.show', ['employee' => $employee->id,'tab' => 3]) }}" class="nav-link border-none {{ $tab == 3 ? 'active' : '' }}" title="Education" role="tab">
                                <span class="d-block d-sm-none"><i class="fa fa-graduation-cap"></i></span>
                                <span class="d-none d-sm-block">Education</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('hris.database.employee.show', ['employee' => $employee->id,'tab' => 4]) }}" class="nav-link border-none {{ $tab == 4 ? 'active' : '' }}" title="Training" role="tab">
                                <span class="d-block d-sm-none"><i class="fa fa-chalkboard-teacher"></i></span>
                                <span class="d-none d-sm-block">Training</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('hris.database.employee.show', ['employee' => $employee->id,'tab' => 5]) }}" class="nav-link border-none {{ $tab == 5 ? 'active' : '' }}" title="Experience" role="tab">
                                <span class="d-block d-sm-none"><i class="fa fa-toolbox"></i></span>
                                <span class="d-none d-sm-block">Experience</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('hris.database.employee.show', ['employee' => $employee->id,'tab' => 6]) }}" class="nav-link border-none {{ $tab == 6 ? 'active' : '' }}" title="Service" role="tab">
                                <span class="d-block d-sm-none"><i class="fa fa-briefcase"></i></span>
                                <span class="d-none d-sm-block">Service</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('hris.database.employee.show', ['employee' => $employee->id,'tab' => 7]) }}" class="nav-link border-none {{ $tab == 7 ? 'active' : '' }}" title="Reference" role="tab">
                                <span class="d-block d-sm-none"><i class="far fa-address-card"></i></span>
                                <span class="d-none d-sm-block">Reference</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('hris.database.employee.show', ['employee' => $employee->id,'tab' => 8]) }}" class="nav-link border-none {{ $tab == 8 ? 'active' : '' }}" title="Documents" role="tab">
                                <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                <span class="d-none d-sm-block">Documents</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('hris.database.employee.show', ['employee' => $employee->id,'tab' => 9]) }}" class="nav-link border-none {{ $tab == 9 ? 'active' : '' }}" title="Mescellaneous" role="tab">
                                <span class="d-block d-sm-none"><i class="fas fa-tools"></i></span>
                                <span class="d-none d-sm-block">Mescellaneous</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('hris.database.employee.show', ['employee' => $employee->id,'tab' => 10]) }}" class="nav-link border-none {{ $tab == 10 ? 'active' : '' }}" title="Bangla" role="tab">
                                <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                <span class="d-none d-sm-block">Bangla</span>
                            </a>
                        </li>
                        <li class="nav-item">

                        </li>
                    </ul>

                    <div class="tab-content text-muted">
                        @if($tab == 1)
                        <div class="tab-pane {{ $tab == 1 ? 'active' : '' }}    " id="basic" role="tabpanel">
                            @include('hris::database.employee.tab1')
                        </div>
                        @endif
                        @if($tab == 2)
                        <div class="tab-pane {{ $tab == 2 ? 'active' : '' }}" id="salary" role="tabpanel">
                            @include('hris::database.employee.tab2')
                        </div>
                        @endif
                        @if($tab == 3)
                        <div class="tab-pane {{ $tab == 3 ? 'active' : '' }}" id="education" role="tabpanel">
                            @include('hris::database.employee.tab3')
                        </div>
                        @endif
                        @if($tab == 4)
                        <div class="tab-pane {{ $tab == 4 ? 'active' : '' }}" id="training" role="tabpanel">
                            @include('hris::database.employee.tab4')
                        </div>
                        @endif
                        @if($tab == 5)
                        <div class="tab-pane {{ $tab == 5 ? 'active' : '' }}" id="experience" role="tabpanel">
                            @include('hris::database.employee.tab5')
                        </div>
                        @endif
                        @if($tab == 6)
                        <div class="tab-pane {{ $tab == 6 ? 'active' : '' }}" id="service" role="tabpanel">
                            @include('hris::database.employee.tab6')
                        </div>
                        @endif
                        @if($tab == 7)
                        <div class="tab-pane {{ $tab == 7 ? 'active' : '' }}" id="reference" role="tabpanel">
                            @include('hris::database.employee.tab7')
                        </div>
                        @endif
                        @if($tab == 8)
                        <div class="tab-pane {{ $tab == 8 ? 'active' : '' }}" id="documents" role="tabpanel">
                            @include('hris::database.employee.tab8')
                        </div>
                        @endif
                        @if($tab == 9)
                        <div class="tab-pane {{ $tab == 9 ? 'active' : '' }}" id="miscellaneous" role="tabpanel">
                            @include('hris::database.employee.tab9')
                        </div>
                        @endif
                        @if($tab == 10)
                        <div class="tab-pane {{ $tab == 10 ? 'active' : '' }}" id="bangla" role="tabpanel">
                            @include('hris::database.employee.tab10')
                        </div>
                        @endif
                        @if($tab == 11)
                        <div class="tab-pane {{ $tab == 11 ? 'active' : '' }}" id="operation" role="tabpanel">
                            @include('hris::database.employee.tab11')
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Date restriction
            let today = new Date().toISOString().split('T')[0];
            $('#joining_date').attr('min', today);

            // Initialize Select2
            $('.select2').select2({
                placeholder: "Select an option",
                allowClear: true,
                width: '100%'
            });
        });
    </script>
@endpush
