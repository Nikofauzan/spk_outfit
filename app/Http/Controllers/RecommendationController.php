<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RecommendationController extends Controller
{
    public function index()
    {
        return view('recommendation');
    }

    public function calculate(Request $request)
    {
        // ... (Bagian validasi dan pembuatan $profilIdeal sama persis)
        $request->validate([
            'target_formality' => 'required|integer|min:1|max:10',
            'target_warmth' => 'required|integer|min:1|max:10',
            'target_comfort' => 'required|integer|min:1|max:10',
            'target_style_genre' => 'required|string',
        ]);

        $profilIdeal = (object)[
            'target_formality' => $request->input('target_formality'),
            'target_warmth'    => $request->input('target_warmth'),
            'target_comfort'   => $request->input('target_comfort'),
            'target_style_genre' => $request->input('target_style_genre'),
        ];
        
        // ... (Bagian looping untuk atasan, bawahan, sepatu juga sama persis)
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

        // =================================================================
        // LANGKAH 4: CARI AKSESORIS TAMBAHAN (INI BAGIAN BARUNYA!)
        // =================================================================
        $aksesorisTerbaik = null;
        $semuaAksesoris = DB::table('clothing_items')->where('category', 'Aksesoris')->get();

        // Hanya jalankan pencarian jika ada data aksesoris di database
        if (!$semuaAksesoris->isEmpty()) {
            $poinPenaltiTerendah = PHP_INT_MAX; // Set ke angka tertinggi

            foreach ($semuaAksesoris as $aksesoris) {
                $penaltiSekarang = $this->hitungPoinPenalti($aksesoris, $profilIdeal);
                if ($penaltiSekarang < $poinPenaltiTerendah) {
                    $poinPenaltiTerendah = $penaltiSekarang;
                    $aksesorisTerbaik = $aksesoris;
                }
            }
        }
        
        // Selipkan aksesoris terbaik (atau null jika tidak ada) ke dalam hasil rekomendasi
        $rekomendasiTerbaik['aksesoris'] = $aksesorisTerbaik;
        // =================================================================

        return view('result', ['rekomendasi' => $rekomendasiTerbaik]);
    }

    private function hitungPoinPenalti($pakaian, $profilIdeal)
    {
        $bobotStyle = 2.0;
        $bobotFormalitas = 1.5;
        $bobotKenyamanan = 1.2;
        $bobotKehangatan = 1.0;

        $penaltiStyle = 0;
        if ($pakaian->style_genre !== 'Netral' && $pakaian->style_genre !== $profilIdeal->target_style_genre) {
            $penaltiStyle = 10 * $bobotStyle;
        }
        $penaltiFormalitas = abs($pakaian->formality_score - $profilIdeal->target_formality) * $bobotFormalitas;
        $penaltiKenyamanan = abs($pakaian->comfort_score - $profilIdeal->target_comfort) * $bobotKenyamanan;
        $penaltiKehangatan = abs($pakaian->warmth_score - $profilIdeal->target_warmth) * $bobotKehangatan;

        return $penaltiStyle + $penaltiFormalitas + $penaltiKenyamanan + $penaltiKehangatan;
    }
}
