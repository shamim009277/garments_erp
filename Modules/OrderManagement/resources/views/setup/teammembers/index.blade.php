@extends('layouts.app')
@section('title', 'Order Management')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'Order Management',
                'subtitle' => 'Team Members',
                'breadcrumbs' => [
                    ['label' => 'Order Management', 'url' => route('ordermanagement.index')],
                    ['label' => 'Setup', 'url' => route('ordermanagement.index')],
                    ['label' => 'Team Members', 'url' => route('ordermanagement.setup.teammembers.index')],
                ],
            ])
        </div>
        <div class="col-md-8">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Team Members List</h6>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap w-100" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Team Name</th>
                                <th>Leader</th>
                                <th>Assistant</th>
                                <th>Members</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($teams as $key => $team)
                                @php
                                    $leader = $team->members->where('is_leader', 1)->first();
                                    $assistant = $team->members->where('is_assistant', 1)->first();
                                    // Use ALL members for the list/count, but you might want to differentiate them in the tooltip
                                    $members = $team->members; 
                                @endphp
                                <tr id="row-{{ $team->id }}">
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $team->team_name }}</td>
                                    <td>{{ $leader && $leader->merchant ? $leader->merchant->name : 'N/A' }}</td>
                                    <td>{{ $assistant && $assistant->merchant ? $assistant->merchant->name : 'N/A' }}</td>
                                    <td>
                                        @if($members->count() > 0)
                                            <span class="badge bg-info" data-bs-toggle="tooltip" title="{{ $members->map(function($m) { 
                                                $name = $m->merchant ? $m->merchant->name : '';
                                                if($m->is_leader) $name .= ' (Leader)';
                                                if($m->is_assistant) $name .= ' (Assistant)';
                                                return $name;
                                            })->join(', ') }}">
                                                {{ $members->count() }} Members
                                            </span>
                                        @else
                                            <span class="badge bg-secondary">0 Members</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="square-switch">
                                            <input type="checkbox" id="switch-{{ $team->id }}"
                                                class="toggle-status" data-id="{{ $team->id }}"
                                                switch="bool" {{ $team->is_active ? 'checked' : '' }} />
                                            <label for="switch-{{ $team->id }}" data-on-label="Yes"
                                                data-off-label="No"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-soft-success waves-effect waves-light"
                                            style="padding: 4px 6px;" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $team->id }}"><i class="fas fa-edit"></i></a>
                                        
                                        <a href="#" class="btn btn-soft-danger waves-effect waves-light delete-item"
                                           data-id="{{ $team->id }}" style="padding: 4px 6px;"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>

                                {{-- Edit Modal --}}
                                <div class="modal fade" id="editModal{{ $team->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Team Assignments</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('ordermanagement.setup.teammembers.update', $team->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    
                                                    <div class="mb-3">
                                                        <label class="form-label">Team</label>
                                                        <input type="text" class="form-control" value="{{ $team->team_name }}" disabled>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Leader</label>
                                                        <select name="leader_id" class="form-control select2" style="width: 100%;">
                                                            <option value="">Select Leader</option>
                                                            @foreach($merchants as $merchant)
                                                                <option value="{{ $merchant->id }}" {{ ($leader && $leader->merchant_id == $merchant->id) ? 'selected' : '' }}>
                                                                    {{ $merchant->name }} ({{ $merchant->employee_id }})
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Assistant</label>
                                                        <select name="assistant_id" class="form-control select2" style="width: 100%;">
                                                            <option value="">Select Assistant</option>
                                                            @foreach($merchants as $merchant)
                                                                <option value="{{ $merchant->id }}" {{ ($assistant && $assistant->merchant_id == $merchant->id) ? 'selected' : '' }}>
                                                                    {{ $merchant->name }} ({{ $merchant->employee_id }})
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    
                                                    <div class="mb-3">
                                                        <label class="form-label">Members</label>
                                                        <select name="member_ids[]" class="form-control select2" multiple="multiple" style="width: 100%;">
                                                            @foreach($merchants as $merchant)
                                                                <option value="{{ $merchant->id }}" 
                                                                    {{ $members->contains('merchant_id', $merchant->id) ? 'selected' : '' }}>
                                                                    {{ $merchant->name }} ({{ $merchant->employee_id }})
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <button type="submit" class="btn btn-primary btn-sm float-start">Save Changes</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card alert-info alert-top-border">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i class="mdi mdi-account-multiple-plus"></i> Assign Members to Team</h6>
                </div>
                <div class="card-body">
                    <form id="createForm" action="{{ route('ordermanagement.setup.teammembers.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label">Select Team <span class="text-danger">*</span></label>
                            <select name="team_id" class="form-control select2" required>
                                <option value="">Select Team</option>
                                @foreach($teams as $t)
                                    <option value="{{ $t->id }}" {{ old('team_id') == $t->id ? 'selected' : '' }}>
                                        {{ $t->team_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Leader</label>
                            <select name="leader_id" class="form-control select2">
                                <option value="">Select Leader</option>
                                @foreach($merchants as $merchant)
                                    <option value="{{ $merchant->id }}" {{ old('leader_id') == $merchant->id ? 'selected' : '' }}>
                                        {{ $merchant->name }} ({{ $merchant->employee_id }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Assistant</label>
                            <select name="assistant_id" class="form-control select2">
                                <option value="">Select Assistant</option>
                                @foreach($merchants as $merchant)
                                    <option value="{{ $merchant->id }}" {{ old('assistant_id') == $merchant->id ? 'selected' : '' }}>
                                        {{ $merchant->name }} ({{ $merchant->employee_id }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Members</label>
                            <select name="member_ids[]" class="form-control select2" multiple="multiple">
                                @foreach($merchants as $merchant)
                                    <option value="{{ $merchant->id }}" {{ (collect(old('member_ids'))->contains($merchant->id)) ? 'selected' : '' }}>
                                        {{ $merchant->name }} ({{ $merchant->employee_id }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary btn-sm float-start">Assign Members</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Init for Create form
            $('#createForm .select2').select2({
                placeholder: "Select...",
                allowClear: true,
                width: '100%'
            });

            // Init for Edit modals
            $('.modal').on('shown.bs.modal', function () {
                $(this).find('.select2').select2({
                    dropdownParent: $(this),
                    allowClear: true,
                    width: '100%'
                });
            });

            // Toggle Status
            $('.toggle-status').on('change', function() {
                let id = $(this).data('id');
                let status = $(this).is(':checked') ? 1 : 0;

                $.ajax({
                    url: '{{ route('ordermanagement.setup.teammembers.toggle') }}',
                    type: 'POST',
                    data: {
                        id: id,
                        status: status,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.message);
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        toastr.error('Something went wrong!');
                    }
                });
            });

            // Delete (Clear Assignments)
            $(document).on('click', '.delete-item', function(e) {
                e.preventDefault();
                let id = $(this).data('id');
                Swal.fire({
                    title: 'Clear Assignments?',
                    text: "This will remove all members from this team. The team itself will remain.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, clear it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ route('ordermanagement.setup.teammembers.delete') }}',
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                id: id
                            },
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire(
                                        'Cleared!',
                                        response.message,
                                        'success'
                                    ).then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire(
                                        'Error!',
                                        response.message,
                                        'error'
                                    );
                                }
                            },
                            error: function() {
                                Swal.fire(
                                    'Error!',
                                    'Something went wrong.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });
        });
    </script>
@endpush
