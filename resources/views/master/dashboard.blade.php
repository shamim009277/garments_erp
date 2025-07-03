
@extends('layouts.app')
@section('title', 'Master')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'Master',
                'subtitle' => 'Dashboard',
                'breadcrumbs' => [
                    ['label' => 'Master', 'url' => route('master.index')],
                    ['label' => 'Dashboard'],
                ]
            ])
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="my-0">Master Dashboard</h5>
                </div>
                <div class="card-body">
                    <p class="card-title-desc">Welcome to Master Dashboard</p>
                </div>
            </div>
        </div>
    </div>
@endsection
