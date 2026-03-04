@extends('layouts.app')
@section('title', 'SEWING MANAGEMENT')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'SEWING MANAGEMENT',
                'subtitle' => 'Sewing Group Assignments',
                'breadcrumbs' => [
                    ['label' => 'SEWING MANAGEMENT', 'url' => route('sms.index')],
                    ['label' => 'Setup', 'url' => route('sms.index')],
                    ['label' => 'Sewing Groups', 'url' => route('sms.setup.sewing_groups.index')],
                ],
            ])
        </div>
        <div class="col-md-8">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Sewing Groups List</h6>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap w-100" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Group Code</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Employees</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sewingGroups as $key => $group)
                                <tr id="row-{{ $group->id }}">
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $group->group_code }}</td>
                                    <td>{{ $group->name }}</td>
                                    <td>{{ $group->description }}</td>
                                    <td>
                                        @if($group->sewingGroupEmployees->count() > 0)
                                        <ul>
                                            @foreach($group->sewingGroupEmployees as $sge)
                                                <li>{{ $sge->employee ? $sge->employee->name : $sge->employee_id }}</li>
                                            @endforeach
                                        </ul>
                                            <!-- <span class="badge bg-info">{{ $group->sewingGroupEmployees->count() }} Employees</span> -->
                                            <!-- <i class="fas fa-info-circle text-info" data-bs-toggle="tooltip" title="{{ $group->sewingGroupEmployees->map(function($sge) { return $sge->employee ? $sge->employee->name : $sge->employee_id; })->join(', ') }}"></i> -->
                                        @else
                                            <span class="badge bg-secondary">0 Employees</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="square-switch">
                                            <input type="checkbox" id="square-switch3{{ $group->id }}"
                                                class="group-toggle" data-id="{{ $group->id }}"
                                                switch="bool" {{ $group->is_active ? 'checked' : '' }} />
                                            <label for="square-switch3{{ $group->id }}" data-on-label="Yes"
                                                data-off-label="No" style="margin: 0px; vertical-align: middle;"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-soft-success waves-effect waves-light "
                                            style="padding: 4px 6px;" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $group->id }}"><i
                                                class="fas fa-edit"></i></a>
                                        
                                        <a href="#"
                                            class="btn btn-soft-danger waves-effect waves-light delete-group"
                                            data-id="{{ $group->id }}" style="padding: 4px 6px;" title="Clear Assignments"><i
                                                class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                                {{-- load edit modal --}}
                                <div class="modal fade" id="editModal{{ $group->id }}" tabindex="-1"
                                    aria-labelledby="editModalLabel{{ $group->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel{{ $group->id }}">Edit Assignments: {{ $group->name }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="editForm{{ $group->id }}"
                                                    action="{{ route('sms.setup.sewing_groups.update', $group->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    
                                                    <!-- Hidden Group ID -->
                                                    <input type="hidden" name="group_id" value="{{ $group->id }}">

                                                    <div class="mb-3">
                                                        <label class="form-label">Group</label>
                                                        <input type="text" class="form-control" value="{{ $group->name }} ({{ $group->group_code }})" disabled>
                                                    </div>
                                                    
                                                    <div class="mb-3">
                                                        <label class="form-label">Employees</label>
                                                        <select name="employee_ids[]" class="form-control select2" multiple="multiple" style="width: 100%;">
                                                            @foreach($employees as $employee)
                                                                <option value="{{ $employee->employee_id }}" 
                                                                    {{ $group->sewingGroupEmployees->contains('employee_id', $employee->employee_id) ? 'selected' : '' }}>
                                                                    {{ $employee->name }} ({{ $employee->employee_id }})
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <x-select-input-group name="is_active" label="Group Status"
                                                        :options="['1' => 'Active', '0' => 'Inactive']" :selected="$group->is_active ? '1' : '0'" required />
                                                    <x-primary-button
                                                        class="float-start btn-sm submitBtn">Save Changes</x-primary-button>
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
                    <h6 class="my-0 text-primary"> <i class="mdi mdi-account-multiple-plus"></i> Assign Employees to Group</h6>
                </div>
                <div class="card-body">
                    <form id="createForm" action="{{ route('sms.setup.sewing_groups.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label">Select Group <span class="text-danger">*</span></label>
                            <select name="group_id" class="form-control select2" required>
                                <option value="">Select Group</option>
                                @foreach($groups as $g)
                                    <option value="{{ $g->id }}" {{ old('group_id') == $g->id ? 'selected' : '' }}>
                                        {{ $g->name }} ({{ $g->group_code }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Employees</label>
                            <select name="employee_ids[]" class="form-control select2" multiple="multiple" style="width: 100%;">
                                @foreach($employees as $employee)
                                    <option value="{{ $employee->employee_id }}" {{ (collect(old('employee_ids'))->contains($employee->employee_id)) ? 'selected' : '' }}>
                                        {{ $employee->name }} ({{ $employee->employee_id }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <x-select-input-group name="is_active" label="Group Status" :options="['1' => 'Active', '0' => 'Inactive']" :selected="old('is_active', '1')"
                            required />
                        <x-primary-button class="float-start btn-sm submitBtn">Assign Employees</x-primary-button>
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
                allowClear: true
            });

            // Init for Edit modals
            $('.modal').on('shown.bs.modal', function () {
                $(this).find('.select2').select2({
                    dropdownParent: $(this),
                    placeholder: "Select Employees",
                    allowClear: true
                });
            });

            $('.group-toggle').on('change', function() {
                let id = $(this).data('id');
                let status = $(this).is(':checked') ? 1 : 0;

                $.ajax({
                    url: '{{ route('sms.setup.sewing_groups.toggle') }}',
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
        });

        $(document).on('click', '.delete-group', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            Swal.fire({
                title: 'Clear Assignments?',
                text: "This will remove all employees from this group. The group itself will remain.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, clear it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('sms.setup.sewing_groups.destroy', ':id') }}'.replace(':id', id),
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}',
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire(
                                    'Cleared!',
                                    response.message,
                                    'success'
                                );
                                // Reload page to reflect changes
                                location.reload();
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
    </script>
@endpush
