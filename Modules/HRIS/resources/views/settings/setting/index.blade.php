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
                'subtitle' => 'Settings',
                'breadcrumbs' => [
                    ['label' => 'HRIS', 'url' => route('hris.index')],
                    ['label' => 'Settings', 'url' => route('hris.settings.hr-settings.index')],
                ],
            ])
        </div>

        <div class="col-lg-12 mb-3">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                <!-- Title -->
                <h4 class="text-center flex-grow-1 order-1 order-md-0 mb-2 mb-md-0">Settings</h4>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="card alert-primary alert-top-border">
                <div class="card-body px-0 py-0">
                    <ul class="nav nav-tabs nav-tabs-custom" role="tablist" style="background-color: #4549A2; color: white;border-radius: 0px !important;">
                        <li class="nav-item">
                            <a class="nav-link border-none {{ $tab == 1 ? 'active' : '' }}" data-url="{{ route('hris.settings.hr-settings.index', ['tab' => 1]) }}" href="#salary" role="tab">
                                <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                <span class="d-none d-sm-block">Salary Structure</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link border-none {{ $tab == 2 ? 'active' : '' }}" data-url="{{ route('hris.settings.hr-settings.index', ['tab' => 2]) }}" href="#leave" role="tab">
                                <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                <span class="d-none d-sm-block">Leave Options</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link border-none {{ $tab == 3 ? 'active' : '' }}" data-url="{{ route('hris.settings.hr-settings.index', ['tab' => 3]) }}" href="#leave_schedule" role="tab">
                                <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                <span class="d-none d-sm-block">Ramadan Schedule</span>
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content text-muted">
                        <div class="tab-pane {{ $tab == 1 ? 'active' : '' }}" id="salary" role="tabpanel">
                            @if($tab == 1)
                                @include('hris::settings.setting.tab1')
                            @endif
                        </div>
                        <div class="tab-pane {{ $tab == 2 ? 'active' : '' }}" id="leave" role="tabpanel">
                            @if($tab == 2)
                                @include('hris::settings.setting.tab2')
                            @endif
                        </div>
                        <div class="tab-pane {{ $tab == 3 ? 'active' : '' }}" id="leave_schedule" role="tabpanel">
                            @if($tab == 3)
                                @include('hris::settings.setting.tab3')
                            @endif
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
            initPlugins();

            $('.nav-link').on('click', function(e) {
                e.preventDefault();
                var target = $(this).attr('href');
                var url = $(this).data('url');
                var tabContent = $(target);

                // Update active state
                $('.nav-link').removeClass('active');
                $(this).addClass('active');
                $('.tab-pane').removeClass('active');
                tabContent.addClass('active');

                // Load content if empty
                if (tabContent.html().trim() === '') {
                    // Show loader
                    tabContent.html('<div class="text-center p-5"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></div>');
                    
                    $.ajax({
                        url: url,
                        type: 'GET',
                        success: function(response) {
                            tabContent.html(response);
                            initPlugins();
                        },
                        error: function(xhr) {
                            tabContent.html('<div class="alert alert-danger">Error loading data</div>');
                        }
                    });
                }
            });

            function initPlugins() {
                // Initialize Select2
                if($('.select2').length > 0) {
                    $('.select2').select2({
                        placeholder: "Select an option",
                        allowClear: true,
                        width: '100%'
                    });
                }

                // Flatpickr for Ramadan Schedule
                if ($("#start_date").length > 0) {
                    let startPicker = flatpickr("#start_date", {
                        dateFormat: "d-m-Y",
                        onChange: function (selectedDates, dateStr) {
                            if (dateStr) {
                                endPicker.set("minDate", dateStr);
                            }
                            if ($("#end_date").val() && $("#end_date").val() < dateStr) {
                                $("#end_date").val("");
                                $("#days").val("");
                            }
                            updateDays();
                        }
                    });

                    let endPicker = flatpickr("#end_date", {
                        dateFormat: "d-m-Y",
                        onChange: function (selectedDates, dateStr) {
                            if (dateStr) {
                                startPicker.set("maxDate", dateStr);
                            }
                            if ($("#start_date").val() && $("#start_date").val() > dateStr) {
                                $("#start_date").val("");
                                $("#days").val("");
                            }
                            updateDays();
                        }
                    });

                    // Sync values if present
                    if ($("#start_date").val()) {
                        endPicker.set("minDate", $("#start_date").val());
                    }
                    if ($("#end_date").val()) {
                        startPicker.set("maxDate", $("#end_date").val());
                    }
                }
            }

            function updateDays() {
                let start = $("#start_date").val();
                let end = $("#end_date").val();

                if (!start || !end) return;

                let startDate = new Date(start);
                let endDate = new Date(end);

                if (startDate > endDate) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Invalid Date!',
                        text: 'End Date must be greater than or equal to Start Date',
                    });
                    $("#end_date").val("");
                    $("#days").val("");
                    return;
                }

                // let diffDays = Math.floor((endDate - startDate) / (1000 * 60 * 60 * 24)) + 1;
                // if (diffDays !== 29 && diffDays !== 30) {
                //     Swal.fire({
                //         icon: 'error',
                //         title: 'Invalid Date!',
                //         text: 'Ramadan Schedule must be 29 or 30 days only',
                //     });

                //     $("#end_date").val("");
                //     $("#days").val("");
                //     return;
                // }
            }
        });
    </script>
@endpush
