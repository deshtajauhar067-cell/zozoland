<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promo;
use Illuminate\Http\Request;

class PromoController extends Controller
{
    /**
     * Display a listing of promos
     */
    public function index()
    {
        $promos = Promo::paginate(15);
        return view('admin.promos.index', compact('promos'));
    }

    /**
     * Show the form for creating a new promo
     */
    public function create()
    {
        return view('admin.promos.create');
    }

    /**
     * Store a newly created promo in storage
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'how_to_join' => 'required|string',
            'category' => 'required|string|max:100',
            'valid_from' => 'required|date',
            'valid_until' => 'required|date|after:valid_from',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('promos', 'public');
            $validated['image'] = $imagePath;
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['valid_from'] = date('Y-m-d H:i:s', strtotime($validated['valid_from']));
        $validated['valid_until'] = date('Y-m-d H:i:s', strtotime($validated['valid_until']));

        Promo::create($validated);

        return redirect()->route('admin.promos.index')->with('success', 'Promo created successfully!');
    }

    /**
     * Show the form for editing the specified promo
     */
    public function edit(Promo $promo)
    {
        return view('admin.promos.edit', compact('promo'));
    }

    /**
     * Update the specified promo in storage
     */
    public function update(Request $request, Promo $promo)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'how_to_join' => 'required|string',
            'category' => 'required|string|max:100',
            'valid_from' => 'required|date',
            'valid_until' => 'required|date|after:valid_from',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            if ($promo->image && \Storage::disk('public')->exists($promo->image)) {
                \Storage::disk('public')->delete($promo->image);
            }
            $imagePath = $request->file('image')->store('promos', 'public');
            $validated['image'] = $imagePath;
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['valid_from'] = date('Y-m-d H:i:s', strtotime($validated['valid_from']));
        $validated['valid_until'] = date('Y-m-d H:i:s', strtotime($validated['valid_until']));

        $promo->update($validated);

        return redirect()->route('admin.promos.index')->with('success', 'Promo updated successfully!');
    }

    /**
     * Remove the specified promo from storage
     */
    public function destroy(Promo $promo)
    {
        if ($promo->image && \Storage::disk('public')->exists($promo->image)) {
            \Storage::disk('public')->delete($promo->image);
        }

        $promo->delete();

        return redirect()->route('admin.promos.index')->with('success', 'Promo deleted successfully!');
    }
}
