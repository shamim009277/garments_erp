<div class="page-title-box d-sm-flex align-items-center justify-content-between">
    @if ($title)
        <h4 class="mb-sm-0 font-size-18">
            {{ $title }}
            @if ($subtitle)
                | <span class="text-muted font-size-12">{{ $subtitle }}</span>
            @endif
        </h4>
    @endif

    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">
                    <i data-feather="home" class="icon-xs align-middle" style="margin-top: -5px;width: 12px;"></i>
                </a>
            </li>
            @foreach ($breadcrumbs as $item)
                <li class="breadcrumb-item {{ $loop->last ? 'active' : '' }}">
                    @if (!$loop->last)
                        <a href="{{ $item['url'] }}">{{ $item['label'] }}</a>
                    @else
                        {{ $item['label'] }}
                    @endif
                </li>
            @endforeach
        </ol>
    </div>
</div>
