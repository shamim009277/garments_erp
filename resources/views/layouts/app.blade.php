
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
		@include('includes.sidebar')
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
	<script>
		$(document).ready(function () { 
			$("html").attr("class", "semi-dark");
			$("html").addClass("color-header headercolor9")
			// let sidebarColor = localStorage.getItem("sidebarColor");
			// if (sidebarColor) {
			// 	$("html").addClass(sidebarColor);
			// }
        });
	</script>
	@stack('scripts')
</body>
</html>
