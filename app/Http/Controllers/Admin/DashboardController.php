<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Promo;
use App\Models\Testimonial;
use App\Models\Settings;

class DashboardController extends Controller
{
    /**
     * Show the admin dashboard
     */
    public function index()
    {
        $stats = [
            'total_menus' => Menu::count(),
            'total_promos' => Promo::count(),
            'active_promos' => Promo::where('is_active', true)->count(),
            'total_testimonials' => Testimonial::count(),
            'visible_testimonials' => Testimonial::where('is_visible', true)->count(),
        ];

        $quick_access = [
            'is_open' => Settings::getValue('is_open', false) == 'true',
            'quick_address' => Settings::getValue('quick_address', 'Jl. ZozoLand No. 123'),
            'featured_promo_id' => Settings::getValue('featured_promo_id', null),
        ];

        $featured_promo = null;
        if ($quick_access['featured_promo_id']) {
            $featured_promo = Promo::find($quick_access['featured_promo_id']);
        }

        $recent_testimonials = Testimonial::latest()->take(5)->get();

        return view(
            'admin.dashboard.index',
            compact('stats', 'quick_access', 'featured_promo', 'recent_testimonials')
        );
    }

    /**
     * Update Quick Access settings
     */
    public function updateQuickAccess(Request $request)
    {
        // Validasi
        $validated = $request->validate([
            'is_open' => 'nullable|boolean',
            'quick_address' => 'required|string|max:255',
            'featured_promo_id' => 'nullable|exists:promos,id',
        ]);

        // FIX checkbox (checkbox tidak terkirim kalau tidak dicentang)
        $isOpen = $request->has('is_open');

        Settings::setValue('is_open', $isOpen ? 'true' : 'false');
        Settings::setValue('quick_address', $validated['quick_address']);

        if (!empty($validated['featured_promo_id'])) {
            Settings::setValue('featured_promo_id', $validated['featured_promo_id']);
        }

        return redirect()
            ->route('admin.dashboard')
            ->with('success', 'Quick Access settings updated successfully!');
    }
}
