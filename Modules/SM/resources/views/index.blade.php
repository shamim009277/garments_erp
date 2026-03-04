@extends('layouts.app')
@section('title', 'Sample Management')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'SAMPLE MANAGEMENT',
                'subtitle' => 'Dashboard',
                'breadcrumbs' => [
                    ['label' => 'SAMPLE MANAGEMENT', 'url' => route('sms.index')],  
                    ['label' => 'Dashboard', 'url' => route('sms.index')],
                ],
            ])
        </div>
        <div class="col-md-8">
            
        </div>

      
    </div>
@endsection
