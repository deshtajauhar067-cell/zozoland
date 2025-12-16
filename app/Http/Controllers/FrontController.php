<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Promo;
use App\Models\Location;
use App\Models\Testimonial;
use App\Models\Settings;

class FrontController extends Controller
{
    public function home()
    {
        $menus = Menu::limit(6)->get();
        $promos = Promo::all();
        return view('home', compact('menus', 'promos'));
    }

    public function menu()
    {
        $menus = Menu::all();
        return view('menu', compact('menus'));
    }

    public function promo()
    {
        $promos = Promo::all();
        return view('promo', compact('promos'));
    }

    public function location()
    {
        $days = ['monday','tuesday','wednesday','thursday','friday','saturday','sunday'];
        $hours = [];

        foreach ($days as $day) {
            $val = Settings::getValue('operating_hours_' . $day);
            if ($val) {
                $hours[] = ucfirst($day) . ': ' . $val;
            }
        }

        $jam_operasional = count($hours) ? implode(' | ', $hours) : null;
        return view('location', compact('jam_operasional'));
    }

    public function testimonials()
    {
        $testimonials = Testimonial::where('is_visible', 1)
            ->latest()
            ->get();

        return view('testimonials', compact('testimonials'));
    }
}
