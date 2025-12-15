<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;

class TestimonialController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string',
            'email' => 'nullable|email',
            'message' => 'required|string|max:1000'
        ]);

        Testimonial::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            'approved' => false // admin belum moderasi
        ]);

        return back()->with('success', 'Terima kasih! Testimoni berhasil dikirim.');
    }
}
