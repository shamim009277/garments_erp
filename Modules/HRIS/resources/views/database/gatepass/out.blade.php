@extends('layouts.app')
@section('title', 'HRIS')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'HRIS',
                'subtitle' => 'Employee Gate Pass Out',
                'breadcrumbs' => [
                    ['label' => 'HRIS', 'url' => route('hris.index')],
                    ['label' => 'Database', 'url' => route('hris.index')],
                    ['label' => 'Employee Gate Pass Out', 'url' => route('hris.database.employee-gatepass.out')],
                ],
            ])
        </div>
        <div class="col-12 mb-3">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                <!-- Centered Title -->
                <h4 class="text-center flex-grow-1 order-1 order-md-0 mb-2 mb-md-0">
                   Employee Gate Pass Out
                </h4>
            </div>
        </div>
        <div class="col-lg-12">
            <form action="{{ route('hris.database.employee-gatepass.store') }}" method="POST">
                @csrf
                <div class="card alert-primary alert-top-border padding-card">
                    <div class="card-header">
                        <h6 class="my-0 text-primary"> <i data-feather="list" width="18" height="18"></i> Employee Gate Pass Out</h6>
                    </div>
                    <div class="card-body">
                        <table id="datacom" class="table table-striped" width="100%">
                            <thead class="table-light">
                                <tr>
                                    <th width="8%">Emp ID</th>
                                    <th width="12%">Name</th>
                                    <th width="12%">Photo</th>
                                    <th width="10%">Purpose</th>
                                    <th width="10%">Reason</th>
                                    <th width="8%">Pass Type</th>
                                    <th width="10%">Approved By</th>
                                    <th width="8%">Start Time</th>
                                    <th width="8%">End Time</th>
                                    <th width="8%">Duration</th>
                                    <th width="6%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($gatePasses as $gatePass)
                                <tr id="row-{{ $gatePass->id }}">
                                    <td>{{ $gatePass->employee->employee_id }}</td>
                                    <td>{{ $gatePass->employee->name }}</td>
                                    <td>
                                        @if ($gatePass->employee->photo)
                                            <img src="{{ asset('storage/' . $gatePass->employee->photo) }}" alt="" width="50" height="50">
                                        @else
                                            <img src="{{ asset('backend/assets/images/demo.png') }}" alt="" width="50" height="50">
                                        @endif
                                    </td>
                                    <td>{{ $gatePass->purpose->purpose }}</td>
                                    <td>{{ $gatePass->reason->reason }}</td>
                                    <td>{{ $gatePass->type_id == 1 ? 'Short Time' : 'Full Day' }}</td>
                                    <td>{{ $gatePass->approvedBy->name ?? 'N/A' }}</td>
                                    <td>
                                        <strong class="text-primary">{{ $gatePass->start_time }}</strong>
                                    </td>
                                    <td>
                                        <strong class="text-primary">{{ $gatePass->end_time }}</strong>
                                    </td>
                                    <td>
                                        <strong class="text-primary">{{ $gatePass->duration }}</strong>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm" onclick="outBtn({{ $gatePass->id }})">
                                            <i data-feather="log-out" width="16" height="16"></i> Out</button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $('#datacom').DataTable({
        paging: false,
        lengthChange: false,
        searching: true,
        ordering: false,
        scrollY: "400px",
        scrollX: true,
        scrollCollapse: true,
        fixedHeader: true,
    });

    function outBtn(id) {
        $.ajax({
            url: '{{ route('hris.database.employee-gatepass.out') }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                id: id,
            },
            success: function (response) {
                if (response) {
                    Swal.fire(
                        'Success!',
                        'Employee gate pass out successfully.',
                        'success'
                    );
                    $('#row-' + id).remove();
                }
            },
            error: function (xhr, status, error) {
                Swal.fire(
                    'Error!',
                    'Something went wrong.',
                    'error'
                );
            }
        });
    }
</script>
@endpush
