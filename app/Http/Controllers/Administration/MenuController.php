<?php

namespace App\Http\Controllers\Administration;

use Illuminate\Http\Request;
use App\Models\Administration\Menu;
use App\Http\Controllers\Controller;
use App\Models\Administration\Module;
use App\Http\Requests\Administration\MenuRequest;
use Yajra\DataTables\Facades\DataTables;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $menus = Menu::select('id', 'title', 'url', 'is_active')->get();
        $modules = Module::select('id', 'name')->get();

        if ($request->ajax()) {
            $data = Menu::select('menus.*')
                ->leftJoin('modules', 'modules.id', '=', 'menus.module_id')
                ->when($request->module_id, function ($query) use ($request) {
                    $query->where('menus.module_id', $request->module_id);
                })
                ->with(['parent' => function($query) {
                    $query->select('id', 'title');
                }])
                ->addSelect('modules.name as module_name');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('module_name', function ($row) {
                    return $row->module_name ?? '-';
                })
                ->addColumn('parent_name', function ($row) {
                    return $row->parent->title ?? '-';
                })
                ->editColumn('is_active', function ($row) {
                    return '
                        <div class="square-switch">
                            <input type="checkbox" id="square-switch3' . $row->id . '"
                                class="menu-toggle"
                                data-id="' . $row->id . '"
                                switch="bool"
                                ' . ($row->is_active ? 'checked' : '') . ' />
                            <label for="square-switch3' . $row->id . '"
                                data-on-label="Yes"
                                data-off-label="No"
                                style="margin: 0px; vertical-align: middle;"></label>
                        </div>
                    ';
                })
                ->editColumn('has_child', function ($row) {
                    return $row->has_child ? 'Yes' : 'No';
                })
                ->addColumn('action', function ($row) {
                    return '
                        <a href="#" class="btn btn-soft-success waves-effect waves-light" style="padding: 4px 6px;"
                           data-bs-toggle="modal" data-bs-target="#editModal' . $row->id . '">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="#" class="btn btn-soft-danger waves-effect waves-light delete-menu"
                           data-id="' . $row->id . '" style="padding: 4px 6px;">
                            <i class="fas fa-trash"></i>
                        </a>
                    ';
                })
                ->rawColumns(['is_active', 'action'])
                ->orderColumn('module_name', function ($query, $order) {
                    $query->join('modules', 'modules.id', '=', 'menus.module_id')
                        ->orderBy('modules.name', $order);
                })
                ->make(true);
        }

        return view('administration.menu.index', compact('menus', 'modules'));
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
    public function store(MenuRequest $request)
    {
        try {
            Menu::create($request->validated());
            return redirect()->back()->with('success', 'Menu created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Menu creation failed: ' . $e->getMessage());
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

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MenuRequest $request, string $id)
    {
        try {
            Menu::findOrFail($id)->update($request->validated());
            return redirect()->back()->with('success', 'Menu updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Menu update failed: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            Menu::find($request->id)->delete();
            return response()->json(['success' => true, 'message' => 'Menu deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Menu deletion failed: ' . $e->getMessage()]);
        }
    }

    public function toggleStatus(Request $request)
    {
        try {
            Menu::findOrFail($request->id)->update(['is_active' => $request->status]);
            return response()->json(['success' => true, 'message' => 'Menu status updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Menu status update failed: ' . $e->getMessage()]);
        }
    }

    public function getMenuParents($id)
    {
        $parents = Menu::where('module_id', $id)->get();
        return response()->json($parents);
    }
}
