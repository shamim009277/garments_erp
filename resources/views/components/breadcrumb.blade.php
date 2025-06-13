<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    @if (!empty($title))
        <div class="breadcrumb-title pe-3">{{ $title }}</div>
    @endif

    @if (!empty($subtitle))
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item active" aria-current="page">{{ $subtitle }}</li>
                </ol>
            </nav>
        </div>
    @endif

    <div class="ms-auto">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item">
                    <a href="{{ url('/dashboard') }}"><i class="bx bx-home-alt"></i></a>
                </li>
                @foreach ($right as $item)
                    <li class="breadcrumb-item {{ $loop->last ? 'active' : '' }}" aria-current="{{ $loop->last ? 'page' : '' }}">
                        @if(isset($item['url']))
                            <a href="{{ $item['url'] }}">{{ $item['label'] }}</a>
                        @else
                            {{ $item['label'] }}
                        @endif
                    </li>
                @endforeach
            </ol>
        </nav>
    </div>
</div>
