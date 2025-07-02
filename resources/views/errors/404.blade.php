<x-guest-layout :title="'Page Not Found - 404'">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center py-5">
                    <div class="text-primary"><h1 style="font-size: 6rem !important;">404</h1></div>
                    <h3 class="mt-4">Oops, Page Not Found.</h3>
                    <p class="text-muted font-size-15 font-weight-bold text-danger" style="color:#EB7C22 !important;font-size: 1rem !important;">The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.</p>
                    <div class="mt-5">
                        <a class="btn btn-primary waves-effect waves-light" href="{{ url()->previous() }}">
                            <i class="mdi mdi-arrow-left"></i> Go Back
                        </a>
                    </div>
                </div>

                <x-footer-copyright />
            </div>
        </div>
    </div>
</x-guest-layout>
