@extends('layouts.app')
@section('title', isset($role) ? 'Role Update' : 'Role Create')
@push('styles')
    <style>
        input[type="checkbox"] {
            display: inline-block !important;
            opacity: 1 !important;
        }
    </style>
@endpush
@section('content')
    @php
        $isEdit = isset($role) && $role !== null;
        $assignedPermissions = $role?->permissions?->pluck('name')->toArray() ?? [];
        $assignedMenus = $role?->menus?->pluck('id')->toArray() ?? [];
        $assignedModules = $role?->modules?->pluck('id')->toArray() ?? [];
    @endphp

    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'Authorization',
                'subtitle' => 'Role',
                'breadcrumbs' => [
                    ['label' => 'Administration', 'url' => route('administration.index')],
                    ['label' => 'Role', 'url' => route('administration.authorization.role.index')],
                    ['label' => $isEdit ? 'Role Update' : 'Role Create'],
                ],
            ])
        </div>
        <div class="col-md-12">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2">
                    <h6 class="my-0 text-primary"> <i data-feather="list" style="width: 16px;"></i> {{ $isEdit ? 'Update Role' : 'Role Create' }}</h6>
                    <div class="action-btn">
                        <a href="{{ route('administration.authorization.role.index') }}" class="btn btn-primary btn-sm">
                            <i data-feather="arrow-left" style="width: 16px;"></i> Back
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ $isEdit ? route('administration.authorization.role.update', $role->id) : route('administration.authorization.role.store') }}" method="POST">
                        @csrf
                        @if($isEdit)
                            @method('PUT')
                        @endif
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">Role Name</label>
                                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $role->name ?? '') }}" required>
                                    <x-input-error :messages="$errors->get('name')" />
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <div class="form-group mt-3">
                                    <label for="permissions">Permissions List</label>
                                    <div class="row">
                                        <div class="col-12 mb-3">
                                            @foreach ($datas as $key => $data)
                                                @if ($data->menus->count() > 0)
                                                    <div class="card shadow-sm">
                                                        <div class="card-body">
                                                            {{-- Module --}}
                                                            <div class="form-check mb-2">
                                                                <input type="checkbox"
                                                                    class="form-check-input module-check"
                                                                    name="modules[]"
                                                                    value="{{ $data->id }}{{ $key }}"
                                                                    id="module_{{ $data->id }}{{ $key }}"
                                                                    data-target=".module_{{ $data->id }}{{ $key }}"
                                                                    {{ in_array($data->id, $assignedModules) ? 'checked' : '' }}>
                                                                <label class="form-check-label text-primary fw-semibold" for="module_{{ $data->id }}{{ $key }}">
                                                                    {{ $data->name }}
                                                                </label>
                                                            </div>

                                                            {{-- Menus --}}
                                                            @foreach ($data->menus as $menu)
                                                                {{-- Normal Menu (no child) --}}
                                                                @if ($menu->has_child != 1 && $menu->parent_id == null)
                                                                    <div class="mb-3 p-3 rounded shadow-sm">
                                                                        <div class="form-check mb-2">
                                                                            <input type="checkbox"
                                                                                class="form-check-input menu-check module_{{ $data->id }}{{ $key }}"
                                                                                name="menus[]"
                                                                                value="{{ $menu->id }}"
                                                                                id="menu_{{ $menu->id }}"
                                                                                data-target=".menu_{{ $menu->id }}"
                                                                                {{ in_array($menu->id, $assignedMenus) ? 'checked' : '' }}>
                                                                            <label class="form-check-label text-info fw-semibold fs-6" for="menu_{{ $menu->id }}">
                                                                                {{ $menu->title }}
                                                                            </label>
                                                                        </div>

                                                                        {{-- Permissions --}}
                                                                        <div class="row g-3 menu_{{ $menu->id }}" style="margin-left: 15px;">
                                                                            @foreach ($menu->permissions as $index => $permission)
                                                                                <div class="col-6 col-sm-4 col-md-3">
                                                                                    <div class="form-check">
                                                                                        <input class="form-check-input module_{{ $data->id }}{{ $key }} menu_{{ $menu->id }}"
                                                                                            type="checkbox"
                                                                                            name="permissions[]"
                                                                                            value="{{ $permission->name }}"
                                                                                            {{ in_array($permission->name, $assignedPermissions) ? 'checked' : '' }}>
                                                                                        <label class="form-check-label" for="perm_{{ $index }}">
                                                                                            {{ ucfirst(str_replace('.', ' ', $permission->name)) }}
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                @endif

                                                                {{-- Parent Menu with Childs --}}
                                                                @if ($menu->has_child == 1 && $menu->parent_id == null)
                                                                    <div class="mb-3 p-3 rounded shadow-sm">
                                                                        <div class="form-check mb-2">
                                                                            <input type="checkbox"
                                                                                class="form-check-input parent-menu-check module_{{ $data->id }}{{ $key }}"
                                                                                name="menus[]"
                                                                                value="{{ $menu->id }}"
                                                                                id="menu_{{ $menu->id }}"
                                                                                data-target=".parent_menu_{{ $menu->id }}"
                                                                                {{ in_array($menu->id, $assignedMenus) ? 'checked' : '' }}>
                                                                            <label class="form-check-label text-info fw-semibold fs-6" for="menu_{{ $menu->id }}">
                                                                                {{ $menu->title }}
                                                                            </label>
                                                                        </div>

                                                                        {{-- Child Menus --}}
                                                                        <div class="row g-3 parent_menu_{{ $menu->id }}" style="margin-left: 15px;">
                                                                            @foreach ($menu->childs as $child)
                                                                                <div class="form-check mb-2">
                                                                                    <input type="checkbox"
                                                                                        class="form-check-input menu-check1 module_{{ $data->id }}{{ $key }} parent_menu_{{ $menu->id }}"
                                                                                        name="menus[]"
                                                                                        value="{{ $child->id }}"
                                                                                        id="menu_{{ $child->id }}"
                                                                                        data-target=".menu_{{ $child->id }}"
                                                                                        {{ in_array($child->id, $assignedMenus) ? 'checked' : '' }}>
                                                                                    <label class="form-check-label text-info fw-semibold fs-6" for="menu_{{ $child->id }}">
                                                                                        {{ $child->title }}
                                                                                    </label>
                                                                                </div>

                                                                                {{-- Child Permissions --}}
                                                                                @foreach ($child->permissions as $index => $permission)
                                                                                    <div class="col-6 col-sm-4 col-md-3 menu_{{ $child->id }}" style="margin:0px !important">
                                                                                        <div class="form-check" style="margin-left: 15px !important">
                                                                                            <input class="form-check-input module_{{ $data->id }}{{ $key }} menu_{{ $child->id }} parent_menu_{{ $menu->id }}"
                                                                                                type="checkbox"
                                                                                                name="permissions[]"
                                                                                                value="{{ $permission->name }}"
                                                                                                id="perm_{{ $index }}"
                                                                                                {{ in_array($permission->name, $assignedPermissions) ? 'checked' : '' }}>
                                                                                            <label class="form-check-label" for="perm_{{ $index }}">
                                                                                                {{ ucfirst(str_replace('.', ' ', $permission->name)) }}
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                @endforeach
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>

                                    </div>
                                    <x-input-error :messages="$errors->get('permissions')" />
                                </div>
                            </div>
                        </div>
                        <x-primary-button class="float-start btn-md submitBtn mt-3">{{ $isEdit ? 'Update Role' : 'Add Permission' }}</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            // ===== Module Check =====
            $(document).on('change', '.module-check', function () {
                let card = $(this).closest('.card');
                card.find('input[type="checkbox"]').prop('checked', $(this).prop('checked'));
            });

            // ===== Parent Menu Check =====
            $(document).on('change', '.parent-menu-check', function () {
                let parentDiv = $(this).closest('.mb-3.p-3');
                parentDiv.find('input[type="checkbox"]').prop('checked', $(this).prop('checked'));
                updateModuleCheck($(this).closest('.card'));
            });

            // ===== Normal Menu Check =====
            $(document).on('change', '.menu-check', function () {
                let menuDiv = $(this).closest('.mb-3.p-3');
                menuDiv.find('input[type="checkbox"]').prop('checked', $(this).prop('checked'));
                updateModuleCheck($(this).closest('.card'));
            });

            // ===== Child Menu Check =====
            $(document).on('change', '.menu-check1', function () {
                let childCheckbox = $(this);

                // শুধুমাত্র নিজে এবং তার permission চেক/আনচেক হবে
                let childId = childCheckbox.val();
                $('.menu_' + childId).prop('checked', childCheckbox.prop('checked'));

                // parent menu check update
                let parentDiv = childCheckbox.closest('.parent_menu_' + childCheckbox.closest('.parent_menu_' + childCheckbox.data('target').replace('.', '')).attr('class').split(' ')[0].replace('.', ''));
                if (!parentDiv.length) {
                    // direct parentDiv selector fail হলে closest parent row
                    parentDiv = childCheckbox.closest('.row').closest('.parent_menu_' + childCheckbox.closest('.row').attr('class').split(' ')[0].replace('.', ''));
                }
                updateParentCheck(childCheckbox);

                // module check update
                updateModuleCheck(childCheckbox.closest('.card'));
            });

            // ===== Permission Check =====
            $(document).on('change', 'input[name="permissions[]"]', function () {
                let checkbox = $(this);
                let row = checkbox.closest('.row');
                if (row.length === 0) return;

                // menu checkbox update
                let menuCheckbox = row.prevAll('input[type="checkbox"]').first();
                if (menuCheckbox.length > 0) {
                    let allPermChecked = row.find('input[type="checkbox"]').length === row.find('input[type="checkbox"]:checked').length;
                    menuCheckbox.prop('checked', allPermChecked);
                }

                // parent menu update
                updateParentCheck(checkbox);

                // module update
                updateModuleCheck(checkbox.closest('.card'));
            });

            // -------- Helper Functions --------
            function updateParentCheck(element) {
                let parentDiv = element.closest('.parent_menu_' + element.closest('.row').attr('class').split(' ')[0].replace('.', ''));
                if (parentDiv.length === 0) return;

                parentDiv.each(function () {
                    let allChildChecked = $(this).find('.menu-check1').length === $(this).find('.menu-check1:checked').length;
                    $(this).closest('.mb-3.p-3').find('.parent-menu-check').prop('checked', allChildChecked);
                });
            }

            function updateModuleCheck(card) {
                let parentMenus = card.find('.parent-menu-check');
                if (parentMenus.length > 0) {
                    let allParentChecked = parentMenus.length === parentMenus.filter(':checked').length;
                    card.find('.module-check').prop('checked', allParentChecked);
                } else {
                    let normalMenus = card.find('.menu-check');
                    if (normalMenus.length > 0) {
                        let allMenuChecked = normalMenus.length === normalMenus.filter(':checked').length;
                        card.find('.module-check').prop('checked', allMenuChecked);
                    }
                }
            }
        });
    </script>
@endpush
