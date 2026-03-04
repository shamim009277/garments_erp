@extends('layouts.app')
@section('title', 'ORDER MANAGEMENT')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'ORDER MANAGEMENT',
                'subtitle' => 'Dashboard',
                'breadcrumbs' => [
                    ['label' => 'ORDER MANAGEMENT', 'url' => route('ordermanagements.index')],
                    ['label' => 'Dashboard', 'url' => route('ordermanagements.index')],
                ],
            ])
        </div>
        <div class="col-md-8">
            
        </div>

      
    </div>
@endsection


