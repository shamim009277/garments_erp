@extends('layouts.app')
@section('title', 'INVENTORY')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'INVENTORY',
                'subtitle' => 'Purchase Requisition',
                'breadcrumbs' => [
                    ['label' => 'INVENTORY', 'url' => route('inventory.index')],
                    ['label' => 'Setup', 'url' => route('inventory.index')],
                    ['label' => 'Purchase Requisition', 'url' => route('inventory.database.purrequisitions.index')],
                ],
            ])
        </div>
        <div class="col-md-3">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Purchase Requisition List
                    </h6>
                </div>
                <div class="card-body">
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card alert-secondary alert-top-border padding-card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Input Parameters For Purchase Requisition..</h6>
                        </div>
                        <div class="col-sm-6">
                            <x-primary-button class="btn-sm float-right" data-bs-toggle="modal" data-bs-target="#addModal">Add New</x-primary-button>
                            <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addModalLabel">Add New Purchase Requisition</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form id="addForm" action="{{ route('inventory.database.purrequisitions.store') }}" method="POST">
                                            <div class="modal-body">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <x-text-input id="name" name="name" type="date" required />
                                                    </div>
                                                    <div class="col-md-6">
                                                        <x-text-input id="code" name="code" type="text" required />
                                                    </div>
                                                </div>
                                                @method('PUT')
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary waves-effect btn-sm" data-bs-dismiss="modal">Close</button>
                                                <x-primary-button class="float-start btn-sm submitBtn">Save Changes</x-primary-button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                </div>
                <div class="card-body">
                </div>
            </div>
        </div>

    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {

            $('[data-toggle="tooltip"]').tooltip()

            $('.forapppannel-toggle').on('change', function() {
                let id = $(this).data('id');
                let status = $(this).is(':checked') ? 1 : 0;
                $.ajax({
                    url: '{{ route('inventory.setup.forapppannel.toggle') }}',
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

        $(document).on('click', '.delete-forapppannel', function(e) {
            e.preventDefault();
            let forapppannelId = $(this).data('id');
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
                        url: '{{ route('inventory.setup.forapppannel.delete') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: forapppannelId
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                'Forward Approve Pannel has been deleted.',
                                'success'
                            );
                            $('#row-' + forapppannelId).remove();
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
                        'Forward Approve Pannel has not been deleted.',
                        'error'
                    );
                }
            });
        });
    </script>
@endpush
