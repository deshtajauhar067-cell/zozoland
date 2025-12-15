<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Testimonial;

class TestimonialSeeder extends Seeder
{
    public function run()
    {
        Testimonial::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'message' => 'Ice creamnya enak banget! Recomended deh.',
            'rating' => 5,
            'is_visible' => true,
            'category' => 'Customer',
        ]);

        Testimonial::create([
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'message' => 'Pelayanan ramah dan tempatnya nyaman.',
            'rating' => 4,
            'is_visible' => true,
            'category' => 'Customer',
        ]);
    }
}