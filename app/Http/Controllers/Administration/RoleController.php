<?php

namespace App\Http\Controllers\Administration;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Models\Administration\Module;
use App\Traits\ToggleStatus;

class RoleController extends Controller
{
    use ToggleStatus;

    function __construct()
    {
        $this->middleware('permission:administration.role.view')->only('index');
        $this->middleware('permission:administration.role.add')->only('store');
        $this->middleware('permission:administration.role.edit')->only(['edit', 'update','toggleStatus']);
        $this->middleware('permission:administration.role.delete')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::with('users')->get();
        return view('administration.authorization.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $datas = Module::where('is_active', 1)
            ->whereHas('menus', function ($q) {
                $q->where('is_active', 1)->whereHas('permissions', function ($q2) {
                    $q2->where('is_active', 1);
                });
            })
            ->with(['menus' => function ($query) {
                $query->where('is_active', 1)->with([
                    'permissions' => function ($query) {
                        $query->where('is_active', 1);
                    }
                ]);
            }])
            ->get();
        $role = null;
        return view('administration.authorization.role.create', compact('datas', 'role'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'permissions' => 'array',
        ]);

        try {
            $data = $request->all();
            $data['guard_name'] = 'web';
            $role = Role::create($data);
            $role->givePermissionTo($request->permissions);
            return redirect()->route('administration.authorization.role.index')->with('success', 'Role created successfully');
        } catch (\Throwable $th) {
            return redirect()->route('administration.authorization.role.index')->with('error', 'Role creation failed: ' . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = Role::findOrFail($id);
        $datas = Module::where('is_active', 1)
            ->whereHas('menus', function ($q) {
                $q->where('is_active', 1)->whereHas('permissions', function ($q2) {
                    $q2->where('is_active', 1);
                });
            })
            ->with(['menus' => function ($query) {
                $query->where('is_active', 1)->with([
                    'permissions' => function ($query) {
                        $query->where('is_active', 1);
                    }
                ]);
            }])
            ->get();
        return view('administration.authorization.role.create', compact('role', 'datas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'permissions' => 'array',
        ]);

        try {
            $role = Role::findOrFail($id);
            $role->name = $request->name;
            $role->syncPermissions($request->permissions);
            $role->save();
            return redirect()->route('administration.authorization.role.index')->with('success', 'Role updated successfully');
        } catch (\Throwable $th) {
            return redirect()->route('administration.authorization.role.index')->with('error', 'Role update failed: ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $role = Role::findOrFail($request->id);
            $role->syncPermissions([]);
            $role->delete();

            app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
            return redirect()->back()->with('success', 'Role deleted successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Role deletion failed: ' . $th->getMessage());
        }
    }

    public function toggleStatus(Request $request)
    {
        try {
            return $this->ToggleStatusTrait($request, Role::class);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Role status update failed: ' . $th->getMessage());
        }
    }
}
