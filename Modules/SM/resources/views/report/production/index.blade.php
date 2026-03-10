@extends('layouts.app')
@section('title', 'Sample Delivery')
@section('content')
@push('styles')
    <style>
        input[type="checkbox"] {
            display: inline-block !important;
            opacity: 1 !important;
        }

        .collapse {
            display: none;
            margin-left: 35px;
        }

        .toggle-btn {
            cursor: pointer;
            color: #5156be;
            margin-left: 5px;
        }
        .parent-label {
            font-weight: bold;
        }

        .disabled-select {
            cursor: not-allowed !important;
            background-color: #dad9d9 !important;
        }
        .form-check-input:checked:disabled {
            background-color: #b7bbf5 !important;
            border: 1px solid #b7bbf5 !important;
        }
    </style>
@endpush
<div class="row">
    <div class="col-12">
        @include('components.breadcrumb', [
        'title' => 'Sample Delivery',
        'subtitle' => 'Sample Delivery List',
        'breadcrumbs' => [
        ['label' => 'Sample Management', 'url' => route('sms.index')],
        ['label' => 'Database', 'url' => route('sms.index')],
        ['label' => 'Sample Delivery', 'url' => route('sms.database.sampledelivery.index')],
        ],
        ])
    </div>
    <div class="col-lg-12 pr-0">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Sample Production Report
                    </h6>
                </div>
                <form id="employeeListingForm" action="{{ route('sms.report.production.preview') }}" method="POST" target="_blank">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <!-- Titles -->
                            <div class="col-lg-3 mb-3 pe-lg-0">
                                <div class="card alert-info alert-top-border">
                                    <div class="card-header">
                                        <h6 class="my-0 text-primary"> <i data-feather="list" width="16"height="16"></i>Preview Title's</h6>
                                    </div>
                                    <div class="card-body" style="max-height:450px;min-height:450px; overflow-y: auto;">
                                        <div class="form-check">
                                            <input type="radio" id="title1" name="title" value="1"class="form-check-input titles" checked>
                                            <label class="form-check-label" for="title1">Daily Production Report</label>
                                        </div>
                                         <div class="form-check">
                                            <input type="radio" id="title2" name="title" value="2"class="form-check-input titles">
                                            <label class="form-check-label" for="title2">Production Report (Date Range)</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 mb-3 pe-lg-0">
                                <div class="card alert-info alert-top-border">
                                    <div class="card-header">
                                        <h6 class="my-0 text-primary"> <i data-feather="list" width="16"height="16"></i> Buyers</h6>
                                    </div>
                                    <div class="card-body" style="max-height:400px;min-height:400px; overflow-y: auto;">
                                        <!-- Sample departments -->
                                        <div class="buyer-list">
                                            <!-- Parent 1 -->
                                            @foreach ($buyers as $buyer)
                                            <div class="parent-wrapper">
                                                <label class="parent-label">
                                                    <span class="toggle-btn" data-target="children-{{ $buyer->id }}">[+]</span>
                                                    <input type="checkbox" class="parent-checkbox buyerID" data-id="{{ $buyer->id }}" name="buyer_id[]" value="{{ $buyer->id }}"> {{ $buyer->buyer_name }}
                                                </label>
                                                @php
                                                $ordersList = collect($samples)->where('initialOrder.buyer_id',$buyer->id)->all();
                                                @endphp
                                                <div class="collapse" id="children-{{ $buyer->id }}">
                                                    @foreach ($ordersList as $programme)
                                                    <label><input type="checkbox" class="form-check-input child-of-{{ $buyer->id }} ProgrammeID" name="programme_id[]" value="{{ $programme->id }}"> {{ $programme->programme_code }}</label><br>
                                                    @endforeach
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="card-footer" style="padding:10px 15px;">
                                        <button type="button" class="btn btn-sm btn-outline-primary" id="check_all">Check All</button>
                                        <button type="button" class="btn btn-sm btn-outline-danger" id="uncheck_all">Uncheck All</button>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-3 col-md-6 mb-3 pe-lg-0">
                                <div class="card alert-info alert-top-border">
                                    <div class="card-header">
                                        <h6 class="my-0 text-primary"> <i data-feather="list" width="16"height="16"></i> Sample Types</h6>
                                    </div>
                                    <div class="card-body" style="max-height:400px;min-height:400px; overflow-y: auto;">
                                        <!-- Sample departments -->
                                        <div class="sample-list">
                                            <!-- Parent 1 -->
                                            @foreach ($sampleTypes as $sample)
                                            <div class="parent-wrapper">
                                                <label class="parent-label">
                                                    <input type="checkbox" class="parent-checkbox-type sampleID" data-id="{{ $sample->id }}" name="sample_id[]" value="{{ $sample->id }}"> {{ $sample->sample_type_name }}
                                                </label>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="card-footer" style="padding:10px 15px;">
                                        <button type="button" class="btn btn-sm btn-outline-primary" id="check_all2">Check All</button>
                                        <button type="button" class="btn btn-sm btn-outline-danger" id="uncheck_all2">Uncheck All</button>
                                    </div>
                                </div>

                            </div>
                          
                            <!-- Department & Designation -->
                             <div class="col-lg-3 mb-3 pe-lg-0">
                                <div class="card alert-info alert-top-border">
                                    <div class="card-body" style="max-height:460px;min-height:460px; overflow-y: auto;">
                                        <table class="table table-sm" width="100%">
                                            <tbody>
                                                <tr>
                                                    <th>Start Date</th>
                                                    <td width="60%">
                                                        <x-text-input name="start_date" type="date" id="start_date" class="form-control-sm" value="{{ old('start_date', $startDate) }}" placeholder="Start Date"  />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th width="40%">End Date</th>
                                                    <td width="60%">
                                                        <x-text-input name="end_date" type="date" id="end_date" class="form-control-sm" value="{{ old('end_date', $endDate) }}" placeholder="End Date"  />
                                                    </td>
                                                </tr>
                                                <!-- <tr>
                                                    <th width="40%">Organization</th>
                                                    <td width="60%">
                                                        <x-select-input name="organization_id" id="organization_id" class="select2" :options="$organizations" selected="{{ old('organization_id', 1) }}" placeholder="Organization" />
                                                    </td>
                                                </tr> -->
                                                <tr>
                                                    <th width="40%">View Mode</th>
                                                    <td width="60%">
                                                        <x-select-input name="view_mode" id="view_mode" class="select2" :options="['1' => 'Normal View', '2' => 'PDF View']" selected="{{ old('view_mode', 1) }}" placeholder="View Mode" />
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="card-footer" style="padding:10px 15px;">
                                        <button type="submit" class="btn btn-sm btn-primary float-end">Preview</button>
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </form>
            </div>
        </div>
   
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('.parent-checkbox.buyerID, .parent-checkbox-type.sampleID,.form-check-input.buyerID').prop('checked', true);
        $('.ProgrammeID').prop('checked', true);

        $('.titles').prop('checked', false);
        $('#title1').prop('checked', true);

        $('.toggle-btn').on('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            const target = $('#' + $(this).data('target'));
            const isOpen = target.is(':visible');
            target.toggle();
            $(this).text(isOpen ? '[+]' : '[-]');
        });

        $('.parent-checkbox').on('change', function () {
            const id = $(this).data('id');
            $(`.child-of-${id}`).prop('checked', this.checked);
        });

        $('.form-check-input').on('change', function () {
            const classList = $(this).attr('class').split(/\s+/);
            const childClass = classList.find(cls => cls.startsWith('child-of-'));
           if (childClass) {
        const parentId = childClass.split('-').pop();

        const children = $(`.child-of-${parentId}`);
        const parent = $(`.parent-checkbox[data-id="${parentId}"]`);
        
        const anyChecked = children.is(':checked');
        parent.prop('checked', anyChecked);
            }
        });

        $('#check_all').on('click', function () {
            $('.parent-checkbox.buyerID, .form-check-input.ProgrammeID').prop('checked', true);
        });

        $('#uncheck_all').on('click', function () {
            $('.parent-checkbox.buyerID, .form-check-input.ProgrammeID').prop('checked', false);
        });

        $('#check_all2').on('click', function () {
            $('.sampleID').prop('checked', true);
        });

        $('#uncheck_all2').on('click', function () {
            $('.sampleID').prop('checked', false);
        });

        
       

        function handleToggle(checkboxSelector, selectSelector, sectionSelector) {
            const isChecked = $(checkboxSelector).is(':checked');

            $(selectSelector)
                .prop('disabled', isChecked)
                .val(null).trigger('change');

            $(selectSelector).toggleClass('disabled-select', isChecked);
            $(sectionSelector).toggleClass('disabled-select', isChecked);
        }
    });

    $('#start_date').on('change', function () {
        let startDate = $(this).val();
        if (startDate) {
            $('#end_date').attr('min', startDate);
        } else {
            $('#end_date').removeAttr('min');
        }
    });

    $('#end_date').on('change', function () {
        let endDate = $(this).val();
        if (endDate) {
            $('#start_date').attr('max', endDate);
        } else {
            $('#start_date').removeAttr('max');
        }
    });


    handleTitleSelection();

    // On title radio change
    $('input[name="title"]').on('change', function() {
        handleTitleSelection();
    });

    function handleTitleSelection() {
        let selectedValue = $('input[name="title"]:checked').val();
        if (selectedValue == '1') {
            $('#start_date').prop('disabled', false);
            $('#end_date').prop('disabled', false);
        } else if (selectedValue == '2') {
            console.log(selectedValue);

            $('#start_date').prop('disabled', false);
            $('#end_date').prop('disabled', false);
        } else {
            $('#start_date').prop('disabled', false);
            $('#end_date').prop('disabled', false);
        }
    }



</script>

@endpush