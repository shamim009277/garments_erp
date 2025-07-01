<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            @php
                $module = \App\Models\Administration\Module::where('is_active', 1)->where('url',$currentModule)->first();
                $menus = \App\Models\Administration\Menu::with('module','parent')->where('is_active', 1)->where('module_id',$module->id)->get();
            @endphp
            <ul class="metismenu list-unstyled" id="side-menu">
                <li>
                    <a href="{{ url('hris') }}">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>
                @foreach ($menus as $menu)
                    @if ($menu->has_child == false && $menu->parent_id == null)
                        <li>
                            <a href="{{ url($menu->module->url . '/' . $menu->url) }}">
                                <i data-feather={{ $menu->icon }}></i>
                                <span data-key="t-module">{{ $menu->title }}</span>
                            </a>
                        </li>
                    @else
                        @if ($menu->has_child == true && $menu->parent_id == null)
                            <li>
                                <a href="javascript: void(0);" class="has-arrow">
                                    <i data-feather={{ $menu->icon }}></i>
                                    <span data-key="t-authorization">{{ $menu->title }}</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    @foreach ($menu->childs as $child)
                                        <li>
                                            <a href="{{ url($menu->module->url . '/' . $menu->url . '/' . $child->url) }}">
                                                <i data-feather={{ $child->icon }}></i>
                                                <span data-key="t-role">{{ $child->title }}</span>
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
