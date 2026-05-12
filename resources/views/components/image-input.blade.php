{{-- @props([
    'name',
    'id'=>null,
    'accept' => 'image/*',
    'preview' => false,
    'value' => null,
    'previewWidth' => 100,
    'previewHeight' => null,
])

<div class="mb-3">
    <input type="file" class="form-control" id="{{ $id }}" name="{{ $name }}"
        accept="{{ $accept }}"
        @if ($preview) onchange="previewImage_{{ $name }}(event)" @endif>

    @if ($preview)
        <img id="preview-{{ $name }}" src="{{ $value ? asset('storage/' . $value) : '#' }}" alt="Image Preview"
            style="display: {{ $value ? 'block' : 'none' }}; max-width: {{ $previewWidth }}px;
            @if ($previewHeight) max-height: {{ $previewHeight }}px; @endif" class="img-thumbnail mt-2">

        <script>
            function previewImage_{{ $name }}(event) {
                const input = event.target;
                const preview = document.getElementById('preview-{{ $name }}');

                if (input.files && input.files[0]) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        preview.style.display = 'block';
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>
    @endif
</div> --}}

@props([
    'name',
    'id' => null,
    'accept' => 'image/*',
    'preview' => false,
    'value' => null,
    'previewWidth' => 100,
    'previewHeight' => null,
])

@php
    $inputId = $id ?? $name;
@endphp

<div class="mb-3">
    <input
        type="file"
        class="form-control"
        id="{{ $inputId }}"
        name="{{ $name }}"
        accept="{{ $accept }}"
        @if ($preview) onchange="previewImage_{{ $inputId }}(event)" @endif
    >

    @if ($preview)
        <img
            id="preview-{{ $inputId }}"
            src="{{ $value ? asset('storage/' . $value) : '#' }}"
            alt="Image Preview"
            style="
                display: {{ $value ? 'block' : 'none' }};
                max-width: {{ $previewWidth }}px;
                @if ($previewHeight) max-height: {{ $previewHeight }}px; @endif
            "
            class="img-thumbnail mt-2"
        >

        <script>
            function previewImage_{{ $inputId }}(event) {
                const input = event.target;
                const preview = document.getElementById('preview-{{ $inputId }}');

                if (input.files && input.files[0]) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        preview.style.display = 'block';
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>
    @endif
</div>

{{-- <x-form.image-input
    name="logo"
    label="Logo"
    preview
    :value="$settings->logo"
    :previewWidth="200"
    :previewHeight="120"
/> --}}
