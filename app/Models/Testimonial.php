<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'message',
        'rating',
<<<<<<< HEAD
        'is_visible', // 
    ];
}
=======
        'is_visible',
        'category',
    ];

    protected $casts = [
        'is_visible' => 'boolean',
        'rating' => 'integer',
    ];
}

>>>>>>> 0d46fbabf1eb6f7f94be51bbe166b890193439e6
