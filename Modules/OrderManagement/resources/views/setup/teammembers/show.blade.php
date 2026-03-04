@extends('layouts.app')
@section('title', 'Order Management')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'Order Management',
                'subtitle' => 'Team Member Details',
                'breadcrumbs' => [
                    ['label' => 'Order Management', 'url' => route('ordermanagement.index')],
                    ['label' => 'Setup', 'url' => route('ordermanagement.index')],
                    ['label' => 'Team Members', 'url' => route('ordermanagement.setup.teammembers.index')],
                    ['label' => 'Details', 'url' => '#'],
                ],
            ])
        </div>
        <div class="col-12">
            <div class="card alert-success alert-top-border">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i class="mdi mdi-eye"></i> Team Member Details
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="text-primary">Basic Information</h6>
                            <table class="table table-sm">
                                <tr>
                                    <td width="30%"><strong>Team:</strong></td>
                                    <td>{{ $teamMember->team->team_name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Merchant:</strong></td>
                                    <td>{{ $teamMember->merchant->name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Is Leader:</strong></td>
                                    <td>
                                        <span class="badge bg-{{ $teamMember->is_leader ? 'success' : 'secondary' }}">
                                            {{ $teamMember->is_leader ? 'Yes' : 'No' }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Is Assistant:</strong></td>
                                    <td>
                                        <span class="badge bg-{{ $teamMember->is_assistant ? 'info' : 'secondary' }}">
                                            {{ $teamMember->is_assistant ? 'Yes' : 'No' }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Status:</strong></td>
                                    <td>
                                        <span class="badge bg-{{ $teamMember->is_active ? 'success' : 'danger' }}">
                                            {{ $teamMember->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-primary">System Information</h6>
                            <table class="table table-sm">
                                <tr>
                                    <td width="30%"><strong>Created At:</strong></td>
                                    <td>{{ $teamMember->created_at->format('d M Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Updated At:</strong></td>
                                    <td>{{ $teamMember->updated_at->format('d M Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <a href="{{ route('ordermanagement.setup.teammembers.edit', $teamMember->id) }}" 
                               class="btn btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="{{ route('ordermanagement.setup.teammembers.index') }}" 
                               class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Back to List
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
