@props([
    'name',
    'id'=>null,
    'group_id'=>null,
    'label' => null,
    'value' => '',
    'type' => 'text',
    'required' => false,
    'disabled' => false,
    'placeholder' => null,
])

<div class="mb-3" id="{{ $group_id }}">
    @if ($label)
        <label for="{{ $name }}" class="form-label">
            {{ $label }}
            @if($required)
                <span class="text-danger">*</span>
            @endif
        </label>
    @endif

    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $id }}"
        value="{{ old($name, $value) }}"
        placeholder="{{ $placeholder }}"
        @if($required) required @endif
        @if($disabled) disabled @endif
        {{ $attributes->merge(['class' => 'form-control' . ($errors->has($name) ? ' is-invalid' : '')]) }}
    >

    @error($name)
        <div class="text-danger mt-1">{{ $message }}</div>
    @enderror
</div>

