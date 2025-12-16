<?php

namespace App\Http\Controllers;

use App\Models\Menu;

class MenuController extends Controller
{
    // Halaman daftar menu
    public function index()
    {
        // ambil semua data menu dari database
        $menus = Menu::all();

        // kirim data ke view resources/views/menu.blade.php
        return view('menu', compact('menus'));
    }
}
