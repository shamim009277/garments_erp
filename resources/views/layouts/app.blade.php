<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <title>Rocker || {{ $title ?? config('app.name', 'Laravel') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('partials.styles')
    @stack('styles')
</head>

<body>
    <!--wrapper-->
    <div class="wrapper">
        <!--sidebar wrapper -->
        {{-- @include('includes.sidebar') --}}
        @includeIf('includes.sidebar.' . ($currentModule ?? 'common'))
        <!--end sidebar wrapper -->
        <!--start header -->
        <header>
            <div class="topbar d-flex align-items-center">
                @include('includes.navbar')
            </div>
        </header>
        <!--end header -->
        <!--start page wrapper -->
        <div class="page-wrapper">
            <div class="page-content">
                {{ $slot }}
            </div>
        </div>
        <!--end page wrapper -->
        <!--start overlay-->
        <div class="overlay toggle-icon"></div>
        <!--end overlay-->
        <!--Start Back To Top Button-->
        <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
        <!--End Back To Top Button-->
        @include('includes.footer')
    </div>
    <!--end wrapper-->
    <!--start switcher-->
    @include('partials.customizer')
    <!--end switcher-->

    @include('partials.scripts')
    <style>
        /* Smooth transitions for topbar and sidebar */
        .topbar,
        .sidebar-wrapper {
            transition: all 0.3s ease-in-out;
        }

        /* Optional: transition for page content shifting */
        .page-wrapper {
            transition: margin-left 0.3s ease-in-out;
        }

        /* Optional dark/light mode transitions */
        html,
        body {
            transition: background-color 0.3s ease, color 0.3s ease;
        }
    </style>
    @stack('scripts')
    <script>
        $(function() {
            "use strict";

            // Force sidebar collapsed on page load
            $(".wrapper").addClass("toggled");

            // Enable hover to expand sidebar
            $(".sidebar-wrapper").hover(
                function() {
                    $(".wrapper").addClass("sidebar-hovered");
                },
                function() {
                    $(".wrapper").removeClass("sidebar-hovered");
                }
            );

            new PerfectScrollbar(".header-message-list");
            new PerfectScrollbar(".header-notifications-list");

            $(".mobile-search-icon").on("click", function() {
                $(".search-bar").addClass("full-search-bar");
            });

            $(".search-close").on("click", function() {
                $(".search-bar").removeClass("full-search-bar");
            });

            $(".mobile-toggle-menu").on("click", function() {
                $(".wrapper").addClass("toggled");
            });

            $(".toggle-icon").click(function() {
                if ($(".wrapper").hasClass("toggled")) {
                    $(".wrapper").removeClass("toggled");
                    $(".sidebar-wrapper").unbind("hover");
                } else {
                    $(".wrapper").addClass("toggled");
                    $(".sidebar-wrapper").hover(
                        function() {
                            $(".wrapper").addClass("sidebar-hovered");
                        },
                        function() {
                            $(".wrapper").removeClass("sidebar-hovered");
                        }
                    );
                }
            });
        });


        $(document).ready(function() {
            $("html").attr("class", "semi-dark");
            $("html").addClass("color-header headercolor9");
        });
    </script>
</body>

</html>
