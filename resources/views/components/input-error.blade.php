@props(['messages'])

@if ($messages)
    @foreach ((array) $messages as $message)
        <div {{ $attributes->merge(['class' => 'text-danger mb-1']) }}>
            {{ $message }}
        </div>
    @endforeach
@endif
