@extends('layouts.app')
@section('title', 'Payroll')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'Payroll',
                'subtitle' => 'Process Attendence',
                'breadcrumbs' => [
                    ['label' => 'Payroll', 'url' => route('payroll.index')],
                    ['label' => 'Tools', 'url' => route('payroll.index')],
                    ['label' => 'Process Attendence', 'url' => route('payroll.tools.process-attendence.index')],
                ],
            ])
        </div>
        <div class="col-12 mb-3">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                <h4 class="text-center flex-grow-1 order-1 order-md-0 mb-2 mb-md-0">
                   Process Attendence
                </h4>
            </div>
        </div>
        <div class="col-lg-6 ps-lg-0" style="margin:0px auto;">
            <form action="{{ route('payroll.tools.process-attendence.store') }}" id="applicantForm" method="POST">
                @csrf
                <div class="card alert-primary alert-top-border">
                    <div class="card-header" style="padding: 15px 16px;">
                        <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Process Attendence</h6>
                    </div>
                    <div class="card-body" style="overflow-y: auto;">
                        <div class="row">
                            <div class="col-md-8 mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="title" value="1" id="title1" checked>
                                    <label class="form-check-label" for="title1">Pre Process Attendence</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="title" value="2" id="title2">
                                    <label class="form-check-label" for="title2">Undo / Revert Process Attendence</label>
                                </div><br>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="title" value="3" id="title3">
                                    <label class="form-check-label" for="title1">Process Attendence</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="title" value="4" id="title4">
                                    <label class="form-check-label" for="title2">Undo / Revert Process Attendence</label>
                                </div>
                            </div><br><br>

                            <div class="col-md-4 mb-3">
                                <x-select-input name="org_id" id="org_id" class="select2" :options="$organizations" :selected="old('org_id', '1')" placeholder="Select Organization" required />
                                <x-input-group type="date" name="date" value="{{ $date }}" class="form-control-sm"/>
                                <x-select-input name="month" id="month" class="select2" :options="['1' => 'January', '2' => 'February', '3' => 'March', '4' => 'April', '5' => 'May', '6' => 'June', '7' => 'July', '8' => 'August', '9' => 'September', '10' => 'October', '11' => 'November', '12' => 'December']" :selected="$month" placeholder="Select Month" required />
                                <x-select-input name="year" id="year" class="select2" :options="$yearlist" :selected="date('Y')" placeholder="Select Year" required />
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body" id="progress-container" style="display:none;">
                        <div class="progress" style="height: 20px;">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: 0%;" id="progress-bar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                        </div>
                        <div class="text-center mt-1"><small id="progress-text">Initializing...</small></div>
                    </div>

                    <div class="card-footer" style="padding:15px 16px;">
                        <x-primary-button id="submitBtn" class="btn-sm submitBtn float-end" type="submit">Start Process</x-primary-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        // Form Submit Logic
        $('#applicantForm').on('submit', function (e) {
            let selectedTitle = $('input[name="title"]:checked').val();
            
            // Only use AJAX for "Process Attendence" (Title 3) and "Pre Process Attendence" (Title 1)
            if (selectedTitle == 3 || selectedTitle == 1) {
                e.preventDefault();
                e.stopPropagation();
                let formData = new FormData(this);
                let submitBtn = $('#submitBtn');
                
                submitBtn.prop('disabled', true);
                $('#progress-container').show();
                $('#progress-bar').css('width', '0%').attr('aria-valuenow', 0).text('0%');
                $('#progress-text').text('Starting...').removeClass('text-success fw-bold').addClass('text-muted');

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        if (response.success) {
                            if(response.job_status_id) {
                                toastr.success(response.message);
                                pollJobStatus(response.job_status_id);
                            } else {
                                // Fallback for non-job responses (if any)
                                toastr.success(response.message || 'Success');
                                submitBtn.prop('disabled', false);
                                $('#progress-container').hide();
                            }
                        } else {
                            toastr.error(response.message || 'An error occurred');
                            submitBtn.prop('disabled', false);
                            $('#progress-container').hide();
                        }
                    },
                    error: function (xhr) {
                        let errorMessage = 'An error occurred';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        } else if (xhr.responseJSON && xhr.responseJSON.error) {
                            errorMessage = xhr.responseJSON.error;
                        }
                        toastr.error(errorMessage);
                        submitBtn.prop('disabled', false);
                        $('#progress-container').hide();
                    }
                });
            } else {
                // Allow normal submission for other options (Pre-process, Delete, etc.)
                return true; 
            }
        });

        function pollJobStatus(jobId) {
            let interval = setInterval(function () {
                $.ajax({
                    url: "{{ url('payroll/tools/process-attendence/status') }}/" + jobId,
                    type: 'GET',
                    success: function (response) {
                        if (response.success) {
                            let percentage = response.progress;
                            $('#progress-bar').css('width', percentage + '%').attr('aria-valuenow', percentage).text(percentage + '%');
                            $('#progress-text').text(response.message);

                            if (response.status === 'completed') {
                                clearInterval(interval);
                                toastr.success('Attendance processed successfully!');
                                $('#submitBtn').prop('disabled', false);
                                setTimeout(function() {
                                    $('#progress-container').hide();
                                    $('#progress-bar').css('width', '0%').text('0%');
                                }, 3000);
                            } else if (response.status === 'failed') {
                                clearInterval(interval);
                                toastr.error('Job failed: ' + response.message);
                                $('#submitBtn').prop('disabled', false);
                            }
                        }
                    },
                    error: function () {
                        clearInterval(interval);
                        toastr.error('Error checking job status');
                        $('#submitBtn').prop('disabled', false);
                    }
                });
            }, 2000); // Poll every 2 seconds
        }
    });
</script>
@endpush
