@extends('layouts.app')
@section('title', 'HRIS')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'HRIS',
                'subtitle' => 'Organization',
                'breadcrumbs' => [
                    ['label' => 'HRIS', 'url' => route('hris.index')],
                    ['label' => 'Setup', 'url' => route('hris.index')],
                    ['label' => 'Leave Classification', 'url' => route('hris.setup.leaveclassifications.index')],
                ],
            ])
        </div>
        <div class="col-lg-8 pr-0">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Leave Classification List</h6>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100" width="100%">
                        <thead>
                            <tr>
                                <th width="5%">SL</th>
                                <th width="10%">Code</th>
                                <th width="20%">Signification</th>
                                <th width="20%">Signification Bangla</th>
                                <th width="5%">Yearly Limit</th>
                                <th width="5%">Max Permission</th>
                                <th width="10%">Pay Ratio</th>
                                <th width="10%">Is Active</th>
                                <th width="15%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($leaveclassifications as $key => $leaveclassification)
                                <tr id="row-{{ $leaveclassification->id }}">
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $leaveclassification->code }}</td>
                                    <td>{{ $leaveclassification->signification }}</td>
                                    <td>{{ $leaveclassification->signification_bn }}</td>
                                    <td>{{ $leaveclassification->yearly_limit }}</td>
                                    <td>{{ $leaveclassification->max_permission }}</td>
                                    <td>{{ $leaveclassification->pay_ratio }}</td>
                                    <td>
                                        <div class="square-switch">
                                            <input type="checkbox" id="square-switch3{{ $leaveclassification->id }}" class="organization-toggle" data-id="{{ $leaveclassification->id }}" switch="bool" {{ $leaveclassification->is_active ? 'checked' : '' }} />
                                            <label for="square-switch3{{ $leaveclassification->id }}" data-on-label="Yes" data-off-label="No" style="margin: 0px; vertical-align: middle;"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-soft-success waves-effect waves-light" style="padding: 4px 6px;" data-bs-toggle="modal" data-bs-target="#editModal{{ $leaveclassification->id }}"><i class="fas fa-edit"></i></a>
                                        <a href="#" class="btn btn-soft-danger waves-effect waves-light delete-organization" data-id="{{ $leaveclassification->id }}" style="padding: 4px 6px;"><i class="fas fa-trash"></i></a>
                                    </td>
                                    <div id="editModal{{ $leaveclassification->id }}" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-bs-scroll="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title" id="myModalLabel">Edit Leave Classification</h6>
                                                    <button type="button" class="btn-close btn btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <form id="editForm{{ $leaveclassification->id }}" action="{{ route('hris.setup.leaveclassifications.update', $leaveclassification->id) }}" method="POST">
                                                    <div class="modal-body">
                                                        @csrf
                                                        @method('PUT')
                                                        <x-input-group name="code" label="Code" type="text" placeholder="Enter code" :value="$leaveclassification->code" required />
                                                        <x-input-group name="signification" label="Signification" type="text" placeholder="Enter signification" :value="$leaveclassification->signification" required />
                                                        <x-input-group name="signification_bn" label="Signification Bangla" type="text" placeholder="Enter signification bangla" :value="$leaveclassification->signification_bn" required />
                                                        <x-input-group name="yearly_limit" label="Yearly Limit" type="text" placeholder="Enter yearly limit" :value="$leaveclassification->yearly_limit" required />
                                                        <x-input-group name="max_permission" label="Max Permission" type="text" placeholder="Enter max permission" :value="$leaveclassification->max_permission" required />
                                                        <!--<x-input-group name="pay_ratio" label="Pay Ratio" type="text" placeholder="Enter pay ratio" :value="$leaveclassification->pay_ratio" required />-->
                                                        <x-select-input-group name="is_active" label="Is Active" :options="['1' => 'Active', '0' => 'Inactive']" :selected="$leaveclassification->is_active" required />
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
                    <h6 class="my-0 text-primary"> <i class="mdi mdi-list"></i> Input Parameters For New Leave Classification ...</h6>
                </div>
                <div class="card-body">
                    <form id="moduleForm" action="{{ route('hris.setup.leaveclassifications.store') }}" method="POST">
                        @csrf
                        <x-input-group name="code" label="Code" type="text" placeholder="Enter code" :value="old('code')" required />
                        <x-input-group name="signification" label="Signification" type="text" placeholder="Enter signification" :value="old('signification')" required />
                        <x-input-group name="signification_bn" label="Signification Bangla" type="text" placeholder="Enter signification bangla" :value="old('signification_bn')" required />
                        <x-input-group name="yearly_limit" label="Yearly Limit" type="text" placeholder="Enter yearly limit" :value="old('yearly_limit')" required />
                        <x-input-group name="max_permission" label="Max Permission" type="text" placeholder="Enter max permission" :value="old('max_permission')" required />
                        <!--<x-input-group name="pay_ratio" label="Pay Ratio" type="text" placeholder="Enter pay ratio" :value="old('pay_ratio')" required />-->
                        <x-select-input-group
                            name="is_active"
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
            $('.organization-toggle').on('change', function() {
                let id = $(this).data('id');
                let status = $(this).is(':checked') ? 1 : 0;
                $.ajax({
                    url: '{{ route('hris.setup.leaveclassifications.toggle') }}',
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

        $(document).on('click', '.delete-organization', function(e) {
            e.preventDefault();
            let organizationId = $(this).data('id');
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
                        url: '{{ route('hris.setup.leaveclassifications.delete') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: organizationId
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                'Organization has been deleted.',
                                'success'
                            );
                            $('#row-' + organizationId).remove();
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
                        'Organization has not been deleted.',
                        'error'
                    );
                }
            });
        });
    </script>
@endpush
