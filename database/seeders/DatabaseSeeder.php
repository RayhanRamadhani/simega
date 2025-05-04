<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(5)->create();

        User::factory()->create([
            'firstname' => 'Admin',
            'lastname' => 'Kece',
            'username' => 'Adminbro1234',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('1234'),
            'role' => 'admin',
        ]);
        $this->call([
            PackageSeeder::class,
        ]);
    }
}
