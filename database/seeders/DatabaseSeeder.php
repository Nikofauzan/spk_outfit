<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
{
    // \App\Models\User::factory(10)->create(); // <--- CARI BARIS INI

    // atau mungkin seperti ini:
    // \App\Models\User::factory()->create([
    //     'name' => 'Test User',
    //     'email' => 'test@example.com',
    // ]);

    // Panggil seeder-mu di sini
    $this->call([
        ClothingItemSeeder::class,
        OccasionSeeder::class,
    ]);
}
}
