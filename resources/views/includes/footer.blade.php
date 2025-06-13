<footer class="page-footer"
    style="{{ request()->segment(1) == 'dashboard' ? 'margin-left: 0px; width: 100%; left: 0px !important;' : '' }}">
    <p class="mb-0">Copyright &copy; {{ date('Y') }}. All rights reserved.</p>
</footer>