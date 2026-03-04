@extends('layouts.app')
@section('title', 'Order Management')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'Order Management',
                'subtitle' => 'Create Team Member',
                'breadcrumbs' => [
                    ['label' => 'Order Management', 'url' => route('ordermanagement.index')],
                    ['label' => 'Setup', 'url' => route('ordermanagement.index')],
                    ['label' => 'Team Members', 'url' => route('ordermanagement.setup.teammembers.index')],
                    ['label' => 'Create', 'url' => route('ordermanagement.setup.teammembers.create')],
                ],
            ])
        </div>
        <div class="col-12">
            <div class="card alert-info alert-top-border">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i class="mdi mdi-plus"></i> Create New Team Member
                    </h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('ordermanagement.setup.teammembers.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <x-select-input-group name="team_id" label="Team *" 
                                    :options="$teams->pluck('team_name', 'id')" 
                                    :selected="old('team_id')" required />
                            </div>
                            <div class="col-md-6">
                                <x-select-input-group name="merchant_id" label="Merchant *" 
                                    :options="$merchants->pluck('name', 'id')" 
                                    :selected="old('merchant_id')" required />
                            </div>
                            <div class="col-md-6">
                                <x-select-input-group name="is_leader" label="Is Leader?" 
                                    :options="['1' => 'Yes', '0' => 'No']" 
                                    :selected="old('is_leader', '0')" required />
                            </div>
                            <div class="col-md-6">
                                <x-select-input-group name="is_assistant" label="Is Assistant?" 
                                    :options="['1' => 'Yes', '0' => 'No']" 
                                    :selected="old('is_assistant', '0')" required />
                            </div>
                            <div class="col-md-12">
                                <x-select-input-group name="is_active" label="Is Active?" 
                                    :options="['1' => 'Active', '0' => 'Inactive']" 
                                    :selected="old('is_active', '1')" required />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <x-primary-button class="float-start">Save Team Member</x-primary-button>
                                <a href="{{ route('ordermanagement.setup.teammembers.index') }}" 
                                   class="btn btn-secondary float-start ms-2">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
