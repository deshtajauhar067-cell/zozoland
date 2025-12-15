<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Promo;

class PromoSeeder extends Seeder
{
    public function run()
    {
        Promo::create([
            'title' => 'Buy 1 Get 1 Scoop (MABA UB)',
            'description' => 'Spesial untuk mahasiswa baru Universitas Brawijaya: beli 1 dapat 1 scoop gratis (kecuali Zozocone).',
            'how_to_join' => 'Follow IG @zozoland.id dan tunjukkan bukti follow ke kasir, sertakan KTM.',
            'category' => 'General',
            'valid_from' => now(),
            'valid_until' => now()->addWeeks(2),
            'is_active' => true,
        ]);

        Promo::create([
            'title' => 'Diskon UTBK Week',
            'description' => 'Diskon khusus peserta UTBK di hari event.',
            'how_to_join' => 'Tunjukkan bukti pendaftaran UTBK ke kasir.',
            'category' => 'UTBK',
            'valid_from' => now()->addDays(7),
            'valid_until' => now()->addDays(14),
            'is_active' => false,
        ]);
    }
}
