@extends('layouts.app')
@section('title', 'Dashboard')
@push('styles')
    <style>
        .image-wrapper {
            overflow: hidden;
            width: 100%;
            height: 200px;
            border-radius: 8px;
        }

        .image-wrapper img {
            width: 100%;
            height: 100%;
            transition: transform 0.3s ease;
        }

        .image-wrapper:hover img {
            transform: scale(1.1);
        }
    </style>
@endpush
@section('content')
    <div class="row" style="padding: 0px !important;margin-top: -15px;">
        @foreach ($modules as $module)
            @php
                $imagePath = 'backend/assets/images/modules/' . $module->image;
            @endphp
            @include('components.module', [
                'url' => $module->slug,
                'image' => $imagePath,
                'title' => $module->name,
            ])
        @endforeach
    </div>
@endsection

