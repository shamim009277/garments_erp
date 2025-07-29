@extends('layouts.app')
@section('title', 'HRIS')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'HRIS',
                'subtitle' => 'Employee ID Assign',
                'breadcrumbs' => [
                    ['label' => 'HRIS', 'url' => route('hris.index')],
                    ['label' => 'Database', 'url' => route('hris.index')],
                    ['label' => 'Employee ID Assign', 'url' => route('hris.database.employee-idassign.index')],
                ],
            ])
        </div>
        <div class="col-12 mb-3">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                <!-- Centered Title -->
                <h4 class="text-center flex-grow-1 order-1 order-md-0 mb-2 mb-md-0">Applicant Employee ID Assign</h4>

                <!-- Search Input + Button in One Line -->
                <form class="d-flex order-0 order-md-1" style="max-width: 400px;" role="search">
                    <input class="form-control form-control-sm me-2" type="search" placeholder="Applicant Card No ..." aria-label="Search">
                    <button class="btn btn-sm btn-primary d-flex align-items-center" type="submit">
                        <i data-feather="search" width="14" height="14" class="me-1"></i> Search
                    </button>
                </form>
            </div>
        </div>
        <div class="col-lg-7 pe-lg-0">
            <div class="card alert-primary alert-top-border padding-card" >
                <div class="card-header" style="padding:14px 20px;">
                    <h5 class="my-0 text-primary"> <i data-feather="list" width="18" height="18"></i> Applicant For EmployeeID</h5>
                </div>
                <div class="card-body" style="min-height: 500px;max-height: 500px; overflow-y: auto;">
                    <div class="row">
                        <div class="col-lg-6 pe-lg-1">
                            <div class="card border border-primary">
                                <div class="card-header" style="padding:10px 16px;">
                                    <h6 class="my-0 text-primary">Pending Applicant List For EmployeeID (1)</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="applicant_id">Applicant ID</label>
                                                <input type="text" class="form-control" id="applicant_id" placeholder="Applicant ID">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 ps-lg-1">
                            <div class="card border border-info">
                                <div class="card-header" style="padding:10px 16px;">
                                    <h6 class="my-0 text-primary">Input Parameters For EmployeeID</h6>
                                </div>
                                <div class="card-body">
                                    <x-input-group label="Applicant ID" name="applicant_id" type="text" placeholder="Applicant ID" readonly/>
                                    <x-input-group label="Employee ID" name="employee_id" type="text" placeholder="Employee ID" required/>
                                    <x-select-search-input name="final_designation_id" id="final_designation_id" label="Final Designation" :options="['1' => 'Active', '0' => 'Inactive']" :selected="old('final_designation_id')" required />
                                    <x-select-input-group name="recruitment_type" id="recruitment_type" label="Recruitment Type" :options="['N' => 'New', 'R' => 'Replacement']" :selected="old('final_designation_id')" required />
                                </div>
                                <div class="card-footer" style="padding:10px 16px;">
                                    <x-primary-button class="float-start btn-sm submitBtn">Assign</x-primary-button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card alert-info alert-top-border">
                <div class="card-header" style="padding:14px 20px;">
                    <h5 class="my-0 text-primary"><i data-feather="list" width="18" height="18"></i> Applicant For File Entry</h5>
                </div>
                <div class="card-body" style="min-height: 500px;max-height: 500px; overflow-y: auto;">

                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.sex-toggle').on('change', function() {
                let id = $(this).data('id');
                let status = $(this).is(':checked') ? 1 : 0;
                $.ajax({
                    url: '{{ route('hris.setup.sex.toggle') }}',
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

        $(document).ready(function () {
            let today = new Date().toISOString().split('T')[0];
            $('#joining_date').attr('min', today);
        });

        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Select an option",
                allowClear: true
            });
        });

        $(document).on('click', '.delete-sex', function(e) {
            e.preventDefault();
            let sexId = $(this).data('id');
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
                        url: '{{ route('hris.setup.sex.delete') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: sexId
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                'Sex has been deleted.',
                                'success'
                            );
                            $('#row-' + sexId).remove();
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
                        'Sex has not been deleted.',
                        'error'
                    );
                }
            });
        });
    </script>
@endpush
