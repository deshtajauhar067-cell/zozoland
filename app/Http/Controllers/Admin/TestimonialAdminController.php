<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;

class TestimonialAdminController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::latest()->get();
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function toggle($id)
    {
        $t = Testimonial::findOrFail($id);
        $t->is_visible = !$t->is_visible;
        $t->save();

        return back()->with('success', 'Status testimoni diperbarui');
    }
}
