@extends('layouts.app')
@section('title', 'HRIS')
@section('styles')

@endsection
@section('content')
<style>
    .table, tr, th, td {
        border: none !important;
        border-collapse: collapse;
    }
</style>
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'HRIS',
                'subtitle' => 'Photo Sign',
                'breadcrumbs' => [
                    ['label' => 'HRIS', 'url' => route('hris.index')],
                    ['label' => 'Database', 'url' => route('hris.index')],
                    ['label' => 'Photo Sign', 'url' => route('hris.database.photosign.index')],
                ],
            ])
        </div>
        <div class="col-lg-2">
            
        </div>
        <div class="col-lg-8">
            <form action="{{ route('hris.database.photosign.store') }}" id="applicantForm" method="POST">
                @csrf
                <div class="card alert-info alert-top-border">
                    <div class="card-header d-flex justify-content-between align-items-center flex-wrap px-10 py-12" style="padding: 16px 20px">
                        <h6 class="my-0 text-primary d-flex align-items-center gap-1"><i data-feather="list" width="18" height="18"></i>
                            Photo Sign
                        </h6>
                    </div>

                    <div class="card-body" style="min-height: 500px;max-height: 500px; overflow-y: auto;">
                        <div class="row g-2">
                            <!-- Employee basic info -->
                            <div class="col-md-4">
                                <table class="table table-bordered" id="employeeInfoTable" width="100%">
                                    <tr>
                                        <th width="30%" style="border: none;">Employee ID</th>
                                        <td width="70%" style="border: none;"><x-input-group name="empId" id="empId" type="text" placeholder="Employee ID"/></td>
                                    </tr>
                                    <tr>
                                        <th width="30%" style="border: none;">Name</th>
                                        <td width="70%" style="border: none;"><x-input-group name="empName" id="empName" type="text" placeholder="Employee Name" readonly/></td>
                                    </tr>
                                    <tr>
                                        <th width="30%" style="border: none;">Designation</th>
                                        <td width="70%" style="border: none;"><x-input-group name="curDesig" id="curDesig" type="text" placeholder="Designation" readonly/></td>
                                    </tr>
                                    <tr>
                                        <th width="30%" style="border: none;">Department</th>
                                        <td width="70%" style="border: none;"><x-input-group name="curDept" id="curDept" type="text" placeholder="Department" readonly/></td>
                                    </tr>
                                    <tr>
                                        <th width="30%" style="border: none;">Joining Date</th>
                                        <td width="70%" style="border: none;"><x-input-group name="joinDate" id="joinDate" type="text" placeholder="Joining Date" readonly/></td>
                                    </tr>
                                </table>
                            </div>

                            <!-- Upload new photo & signature -->
                            <div class="col-md-4" style="height:450px; width:300px; border:1px solid #ddd; overflow:hidden;">
                                <table class="table" width="100%">
                                    <tr>
                                        <th class="text-center" colspan="2">Photo (128x148)</th>
                                    </tr>
                                    <tr>
                                        <td class="text-center mb-2">
                                            {{--                <img id="photoPreview" src="#" alt="New Photo" style="height:148px; width:128px; object-fit:cover; border:1px solid #ddd; display:none;">
                                            --}}     
                                            <div class="text-center mt-3">
                                                {{-- <label class="text-primary fw-bold">Photo</label> --}}
                                                <div class="border border-dark mx-auto" style="width:128px; height:148px;">
                                                    <img id="photoPreview" src="{{ asset('images/placeholder.png') }}" style="width:128px;height:148px;object-fit:cover;" />
                                                </div>
                                            </div>                                  
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center mb-2">
                                            <input type="file" name="photo" id="photo" accept="image/*" class="form-control form-control-sm">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-center" colspan="2">Sign (300x150)</th>
                                    </tr>
                                    <tr>
                                        <td class="text-center mb-2">
                                            {{--    <img id="signaturePreview" src="#" alt="New Signature" style="height:150px; width:300px; object-fit:contain; border:1px solid #ddd; display:none;"> --}}    
                                            <div class="text-center mt-3">
                                                {{-- <label class="text-primary fw-bold">Signature</label> --}}
                                                <div class="border border-dark mx-auto" style="width:300px; height:100px;">
                                                    <img id="signaturePreview" src="{{ asset('images/placeholder.png') }}" style="width:300px;height:100px;object-fit:cover;" />
                                                </div>
                                            </div>                              
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center mb-2">
                                            <input type="file" name="signature" id="signature" accept="image/*" class="form-control form-control-sm">
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <!-- Existing photo & signature -->
                            <div class="col-md-4" style="height:450px; width:300px; border:1px solid #ddd; overflow:hidden;">
                                <table class="table" width="100%">
                                    <tr>
                                        <th class="text-center" colspan="2">Existing Photo</th>
                                    </tr>
                                    <tr>
                                        <td class="text-center">
                                            <div class="border border-dark mx-auto" style="width:128px; height:148px;">
                                            <img 
                                                id="existingPhoto" 
                                                src="{{ $existingPhoto ?? '#' }}" 
                                                alt="Existing Photo" 
                                                class="border img-fluid img-thumbnail"
                                                style="height:148px; width:128px; object-fit:cover;"
                                            >
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-center" colspan="2">Existing Signature</th>
                                    </tr>
                                    <tr>
                                        <td class="text-center">
                                            <div class="border border-dark mx-auto" style="width:300px; height:100px;">
                                                <img 
                                                    id="existingSignature" 
                                                    src="{{ $existingSignature ?? '#' }}" 
                                                    alt="Existing Signature" 
                                                    class="border img-fluid"
                                                    style="height:100px; width:300px; object-fit:contain; border:1px solid #ddd;"
                                                >
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer" style="padding:14px 20px;">
                        <x-primary-button class="float-start btn-sm submitBtn">Assign</x-primary-button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-2">
            
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Image preview helpers
        function readURL(input, previewSelector) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = e => {
                    $(previewSelector).attr('src', e.target.result).show();
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        $('#photo').on('change', function () {
            readURL(this, '#photoPreview');
        });

        $('#signature').on('change', function () {
            readURL(this, '#signaturePreview');
        });

        // Demo behaviour: auto-fill display fields when Employee ID loses focus
        $('#empId').on('blur', function () {
            if (this.value.trim() === 'E001') {
                $('#empName').val('John Doe');
            } else {
                $('#empName').val('');
            }
        });
    </script>
@endpush
