<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function edit()
    {
        $settings = Setting::current();
        return view('admin.settings.edit', compact('settings'));
    }

    public function update(Request $request)
    {
        $settings = Setting::current();

        $validated = $request->validate([
            'site_name'         => ['required', 'string', 'max:255'],
            'tagline'           => ['nullable', 'string', 'max:255'],
            'address'           => ['nullable', 'string', 'max:500'],
            'phone'             => ['nullable', 'string', 'max:30'],
            'whatsapp'          => ['nullable', 'string', 'max:30'],
            'email'             => ['nullable', 'email', 'max:255'],
            'facebook_url'      => ['nullable', 'url', 'max:255'],
            'instagram_url'     => ['nullable', 'url', 'max:255'],
            'youtube_url'       => ['nullable', 'url', 'max:255'],
            'tiktok_url'        => ['nullable', 'url', 'max:255'],
            'footer_about'      => ['nullable', 'string', 'max:1000'],
            'meta_description'  => ['nullable', 'string', 'max:300'],
            'logo'              => ['nullable', 'image', 'max:1024'],
            'favicon'           => ['nullable', 'image', 'max:512'],
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('settings', 'public');
        }

        if ($request->hasFile('favicon')) {
            $validated['favicon'] = $request->file('favicon')->store('settings', 'public');
        }

        $settings->update($validated);

        return back()->with('status', 'সেটিংস আপডেট হয়েছে');
    }
}