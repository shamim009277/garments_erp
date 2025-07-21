<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Minia | @yield('title', config('app.name'))</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Garments ERP - Complete Solution for Garments Manufacturing and Management" />
    <meta name="author" content="ERP Team" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ asset('backend/assets/images/favicon.ico') }}">
    {{-- Select2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Choices.js -->
    <link href="{{ asset('backend/assets/libs/choices.js/public/assets/styles/choices.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- DataTables -->
    <link href="{{ asset('backend/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{ asset('backend/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Responsive Table css -->
    <link href="{{ asset('backend/assets/libs/admin-resources/rwd-table/rwd-table.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- preloader css -->
    <link rel="stylesheet" href="{{ asset('backend/assets/css/preloader.min.css') }}" type="text/css" />
    <!-- Bootstrap Css -->
    <link href="{{ asset('backend/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('backend/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('backend/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <style>
        table tr th {
            padding: 6px !important;
            vertical-align: middle !important;
            font-weight: bold !important;
        }

        table tr td {
            padding: 4px !important;
            vertical-align: middle !important;
        }

        .padding-card {
            padding: 0px !important;
        }

        .page-content {
            padding: calc(70px + 1.5rem) 0 60px 0 !important;
            background-color: #F6F9FC !important;
            min-height: 100vh !important;
            width: 100%;
        }

        .pr-0 {
            padding-right: 0px !important;
        }

        .navbar-header {
            padding: 0 1.0rem 0 0 !important;
        }

        .border-none{
            border-radius: 0px !important;
        }

        /* Custom Navigation */
        .nav-custom {
            list-style: none;
            padding-left: 0;
            font-size: 14px;
        }

        .nav-custom-item {
            margin-left: 0px;
            width: 100%;
            line-height: 16px;
            list-style: none;
            padding: 2px 0px;
        }

        .nav-custom-link {
            cursor: pointer;
            display: block;
            margin: 0px;
            padding: 8px 6px;
            color: #4549A2;
        }

        .nav-custom-content {
            display: none;
            margin-left: 5px;
            margin-bottom: 5px;
            transform: translateY(-10px);
            transition: max-height 0.5s ease, opacity 0.5s ease, transform 0.5s ease;
        }

        input[type="checkbox"] {
            display: none;
        }

        .nav-custom-link:hover {
            color: #4549A2;
            background-color: #ebf0f6;
        }

        input:checked+label+.nav-custom-content {
            display: block;
            max-height: 1000px;
            opacity: 1;
            transform: translateY(0);
        }

        .nav-custom-caret::before {
            content: "➡";
            margin-right: 5px;
            transition: transform 0.2s;
            display: inline-block;
        }

        input:checked+label .nav-custom-caret::before {
            transform: rotate(90deg);
        }

        .employee-link {
            display: block;
            margin-left: 30px;
            color: #313533;
            padding: 6px 6px;
        }

        .employee-link:hover {
            text-decoration: underline;
            background-color: #ebf0f6;
        }
        /* End Custom Navigation */
        input[readonly] {
            background-color: #dad9d9;
            cursor: not-allowed;
        }
        .select2-container--default .select2-selection--single{
            background-color: #F8F9FA !important;
            border: 1px solid #E9E9EF !important;
        }
    </style>
    @stack('styles')
</head>

<body data-sidebar-size='sm' data-topbar='dark'>
    <!-- Begin page -->
    <div id="layout-wrapper">
        @include('includes.header')
        <!-- ========== Left Sidebar Start ========== -->
        @if (request()->segment(1) != 'dashboard')
            @include('includes.sidebar')
        @endif
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content"
            style="{{ request()->segment(1) == 'dashboard' ? 'margin-left: 0px !important' : '' }}">
            <div class="page-content">
                <div class="container-fluid"
                    style="{{ request()->segment(1) == 'dashboard' ? 'padding: 0px !important' : '' }}">
                    <!-- start page title -->
                    @yield('content')
                    <!-- end page title -->
                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
            @include('includes.footer')
        </div>
        <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->

    <!-- Right Sidebar -->
    @include('includes.right_bar')
    <!-- /Right-bar -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <script src="{{ asset('backend/assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/feather-icons/feather.min.js') }}"></script>
    <!-- pace js -->
    <script src="{{ asset('backend/assets/libs/pace-js/pace.min.js') }}"></script>
    <!-- Required datatable js -->
    <script src="{{ asset('backend/assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Buttons examples -->
    <script src="{{ asset('backend/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/pdfmake/build/vfs_fonts.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>

    <!-- Responsive examples -->
    <script src="{{ asset('backend/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>
    <!-- Datatable init js -->
    <script src="{{ asset('backend/assets/js/pages/datatables.init.js') }}"></script>
    <!-- Responsive Table js -->
    <script src="{{ asset('backend/assets/libs/admin-resources/rwd-table/rwd-table.min.js') }}"></script>
    <!-- Init js -->
    <script src="{{ asset('backend/assets/js/pages/table-responsive.init.js') }}"></script>
    {{-- Select2 --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="{{ asset('backend/assets/js/pages/form-advanced.init.js') }}"></script>
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>

    <!-- SweetAlert2 & Toastr -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Accept': 'application/json'
            }
        });
        $(document).ready(function() {
            let clickedButton = null;
            $(document).on('click', '.submitBtn', function() {
                clickedButton = $(this);
            });

            $(document).on('submit', 'form', function(e) {
                if (!this.checkValidity()) {
                    e.preventDefault();
                    e.stopPropagation();
                    return;
                }
                if (clickedButton) {
                    clickedButton.prop('disabled', true);
                    clickedButton.find('.spinner-border').removeClass('d-none');

                    let originalText = clickedButton.find('.btn-text').text().trim();
                    let submittingText = makeIngText(originalText);
                    clickedButton.find('.btn-text').text(submittingText);
                }
            });

            function makeIngText(text) {
                const words = text.trim().split(' ');
                let first = words[0].toLowerCase();

                if (first.endsWith('e')) {
                    first = first.slice(0, -1);
                }

                first = first.charAt(0).toUpperCase() + first.slice(1) + 'ing';
                return first + (words.length > 1 ? ' ' + words.slice(1).join(' ') : '') + ' ...';
            }
        });
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
        };

        // Select2
        $('.select2').select2({
            placeholder: "Select an option",
            allowClear: true,
            width: '100%'
        });
    </script>

    <script>
        @if (session('success'))
            toastr.success("{{ session('success') }}", "Success");
        @endif

        @if (session('info'))
            toastr.info("{{ session('info') }}", "Info");
        @endif

        @if (session('warning'))
            toastr.warning("{{ session('warning') }}", "Warning");
        @endif

        @if (session('error'))
            toastr.error("{{ session('error') }}", "Error");
        @endif

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}", "Validation Error");
            @endforeach
        @endif
    </script>
    @stack('scripts')
</body>

</html>
