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
        'is_visible',
        'category',
    ];

    protected $casts = [
        'is_visible' => 'boolean',
        'rating' => 'integer',
    ];
}

