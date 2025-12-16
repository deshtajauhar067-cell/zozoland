<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    public function run()
    {
        Menu::create(['name' => 'Zozocone M', 'nama' => 'Zozocone M', 'description' => 'Cone ukuran medium', 'harga' => 6000, 'category' => 'Cone', 'is_available' => true]);
        Menu::create(['name' => 'Zozocone L', 'nama' => 'Zozocone L', 'description' => 'Cone ukuran large', 'harga' => 8000, 'category' => 'Cone', 'is_available' => true]);
        Menu::create(['name' => 'Wafflove', 'nama' => 'Wafflove', 'description' => 'Waffle + ice cream', 'harga' => 12000, 'category' => 'Special', 'is_available' => true]);
        Menu::create(['name' => 'Chillabun', 'nama' => 'Chillabun', 'description' => 'Churros + ice cream', 'harga' => 13000, 'category' => 'Special', 'is_available' => true]);
    }
}
