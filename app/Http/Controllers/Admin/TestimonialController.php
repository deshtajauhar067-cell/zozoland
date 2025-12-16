<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    /**
     * Display a listing of testimonials
     */
    public function index()
    {
        $testimonials = Testimonial::paginate(20);
        $stats = [
            'total' => Testimonial::count(),
            'visible' => Testimonial::where('is_visible', true)->count(),
            'pending' => Testimonial::where('is_visible', false)->count(),
            'avg_rating' => round(Testimonial::avg('rating'), 1),
        ];
        return view('admin.testimonials.index', compact('testimonials', 'stats'));
    }

    /**
     * Toggle visibility of a testimonial
     */
    public function toggleVisibility($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->update(['is_visible' => !$testimonial->is_visible]);

        $message = $testimonial->is_visible ? 'Testimonial is now visible!' : 'Testimonial is now hidden!';
        return redirect()->route('admin.testimonials.index')->with('success', $message);
    }

    /**
     * Delete a testimonial
     */
    public function destroy($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial deleted successfully!');
    }
}

