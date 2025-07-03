<?php

namespace App\Http\Controllers\Administration;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Administration\Menu;
use App\Http\Controllers\Controller;
use App\Models\Administration\Module;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;
use App\Traits\ToggleStatus;

class PermissionController extends Controller
{
    use ToggleStatus;

    function __construct()
    {
        $this->middleware('permission:administration.permissions.view')->only('index');
        $this->middleware('permission:administration.permissions.add')->only('store');
        $this->middleware('permission:administration.permissions.edit')->only(['edit', 'update','toggleStatus']);
        $this->middleware('permission:administration.permissions.delete')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $modules = Module::select('id', 'name')->get();

        if ($request->ajax()) {
            $data = Permission::select('permissions.*')
                ->leftJoin('modules', 'modules.id', '=', 'permissions.module_id')
                ->with([
                    'menu:id,title',
                ])
                ->addSelect('modules.name as module_name');

            return DataTables::of($data)
                ->addIndexColumn()

                ->filterColumn('module_name', function ($query, $keyword) {
                    $query->where('modules.name', 'like', "%{$keyword}%");
                })
                ->filterColumn('menu_name', function ($query, $keyword) {
                    $query->whereHas('menu', function ($q) use ($keyword) {
                        $q->where('title', 'like', "%{$keyword}%");
                    });
                })

                ->filter(function ($query) use ($request) {
                    if ($request->has('search') && $request->search['value'] != '') {
                        $search = $request->search['value'];
                        $query->where(function ($q) use ($search) {
                            $q->where('permissions.name', 'like', "%{$search}%");
                        });
                    }
                    if ($request->module_id) {
                        $query->where('permissions.module_id', $request->module_id);
                    }
                    if ($request->menu_id) {
                        $query->where('permissions.menu_id', $request->menu_id);
                    }
                })
                ->addColumn('module_name', function ($row) {
                    return $row->module_name ?? '-';
                })
                ->addColumn('menu_name', function ($row) {
                    return $row->menu->title ?? '-';
                })
                ->editColumn('is_active', function ($row) {
                    return '
                    <div class="square-switch">
                        <input type="checkbox" id="square-switch3' . $row->id . '"class="permission-toggle" data-id="' . $row->id . '" switch="bool" ' . ($row->is_active ? 'checked' : '') . ' />
                        <label for="square-switch3' . $row->id . '" data-on-label="Yes" data-off-label="No" style="margin: 0px; vertical-align: middle;"></label>
                    </div>';
                })
                ->addColumn('action', function ($row) {
                    return '
                    <a href="#" class="btn btn-soft-success waves-effect waves-light edit-permission" style="padding: 2px 4px;" data-id="' . $row->id . '">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="#" class="btn btn-soft-danger waves-effect waves-light delete-permission" data-id="' . $row->id . '" style="padding: 2px 4px;">
                        <i class="fas fa-trash"></i>
                    </a>';
                })
                ->rawColumns(['action', 'is_active'])
                ->orderColumn('module_name', function ($query, $order) {
                    $query->orderBy('modules.name', $order);
                })
                ->make(true);
        }
        return view('administration.authorization.permission.index', compact('modules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'module_id' => 'required',
            'menu_id' => 'required',
            'permission' => 'required',
            'is_active' => 'required',
        ]);

        try {
            $actions = array_map('trim', explode(',', $request->permission));

            // module ও menu খুঁজে আনছে
            $module = Module::findOrFail($request->module_id);
            $menu = Menu::findOrFail($request->menu_id);


            $moduleSlug = strtolower($module->slug);
            $menuSlug = strtolower($menu->slug);

            foreach ($actions as $action) {
                $permissionName = "{$moduleSlug}.{$menuSlug}." . strtolower($action);

                Permission::firstOrCreate([
                    'name' => $permissionName,
                    'guard_name' => 'web',
                ], [
                    'module_id' => $request->module_id,
                    'menu_id' => $request->menu_id,
                    'is_active' => $request->is_active,
                ]);
            }
            return redirect()->back()->with('success', 'Permission created successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Permission creation failed: ' . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $permission = Permission::findOrFail($id);
        return response()->json($permission);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'is_active' => 'required',
        ]);

        try {
            $permission = Permission::findOrFail($id);
            $permission->update([
                'name' => $request->name,
                'is_active' => $request->is_active,
            ]);
            return redirect()->back()->with('success', 'Permission updated successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Permission update failed: ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $permission = Permission::findOrFail($request->id);
            $permission->roles()->detach();
            $permission->users()->detach();
            $permission->delete();

            app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
            return redirect()->back()->with('success', 'Permission deleted successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Permission deletion failed: ' . $th->getMessage());
        }
    }

    public function toggleStatus(Request $request)
    {
        return $this->ToggleStatusTrait($request, Permission::class);
    }
}
