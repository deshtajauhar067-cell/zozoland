<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
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

    public function toggleVisibility($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->update(['is_visible' => !$testimonial->is_visible]);

        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'is_visible' => $testimonial->is_visible,
            ]);
        }

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Visibility updated.');
    }

    public function destroy($id)
    {
        Testimonial::findOrFail($id)->delete();

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial deleted.');
    }
}
