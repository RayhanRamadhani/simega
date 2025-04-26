<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Package;

class PackageSeeder extends Seeder
{
    public function run()
    {
        Package::updateOrCreate([
            'name' => 'Gratis',
        ], [
            'duration_month' => 0,
            'price' => 0,
            'features' => [
                'Buat tugas maksimal 3 kali',
                'Buat list tugas maksimal 3 kali',
                'Ngobrol bareng Roki maksimal 2 kali per hari',
            ],
        ]);

        Package::updateOrCreate([
            'name' => 'Pro',
        ], [
            'duration_month' => 12,
            'price' => 50000,
            'features' => [
                'Buat tugas tanpa batas!',
                'Buat list tugas tanpa batas juga!',
                'Ngobrol bareng Roki sepuasnya!',
                'Fitur Distract Avoider untuk pengguna mobile!',
            ],
        ]);
    }
}
