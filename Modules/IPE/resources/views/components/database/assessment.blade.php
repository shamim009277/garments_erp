<div class="card alert-primary alert-top-border padding-card">

    <div class="card-header">
        <h6 class="my-0 text-primary">
            <i data-feather="list" width="18" height="18"></i>
            {{ $title }}
        </h6>
    </div>

    <div class="card-body" style="min-height:460px; max-height:670px; overflow-y:auto;">

        @php
            $companyWise = collect($pendingApplicants)->groupBy('org_id');
        @endphp

        <ul class="nav-custom">

            @foreach ($companyWise as $companyId => $companyApplicants)

                @php
                    $companyName = $companyApplicants->first()->Organization->short_name ?? 'N/A';
                    $departmentWise = $companyApplicants->groupBy('department_id');

                    $isCompanyActive = $uniqueApplicant && $uniqueApplicant->org_id == $companyId;
                @endphp

                <li class="nav-custom-item">

                    <input type="checkbox" id="company{{ $companyId }}" {{ $isCompanyActive ? 'checked' : '' }}>

                    <label class="nav-custom-link" for="company{{ $companyId }}"
                        style="{{ $isCompanyActive ? 'background:#f2b14b;border-radius:3px;' : '' }}">

                        <span class="nav-custom-caret"></span>
                        {{ $companyName }} ({{ $companyApplicants->count() }})
                    </label>

                    <ul class="nav-custom-content">

                        @foreach ($departmentWise as $departmentId => $departmentApplicants)
                            @php
                                $departmentName = $departmentApplicants->first()->department->department ?? 'N/A';

                                $dateWise = $departmentApplicants->groupBy('entry_date');

                                $isDepartmentActive =
                                    $uniqueApplicant &&
                                    $uniqueApplicant->org_id == $companyId &&
                                    $uniqueApplicant->department_id == $departmentId;
                            @endphp

                            <li class="nav-custom-item">

                                <input type="checkbox" id="dept{{ $companyId }}-{{ $departmentId }}"
                                    {{ $isDepartmentActive ? 'checked' : '' }}>

                                <label class="nav-custom-link" for="dept{{ $companyId }}-{{ $departmentId }}"
                                    style="{{ $isDepartmentActive ? 'background:#D75350;border-radius:3px;' : '' }}">

                                    <span class="nav-custom-caret"></span>
                                    {{ $departmentName }}
                                    ({{ $departmentApplicants->count() }})
                                </label>

                                <ul class="nav-custom-content">

                                    @foreach ($dateWise as $entryDate => $dateApplicants)
                                        @php
                                            $isDateActive =
                                                $uniqueApplicant &&
                                                $uniqueApplicant->org_id == $companyId &&
                                                $uniqueApplicant->department_id == $departmentId &&
                                                $uniqueApplicant->entry_date == $entryDate;
                                        @endphp

                                        <li class="nav-custom-item">

                                            <input type="checkbox"
                                                id="date{{ $companyId }}-{{ $departmentId }}-{{ $entryDate }}"
                                                {{ $isDateActive ? 'checked' : '' }}>

                                            <label class="nav-custom-link"
                                                for="date{{ $companyId }}-{{ $departmentId }}-{{ $entryDate }}"
                                                style="{{ $isDateActive ? 'background:#75bcf5;border-radius:3px;' : '' }}">

                                                <span class="nav-custom-caret"></span>

                                                {{ \Carbon\Carbon::parse($entryDate)->format('d-M-Y') }}
                                                ({{ $dateApplicants->count() }})
                                            </label>

                                            <div class="nav-custom-content">
                                                @foreach ($dateApplicants as $applicant)
                                                    @php
                                                        $assessment = $applicant->assessment;
                                                        $isActive =
                                                            $uniqueApplicant &&
                                                            $uniqueApplicant->id == ($assessment->id ?? $applicant->id);
                                                    @endphp

                                                    @if ($assessment)
                                                        <a href="{{ route('ipe.database.assessments.show', $assessment->id) }}" class="employee-link" style="{{ $isActive ? 'color:#fff;background:#4549A2;border-radius:3px;' : '' }}">
                                                            {{ $applicant->id }} :: {{ strtoupper($applicant->name) }}
                                                        </a>
                                                    @else
                                                        <a href="javascript:void(0)" data-id="{{ $applicant->id }}"
                                                            data-org_id="{{ $applicant->org_id }}"
                                                            data-name="{{ $applicant->name }}"
                                                            data-name_bn="{{ $applicant->name_bangla }}"
                                                            data-entry_date="{{ $applicant->entry_date }}"
                                                            data-mobile="{{ $applicant->mobile }}"
                                                            data-line="{{ $applicant->line }}"
                                                            data-designation_id="{{ $applicant->designation_id }}"
                                                            class="employee-link employee-show"
                                                            style="{{ $isActive ? 'color:#fff;background:#4549A2;border-radius:3px;' : '' }}">

                                                            {{ $applicant->id }} :: {{ strtoupper($applicant->name) }}
                                                        </a>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>
    </div>
</div>
