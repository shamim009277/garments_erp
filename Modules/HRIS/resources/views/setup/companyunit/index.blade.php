@extends('layouts.app')
@section('title', 'HRIS')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'HRIS',
                'subtitle' => 'Company Wise Unit',
                'breadcrumbs' => [
                    ['label' => 'HRIS', 'url' => route('hris.index')],
                    ['label' => 'Setup', 'url' => route('hris.index')],
                    ['label' => 'Company Wise Unit', 'url' => route('hris.setup.companyunits.index')],
                ],
            ])
        </div>
        <div class="col-lg-8 pe-lg-0">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i>Company Unit List
                    </h6>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100" width="100%">
                        <thead>
                            <tr>
                                <th width="5%">SL</th>
                                <th width="10%">Organization</th>
                                <th width="10%">Unit</th>
                                <th width="10%">Code</th>
                                <th width="45%">Line</th>
                                <th width="10%">Is Active</th>
                                <th width="10%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($units as $key => $unit)
                                <tr id="row-{{ $unit->id }}">
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $unit->company->short_name }}</td>
                                    <td>{{ $unit->unit }}</td>
                                    <td>{{ $unit->code }}</td>
                                    <td>
                                        {{ implode(',', $unit->line) }}
                                    </td>
                                    <td>
                                        <div class="square-switch">
                                            <input type="checkbox" id="square-switch3{{ $unit->id }}"
                                                class="unit-toggle" data-id="{{ $unit->id }}" switch="bool"
                                                {{ $unit->is_active ? 'checked' : '' }} />
                                            <label for="square-switch3{{ $unit->id }}" data-on-label="Yes"
                                                data-off-label="No" style="margin: 0px; vertical-align: middle;"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-soft-success waves-effect waves-light"
                                            style="padding: 4px 6px;" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $unit->id }}"><i class="fas fa-edit"></i></a>
                                        <a href="#" class="btn btn-soft-danger waves-effect waves-light delete-unit"
                                            data-id="{{ $unit->id }}" style="padding: 4px 6px;"><i
                                                class="fas fa-trash"></i></a>
                                    </td>
                                    <div id="editModal{{ $unit->id }}" class="modal fade" tabindex="-1"
                                        aria-labelledby="myModalLabel" aria-hidden="true" data-bs-scroll="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title" id="myModalLabel">Edit Unit</h6>
                                                    <button type="button" class="btn-close btn btn-sm"
                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form id="editForm{{ $unit->id }}"
                                                    action="{{ route('hris.setup.companyunits.update', $unit->id) }}"
                                                    method="POST">
                                                    <div class="modal-body">
                                                        @csrf
                                                        @method('PUT')
                                                        <x-select-input-group name="org_id" class="mb-2"
                                                            label="Organization" :options="$organizations" :selected="$unit->org_id" required />

                                                        <x-select-input-group name="code" class="mb-2" label="Unit List" :options="$unitlist" :selected="$unit->code"  required />

                                                        <label for="line_id">Line <span
                                                                class="text-danger">*</span></label>

                                                        <x-select-multiple-input name="line_id[]"
                                                            id="line_id_edit_{{ $unit->id }}"
                                                            class="select2 multiselect mb-2" :options="$lines"
                                                            :selected="$unit->line_id ?? []" multiple required />
                                                        <br>
                                                        <x-select-input-group name="is_active" label="Is Active"
                                                            :options="['1' => 'Active', '0' => 'Inactive']" :selected="$unit->is_active" required />
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary waves-effect btn-sm"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <x-primary-button id="submitBtn"
                                                            class="float-start btn-sm submitBtn">Save
                                                            changes</x-primary-button>
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
                    <form id="moduleForm" action="{{ route('hris.setup.companyunits.store') }}" method="POST">
                        @csrf
                        <x-select-input-group name="org_id" class="mb-2" label="Organization" :options="$organizations"
                            :selected="1" required />
                        <x-select-input-group name="code" class="mb-2" label="Unit List" :options="$unitlist" required />
                        <label for="line_id">Line <span class="text-danger">*</span></label>
                        <x-select-multiple-input name="line_id[]" id="line_id_add" :options="$lines" :selected="old('line_id', [])" multiple/>
                        <br><br>
                        <x-select-input-group name="is_active" class="mb-2" label="Is Active?" :options="['1' => 'Active', '0' => 'Inactive']"
                            :selected="old('is_active', '1')" required />
                        <x-primary-button class="float-start btn-sm submitBtn">Save</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('.select2').select2({
                placeholder: 'Select option',
                allowClear: true,
                width: '100%'
            });
        });
        $(document).ready(function() {
            $('.unit-toggle').on('change', function() {
                let id = $(this).data('id');
                let status = $(this).is(':checked') ? 1 : 0;
                $.ajax({
                    url: '{{ route('hris.setup.companyunits.toggle') }}',
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
                        url: '{{ route('hris.setup.companyunits.delete') }}',
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
