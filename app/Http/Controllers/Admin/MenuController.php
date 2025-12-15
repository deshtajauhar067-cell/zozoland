<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of menus
     */
    public function index()
    {
        $menus = Menu::paginate(15);
        return view('admin.menus.index', compact('menus'));
    }

    /**
     * Show the form for creating a new menu
     */
    public function create()
    {
        return view('admin.menus.create');
    }

    /**
     * Store a newly created menu in storage
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'name' => 'nullable|string|max:255',
            'description' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => 'required|string|max:100',
            'is_available' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
    $path = $request->file('image')->store('menu_images', 'public');
    $menu->image = $path;
}


        $validated['is_available'] = $request->has('is_available');

        Menu::create($validated);

        return redirect()->route('admin.menus.index')->with('success', 'Menu item created successfully!');
    }

    /**
     * Display the specified menu
     */
    public function show(Menu $menu)
    {
        return view('admin.menus.show', compact('menu'));
    }

    /**
     * Show the form for editing the specified menu
     */
    public function edit(Menu $menu)
    {
        return view('admin.menus.edit', compact('menu'));
    }

    /**
     * Update the specified menu in storage
     */
    public function update(Request $request, $id)
{
    $menu = Menu::findOrFail($id);

    $request->validate([
        'nama' => 'required|string|max:255',
        'category' => 'required|string|max:255',
        'harga' => 'required|numeric',
        'description' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $menu->nama = $request->nama;
    $menu->category = $request->category;
    $menu->harga = $request->harga;
    $menu->description = $request->description;
    $menu->is_available = $request->has('is_available') ? 1 : 0;

    // 🔥 JIKA UPLOAD GAMBAR BARU
    if ($request->hasFile('image')) {

        // hapus gambar lama
        if ($menu->image && Storage::disk('public')->exists($menu->image)) {
            Storage::disk('public')->delete($menu->image);
        }

        // simpan gambar baru
        $path = $request->file('image')->store('menu', 'public');
        $menu->image = $path;
    }

    $menu->save();

    return redirect()->route('admin.menus.index')
        ->with('success', 'Menu berhasil diperbarui');
}
    /**
     * Remove the specified menu from storage
     */
    public function destroy(Menu $menu)
    {
        if ($menu->image && \Storage::disk('public')->exists($menu->image)) {
            \Storage::disk('public')->delete($menu->image);
        }

        $menu->delete();

        return redirect()->route('admin.menus.index')->with('success', 'Menu item deleted successfully!');
    }
}
