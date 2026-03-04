@extends('layouts.app')
@section('title', 'SAMPLE MANAGEMENT')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'SAMPLE MANAGEMENT',
                'subtitle' => 'Sewing Line Configuration',
                'breadcrumbs' => [
                    ['label' => 'SAMPLE MANAGEMENT', 'url' => route('sms.index')],
                    ['label' => 'Setup', 'url' => route('sms.index')],
                    ['label' => 'Sewing Lines', 'url' => route('sms.setup.sewing_lines.index')],
                ],
            ])
        </div>
        <div class="col-md-8">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Sewing Lines List</h6>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap w-100" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Line Name</th>
                                <th>Line Code</th>
                                <th>Incharge</th>
                                <th>Groups</th>
                                <th>Total Machine</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sewingLines as $key => $sl)
                                <tr id="row-{{ $sl->id }}">
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $sl->line ? $sl->line->name : 'N/A' }}</td>
                                    <td>{{ $sl->line ? $sl->line->line_code : 'N/A' }}</td>
                                    <td>{{ $sl->incharge ? $sl->incharge->name : $sl->line_incharge_id }}</td>
                                    <td>
                                        @if($sl->groups->count() > 0)
                                            <span class="badge bg-info" data-bs-toggle="tooltip" title="{{ $sl->groups->pluck('name')->join(', ') }}">
                                                {{ $sl->groups->count() }} Groups
                                            </span>
                                        @else
                                            <span class="badge bg-secondary">0 Groups</span>
                                        @endif
                                    </td>
                                    <td>{{ $sl->total_machine }}</td>
                                    <td>
                                        <div class="square-switch">
                                            <input type="checkbox" id="square-switch3{{ $sl->id }}"
                                                class="line-toggle" data-id="{{ $sl->id }}"
                                                switch="bool" {{ $sl->is_active ? 'checked' : '' }} />
                                            <label for="square-switch3{{ $sl->id }}" data-on-label="Yes"
                                                data-off-label="No" style="margin: 0px; vertical-align: middle;"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-soft-success waves-effect waves-light "
                                            style="padding: 4px 6px;" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $sl->id }}"><i
                                                class="fas fa-edit"></i></a>
                                        
                                        <a href="#"
                                            class="btn btn-soft-danger waves-effect waves-light delete-line"
                                            data-id="{{ $sl->id }}" style="padding: 4px 6px;" title="Delete Configuration"><i
                                                class="fas fa-trash"></i></a>
                                        <form id="delete-form-{{ $sl->id }}" action="{{ route('sms.setup.sewing_lines.destroy', $sl->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                                {{-- load edit modal --}}
                                <div class="modal fade" id="editModal{{ $sl->id }}" tabindex="-1"
                                    aria-labelledby="editModalLabel{{ $sl->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel{{ $sl->id }}">Edit Configuration: {{ $sl->line ? $sl->line->name : '' }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="editForm{{ $sl->id }}"
                                                    action="{{ route('sms.setup.sewing_lines.update', $sl->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    
                                                    <div class="mb-3">
                                                        <label class="form-label">Line</label>
                                                        <select name="line_id" class="form-control select2" required>
                                                            @foreach($lines as $l)
                                                                <option value="{{ $l->id }}" {{ $sl->line_id == $l->id ? 'selected' : '' }}>
                                                                    {{ $l->name }} ({{ $l->line_code }})
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Line Incharge <span class="text-danger">*</span></label>
                                                        <select name="line_incharge_id" class="form-control select2" required style="width: 100%;">
                                                            @foreach($employees as $emp)
                                                                <option value="{{ $emp->employee_id }}" {{ $sl->line_incharge_id == $emp->employee_id ? 'selected' : '' }}>
                                                                    {{ $emp->name }} ({{ $emp->employee_id }})
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    
                                                    <div class="mb-3">
                                                        <label class="form-label">Groups</label>
                                                        <select name="group_ids[]" class="form-control select2" multiple="multiple" style="width: 100%;">
                                                            @foreach($groups as $g)
                                                                <option value="{{ $g->id }}" 
                                                                    {{ $sl->groups->contains('id', $g->id) ? 'selected' : '' }}>
                                                                    {{ $g->name }} ({{ $g->group_code }})
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <x-input-group name="total_machine" label="No. Of Machine" type="number"
                                                        placeholder="Enter Total Machine" :value="$sl->total_machine" required />

                                                    <x-select-input-group name="is_active" label="Status"
                                                        :options="['1' => 'Active', '0' => 'Inactive']" :selected="$sl->is_active ? '1' : '0'" required />
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
                    <h6 class="my-0 text-primary"> <i class="mdi mdi-plus-circle-outline"></i> Configure Sewing Line</h6>
                </div>
                <div class="card-body">
                    <form id="createForm" action="{{ route('sms.setup.sewing_lines.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label">Select Line <span class="text-danger">*</span></label>
                            <select name="line_id" class="form-control select2" required>
                                <option value="">Select Line</option>
                                @foreach($lines as $l)
                                    <option value="{{ $l->id }}" {{ old('line_id') == $l->id ? 'selected' : '' }}>
                                        {{ $l->name }} ({{ $l->line_code }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Line Incharge <span class="text-danger">*</span></label>
                            <select name="line_incharge_id" class="form-control select2" required style="width: 100%;">
                                <option value="">Select Incharge</option>
                                @foreach($employees as $emp)
                                    <option value="{{ $emp->employee_id }}" {{ old('line_incharge_id') == $emp->employee_id ? 'selected' : '' }}>
                                        {{ $emp->name }} ({{ $emp->employee_id }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Select Groups</label>
                            <select name="group_ids[]" class="form-control select2" multiple="multiple" style="width: 100%;">
                                @foreach($groups as $g)
                                    <option value="{{ $g->id }}" {{ (collect(old('group_ids'))->contains($g->id)) ? 'selected' : '' }}>
                                        {{ $g->name }} ({{ $g->group_code }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <x-input-group name="total_machine" label="No. Of Machine" type="number"
                            placeholder="Enter Total Machine" :value="old('total_machine')" required />

                        <x-select-input-group name="is_active" label="Status" :options="['1' => 'Active', '0' => 'Inactive']" :selected="old('is_active', '1')"
                            required />
                        <x-primary-button class="float-start btn-sm submitBtn">Save Configuration</x-primary-button>
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
                    placeholder: "Select...",
                    allowClear: true
                });
            });

            $('.line-toggle').on('change', function() {
                let id = $(this).data('id');
                let status = $(this).is(':checked') ? 1 : 0;

                $.ajax({
                    url: '{{ route('sms.setup.sewing_lines.toggle') }}',
                    type: 'POST',
                    data: {
                        id: id,
                        status: status,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            toastr.success(response.message);
                        } else {
                            toastr.error('Something went wrong. Please try again.');
                        }
                    },
                    error: function(xhr, status, error) {
                        toastr.error(xhr.responseText);
                    }
                });
            });

            $('.delete-line').on('click', function(e) {
                e.preventDefault();
                let id = $(this).data('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#delete-form-' + id).submit();
                    }
                })
            });
        });
    </script>
@endpush
