
@props([
    'name',
    'id'=>null,
    'value' => '',
    'required' => false,
    'disabled' => false,
    'type' => 'text',
])

<input type="{{ $type }}" name="{{ $name }}" id="{{ $id }}" value="{{ old($name, $value) }}"
    {{ $attributes->merge(['class' => 'form-control' . ($errors->has($name) ? ' is-invalid' : '')]) }}
    @if($required) required @endif
    @if($disabled) disabled @endif
>
