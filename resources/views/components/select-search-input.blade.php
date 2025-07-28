@props([
    'name',
    'label' => null,
    'options' => [],
    'selected' => '',
    'required' => false,
    'disabled' => false,
    'placeholder' => 'Select One',
])

<div class="mb-3">
    @if ($label)
        <label for="{{ $name }}" class="form-label">
            {{ $label }}
            @if($required)
                <span class="text-danger">*</span>
            @endif
        </label>
    @endif

    <select
        name="{{ $name }}"
        id="{{ $name }}"
        data-trigger
        placeholder="{{ $placeholder }}"
        @if($required) required @endif
        @if($disabled) disabled @endif
        {{ $attributes->merge(['class' => 'form-control']) }}
    >
        <option value="">{{ $placeholder }}</option>
        @foreach ($options as $value => $text)
            <option value="{{ $value }}" {{ (string) old($name, $selected) === (string) $value ? 'selected' : '' }}>
                {{ $text }}
            </option>
        @endforeach
    </select>
</div>
