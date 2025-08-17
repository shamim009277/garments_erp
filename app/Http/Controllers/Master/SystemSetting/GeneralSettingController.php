<?php

namespace App\Http\Controllers\Master\SystemSetting;

use Illuminate\Http\Request;
use App\Services\FileUploadService;
use App\Http\Controllers\Controller;
use App\Models\Master\GeneralSetting;

class GeneralSettingController extends Controller
{
    public function generalSettings()
    {
        $generalSettings = GeneralSetting::first();
        return view('master.system-setting.general-setting.setting', compact('generalSettings'));
    }

    public function generalSettingsStore(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:50',
            'short_name' => 'required|string|max:20',
            'logo' => 'nullable|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'favicon' => 'nullable|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        try {
            if ($request->id) {
                $generalSettings = GeneralSetting::findOrFail($request->id);
            } else {
                $generalSettings = new GeneralSetting();
            }
            $generalSettings->full_name = $request->full_name;
            $generalSettings->short_name = $request->short_name;
            $generalSettings->footer_text = $request->footer_text;
            $generalSettings->created_by = auth()->user()->id;
            $generalSettings->updated_by = auth()->user()->id;

            $fileUploadService = new FileUploadService();

            if ($request->hasFile('logo')) {
                $logo = $request->file('logo');
                $logoPath = $fileUploadService->upload($logo, 'logo', []);
                $generalSettings->logo = $logoPath['name'];
                $generalSettings->logo_path = $logoPath['path'];
            }

            if ($request->hasFile('favicon')) {
                $favicon = $request->file('favicon');
                $faviconPath = $fileUploadService->upload($favicon, 'favicon', []);
                $generalSettings->favicon = $faviconPath['name'];
                $generalSettings->favicon_path = $faviconPath['path'];
            }

            if ($generalSettings->isDirty()) {
                $generalSettings->save();

                //Clear cache
                cache()->forget('general_settings');
                return back()->with('success', 'Settings updated successfully!');
            } else {
                return back()->with('info', 'No changes detected, nothing to update.');
            }
        } catch (\Throwable $th) {
            return redirect()->route('master.system-settings.general-settings')->with('error', 'General Settings Updated Failed: ' . $th->getMessage());
        }

        return redirect()->route('master.system-settings.general-settings')->with('success', 'General Settings Updated Successfully');
    }
}
