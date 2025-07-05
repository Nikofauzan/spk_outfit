<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // <-- Pastikan ini ada!

class OccasionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus data lama dulu
        DB::table('occasions')->truncate();

        DB::table('occasions')->insert([
            // --- Acara untuk Cewek ---
            [
                'name' => 'Nongkrong di Kafe (Look Cewek Bumi)',
                'target_formality' => 4, 'target_warmth' => 5, 'target_style_genre' => 'Bumi',
            ],
            [
                'name' => 'Brunch Cantik (Look Cewek Kue)',
                'target_formality' => 5, 'target_warmth' => 4, 'target_style_genre' => 'Kue',
            ],
            [
                'name' => 'Kondangan Malam (Look Cewek Mamba)',
                'target_formality' => 9, 'target_warmth' => 4, 'target_style_genre' => 'Mamba',
            ],
            [
                'name' => 'Kondangan Siang (Look Cewek Bumi/Kue)',
                'target_formality' => 8, 'target_warmth' => 3, 'target_style_genre' => 'Bumi', // Bisa juga Kue
            ],

            // --- Acara untuk Cowok ---
            [
                'name' => 'Nonton Konser Musik (Look Anak Senja)',
                'target_formality' => 3, 'target_warmth' => 6, 'target_style_genre' => 'Anak Senja',
            ],
            [
                'name' => 'Presentasi di Kelas (Look Rapi)',
                'target_formality' => 7, 'target_warmth' => 4, 'target_style_genre' => 'Rapi',
            ],
            [
                'name' => 'Jalan-jalan di Mall (Look Streetwear)',
                'target_formality' => 2, 'target_warmth' => 5, 'target_style_genre' => 'Streetwear',
            ],

            // --- Acara Umum ---
            [
                'name' => 'Kerja di Kantor (Smart Casual)',
                'target_formality' => 7, 'target_warmth' => 5, 'target_style_genre' => 'Netral', // Netral bisa cocok dengan banyak genre
            ],
        ]);
    }
}
