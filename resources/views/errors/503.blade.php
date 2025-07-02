<x-guest-layout :title="'Maintenance Mode - 503'">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center">
                    <div class="maintenance-cog-icon text-primary pt-4">
                        <i class="mdi mdi-cog spin-right display-3"></i>
                        <i class="mdi mdi-cog spin-left display-4 cog-icon"></i>
                    </div>
                    <h3 class="mt-4">Site is Under Maintenance</h3>
                    <p class="text-muted font-size-15 font-weight-bold text-danger" style="color:#EB7C22 !important;font-size: 1rem !important;">Site is currently under maintenance. Please check back later.</p>
                </div>
                <x-footer-copyright />
            </div>
        </div>
    </div>
</x-guest-layout>
