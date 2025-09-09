@extends('layouts.app')
@section('title', 'HRIS')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'HRIS',
                'subtitle' => 'Unit',
                'breadcrumbs' => [
                    ['label' => 'HRIS', 'url' => route('hris.index')],
                    ['label' => 'Setup', 'url' => route('hris.index')],
                    ['label' => 'Unit', 'url' => route('hris.setup.units.index')],
                ],
            ])
        </div>
        <div class="col-lg-8 pe-lg-0">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Unit List</h6>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100" width="100%">
                        <thead>
                            <tr>
                                <th width="5%">SL</th>
                                <th width="20%">Unit</th>
                                <th width="10%">Code</th>
                                <th width="45%">Line</th>
                                <th width="10%">Is Active</th>
                                <th width="10%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($units as $key => $unit)
                                @php
                                    $assoc = array_combine(json_decode($unit->line_id, true), json_decode($unit->line, true));
                                    $lines_custom = $assoc+$lines;
                                @endphp
                                <tr id="row-{{ $unit->id }}">
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $unit->unit }}</td>
                                    <td>{{ $unit->code }}</td>
                                    <td>
                                        {{ implode(',', json_decode($unit->line, true)) }}
                                    </td>
                                    <td>
                                        <div class="square-switch">
                                            <input type="checkbox" id="square-switch3{{ $unit->id }}" class="unit-toggle" data-id="{{ $unit->id }}" switch="bool" {{ $unit->is_active ? 'checked' : '' }} />
                                            <label for="square-switch3{{ $unit->id }}" data-on-label="Yes" data-off-label="No" style="margin: 0px; vertical-align: middle;"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-soft-success waves-effect waves-light" style="padding: 4px 6px;" data-bs-toggle="modal" data-bs-target="#editModal{{ $unit->id }}"><i class="fas fa-edit"></i></a>
                                        <a href="#" class="btn btn-soft-danger waves-effect waves-light delete-unit" data-id="{{ $unit->id }}" style="padding: 4px 6px;"><i class="fas fa-trash"></i></a>
                                    </td>
                                    <div id="editModal{{ $unit->id }}" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-bs-scroll="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title" id="myModalLabel">Edit Unit</h6>
                                                    <button type="button" class="btn-close btn btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form id="editForm{{ $unit->id }}" action="{{ route('hris.setup.units.update', $unit->id) }}" method="POST">
                                                    <div class="modal-body">
                                                        @csrf
                                                        @method('PUT')
                                                        <x-input-group name="unit" label="Unit" type="text" placeholder="Enter unit" :value="$unit->unit" required />
                                                        <x-input-group name="code" label="Code" type="text" placeholder="Enter code" :value="$unit->code" required />
                                                        <label for="line_id">Line <span class="text-danger">*</span></label>
                                                        <x-select-multiple-input
                                                            name="line_id[]"
                                                            id="line_id_edit_{{ $unit->id }}"
                                                            class="select2 multiselect mb-2"
                                                            :options="$lines_custom"
                                                            :selected="json_decode($unit->line_id, true) ?? []"
                                                            multiple
                                                            required
                                                        />
                                                        <br>
                                                        <x-select-input-group name="is_active" label="Is Active" :options="['1' => 'Active', '0' => 'Inactive']" :selected="$unit->is_active" required />
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary waves-effect btn-sm" data-bs-dismiss="modal">Close</button>
                                                        <x-primary-button id="submitBtn" class="float-start btn-sm submitBtn">Save changes</x-primary-button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card alert-info alert-top-border">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i class="mdi mdi-list"></i> Input Parameters For New Unit ...</h6>
                </div>
                <div class="card-body">
                    <form id="moduleForm" action="{{ route('hris.setup.units.store') }}" method="POST">
                        @csrf
                        <x-input-group name="unit" label="Unit" type="text" placeholder="Enter unit" :value="old('unit')" required />
                        <x-input-group name="code" label="Code" type="text" placeholder="Enter code" :value="old('code')" required />
                        <label for="line_id">Line <span class="text-danger">*</span></label>
                        <x-select-multiple-input
                            name="line_id[]"
                            id="classification_id_add"
                            class="select2 multiselect mb-2"
                            :options="$lines"
                            :selected="old('classification_id', [])"
                            multiple
                            required
                        />
                        <br><br>
                        <x-select-input-group
                            name="is_active"
                            class="mb-2"
                            label="Is Active?"
                            :options="['1' => 'Active', '0' => 'Inactive']"
                            :selected="old('is_active', '1')"
                            required
                        />
                        <x-primary-button class="float-start btn-sm submitBtn">Save</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#line_id_add').select2({
                placeholder: 'Select Line',
                allowClear: true,
                multiple: true,
            });

            $('.select2.multiselect').each(function() {
                if (!$(this).hasClass('select2-hidden-accessible')) {
                    $(this).select2();
                }
            });

            $('.unit-toggle').on('change', function() {
                let id = $(this).data('id');
                let status = $(this).is(':checked') ? 1 : 0;
                $.ajax({
                    url: '{{ route('hris.setup.units.toggle') }}',
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

        $(document).on('click', '.delete-unit', function(e) {
            e.preventDefault();
            let unitId = $(this).data('id');
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
                    $.ajax({
                        url: '{{ route('hris.setup.units.delete') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: unitId
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                'Unit has been deleted.',
                                'success'
                            );
                            $('#row-' + unitId).remove();
                        },
                        error: function() {
                            Swal.fire(
                                'Error!',
                                'Something went wrong.',
                                'error'
                            );
                        }
                    });
                } else {
                    Swal.fire(
                        'Cancelled!',
                        'Unit has not been deleted.',
                        'error'
                    );
                }
            });
        });
    </script>
@endpush
