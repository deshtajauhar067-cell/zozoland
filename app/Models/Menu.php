<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'name',
        'description',
        'harga',
        'price',
        'image',
        'category',
        'is_available',
    ];

    protected $casts = [
        'is_available' => 'boolean',
        'price' => 'float',
    ];
}
