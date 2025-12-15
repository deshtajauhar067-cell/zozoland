<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Settings;

class SettingsSeeder extends Seeder
{
    public function run()
    {
        Settings::setValue('site_name', 'ZozoLand', 'Nama situs');
        Settings::setValue('site_description', 'Tempat terbaik untuk ice cream dan dessert', 'Deskripsi situs');
        Settings::setValue('contact_email', 'info@zozoland.com', 'Email kontak');
        Settings::setValue('contact_phone', '+62 123 456 789', 'Nomor telepon kontak');
        // Add more settings as needed
    }
}