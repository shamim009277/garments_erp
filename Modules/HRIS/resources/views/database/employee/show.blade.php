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
                <h4 class="text-center flex-grow-1 order-1 order-md-0 mb-2 mb-md-0">Employee | ID : 1625</h4>

                <!-- Search Form -->
                <form class="d-flex order-0 order-md-1 mb-2 mb-md-0 me-md-2" style="max-width: 400px;" role="search">
                    <input class="form-control form-control-sm me-2" type="search" placeholder="Applicant Card No ..." aria-label="Search">
                    <button class="btn btn-sm btn-primary d-flex align-items-center" type="submit">
                        <i data-feather="search" width="14" height="14" class="me-1"></i> Search
                    </button>
                </form>

                <!-- Back Button -->
                <button class="btn btn-sm btn-info d-flex align-items-center order-2 order-md-2">
                    <i data-feather="arrow-left" width="14" height="14" class="me-1"></i> Back
                </button>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="card alert-primary alert-top-border">
                <div class="card-body px-0 py-0" style="min-height: 500px;">
                    <ul class="nav nav-tabs nav-tabs-custom" role="tablist" style="background-color: #4549A2; color: white;border-radius: 0px !important;">
                        <li class="nav-item">
                            <a href="{{ route('hris.database.employee.show', ['id' => $employee->id,'tab' => 1]) }}" class="nav-link active border-none" data-bs-toggle="tab" href="#basic" role="tab">
                                <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                <span class="d-none d-sm-block">Basic</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('hris.database.employee.show', ['id' => $employee->id,'tab' => 2]) }}" class="nav-link border-none" data-bs-toggle="tab" href="#salary" role="tab">
                                <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                <span class="d-none d-sm-block">Salary Info</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('hris.database.employee.show', ['id' => $employee->id,'tab' => 3]) }}" class="nav-link border-none" data-bs-toggle="tab" href="#education" role="tab">
                                <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                <span class="d-none d-sm-block">Education</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('hris.database.employee.show', ['id' => $employee->id,'tab' => 4]) }}" class="nav-link border-none" data-bs-toggle="tab" href="#training" role="tab">
                                <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                <span class="d-none d-sm-block">Training</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('hris.database.employee.show', ['id' => $employee->id,'tab' => 5]) }}" class="nav-link border-none" data-bs-toggle="tab" href="#experience" role="tab">
                                <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                <span class="d-none d-sm-block">Experience</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('hris.database.employee.show', ['id' => $employee->id,'tab' => 6]) }}" class="nav-link border-none" data-bs-toggle="tab" href="#service" role="tab">
                                <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                <span class="d-none d-sm-block">Service</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('hris.database.employee.show', ['id' => $employee->id,'tab' => 7]) }}" class="nav-link border-none" data-bs-toggle="tab" href="#reference" role="tab">
                                <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                <span class="d-none d-sm-block">Reference</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('hris.database.employee.show', ['id' => $employee->id,'tab' => 8]) }}" class="nav-link border-none" data-bs-toggle="tab" href="#documents" role="tab">
                                <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                <span class="d-none d-sm-block">Documents</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('hris.database.employee.show', ['id' => $employee->id,'tab' => 9]) }}" class="nav-link border-none" data-bs-toggle="tab" href="#miscellaneous" role="tab">
                                <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                <span class="d-none d-sm-block">Mescellaneous</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('hris.database.employee.show', ['id' => $employee->id,'tab' => 10]) }}" class="nav-link border-none" data-bs-toggle="tab" href="#bangla" role="tab">
                                <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                <span class="d-none d-sm-block">Bangla</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('hris.database.employee.show', ['id' => $employee->id,'tab' => 11]) }}" class="nav-link border-none" data-bs-toggle="tab" href="#operation" role="tab">
                                <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                <span class="d-none d-sm-block">Operation</span>
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content text-muted">
                        <div class="tab-pane {{ $tab == 1 ? 'active' : '' }}" id="basic" role="tabpanel">
                            @include('hris::database.employee.tab1')
                        </div>
                        <div class="tab-pane {{ $tab == 2 ? 'active' : '' }}" id="salary" role="tabpanel">
                            @include('hris::database.employee.tab2')
                        </div>
                        <div class="tab-pane {{ $tab == 3 ? 'active' : '' }}" id="education" role="tabpanel">
                            @include('hris::database.employee.tab3')
                        </div>
                        <div class="tab-pane {{ $tab == 4 ? 'active' : '' }}" id="training" role="tabpanel">
                            @include('hris::database.employee.tab4')
                        </div>
                        <div class="tab-pane {{ $tab == 5 ? 'active' : '' }}" id="experience" role="tabpanel">
                            @include('hris::database.employee.tab5')
                        </div>
                        <div class="tab-pane {{ $tab == 6 ? 'active' : '' }}" id="service" role="tabpanel">
                            @include('hris::database.employee.tab6')
                        </div>
                        <div class="tab-pane {{ $tab == 7 ? 'active' : '' }}" id="reference" role="tabpanel">
                            @include('hris::database.employee.tab7')
                        </div>
                        <div class="tab-pane {{ $tab == 8 ? 'active' : '' }}" id="documents" role="tabpanel">
                            @include('hris::database.employee.tab8')
                        </div>
                        <div class="tab-pane {{ $tab == 9 ? 'active' : '' }}" id="miscellaneous" role="tabpanel">
                            @include('hris::database.employee.tab9')
                        </div>
                        <div class="tab-pane {{ $tab == 10 ? 'active' : '' }}" id="bangla" role="tabpanel">
                            @include('hris::database.employee.tab10')
                        </div>
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
