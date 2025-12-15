<header>
    <div style="display: flex; align-items: center;">
        <!-- Logo -->
        <div>
            <img src="{{ $logo }}" alt="Logo" style="width: 40px; height: 40px;">
        </div>

        <!-- Company Info -->
        <div class="company-info">
            <div style="font-weight: bold; font-size: 14px; font-family: italic">{{ $orgname }}</div>
            <div style="font-size: 12px;font-weight: normal; font-family: italic">{{ $address }}</div>
            <div style="font-size: 12px;font-weight: normal; font-family: italic">Email: {{ $email }} | Phone: {{ $phone }}</div>
        </div>
    </div>
    <hr style="border: 1px solid #ccc;">
</header>
