<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RecommendationController extends Controller
{
    /**
     * Halaman index sekarang tugasnya cuma menampilkan form.
     * Tidak perlu mengambil data apa-apa lagi.
     */
    public function index()
    {
        return view('recommendation');
    }

    /**
     * Fungsi untuk menghitung rekomendasi.
     * Logikanya diubah untuk membangun profil ideal dari input user.
     */
    public function calculate(Request $request)
    {
        // === LANGKAH 1: BANGUN PROFIL IDEAL DARI INPUT USER ===
        
        // Validasi input dulu biar aman
        $request->validate([
            'target_formality' => 'required|integer|min:1|max:10',
            'target_warmth' => 'required|integer|min:1|max:10',
            'target_style_genre' => 'required|string',
        ]);

        // Buat objek "Profil Ideal" secara dinamis dari data yang dikirim form.
        // Kita pakai (object) biar strukturnya mirip kayak data dari database.
        $profilIdeal = (object)[
            'target_formality' => $request->input('target_formality'),
            'target_warmth'    => $request->input('target_warmth'),
            'target_style_genre' => $request->input('target_style_genre'),
        ];

        // === SISA LOGIKA DARI SINI KE BAWAH, SAMA PERSIS! ===
        // Tidak perlu diubah sama sekali, karena dia akan otomatis membandingkan
        // dengan $profilIdeal baru yang sudah kita buat.

        $semuaAtasan = DB::table('clothing_items')->where('category', 'Atasan')->get();
        $semuaBawahan = DB::table('clothing_items')->where('category', 'Bawahan')->get();
        $semuaSepatu = DB::table('clothing_items')->where('category', 'Sepatu')->get();

        if ($semuaAtasan->isEmpty() || $semuaBawahan->isEmpty() || $semuaSepatu->isEmpty()) {
            return view('result', ['rekomendasi' => null]);
        }

        $hasilKombinasi = [];
        foreach ($semuaAtasan as $atasan) {
            foreach ($semuaBawahan as $bawahan) {
                foreach ($semuaSepatu as $sepatu) {
                    $penaltiAtasan = $this->hitungPoinPenalti($atasan, $profilIdeal);
                    $penaltiBawahan = $this->hitungPoinPenalti($bawahan, $profilIdeal);
                    $penaltiSepatu = $this->hitungPoinPenalti($sepatu, $profilIdeal);
                    $totalPoinPenalti = $penaltiAtasan + $penaltiBawahan + $penaltiSepatu;

                    $hasilKombinasi[] = [
                        'atasan' => $atasan,
                        'bawahan' => $bawahan,
                        'sepatu' => $sepatu,
                        'total_poin_penalti' => $totalPoinPenalti,
                    ];
                }
            }
        }

        if (empty($hasilKombinasi)) {
            return view('result', ['rekomendasi' => null]);
        }

        usort($hasilKombinasi, function ($a, $b) {
            return $a['total_poin_penalti'] <=> $b['total_poin_penalti'];
        });

        $rekomendasiTerbaik = $hasilKombinasi[0];
        return view('result', ['rekomendasi' => $rekomendasiTerbaik]);
    }

    private function hitungPoinPenalti($pakaian, $profilIdeal)
    {
        $bobotFormalitas = 1.5;
        $bobotKehangatan = 1.0;
        $bobotStyle = 2.0;

        $penaltiFormalitas = abs($pakaian->formality_score - $profilIdeal->target_formality) * $bobotFormalitas;
        $penaltiKehangatan = abs($pakaian->warmth_score - $profilIdeal->target_warmth) * $bobotKehangatan;

        $penaltiStyle = 0;
        if ($pakaian->style_genre !== 'Netral' && $pakaian->style_genre !== $profilIdeal->target_style_genre) {
            $penaltiStyle = 10 * $bobotStyle;
        }

        return $penaltiFormalitas + $penaltiKehangatan + $penaltiStyle;
    }
}
