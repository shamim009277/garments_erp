<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            @php
                $module = \App\Models\Administration\Module::where('is_active', 1)
                    ->where('url', $currentModule)
                    ->first();

                $menus = \App\Models\Administration\Menu::with([
                        'module' => function ($q) { $q->where('is_active', 1); },
                        'parent' => function ($q) { $q->where('is_active', 1); },
                        'permissions' => function ($q) { $q->where('is_active', 1); },
                        'childs.permissions' => function ($q) { $q->where('is_active', 1); }
                    ])
                    ->where('is_active', 1)
                    ->whereHas('module', function ($q) { $q->where('is_active', 1); })
                    ->where(function ($query) {
                        $query->whereNull('parent_id')->orWhereHas('parent', function ($q) {
                            $q->where('is_active', 1);
                        });
                    })
                    ->where('module_id', $module->id)
                    ->get();

                $userPermissions = auth()->check()
                    ? collect(auth()->user()->getAllPermissions()->pluck('name')->toArray())
                    : collect([]);
            @endphp
            <ul class="metismenu list-unstyled" id="side-menu">
                <li>
                    <a href="{{ url($currentModule) }}">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>

                @foreach ($menus as $menu)
                    {{-- leaf menu (no child) --}}
                    @if ($menu->has_child == false && $menu->parent_id == null)
                        @php
                            $menuViewPerms = $menu->permissions
                                ->pluck('name')
                                ->filter(function($n) {
                                    return \Illuminate\Support\Str::endsWith($n, '.view');
                                });
                        @endphp

                        @if ($menuViewPerms->intersect($userPermissions)->isNotEmpty())
                            <li>
                                <a href="{{ url($menu->module->url . '/' . $menu->url) }}">
                                    <i data-feather="{{ $menu->icon }}"></i>
                                    <span>{{ $menu->title }}</span>
                                </a>
                            </li>
                        @endif

                    {{-- parent menu with childs --}}
                    @elseif ($menu->has_child == true && $menu->parent_id == null)
                        @php
                            $visibleChilds = $menu->childs->filter(function($child) use ($userPermissions) {
                                $childViewPerms = $child->permissions
                                    ->pluck('name')
                                    ->filter(function($n) {
                                        return \Illuminate\Support\Str::endsWith($n, '.view');
                                    });
                                return $childViewPerms->intersect($userPermissions)->isNotEmpty();
                            });
                        @endphp

                        @if ($visibleChilds->isNotEmpty())
                            <li>
                                <a href="javascript: void(0);" class="has-arrow">
                                    <i data-feather="{{ $menu->icon }}"></i>
                                    <span>{{ $menu->title }} ({{ $visibleChilds->count() }})</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false" style="max-height: 600px;overflow-x:hidden;overflow-y:auto">
                                    @foreach ($visibleChilds as $child)
                                        <li>
                                            <a href="{{ url($menu->module->url . '/' . $menu->url . '/' . $child->url) }}">
                                                <i data-feather="{{ $child->icon }}"></i>
                                                <span>{{ $child->title }}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                    @endif
                @endforeach
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
