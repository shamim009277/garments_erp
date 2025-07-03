<footer class="footer" style="{{ request()->segment(1) == 'dashboard' ? 'width: 100%; left: 0px !important' : '' }}">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <script>document.write(new Date().getFullYear())</script> © {{ $general->short_name }}.
            </div>
            <div class="col-sm-6">
                <div class="text-sm-end d-none d-sm-block">
                    {{ $general->short_name }} <a href="#!" class="text-decoration-underline">{{ $general->footer_text }}</a>
                </div>
            </div>
        </div>
    </div>
</footer>
