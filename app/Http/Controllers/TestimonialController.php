<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
<<<<<<< HEAD
    /**
     * Store a newly created testimonial.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'nullable|email',
            'message' => 'required|string',
            'rating'  => 'required|integer|min:1|max:5',
        ]);

        Testimonial::create([
            'name'       => $request->name,
            'email'      => $request->email,
            'message'    => $request->message,
            'rating'     => $request->rating,
            'is_visible' => 0, // pending approval
        ]);

        return back()->with(
            'success',
            'Testimoni berhasil dikirim, menunggu persetujuan admin.'
        );
    }
}

=======
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string|max:100',
            'email' => 'nullable|email',
            'message' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        Testimonial::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            'rating' => $request->rating,
            'is_visible' => false,
        ]);

        return back()->with('success', 'Terima kasih! Testimoni berhasil dikirim.');
    }
}
>>>>>>> 0d46fbabf1eb6f7f94be51bbe166b890193439e6
