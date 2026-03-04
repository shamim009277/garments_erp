@extends('layouts.app')
@section('title', 'Sample Management')
@section('styles')
<style>
    .table, tr, th, td { border: none !important; border-collapse: collapse; }
</style>
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        @include('components.breadcrumb', [
        'title' => 'Sample Management',
        'subtitle' => 'Sample Management',
        'breadcrumbs' => [
        ['label' => 'Sample Management', 'url' => route('sms.index')],
        ['label' => 'Database', 'url' => route('sms.index')],
        ['label' => 'Sample Management', 'url' => route('sms.database.sampleorderprogramme.index')],
        ],
        ])
    </div>
    <div class="col-md-3">
        <div class="card alert-primary alert-top-border padding-card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <i data-feather="list" width="16" height="16"></i>
                    <h6 class="my-0 text-primary ms-2">Initial Orders List</h6>
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
            @php
            $org = collect($orders)->pluck('organization');
            $orgList = collect($org)->unique();
            @endphp
            <div class="card-body">
                @foreach ($orgList as $key => $org)
                <ul class="nav-custom">
                    <li class="nav-custom-item">
                        <input type="checkbox" id="dept{{ $org->id }}">
                        <label class="nav-custom-link" for="dept{{ $org->id }}">
                            <span class="nav-custom-caret"> </span>
                            {{ $org->name }}
                        </label>
                        @php
                        $ordList = collect($orders)->where('organization_id', $org->id);
                        @endphp
                        <ul class="nav-custom-content">
                            @foreach ($ordList as $key => $order)
                            <li class="nav-custom-item"><a href="{{ route('sms.database.sampleorderprogramme.show', $order->id) }}" class="nav-custom-link">{{ $order->order_code }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card alert-info alert-top-border">
            <div class="card-body">
                <p class="text-center text-muted">Select an order from the list to view/add Sample Order Programme.</p>
            </div>
        </div>
    </div>
</div>
@endsection
