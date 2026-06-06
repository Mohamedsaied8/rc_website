<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteSetting;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::orderBy('key')->get();
        return view('admin.settings.index', compact('settings'));
    }

    public function edit(SiteSetting $setting)
    {
        return view('admin.settings.edit', compact('setting'));
    }

    public function update(Request $request, SiteSetting $setting)
    {
        $request->validate([
            'value' => 'required|string|max:1000',
        ]);

        $setting->update([
            'value' => $request->value,
        ]);

        return redirect()->route('admin.settings.index')
            ->with('success', 'Setting updated successfully.');
    }
}
