
<button id="{{ $id ?? 'submitBtn' }}"
    {{ $attributes->merge(['type' => 'submit','class' => 'btn btn-primary btn-md float-end']) }}>
    <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
    <span class="btn-text">{{ $slot ?? 'Submit' }}</span>
</button>
