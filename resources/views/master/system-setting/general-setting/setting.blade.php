@extends('layouts.app')
@section('title', 'General Setting')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'System Setting',
                'subtitle' => 'General Setting',
                'breadcrumbs' => [
                    ['label' => 'Master', 'url' => route('master.index')],
                    ['label' => 'General Setting'],
                ],
            ])
        </div>
        <div class="col-md-6 mx-auto">
            <div class="card alert-info alert-top-border">
                <div class="card-header">
                    <h6 class="my-0 text-primary text-center"> <i class="mdi mdi-list"></i> General Setting</h6>
                </div>
                <div class="card-body">
                    <form id="generalSettingForm" action="{{ route('master.system-settings.general-settings.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <x-input-label for="full_name" text="Application Name" required />
                            <x-text-input id="full_name" name="full_name" type="text" :value="old('full_name', $generalSettings->full_name ?? '')" required />
                            <x-input-error :messages="$errors->get('full_name')" />
                            <input type="hidden" class="form-control" id="id" value="{{ $generalSettings->id }}"
                                name="id">
                        </div>
                        <div class="mb-3">
                            <x-input-label for="short_name" text="Application Short Name" required />
                            <x-text-input id="short_name" name="short_name" type="text" :value="old('short_name', $generalSettings->short_name ?? '')" required />
                            <x-input-error :messages="$errors->get('short_name')" />
                        </div>
                        <div class="mb-3">
                            <x-input-label for="footer_text" text="Footer Text" required />
                            <x-text-input id="footer_text" name="footer_text" type="text" :value="old('footer_text', $generalSettings->footer_text ?? '')" required />
                            <x-input-error :messages="$errors->get('footer_text')" />
                        </div>
                        <div class="mb-3">
                            <x-input-label for="logo" text="Logo" />
                            <x-image-input name="logo" label="Logo" :value="$generalSettings->logo_path" preview />
                            <x-input-error :messages="$errors->get('logo')" />
                        </div>
                        <div class="mb-3">
                            <x-input-label for="favicon" text="Favicon" />
                            <x-image-input name="favicon" label="Favicon" :value="$generalSettings->favicon_path" preview />
                            <x-input-error :messages="$errors->get('favicon')" />
                        </div>
                        <x-primary-button class="float-start btn-sm submitBtn">Update</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('preview');

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
@endpush
