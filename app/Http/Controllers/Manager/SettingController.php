<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        // Get existing settings or set empty strings
        $settings = [
            'footer_desc' => Setting::where('key', 'footer_desc')->value('value') ?? 'Official Cijeungjing luxury supercar showroom. Authorized partner for high-performance exotics, certified pre-owned supercars, and factory-trained racing maintenance.',
            'social_instagram' => Setting::where('key', 'social_instagram')->value('value') ?? '#',
            'social_youtube' => Setting::where('key', 'social_youtube')->value('value') ?? '#',
            'social_facebook' => Setting::where('key', 'social_facebook')->value('value') ?? '#',
            'social_linkedin' => Setting::where('key', 'social_linkedin')->value('value') ?? '#',
            'dealer_latitude' => Setting::where('key', 'dealer_latitude')->value('value') ?? '-7.32740000',
            'dealer_longitude' => Setting::where('key', 'dealer_longitude')->value('value') ?? '108.32250000',
        ];

        return view('manager.settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'footer_desc' => 'nullable|string',
            'social_instagram' => 'nullable|string',
            'social_youtube' => 'nullable|string',
            'social_facebook' => 'nullable|string',
            'social_linkedin' => 'nullable|string',
            'dealer_latitude' => 'nullable|string',
            'dealer_longitude' => 'nullable|string',
        ]);

        foreach ($data as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value ?? '']
            );
        }

        return redirect()->back()->with('success', 'Pengaturan berhasil diperbarui.');
    }
}
