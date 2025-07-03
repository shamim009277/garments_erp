@props([
    'for',
    'text',
    'required' => false,
])

<label for="{{ $for }}" class="form-label">
    {{ $text }}
    @if($required)
        <span class="text-danger">*</span>
    @endif
</label>
