@props([
    'name',
    'id'=>null,
    'options' => [],
    'selected' => '',
    'required' => false,
    'placeholder' => 'Select an option',
])

<select
    name="{{ $name }}"
    id="{{ $id }}"
    @if($required) required @endif
    {{ $attributes->merge(['class' => 'form-select' . ($errors->has($name) ? ' is-invalid' : '')]) }}
>
    <option value="">{{ $placeholder }}</option>
    @foreach ($options as $value => $label)
        <option value="{{ $value }}" {{ (old($name, $selected) == $value) ? 'selected' : '' }}>
            {{ $label }}
        </option>
    @endforeach
</select>
