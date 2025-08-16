<footer class="footer" style="{{ request()->segment(1) == 'dashboard' ? 'width: 100%; left: 0px !important' : '' }}">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <script>document.write(new Date().getFullYear())</script> © {{ $general->full_name }}.
            </div>
            <div class="col-sm-6">
                <div class="text-sm-end d-none d-sm-block">
                    {{ $general->full_name }} <a href="#!" class="text-decoration-underline"></a>
                </div>
            </div>
        </div>
    </div>
</footer>
