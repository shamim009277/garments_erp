
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rocker || Admin Dashboard</title>
    @include('partials.styles')
    <style>
		.image-wrapper {
			overflow: hidden;
			width: 100%;
			height: 200px;
			border-radius: 8px;
		}

		.image-wrapper img {
			width: 100%;
			height: 100%;
			object-fit: cover;
			transition: transform 0.3s ease;
		}

		.image-wrapper:hover img {
			transform: scale(1.1);
		}
	</style>
</head>

<body>
    <!--wrapper-->
    <div class="wrapper">
        <!--start header -->
        <header>
            <div class="topbar align-items-center" style="width: 100%; left: 0; position: fixed; z-index: 1030;">
                @include('includes.navbar')
            </div>
        </header>
        <!--end header -->
        <!--start page wrapper -->
        <div class="page-wrapper" style="margin-left: 0px; width: 100%;">
            <div class="page-content">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-4">
                    <div class="col" style="margin:0 px; padding: 1px;">
                        <div class="card" style="margin:0 px; padding: 0px;">
                            <div class="card-body" style="padding: 0px;">
                                <div class="d-flex align-items-center">
                                    <div class="image-wrapper">
                                        <a href="{{ route('hrm.index') }}">
                                            <img src="{{ asset('backend/assets/images/module/hrm2.jpeg') }}" alt="HRM Module">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col" style="margin:0 px; padding: 1px;">
                        <div class="card" style="margin:0 px; padding: 0px;">
                            <div class="card-body" style="padding: 0px;">
                                <div class="d-flex align-items-center">
                                    <div class="image-wrapper">
                                        <a href="{{ route('payroll.index') }}">
                                            <img src="{{ asset('backend/assets/images/module/payroll.png') }}" alt="Payroll Module">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col" style="margin:0 px; padding: 1px;">
                        <div class="card" style="margin:0 px; padding: 0px;">
                            <div class="card-body" style="padding: 0px;">
                                <div class="d-flex align-items-center">
                                    <div class="image-wrapper">
                                        <a href="{{ route('inventory.index') }}">
                                            <img src="{{ asset('backend/assets/images/module/inventory.webp') }}" alt="Inventory Module">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col" style="margin:0 px; padding: 1px;">
                        <div class="card" style="margin:0 px; padding: 0px;">
                            <div class="card-body" style="padding: 0px;">
                                <div class="d-flex align-items-center">
                                    <div class="image-wrapper">
                                        <a href="{{ route('administration.index') }}">
                                            <img src="{{ asset('backend/assets/images/module/administration.jpg') }}" alt="Administration Module">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>
        </div>
        <!--end page wrapper -->
        @include('includes.footer')
    </div>
    <!--end wrapper-->
    @include('partials.scripts')

    <script>
        $(document).ready(function () {
			$("html").attr("class", "semi-dark");
            $("html").addClass("color-header headercolor9");
        });
    </script>
</body>
</html>
