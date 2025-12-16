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
<<<<<<< HEAD
=======

    public function store(Request $request)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'category' => 'required|string|max:255',
        'harga' => 'required|numeric',
        'description' => 'required|string',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $menu = new Menu();
    $menu->nama = $request->nama;
    $menu->category = $request->category;
    $menu->harga = $request->harga;
    $menu->description = $request->description;
    $menu->is_available = $request->has('is_available') ? 1 : 0;

    // 🔥 UPLOAD IMAGE
    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('menu', 'public');
        $menu->image = $path;
    }

    $menu->save();

    return redirect()->route('admin.menus.index')
        ->with('success', 'Menu berhasil ditambahkan');
}

>>>>>>> 0d46fbabf1eb6f7f94be51bbe166b890193439e6
}
