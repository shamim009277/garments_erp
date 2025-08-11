@props([
    'name',
    'id' => null,
    'options' => [],
    'selected' => [],
    'required' => false,
    'placeholder' => 'Select an option',
    'multiple' => false,
])

@php
    $selectName = $multiple
        ? (str_ends_with($name, '[]') ? $name : $name . '[]')
        : $name;

    $selectedValues = is_array($selected) ? $selected : [$selected];
@endphp

<select
    name="{{ $selectName }}"
    id="{{ $id }}"
    @if($multiple) multiple @endif
    @if($required) required @endif
    {{ $attributes->merge(['class' => 'form-select' . ($errors->has($name) ? ' is-invalid' : '')]) }}
>
    @if(!$multiple)
        <option value="">{{ $placeholder }}</option>
    @endif

    @foreach ($options as $value => $label)
        <option value="{{ $value }}" {{ in_array((string)$value, $selectedValues) ? 'selected' : '' }}>
            {{ $label }}
        </option>
    @endforeach
</select>
