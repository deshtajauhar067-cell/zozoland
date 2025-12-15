<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Promo;
use App\Models\Location;
use App\Models\Testimonial;
use App\Models\Settings;
use Carbon\Carbon;


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
    // Ambil data settings
    $quick_address = Settings::getValue('business_address', 'Belum diatur');
    $maps = Settings::getValue('google_maps_link', '');
    $store_image = Settings::getValue('store_image', null);

    // Hari sekarang
    $day = strtolower(Carbon::now()->format('l')); // monday, tuesday, etc

    $is_open_today = Settings::getValue('is_open_' . $day, 'false') === 'true';
    $open_time = Settings::getValue($day . '_open', '00:00');
    $close_time = Settings::getValue($day . '_close', '00:00');

    // Status toko
    $now = Carbon::now()->format('H:i');
    $is_open = $is_open_today && ($now >= $open_time && $now <= $close_time);

    // Jam operasional tampil
    $jam_operasional = ucfirst($day) . ": $open_time - $close_time";

    return view('location', compact(
        'is_open',
        'quick_address',
        'jam_operasional',
        'maps',
        'store_image'
    ));
}


    public function testimonials()
    {
        $testimonials = Testimonial::where('is_visible', true)
        ->latest()
        ->get();

    return view('testimonials', compact('testimonials'));
    }
}
