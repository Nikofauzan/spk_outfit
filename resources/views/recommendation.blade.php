<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RecommendationController extends Controller
{
    public function index()
    {
        $occasions = DB::table('occasions')->get();
        return view('recommendation', ['occasions' => $occasions]);
    }

    public function calculate(Request $request)
    {
        // === LANGKAH 1: PERSIAPAN ===
        $occasionId = $request->input('occasion_id');
        $profilIdeal = DB::table('occasions')->find($occasionId);

        if (!$profilIdeal) {
            // Jika acara tidak ditemukan, kembali ke halaman awal dengan pesan error
            return redirect('/')->with('error', 'Acara tidak ditemukan!');
        }

        $semuaAtasan = DB::table('clothing_items')->where('category', 'Atasan')->get();
        $semuaBawahan = DB::table('clothing_items')->where('category', 'Bawahan')->get();
        $semuaSepatu = DB::table('clothing_items')->where('category', 'Sepatu')->get();

        $hasilKombinasi = [];

        // === LANGKAH 2: PROSES PENCOCOKAN ===
        if ($semuaAtasan->isEmpty() || $semuaBawahan->isEmpty() || $semuaSepatu->isEmpty()) {
             // Jika salah satu kategori pakaian kosong, langsung tampilkan hasil tanpa rekomendasi
             return view('result', ['rekomendasi' => null]);
        }
        
        foreach ($semuaAtasan as $atasan) {
            foreach ($semuaBawahan as $bawahan) {
                foreach ($semuaSepatu as $sepatu) {
                    
                    // A. Hitung Poin Penalti untuk setiap item
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
        if (empty($hasilKombinasi)) {
            return view('result', ['rekomendasi' => null]);
        }
        
        // Urutkan array berdasarkan 'total_poin_penalti' dari yang terkecil
        usort($hasilKombinasi, function ($a, $b) {
            return $a['total_poin_penalti'] <=> $b['total_poin_penalti'];
        });

        $rekomendasiTerbaik = $hasilKombinasi[0]; 

        return view('result', ['rekomendasi' => $rekomendasiTerbaik]);
    }

    private function hitungPoinPenalti($pakaian, $profilIdeal)
    {
        // Definisikan bobot untuk setiap kriteria
        $bobotFormalitas = 1.5;
        $bobotKehangatan = 1.0;
        $bobotStyle = 2.0;

        // Hitung selisih mutlak (jarak) untuk setiap kriteria.
        $penaltiFormalitas = abs($pakaian->formality_score - $profilIdeal->target_formality) * $bobotFormalitas;
        $penaltiKehangatan = abs($pakaian->warmth_score - $profilIdeal->target_warmth) * $bobotKehangatan;

        // Hitung penalti untuk 'style_genre'.
        $penaltiStyle = 0;
        if ($pakaian->style_genre !== 'Netral' && $pakaian->style_genre !== $profilIdeal->target_style_genre) {
            $penaltiStyle = 10 * $bobotStyle; // Penalti tinggi jika genre tidak cocok & bukan netral.
        }

        return $penaltiFormalitas + $penaltiKehangatan + $penaltiStyle;
    }
}