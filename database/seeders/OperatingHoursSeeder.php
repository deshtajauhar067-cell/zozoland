<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Settings;

class OperatingHoursSeeder extends Seeder
{
    public function run()
    {
        // Seed default operating hours
        Settings::setValue('operating_hours_monday', '10:00 - 22:00', 'Jam operasional Senin');
        Settings::setValue('operating_hours_tuesday', '10:00 - 22:00', 'Jam operasional Selasa');
        Settings::setValue('operating_hours_wednesday', '10:00 - 22:00', 'Jam operasional Rabu');
        Settings::setValue('operating_hours_thursday', '10:00 - 22:00', 'Jam operasional Kamis');
        Settings::setValue('operating_hours_friday', '10:00 - 22:00', 'Jam operasional Jumat');
        Settings::setValue('operating_hours_saturday', '09:00 - 23:00', 'Jam operasional Sabtu');
        Settings::setValue('operating_hours_sunday', '09:00 - 23:00', 'Jam operasional Minggu');
    }
}