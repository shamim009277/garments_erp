<?php

namespace Modules\HRIS\Http\Controllers\Settings;

use Illuminate\Http\Request;
use Modules\HRIS\Models\Setting;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\HRIS\Http\Requests\SettingRequest;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $setting = Setting::active()->first();
        return view('hris::setting.index', compact('setting'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('hris::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SettingRequest $request) {
        try {
            if ($request->tab == 1) {
                $validated = $request->validated();
                $setting = Setting::find($request->id);

                if ($setting) {
                    $setting->fill($validated);

                    if ($setting->isDirty()) {
                        $setting->updated_by = Auth::id();
                        $setting->save();

                        return redirect()->back()->with('success', 'Setting updated successfully');
                    } else {
                        return redirect()->back()->with('info', 'No changes detected');
                    }
                } else {
                    Setting::create(array_merge($validated, [
                        'created_by' => Auth::id(),
                        'updated_by' => Auth::id(),
                    ]));

                    return redirect()->back()->with('success', 'Setting created successfully');
                }
            }

            return redirect()->back()->with('success', 'No action performed');

        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Setting update failed: ' . $th->getMessage());
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('hris::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('hris::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}
}
