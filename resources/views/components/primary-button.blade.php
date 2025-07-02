
<button id="{{ $id ?? 'submitBtn' }}"
    {{ $attributes->merge(['type' => 'submit','class' => 'btn btn-primary btn-md float-end']) }}>
    <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
    <i data-feather="plus" style="width: 16px; height: 16px;"></i>
    <span class="btn-text">{{ $slot ?? 'Submit' }}</span>
</button>
