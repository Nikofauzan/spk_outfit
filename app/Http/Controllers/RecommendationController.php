<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // <-- Pastikan ini selalu ada

class RecommendationController extends Controller
{
    /**
     * Fungsi untuk menampilkan halaman utama.
     * Tugasnya cuma satu: ambil data semua acara dan tampilkan halaman view-nya.
     */
    public function index()
    {
        // 1. Ambil semua data dari tabel 'occasions' untuk ditampilkan di dropdown.
        $occasions = DB::table('occasions')->orderBy('name')->get();

        // 2. Tampilkan view 'recommendation.blade.php'.
        //    Pastikan nama file view-mu adalah 'recommendation.blade.php', bukan 'recomendation'.
        return view('recommendation', ['occasions' => $occasions]);
    }

    /**
     * Fungsi untuk menghitung rekomendasi.
     * Ini adalah "otak" utama dari SPK kita.
     */
    public function calculate(Request $request)
    {
        // === LANGKAH 1: PERSIAPAN & VALIDASI DATA ===

        // Ambil ID acara yang dipilih user dari form input.
        $occasionId = $request->input('occasion_id');

        // Ambil data "Profil Ideal" dari database berdasarkan ID yang dipilih.
        $profilIdeal = DB::table('occasions')->find($occasionId);

        // BENTENG PERTAHANAN #1:
        // Jika acara dengan ID tersebut tidak ditemukan di database, jangan lanjutkan proses.
        // Langsung kembalikan user ke halaman awal dengan pesan error.
        if (!$profilIdeal) {
            return redirect('/')->with('error', 'Acara yang dipilih tidak valid atau tidak ditemukan!');
        }

        // Ambil SEMUA data pakaian dari database, dipisah per kategori.
        $semuaAtasan = DB::table('clothing_items')->where('category', 'Atasan')->get();
        $semuaBawahan = DB::table('clothing_items')->where('category', 'Bawahan')->get();
        $semuaSepatu = DB::table('clothing_items')->where('category', 'Sepatu')->get();
        // (Bisa tambahkan untuk Outerwear, Tas, dll. jika algoritmanya sudah mendukung)

        // BENTENG PERTAHANAN #2:
        // Jika salah satu kategori (misal: tidak ada data sepatu sama sekali) kosong,
        // kita tidak bisa membuat kombinasi. Tampilkan halaman hasil tanpa rekomendasi.
        if ($semuaAtasan->isEmpty() || $semuaBawahan->isEmpty() || $semuaSepatu->isEmpty()) {
            return view('result', ['rekomendasi' => null]);
        }


        // === LANGKAH 2: PROSES PENCocokan (Looping) ===

        $hasilKombinasi = []; // Array kosong untuk menyimpan hasil perhitungan semua kombinasi.

        // Kita akan loop semua kemungkinan kombinasi Atasan, Bawahan, dan Sepatu.
        foreach ($semuaAtasan as $atasan) {
            foreach ($semuaBawahan as $bawahan) {
                foreach ($semuaSepatu as $sepatu) {

                    // A. Hitung Poin Penalti untuk setiap item terhadap Profil Ideal.
                    $penaltiAtasan = $this->hitungPoinPenalti($atasan, $profilIdeal);
                    $penaltiBawahan = $this->hitungPoinPenalti($bawahan, $profilIdeal);
                    $penaltiSepatu = $this->hitungPoinPenalti($sepatu, $profilIdeal);

                    // B. Hitung Total Poin Penalti untuk kombinasi ini.
                    $totalPoinPenalti = $penaltiAtasan + $penaltiBawahan + $penaltiSepatu;

                    // C. Simpan hasil perhitungan ke dalam array.
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

        // BENTENG PERTAHANAN #3:
        // Jika setelah di-loop ternyata tidak ada hasil sama sekali (walaupun ini jarang terjadi
        // jika sudah lolos benteng #2), tetap kita tangani.
        if (empty($hasilKombinasi)) {
            return view('result', ['rekomendasi' => null]);
        }

        // Urutkan array $hasilKombinasi berdasarkan 'total_poin_penalti' dari yang terkecil ke terbesar.
        usort($hasilKombinasi, function ($a, $b) {
            return $a['total_poin_penalti'] <=> $b['total_poin_penalti'];
        });

        // Ambil 1 kombinasi terbaik (yang ada di urutan pertama setelah di-sort).
        $rekomendasiTerbaik = $hasilKombinasi[0];

        // Kirim data rekomendasi terbaik ke halaman view 'result.blade.php'.
        return view('result', ['rekomendasi' => $rekomendasiTerbaik]);
    }

    /**
     * Fungsi BANTUAN untuk menghitung Poin Penalti satu item.
     * Dibuat terpisah agar rapi dan bisa dipakai berulang kali.
     * Logika penalti di sini juga sudah diperbaiki agar lebih fleksibel.
     */
    private function hitungPoinPenalti($pakaian, $profilIdeal)
    {
        // Beri bobot untuk setiap kriteria agar lebih relevan
        $bobotFormalitas = 1.5;
        $bobotKehangatan = 1.0;
        $bobotStyle = 2.0; // Style kita anggap paling penting, jadi bobotnya paling tinggi

        // Hitung selisih mutlak (jarak) untuk setiap kriteria, lalu kalikan dengan bobot.
        $penaltiFormalitas = abs($pakaian->formality_score - $profilIdeal->target_formality) * $bobotFormalitas;
        $penaltiKehangatan = abs($pakaian->warmth_score - $profilIdeal->target_warmth) * $bobotKehangatan;

        // Hitung penalti untuk 'style_genre'.
        // Jika style-nya sama persis atau itemnya Netral, penalti 0.
        // Jika beda, beri penalti tinggi.
        $penaltiStyle = 0;
        if ($pakaian->style_genre !== 'Netral' && $pakaian->style_genre !== $profilIdeal->target_style_genre) {
            $penaltiStyle = 10 * $bobotStyle; // Angka penalti yang signifikan jika genre tidak cocok & bukan netral.
        }

        // Jumlahkan semua penalti.
        return $penaltiFormalitas + $penaltiKehangatan + $penaltiStyle;
    }
}