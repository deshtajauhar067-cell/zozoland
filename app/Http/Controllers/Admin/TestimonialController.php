<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
<<<<<<< HEAD
    /**
     * Display a listing of testimonials
     */
    public function index()
    {
        $testimonials = Testimonial::paginate(20);
=======
    public function index()
    {
        $testimonials = Testimonial::paginate(20);

>>>>>>> 0d46fbabf1eb6f7f94be51bbe166b890193439e6
        $stats = [
            'total' => Testimonial::count(),
            'visible' => Testimonial::where('is_visible', true)->count(),
            'pending' => Testimonial::where('is_visible', false)->count(),
            'avg_rating' => round(Testimonial::avg('rating'), 1),
        ];
<<<<<<< HEAD
        return view('admin.testimonials.index', compact('testimonials', 'stats'));
    }

    /**
     * Toggle visibility of a testimonial
     */
=======

        return view('admin.testimonials.index', compact('testimonials', 'stats'));
    }

>>>>>>> 0d46fbabf1eb6f7f94be51bbe166b890193439e6
    public function toggleVisibility($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->update(['is_visible' => !$testimonial->is_visible]);

<<<<<<< HEAD
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

=======
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
>>>>>>> 0d46fbabf1eb6f7f94be51bbe166b890193439e6
