<footer>
    <div style="display: flex; justify-content: space-between; font-size: 10px;">
        <div>
            Printed by {{ auth()->user()->name ?? 'System' }}
        </div>
        <div>
            Page <span class="page"></span> | {{ now()->format('d-m-Y h:i A') }}
        </div>
    </div>
</footer>
