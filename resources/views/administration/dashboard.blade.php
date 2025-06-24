
@extends('layouts.app')
@section('title', 'Administration')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'Administration',
                'subtitle' => 'Dashboard',
                'breadcrumbs' => [
                    ['label' => 'Administration', 'url' => route('administration.index')],
                    ['label' => 'Dashboard'],
                ]
            ])
        </div>
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-header bg-primary">
                    <h5 class="my-0 text-white">Modules</h5>
                </div>
                <div class="card-body">
                    <p class="card-title-desc">Active: {{ $modules->count() }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-white">
                <div class="card-header bg-warning">
                    <h5 class="my-0 text-white">Active Modules</h5>
                </div>
                <div class="card-body">
                    <p class="card-title-desc">Module: {{ $currentModule }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-header bg-success">
                    <h5 class="my-0 text-white">Administration Dashboard</h5>
                </div>
                <div class="card-body">
                    <p class="card-title-desc">Module: {{ $currentModule }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white">
                <div class="card-header bg-info">
                    <h5 class="my-0 text-white">Administration Dashboard</h5>
                </div>
                <div class="card-body">
                    <p class="card-title-desc">Module: {{ $currentModule }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
