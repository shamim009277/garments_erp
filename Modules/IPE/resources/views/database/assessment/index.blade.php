@extends('layouts.app')
@section('title', 'IPE')
@push('styles')
    <style>
        .select2-selection {
            height: 35px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            height: 32px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 32px !important;
        }

        .employee-active {
            background-color: #4549A2;
            color: #FFFFFF;
        }

        .employee-active:hover {
            color: #000000;
        }
    </style>
@endpush
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'IPE',
                'subtitle' => 'Assessment',
                'breadcrumbs' => [
                    ['label' => 'IPE', 'url' => route('ipe.index')],
                    ['label' => 'Database', 'url' => route('ipe.index')],
                    ['label' => 'Assessment', 'url' => route('ipe.database.assessments.index')],
                ],
            ])
        </div>
        <div class="col-12 mb-3">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                <!-- Centered Title -->
                <h4 class="text-center flex-grow-1 order-1 order-md-0 mb-2 mb-md-0">
                    {{ $unique_applicant ? "Assessment || Applicant ID : $unique_applicant->id" : 'Assessment' }}
                </h4>

                <!-- Search Input + Button in One Line -->
                <form action="{{ route('ipe.database.assessments.search') }}" method="POST" class="d-flex order-0 order-md-1 mb-2 mb-md-0 me-md-2" style="max-width: 400px;" role="search">
                    @csrf
                    <input class="form-control form-control-sm me-2" type="search" name="search" placeholder="Applicant Card No ..." aria-label="Search">
                    <button class="btn btn-sm btn-primary d-flex align-items-center" type="submit"><i data-feather="search" width="14" height="14" class="me-1"></i> Search</button>
                </form>
                @if ($unique_applicant)
                    <!-- Back Button -->
                    <a href="{{ route('ipe.database.assessments.index') }}" class="btn btn-sm btn-info d-flex align-items-center order-2 order-md-2"><i data-feather="arrow-left" width="14" height="14" class="me-1"></i> Back </a>
                @endif
            </div>
        </div>
        <div class="col-lg-3 pe-lg-0">
            <x-ipe::database.assessment title="Pending Assessment List" :pending-applicants="$pending_applicants" :unique-applicant="$unique_applicant" />
        </div>

        <div class="col-lg-9">
            <form action="{{ $unique_applicant ? route('ipe.database.assessments.update', $unique_applicant->id) : route('ipe.database.assessments.store') }}" id="applicantForm" method="POST">
                @csrf
                @if ($unique_applicant)
                    @method('PUT')
                @endif
                <div class="card alert-info alert-top-border">
                    <div class="card-header d-flex justify-content-between align-items-center flex-wrap px-10 py-12" style="padding: 16px 20px">
                        <h6 class="my-0 text-primary d-flex align-items-center gap-1"><i data-feather="list" width="18" height="18"></i>
                            {{ $unique_applicant ? 'Edit Applicant Information' : 'Input Parameters For New Applicant ...' }}
                        </h6>

                        <div class="d-flex gap-2 mt-2 mt-md-0">
                            @if ($unique_applicant)
                                <a href="javascript:void(0);" data-id="{{ $unique_applicant->id }}" class="btn btn-danger btn-sm d-flex align-items-center delete-applicant" data-id="{{ $unique_applicant->id }}"><i data-feather="trash-2" width="16" height="16" class="me-1"></i> Delete</a>
                                <button class="btn btn-warning btn-sm d-flex align-items-center text-white"><i data-feather="star" width="16" height="16" class="me-1"></i> Sticker</button>
                            @else
                                <a href="javascript:void(0);" id="resetForm" class="btn btn-secondary btn-sm d-flex align-items-center"><i data-feather="rotate-ccw" width="16" height="16" class="me-1"></i> Reset</a>
                            @endif
                        </div>
                    </div>

                    <div class="card-body" style="min-height: 400px;max-height: 400px; overflow-y: auto;">
                        <div class="row">
                            @if ($unique_applicant)
                                <div class="col-lg-4 col-md-6 pr-0">
                                    <x-input-group name="entry_date " label="Entry Date" type="date"
                                        placeholder="Enter entry date" :value="old(
                                            'entry_date',
                                            $unique_applicant ? $unique_applicant->entry_date : null,
                                        )" required readonly
                                        class="no-calendar" />
                                </div>
                            @endif
                            @php
                                $selectedOrg = old(
                                    'org_id',
                                    $unique_applicant->org_id ??
                                        ($organizations->count() === 1 ? $organizations->keys()->first() : 1),
                                );
                            @endphp
                            <div class="col-lg-4 col-md-6 pr-0">
                                <input type="hidden" name="applicant_id" id="applicant_id" value="" />
                                <x-select-input-group name="org_id" id="org_id" label="Organization" class="select2"
                                    :options="$organizations" :selected="selected_org($organizations)" required readonly />
                            </div>
                            <div class="col-lg-4 col-md-6 pr-0">
                                <x-input-group name="name" label="Name" id="name" type="text"
                                    placeholder="Enter name" :value="old('name', $unique_applicant ? $unique_applicant->name : null)" required readonly />
                            </div>
                            <div class="col-lg-4 col-md-6 pr-0">
                                <x-input-group name="name_bangla" id="name_bangla" label="Name Bangla" type="text"
                                    placeholder="Enter name bangla" :value="old(
                                        'name_bangla',
                                        $unique_applicant ? $unique_applicant->name_bangla : null,
                                    )" readonly />
                            </div>

                            <div class="col-lg-4 col-md-6 pr-0">
                                <x-input-group name="entry_date" id="entry_date" label="Entry Date" type="text"
                                    pattern="[0-9]{2}" placeholder="Enter entry date" :value="old(
                                        'entry_date',
                                        $unique_applicant ? $unique_applicant->entry_date : null,
                                    )" required readonly />
                            </div>

                            <div class="col-lg-4 col-md-6 pr-0">
                                <x-input-group name="mobile" id="mobile" label="Mobile" type="text"
                                    pattern="(01)[0-9]{9}" maxlength="11" placeholder="Enter mobile" :value="old('mobile', $unique_applicant ? $unique_applicant->mobile : null)"
                                    required readonly />
                            </div>

                            <div class="col-lg-4 col-md-6 pr-0">
                                <x-input-group name="line" id="line" label="Line" type="text"
                                    pattern="[0-9]" placeholder="Enter line" :value="old('line', $unique_applicant ? $unique_applicant->line : null)" />
                            </div>

                            <div class="col-lg-3 col-md-6 pr-0">
                                <x-select-search-input name="degree_id" label="Degree" :options="$degrees"
                                    :selected="old(
                                        'degree_id',
                                        $unique_applicant ? $unique_applicant->degree_id : null,
                                    )" required />
                            </div>

                            <div class="col-lg-3 col-md-6 pr-0">
                                <x-select-input-group name="designation_id" id="designation_id" label="Designation"
                                    class="select2" :options="$designations" :selected="old(
                                        'designation_id',
                                        $unique_applicant ? $unique_applicant->designation_id : null,
                                    )" required />
                            </div>

                            <div class="col-lg-3 col-md-6 pr-0">
                                <x-input-group name="exp_year" label="Experience Year" type="text" pattern="[0-9]"
                                    placeholder="Enter experience year" :value="old('exp_year', $unique_applicant ? $unique_applicant->exp_year : null)" />
                            </div>
                            <div class="col-lg-3 col-md-6 pr-0">
                                <x-input-group name="exp_month" label="Experience Month" type="text" pattern="[0-9]"
                                    placeholder="Enter experience month" :value="old(
                                        'exp_month',
                                        $unique_applicant ? $unique_applicant->exp_month : null,
                                    )" />
                            </div>
                        </div>
                    </div>
                    <div class="card-footer" style="padding:14px 20px;">
                        <x-primary-button
                            class="float-start btn-sm submitBtn">{{ $unique_applicant ? 'Update' : 'Submit' }}</x-primary-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).on('click', '.employee-show', function(e) {
            e.preventDefault();
            $('.employee-show').removeClass('employee-active');
            $(this).addClass('employee-active');

            let orgId = $(this).data('org_id');

            $('#applicant_id').val($(this).data('id'));
            $('#name').val($(this).data('name'));
            $('#name_bangla').val($(this).data('name_bn'));

            $('#entry_date').val($(this).data('entry_date'));
            $('#mobile').val($(this).data('mobile'));
            $('#line').val($(this).data('line'));
            $('#org_id').val(orgId).change();
            $('#designation_id').val($(this).data('designation_id')).change();
        });
    </script>
@endpush
