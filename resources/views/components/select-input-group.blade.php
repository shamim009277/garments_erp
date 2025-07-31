@props([
    'name',
    'id'=>null,
    'group_id'=>null,
    'label' => null,
    'options' => [],
    'selected' => '',
    'required' => false,
    'disabled' => false,
    'placeholder' => 'Select an option',
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

    <select
        name="{{ $name }}"
        id="{{ $id }}"
        @if($required) required @endif
        @if($disabled) disabled @endif
        {{ $attributes->merge(['class' => 'form-select' . ($errors->has($name) ? ' is-invalid' : '')]) }}
    >
        <option value="">{{ $placeholder }}</option>
        @foreach ($options as $value => $optionLabel)
            <option value="{{ $value }}" {{ (string) old($name, $selected) === (string) $value ? 'selected' : '' }}>
                {{ $optionLabel }}
            </option>
        @endforeach
    </select>

    @error($name)
        <div class="text-danger mt-1">{{ $message }}</div>
    @enderror
</div>
