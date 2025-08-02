@extends('layouts.app')
@section('title', 'HRIS')
@section('content')
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
    </style>
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'HRIS',
                'subtitle' => 'Employee Listing',
                'breadcrumbs' => [
                    ['label' => 'HRIS', 'url' => route('hris.index')],
                    ['label' => 'Report', 'url' => route('hris.index')],
                    ['label' => 'Employee Listing', 'url' => route('hris.report.employee-listings.index')],
                ],
            ])
        </div>
        <div class="col-lg-12 pr-0">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Employee Listing</h6>
                </div>
                <div class="card-body">
                    <form id="employeeListingForm">
                        <div class="row">
                            <!-- Titles -->
                            <div class="col-lg-4 mb-3">
                                <div class="card alert-info alert-top-border" style="max-height:460px;min-height:460px;">
                                    <div class="card-header">
                                        <h6 class="my-0 text-primary"> <i data-feather="list" width="16"height="16"></i> Preview Title's</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-check">
                                            <input type="radio" id="title1" name="title" value="1"class="form-check-input titles" checked>
                                            <label class="form-check-label" for="title1">Department-wise Listing of Employees</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" id="title2" name="title" value="2"class="form-check-input titles">
                                            <label class="form-check-label" for="title2">Designation-wise Listing of Employees</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" id="title5" name="title" value="5"class="form-check-input titles">
                                            <label class="form-check-label" for="title5">Employees Joined Within Date Range</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" id="title14" name="title" value="14"class="form-check-input titles">
                                            <label class="form-check-label" for="title14">Employees With Blood Group</label>
                                        </div>
                                    </div>
                                    <div class="card-footer"></div>
                                </div>
                            </div>

                            <!-- Department & Designation -->
                            <div class="col-lg-5 mb-3">
                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <div class="card alert-info alert-top-border"
                                            style="max-height:460px;min-height:460px;">
                                            <div class="card-header">
                                                <h6 class="my-0 text-primary"> <i data-feather="list" width="16"
                                                        height="16"></i> Department</h6>
                                            </div>
                                            <div class="card-body">

                                                <!-- Sample departments -->
                                                <div class="department-list">
                                                    <!-- Parent 1 -->
                                                    <div class="parent-wrapper">
                                                        <label class="parent-label">
                                                            <span class="toggle-btn" data-target="children-1">[+]</span>
                                                            <input type="checkbox" class="parent-checkbox" data-id="1">
                                                            Administration

                                                        </label>
                                                        <div class="collapse" id="children-1">
                                                            <label><input type="checkbox"
                                                                    class="form-check-input child-of-1"> Admin
                                                                Office</label><br>
                                                            <label><input type="checkbox"
                                                                    class="form-check-input child-of-1"> Admin IT</label>
                                                        </div>
                                                    </div>

                                                    <!-- Parent 2 -->
                                                    <div class="parent-wrapper">
                                                        <label class="parent-label">
                                                            <span class="toggle-btn" data-target="children-2">[+]</span>
                                                            <input type="checkbox" class="parent-checkbox" data-id="2">
                                                            Production

                                                        </label>
                                                        <div class="collapse" id="children-2">
                                                            <label><input type="checkbox"
                                                                    class="form-check-input child-of-2"> Cutting</label><br>
                                                            <label><input type="checkbox"
                                                                    class="form-check-input child-of-2"> Sewing</label><br>
                                                            <label><input type="checkbox"
                                                                    class="form-check-input child-of-2"> Finishing</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                id="check_all">Check All</button>
                                            <button type="button" class="btn btn-sm btn-outline-danger"
                                                id="uncheck_all">Uncheck All</button>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 mb-3">
                                        <div class="card alert-info alert-top-border"
                                            style="max-height:460px;min-height:460px;">
                                            <div class="card-header">
                                                <h6 class="my-0 text-primary"> <i data-feather="list" width="16"
                                                        height="16"></i> Designation</h6>
                                            </div>
                                            <div class="card-body">
                                                <label class="font-weight-bold d-block">Designation</label>
                                                <div class="overflow-auto"
                                                    style="max-height:460px;min-height:460px;">
                                                    <!-- Sample designations -->
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input DesignationID"
                                                            id="desg1" checked>
                                                        <label class="form-check-label" for="desg1">Manager</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input DesignationID"
                                                            id="desg2" checked>
                                                        <label class="form-check-label" for="desg2">Officer</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input DesignationID"
                                                            id="desg3" checked>
                                                        <label class="form-check-label" for="desg3">Operator</label>
                                                    </div>
                                                    <!-- ... -->
                                                </div>
                                                <div class="mt-2">
                                                    <button type="button" class="btn btn-sm btn-outline-primary"
                                                        id="check_all2">Check All</button>
                                                    <button type="button" class="btn btn-sm btn-outline-danger"
                                                        id="uncheck_all2">Uncheck All</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Filters -->
                                    <div class="col-lg-3 mb-3">
                                        <table class="table table-sm">
                                            <tbody>
                                                <tr>
                                                    <th>Employee ID</th>
                                                    <td colspan="2">
                                                        <div class="d-flex">
                                                            <input type="number" class="form-control mr-1"
                                                                id="EmployeeF" placeholder="From">
                                                            <input type="number" class="form-control" id="EmployeeL"
                                                                placeholder="To">
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th><input type="checkbox" id="AllCategory" checked> <label
                                                            for="AllCategory">All Category</label></th>
                                                    <td colspan="2">
                                                        <select id="CategoryID" class="form-control category" disabled>
                                                            <option selected>Select One</option>
                                                            <option>Staff</option>
                                                            <option>Worker</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th><input type="checkbox" id="AllLine" checked> <label
                                                            for="AllLine">All Line</label></th>
                                                    <td colspan="2"><input type="number" id="Line"
                                                            class="form-control" placeholder="Line" disabled></td>
                                                </tr>
                                                <tr>
                                                    <th><input type="checkbox" id="AllDistrict" checked> <label
                                                            for="AllDistrict">All District</label></th>
                                                    <td colspan="2">
                                                        <select id="DistrictID" class="form-control" disabled>
                                                            <option selected>Select One</option>
                                                            <option>Dhaka</option>
                                                            <option>Chittagong</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th><input type="checkbox" id="AllBloodGroup" checked> <label
                                                            for="AllBloodGroup">All Blood Group</label></th>
                                                    <td colspan="2">
                                                        <select id="BloodGroup" class="form-control" disabled>
                                                            <option selected>Select One</option>
                                                            <option>A+</option>
                                                            <option>B+</option>
                                                            <option>O+</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th><input type="checkbox" id="AllReason" checked> <label
                                                            for="AllReason">All Reason</label></th>
                                                    <td colspan="2">
                                                        <select id="ReasonID" class="form-control" disabled>
                                                            <option selected>Select One</option>
                                                            <option>Resigned</option>
                                                            <option>Terminated</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Start Date</th>
                                                    <td colspan="2"><input type="date" id="StartDate"
                                                            class="form-control" disabled></td>
                                                </tr>
                                                <tr>
                                                    <th>End Date</th>
                                                    <td colspan="2"><input type="date" id="EndDate"
                                                            class="form-control" disabled></td>
                                                </tr>
                                                <tr>
                                                    <th>Religion</th>
                                                    <td colspan="2">
                                                        <select id="ReligionID" class="form-control" disabled>
                                                            <option selected>Select One</option>
                                                            <option>Islam</option>
                                                            <option>Hinduism</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Date</th>
                                                    <td colspan="2"><input type="date" id="Date"
                                                            class="form-control"></td>
                                                </tr>
                                                <tr>
                                                    <th>View Mode</th>
                                                    <td colspan="2">
                                                        <select id="viewmode" class="form-control">
                                                            <option value="1">Normal View</option>
                                                            <option value="2" selected>PDF View</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" class="text-right">
                                                        <button type="submit" class="btn btn-success">Preview</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Toggle collapse
        document.querySelectorAll('.toggle-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const target = document.getElementById(this.dataset.target);
                const isOpen = target.style.display === 'block';
                target.style.display = isOpen ? 'none' : 'block';
                this.textContent = isOpen ? '[+]' : '[-]';
            });
        });

        // Parent checkbox controls children
        document.querySelectorAll('.parent-checkbox').forEach(parent => {
            parent.addEventListener('change', function() {
                const id = this.dataset.id;
                document.querySelectorAll(`.child-of-${id}`).forEach(child => {
                    child.checked = this.checked;
                });
            });
        });

        // Children affect parent
        document.querySelectorAll('.form-check-input').forEach(child => {
            child.addEventListener('change', function() {
                const parentId = Array.from(this.classList).find(cls => cls.startsWith('child-of-')).split(
                    '-').pop();
                const children = document.querySelectorAll(`.child-of-${parentId}`);
                const parent = document.querySelector(`.parent-checkbox[data-id="${parentId}"]`);
                const anyChecked = Array.from(children).some(cb => cb.checked);
                parent.checked = anyChecked;
            });
        });
        // Department check/uncheck
        document.getElementById('check_all').addEventListener('click', () => {
            document.querySelectorAll('.DepartmentID').forEach(cb => cb.checked = true);
        });
        document.getElementById('uncheck_all').addEventListener('click', () => {
            document.querySelectorAll('.DepartmentID').forEach(cb => cb.checked = false);
        });

        // Designation check/uncheck
        document.getElementById('check_all2').addEventListener('click', () => {
            document.querySelectorAll('.DesignationID').forEach(cb => cb.checked = true);
        });
        document.getElementById('uncheck_all2').addEventListener('click', () => {
            document.querySelectorAll('.DesignationID').forEach(cb => cb.checked = false);
        });
    </script>
@endpush
