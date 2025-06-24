
@extends('layouts.app')
@section('title', 'Inventory')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'Inventory',
                'subtitle' => 'Dashboard',
                'breadcrumbs' => [
                    ['label' => 'Inventory', 'url' => route('inventory.index')],
                    ['label' => 'Dashboard'],
                ]
            ])
        </div>
        <div class="col-12">
            <div class="card border-top border-0 border-2 border-primary">
                <div class="card-header">
                    <h5 class="my-0 text-primary">Inventory Dashboard</h5>
                </div>
                <div class="card-body">
                    <p class="card-title-desc">Module: {{ $currentModule }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection

