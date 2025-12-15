<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Show the settings form
     */
    public function index()
    {
        $settings = [
            'business_name' => Settings::getValue('business_name', 'ZozoLand'),
            'business_address' => Settings::getValue('business_address', ''),
            'business_phone' => Settings::getValue('business_phone', ''),
            'google_maps_link' => Settings::getValue('google_maps_link', ''),
            'opening_time' => Settings::getValue('opening_time', '10:00'),
            'closing_time' => Settings::getValue('closing_time', '22:00'),
            'is_open_monday' => Settings::getValue('is_open_monday', 'true') === 'true',
            'is_open_tuesday' => Settings::getValue('is_open_tuesday', 'true') === 'true',
            'is_open_wednesday' => Settings::getValue('is_open_wednesday', 'true') === 'true',
            'is_open_thursday' => Settings::getValue('is_open_thursday', 'true') === 'true',
            'is_open_friday' => Settings::getValue('is_open_friday', 'true') === 'true',
            'is_open_saturday' => Settings::getValue('is_open_saturday', 'true') === 'true',
            'is_open_sunday' => Settings::getValue('is_open_sunday', 'true') === 'true',
            'monday_open' => Settings::getValue('monday_open', '10:00'),
            'monday_close' => Settings::getValue('monday_close', '22:00'),
            'tuesday_open' => Settings::getValue('tuesday_open', '10:00'),
            'tuesday_close' => Settings::getValue('tuesday_close', '22:00'),
            'wednesday_open' => Settings::getValue('wednesday_open', '10:00'),
            'wednesday_close' => Settings::getValue('wednesday_close', '22:00'),
            'thursday_open' => Settings::getValue('thursday_open', '10:00'),
            'thursday_close' => Settings::getValue('thursday_close', '22:00'),
            'friday_open' => Settings::getValue('friday_open', '10:00'),
            'friday_close' => Settings::getValue('friday_close', '22:00'),
            'saturday_open' => Settings::getValue('saturday_open', '10:00'),
            'saturday_close' => Settings::getValue('saturday_close', '22:00'),
            'sunday_open' => Settings::getValue('sunday_open', '10:00'),
            'sunday_close' => Settings::getValue('sunday_close', '22:00'),
        ];

        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Update settings
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'business_name' => 'required|string|max:255',
            'business_address' => 'required|string',
            'business_phone' => 'required|string|max:20',
            'google_maps_link' => 'required|url',
            'opening_time' => 'required|date_format:H:i',
            'closing_time' => 'required|date_format:H:i',
            'is_open_monday' => 'boolean',
            'is_open_tuesday' => 'boolean',
            'is_open_wednesday' => 'boolean',
            'is_open_thursday' => 'boolean',
            'is_open_friday' => 'boolean',
            'is_open_saturday' => 'boolean',
            'is_open_sunday' => 'boolean',
            'monday_open' => 'required|date_format:H:i',
            'monday_close' => 'required|date_format:H:i',
            'tuesday_open' => 'required|date_format:H:i',
            'tuesday_close' => 'required|date_format:H:i',
            'wednesday_open' => 'required|date_format:H:i',
            'wednesday_close' => 'required|date_format:H:i',
            'thursday_open' => 'required|date_format:H:i',
            'thursday_close' => 'required|date_format:H:i',
            'friday_open' => 'required|date_format:H:i',
            'friday_close' => 'required|date_format:H:i',
            'saturday_open' => 'required|date_format:H:i',
            'saturday_close' => 'required|date_format:H:i',
            'sunday_open' => 'required|date_format:H:i',
            'sunday_close' => 'required|date_format:H:i',
        ]);

        // Save general settings
        Settings::setValue('business_name', $validated['business_name']);
        Settings::setValue('business_address', $validated['business_address']);
        Settings::setValue('business_phone', $validated['business_phone']);
        Settings::setValue('google_maps_link', $validated['google_maps_link']);
        Settings::setValue('opening_time', $validated['opening_time']);
        Settings::setValue('closing_time', $validated['closing_time']);

        // Save day-specific settings
        $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
        foreach ($days as $day) {
            $is_open_key = 'is_open_' . $day;
            Settings::setValue($is_open_key, $request->has($is_open_key) ? 'true' : 'false');
            Settings::setValue($day . '_open', $validated[$day . '_open']);
            Settings::setValue($day . '_close', $validated[$day . '_close']);
        }

        if ($request->hasFile('store_image')) {
    $path = $request->file('store_image')->store('store', 'public');
    Settings::setValue('store_image', $path);
}


        return redirect()->route('admin.settings.index')->with('success', 'Settings updated successfully!');
    }
}
