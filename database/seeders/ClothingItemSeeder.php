<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // <-- Pastikan ini ada!

class ClothingItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus data lama dulu biar nggak numpuk
        DB::table('clothing_items')->truncate();

        DB::table('clothing_items')->insert([
            // --- Genre: BUMI (Cewek) ---
            [
                'name' => 'Kaos Linen Krem', 'category' => 'Atasan', 'formality_score' => 2, 'warmth_score' => 3, 'comfort_score' => 9,
                'style_genre' => 'Bumi', 'tone_warna' => 'Earth Tone',
            ],
            [
                'name' => 'Kemeja Batik Lengan Panjang', 'category' => 'Atasan', 'formality_score' => 8, 'warmth_score' => 5, 'comfort_score' => 7,
                'style_genre' => 'Bumi', 'tone_warna' => 'Tradisional',
            ],
            [
                'name' => 'Cardigan Rajut Coklat', 'category' => 'Outerwear', 'formality_score' => 4, 'warmth_score' => 7, 'comfort_score' => 9,
                'style_genre' => 'Bumi', 'tone_warna' => 'Earth Tone',
            ],
            [
                'name' => 'Celana Kargo Hijau Army', 'category' => 'Bawahan', 'formality_score' => 2, 'warmth_score' => 6, 'comfort_score' => 8,
                'style_genre' => 'Bumi', 'tone_warna' => 'Earth Tone',
            ],
            [
                'name' => 'Rok Lilit Batik', 'category' => 'Bawahan', 'formality_score' => 8, 'warmth_score' => 4, 'comfort_score' => 7,
                'style_genre' => 'Bumi', 'tone_warna' => 'Tradisional',
            ],
            [
                'name' => 'Sandal Tali Kulit', 'category' => 'Sepatu', 'formality_score' => 3, 'warmth_score' => 2, 'comfort_score' => 8,
                'style_genre' => 'Bumi', 'tone_warna' => 'Earth Tone',
            ],
            [
                'name' => 'Tas Rotan Bulat', 'category' => 'Tas', 'formality_score' => 3, 'warmth_score' => 1, 'comfort_score' => 10,
                'style_genre' => 'Bumi', 'tone_warna' => 'Earth Tone',
            ],
            [
                'name' => 'Kalung Manik Kayu', 'category' => 'Aksesoris', 'formality_score' => 2, 'warmth_score' => 1, 'comfort_score' => 10,
                'style_genre' => 'Bumi', 'tone_warna' => 'Earth Tone',
            ],
            [
                'name' => 'Sweater Rajut Turtleneck', 'category' => 'Atasan', 'formality_score' => 5, 'warmth_score' => 8, 'comfort_score' => 9,
                'style_genre' => 'Bumi', 'tone_warna' => 'Earth Tone',
            ],
            [
                'name' => 'Celana Bahan Coklat Tua', 'category' => 'Bawahan', 'formality_score' => 8, 'warmth_score' => 5, 'comfort_score' => 8,
                'style_genre' => 'Bumi', 'tone_warna' => 'Earth Tone',
            ],
            [
                'name' => 'Loafers Kulit Coklat', 'category' => 'Sepatu', 'formality_score' => 7, 'warmth_score' => 3, 'comfort_score' => 7,
                'style_genre' => 'Bumi', 'tone_warna' => 'Earth Tone',
            ],
            [
                'name' => 'Scarf Motif Etnik', 'category' => 'Aksesoris', 'formality_score' => 4, 'warmth_score' => 4, 'comfort_score' => 8,
                'style_genre' => 'Bumi', 'tone_warna' => 'Tradisional',
            ],

            // --- Genre: KUE (Cewek) ---
            [
                'name' => 'Crop Top Rajut Lilac', 'category' => 'Atasan', 'formality_score' => 2, 'warmth_score' => 4, 'comfort_score' => 8,
                'style_genre' => 'Kue', 'tone_warna' => 'Pastel',
            ],
            [
                'name' => 'Blouse Satin Pink Fanta', 'category' => 'Atasan', 'formality_score' => 7, 'warmth_score' => 3, 'comfort_score' => 6,
                'style_genre' => 'Kue', 'tone_warna' => 'Hangat',
            ],
            [
                'name' => 'Cardigan Crop Warna Mint', 'category' => 'Outerwear', 'formality_score' => 3, 'warmth_score' => 5, 'comfort_score' => 8,
                'style_genre' => 'Kue', 'tone_warna' => 'Pastel',
            ],
            [
                'name' => 'Rok Mini Tennis Biru Muda', 'category' => 'Bawahan', 'formality_score' => 2, 'warmth_score' => 3, 'comfort_score' => 7,
                'style_genre' => 'Kue', 'tone_warna' => 'Pastel',
            ],
            [
                'name' => 'Sneakers Putih Aksen Pink', 'category' => 'Sepatu', 'formality_score' => 3, 'warmth_score' => 4, 'comfort_score' => 9,
                'style_genre' => 'Kue', 'tone_warna' => 'Netral',
            ],
            [
                'name' => 'Tas Bahu Mungil Kuning', 'category' => 'Tas', 'formality_score' => 4, 'warmth_score' => 1, 'comfort_score' => 10,
                'style_genre' => 'Kue', 'tone_warna' => 'Hangat',
            ],
            [
                'name' => 'Jepit Rambut Mutiara', 'category' => 'Aksesoris', 'formality_score' => 3, 'warmth_score' => 1, 'comfort_score' => 10,
                'style_genre' => 'Kue', 'tone_warna' => 'Pastel',
            ],
            [
                'name' => 'Dress Bunga-Bunga', 'category' => 'Dress', 'formality_score' => 6, 'warmth_score' => 3, 'comfort_score' => 9,
                'style_genre' => 'Kue', 'tone_warna' => 'Pastel',
            ],
            [
                'name' => 'Celana Cutbray Warna Sage', 'category' => 'Bawahan', 'formality_score' => 6, 'warmth_score' => 4, 'comfort_score' => 8,
                'style_genre' => 'Kue', 'tone_warna' => 'Pastel',
            ],
            [
                'name' => 'High Heels Warna Nude', 'category' => 'Sepatu', 'formality_score' => 9, 'warmth_score' => 2, 'comfort_score' => 5,
                'style_genre' => 'Kue', 'tone_warna' => 'Netral',
            ],
            [
                'name' => 'Anting Akrilik Bentuk Lucu', 'category' => 'Aksesoris', 'formality_score' => 2, 'warmth_score' => 1, 'comfort_score' => 10,
                'style_genre' => 'Kue', 'tone_warna' => 'Hangat',
            ],

            // --- Genre: MAMBA (Cewek) ---
            [
                'name' => 'Tank Top Hitam Polos', 'category' => 'Atasan', 'formality_score' => 2, 'warmth_score' => 2, 'comfort_score' => 9,
                'style_genre' => 'Mamba', 'tone_warna' => 'Netral',
            ],
            [
                'name' => 'Kemeja Satin Hitam', 'category' => 'Atasan', 'formality_score' => 8, 'warmth_score' => 4, 'comfort_score' => 7,
                'style_genre' => 'Mamba', 'tone_warna' => 'Netral',
            ],
            [
                'name' => 'Jaket Kulit Hitam', 'category' => 'Outerwear', 'formality_score' => 6, 'warmth_score' => 8, 'comfort_score' => 6,
                'style_genre' => 'Mamba', 'tone_warna' => 'Netral',
            ],
            [
                'name' => 'Celana Bahan High-Waist Hitam', 'category' => 'Bawahan', 'formality_score' => 9, 'warmth_score' => 5, 'comfort_score' => 8,
                'style_genre' => 'Mamba', 'tone_warna' => 'Netral',
            ],
            [
                'name' => 'Ripped Jeans Hitam', 'category' => 'Bawahan', 'formality_score' => 1, 'warmth_score' => 6, 'comfort_score' => 7,
                'style_genre' => 'Mamba', 'tone_warna' => 'Netral',
            ],
            [
                'name' => 'Sepatu Boots Hitam', 'category' => 'Sepatu', 'formality_score' => 7, 'warmth_score' => 7, 'comfort_score' => 7,
                'style_genre' => 'Mamba', 'tone_warna' => 'Netral',
            ],
            [
                'name' => 'Tas Bahu Rantai Silver', 'category' => 'Tas', 'formality_score' => 7, 'warmth_score' => 1, 'comfort_score' => 10,
                'style_genre' => 'Mamba', 'tone_warna' => 'Netral',
            ],
            [
                'name' => 'Kacamata Hitam Cat-eye', 'category' => 'Aksesoris', 'formality_score' => 4, 'warmth_score' => 1, 'comfort_score' => 10,
                'style_genre' => 'Mamba', 'tone_warna' => 'Netral',
            ],
            [
                'name' => 'Blazer Oversized Hitam', 'category' => 'Outerwear', 'formality_score' => 9, 'warmth_score' => 6, 'comfort_score' => 8,
                'style_genre' => 'Mamba', 'tone_warna' => 'Netral',
            ],
            [
                'name' => 'Rok Span Kulit Hitam', 'category' => 'Bawahan', 'formality_score' => 8, 'warmth_score' => 7, 'comfort_score' => 6,
                'style_genre' => 'Mamba', 'tone_warna' => 'Netral',
            ],
            [
                'name' => 'Stiletto Hitam', 'category' => 'Sepatu', 'formality_score' => 10, 'warmth_score' => 2, 'comfort_score' => 4,
                'style_genre' => 'Mamba', 'tone_warna' => 'Netral',
            ],
            [
                'name' => 'Tas Tangan Kulit Hitam', 'category' => 'Tas', 'formality_score' => 9, 'warmth_score' => 1, 'comfort_score' => 10,
                'style_genre' => 'Mamba', 'tone_warna' => 'Netral',
            ],

            // --- Item Netral/Fleksibel ---
            [
                'name' => 'Kemeja Putih Oversized', 'category' => 'Atasan', 'formality_score' => 7, 'warmth_score' => 4, 'comfort_score' => 9,
                'style_genre' => 'Netral', 'tone_warna' => 'Netral',
            ],
            [
                'name' => 'Straight Jeans Biru Klasik', 'category' => 'Bawahan', 'formality_score' => 3, 'warmth_score' => 6, 'comfort_score' => 8,
                'style_genre' => 'Netral', 'tone_warna' => 'Dingin',
            ],
            [
                'name' => 'Tote Bag Kanvas Putih', 'category' => 'Tas', 'formality_score' => 2, 'warmth_score' => 1, 'comfort_score' => 10,
                'style_genre' => 'Netral', 'tone_warna' => 'Netral',
            ],

            // --- Genre: ANAK SENJA / INDIE (Cowok) ---
            [
                'name' => 'Kaos Band Oversized', 'category' => 'Atasan', 'formality_score' => 2, 'warmth_score' => 4, 'comfort_score' => 8,
                'style_genre' => 'Anak Senja', 'tone_warna' => 'Netral',
            ],
            [
                'name' => 'Kemeja Flanel Kotak-kotak', 'category' => 'Outerwear', 'formality_score' => 3, 'warmth_score' => 6, 'comfort_score' => 9,
                'style_genre' => 'Anak Senja', 'tone_warna' => 'Earth Tone',
            ],
            [
                'name' => 'Celana Corduroy Coklat', 'category' => 'Bawahan', 'formality_score' => 4, 'warmth_score' => 7, 'comfort_score' => 8,
                'style_genre' => 'Anak Senja', 'tone_warna' => 'Earth Tone',
            ],
            [
                'name' => 'Doc Martens Hitam', 'category' => 'Sepatu', 'formality_score' => 6, 'warmth_score' => 7, 'comfort_score' => 6,
                'style_genre' => 'Anak Senja', 'tone_warna' => 'Netral',
            ],
            [
                'name' => 'Tote Bag Kanvas', 'category' => 'Tas', 'formality_score' => 1, 'warmth_score' => 1, 'comfort_score' => 10,
                'style_genre' => 'Anak Senja', 'tone_warna' => 'Netral',
            ],

            // --- Genre: RAPI / KAMPUS BOY (Cowok) ---
            [
                'name' => 'Polo Shirt Biru Navy', 'category' => 'Atasan', 'formality_score' => 6, 'warmth_score' => 4, 'comfort_score' => 9,
                'style_genre' => 'Rapi', 'tone_warna' => 'Dingin',
            ],
            [
                'name' => 'Kemeja Oxford Putih', 'category' => 'Atasan', 'formality_score' => 8, 'warmth_score' => 4, 'comfort_score' => 8,
                'style_genre' => 'Rapi', 'tone_warna' => 'Netral',
            ],
            [
                'name' => 'Celana Chino Krem', 'category' => 'Bawahan', 'formality_score' => 7, 'warmth_score' => 5, 'comfort_score' => 9,
                'style_genre' => 'Rapi', 'tone_warna' => 'Earth Tone',
            ],
            [
                'name' => 'Sepatu Loafers Kulit', 'category' => 'Sepatu', 'formality_score' => 8, 'warmth_score' => 3, 'comfort_score' => 7,
                'style_genre' => 'Rapi', 'tone_warna' => 'Earth Tone',
            ],
            [
                'name' => 'Tas Ransel Kulit', 'category' => 'Tas', 'formality_score' => 7, 'warmth_score' => 1, 'comfort_score' => 10,
                'style_genre' => 'Rapi', 'tone_warna' => 'Netral',
            ],

            // --- Genre: STREETWEAR / HYPEBEAST (Cowok) ---
            [
                'name' => 'Hoodie Grafis Hitam', 'category' => 'Atasan', 'formality_score' => 2, 'warmth_score' => 7, 'comfort_score' => 9,
                'style_genre' => 'Streetwear', 'tone_warna' => 'Netral',
            ],
            [
                'name' => 'Kaos Oversized Putih', 'category' => 'Atasan', 'formality_score' => 1, 'warmth_score' => 3, 'comfort_score' => 9,
                'style_genre' => 'Streetwear', 'tone_warna' => 'Netral',
            ],
            [
                'name' => 'Celana Kargo Hitam', 'category' => 'Bawahan', 'formality_score' => 2, 'warmth_score' => 6, 'comfort_score' => 8,
                'style_genre' => 'Streetwear', 'tone_warna' => 'Netral',
            ],
            [
                'name' => 'Sneakers Air Jordan', 'category' => 'Sepatu', 'formality_score' => 3, 'warmth_score' => 5, 'comfort_score' => 8,
                'style_genre' => 'Streetwear', 'tone_warna' => 'Hangat',
            ],
            [
                'name' => 'Tas Selempang (Sling Bag)', 'category' => 'Tas', 'formality_score' => 1, 'warmth_score' => 1, 'comfort_score' => 10,
                'style_genre' => 'Streetwear', 'tone_warna' => 'Netral',
            ],
        ]);
    }
}
