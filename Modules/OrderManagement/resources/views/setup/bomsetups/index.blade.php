@extends('layouts.app')
@section('title', 'ORDER MANAGEMENT')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'ORDER MANAGEMENT',
                'subtitle' => 'BOM Setup',
                'breadcrumbs' => [
                    ['label' => 'ORDER MANAGEMENT', 'url' => route('ordermanagement.index')],
                    ['label' => 'Setup', 'url' => route('ordermanagement.index')],
                    ['label' => 'BOM Setup', 'url' => route('ordermanagement.setup.bomsetups.index')],
                ],
            ])
        </div>

        <div class="col-md-3">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <i data-feather="list" width="16" height="16"></i>
                        <h6 class="my-0 text-primary ms-2">Buyers List</h6>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="input-group">
                                <input type="text" name="search" id="search" class="form-control form-control-sm" placeholder="Search here...">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @foreach ($buyers as $key => $buyer)
                    <ul class="nav-custom">
                        <li class="nav-custom-item">
                            <input type="checkbox" id="dept{{ $buyer->id }}">
                                <a href="{{ route('ordermanagement.setup.bomsetups.show', $buyer->id) }}" class="nav-custom-link">{{ $buyer->buyer_name }}</a>
                        </li>
                    </ul>
                    @endforeach
                </div>
            </div>
        </div>
        
    </div>
@endsection
