<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // <-- Jangan lupa, ini wajib ada!

class RecommendationController extends Controller
{
    /**
     * Fungsi untuk menampilkan halaman utama.
     * Tugasnya cuma satu: ambil data semua acara dan tampilkan halaman view-nya.
     */
    public function index()
    {
        // 1. Ambil semua data dari tabel 'occasions' untuk ditampilkan di dropdown.
        $occasions = DB::table('occasions')->get();

        // 2. Tampilkan view 'recommendation.blade.php' dan kirim data $occasions ke sana.
        return view('recommendation', ['occasions' => $occasions]);
    }

    /**
     * Fungsi untuk menghitung rekomendasi.
     * Ini adalah "otak" utama dari SPK kita.
     */
    public function calculate(Request $request)
    {
        // === LANGKAH 1: PERSIAPAN ===

        // Ambil ID acara yang dipilih user dari form input.
        $occasionId = $request->input('occasion_id');

        // Ambil data "Profil Ideal" dari database berdasarkan ID yang dipilih.
        $profilIdeal = DB::table('occasions')->find($occasionId);

        // Ambil SEMUA data pakaian dari database, dipisah per kategori.
        $semuaAtasan = DB::table('clothing_items')->where('category', 'Atasan')->get();
        $semuaBawahan = DB::table('clothing_items')->where('category', 'Bawahan')->get();
        $semuaSepatu = DB::table('clothing_items')->where('category', 'Sepatu')->get();
        // (Tambahkan untuk outerwear, aksesoris, dll. jika perlu)

        $hasilKombinasi = []; // Array kosong untuk menyimpan hasil perhitungan semua kombinasi.


        // === LANGKAH 2: PROSES PENCocokan (Looping) ===

        // Kita akan loop semua kemungkinan kombinasi Atasan, Bawahan, dan Sepatu.
        foreach ($semuaAtasan as $atasan) {
            foreach ($semuaBawahan as $bawahan) {
                foreach ($semuaSepatu as $sepatu) {

                    // A. Hitung Poin Penalti untuk setiap item terhadap Profil Ideal.
                    $penaltiAtasan = $this->hitungPoinPenalti($atasan, $profilIdeal);
                    $penaltiBawahan = $this->hitungPoinPenalti($bawahan, $profilIdeal);
                    $penaltiSepatu = $this->hitungPoinPenalti($sepatu, $profilIdeal);

                    // B. Hitung Poin Penalti Warna (jika ada kombinasi yang tidak cocok).
                    // Untuk sekarang kita sederhanakan, bisa dikembangkan nanti.
                    // Misal: Cek kecocokan antara atasan dan bawahan.
                    // $penaltiWarna = $this->hitungPenaltiWarna($atasan, $bawahan);

                    // C. Hitung Total Poin Penalti untuk kombinasi ini.
                    $totalPoinPenalti = $penaltiAtasan + $penaltiBawahan + $penaltiSepatu; // + $penaltiWarna;

                    // D. Simpan hasil perhitungan ke dalam array.
                    $hasilKombinasi[] = [
                        'atasan' => $atasan,
                        'bawahan' => $bawahan,
                        'sepatu' => $sepatu,
                        'total_poin_penalti' => $totalPoinPenalti,
                    ];
                }
            }
        }


        // === LANGKAH 3: RANKING & HASIL AKHIR ===

        // Urutkan array $hasilKombinasi berdasarkan 'total_poin_penalti' dari yang terkecil ke terbesar.
        usort($hasilKombinasi, function ($a, $b) {
            return $a['total_poin_penalti'] <=> $b['total_poin_penalti'];
        });

        // Ambil 1 kombinasi terbaik (yang ada di urutan pertama setelah di-sort).
        $rekomendasiTerbaik = $hasilKombinasi[0] ?? null; // `?? null` untuk antisipasi jika tidak ada hasil.

        // Kirim data rekomendasi terbaik ke halaman view 'result.blade.php'.
        return view('result', ['rekomendasi' => $rekomendasiTerbaik]);
    }

    /**
     * Fungsi BANTUAN untuk menghitung Poin Penalti satu item.
     * Dibuat terpisah agar rapi dan bisa dipakai berulang kali.
     */
    private function hitungPoinPenalti($pakaian, $profilIdeal)
    {
        // Hitung selisih mutlak (jarak) untuk setiap kriteria.
        $penaltiFormalitas = abs($pakaian->formality_score - $profilIdeal->target_formality);
        $penaltiKehangatan = abs($pakaian->warmth_score - $profilIdeal->target_warmth);

        // Hitung penalti untuk 'style_genre'. Jika sama, penalti 0. Jika beda, beri penalti tinggi.
        $penaltiStyle = 0;
        if ($pakaian->style_genre !== 'Netral' && $pakaian->style_genre !== $profilIdeal->target_style_genre) {
            $penaltiStyle = 10; // Angka penalti tinggi jika genre tidak cocok.
        }

        // Jumlahkan semua penalti.
        return $penaltiFormalitas + $penaltiKehangatan + $penaltiStyle;
    }
}