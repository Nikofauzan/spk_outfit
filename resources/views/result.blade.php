<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Rekomendasi Outfit</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .outfit-card { transition: transform 0.3s ease, box-shadow 0.3s ease; }
        .outfit-card:hover { transform: translateY(-5px); box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1); }
    </style>
</head>
<body class="bg-gray-100 py-12">

    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-800">Ini Dia Rekomendasinya!</h1>
            <p class="text-gray-500 mt-2">Semoga suka dengan kombinasi outfit ini ya!</p>
        </div>

        @if ($rekomendasi)
            <div class="max-w-5xl mx-auto bg-white rounded-xl shadow-lg p-8">
                {{-- UBAH GRID INI: 2 kolom di HP, 4 kolom di layar besar --}}
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-8 text-center">
                    
                    {{-- Card untuk Atasan --}}
                    <div class="flex flex-col items-center outfit-card p-4 rounded-lg">
                        <img src="{{ $rekomendasi['atasan']->image_url ?? 'https://placehold.co/300x400/e2e8f0/4a5568?text=Atasan' }}" onerror="this.onerror=null;this.src='https://placehold.co/300x400/e2e8f0/4a5568?text=Atasan';" alt="Gambar Atasan" class="w-full h-80 object-cover rounded-lg shadow-md mb-4">
                        <p class="text-sm text-gray-500 mb-1">Atasan</p>
                        <h3 class="text-lg font-semibold text-gray-700">{{ $rekomendasi['atasan']->name }}</h3>
                    </div>

                    {{-- Card untuk Bawahan --}}
                    <div class="flex flex-col items-center outfit-card p-4 rounded-lg">
                        <img src="{{ $rekomendasi['bawahan']->image_url ?? 'https://placehold.co/300x400/e2e8f0/4a5568?text=Bawahan' }}" onerror="this.onerror=null;this.src='https://placehold.co/300x400/e2e8f0/4a5568?text=Bawahan';" alt="Gambar Bawahan" class="w-full h-80 object-cover rounded-lg shadow-md mb-4">
                        <p class="text-sm text-gray-500 mb-1">Bawahan</p>
                        <h3 class="text-lg font-semibold text-gray-700">{{ $rekomendasi['bawahan']->name }}</h3>
                    </div>

                    {{-- Card untuk Sepatu --}}
                    <div class="flex flex-col items-center outfit-card p-4 rounded-lg">
                        <img src="{{ $rekomendasi['sepatu']->image_url ?? 'https://placehold.co/300x400/e2e8f0/4a5568?text=Sepatu' }}" onerror="this.onerror=null;this.src='https://placehold.co/300x400/e2e8f0/4a5568?text=Sepatu';" alt="Gambar Sepatu" class="w-full h-80 object-cover rounded-lg shadow-md mb-4">
                        <p class="text-sm text-gray-500 mb-1">Sepatu</p>
                        <h3 class="text-lg font-semibold text-gray-700">{{ $rekomendasi['sepatu']->name }}</h3>
                    </div>

                    {{-- CARD BARU UNTUK AKSESORIS (HANYA MUNCUL JIKA ADA) --}}
                    @if(isset($rekomendasi['aksesoris']) && $rekomendasi['aksesoris'])
                        <div class="flex flex-col items-center outfit-card p-4 rounded-lg">
                            <img src="{{ $rekomendasi['aksesoris']->image_url ?? 'https://placehold.co/300x400/e2e8f0/4a5568?text=Aksesoris' }}" onerror="this.onerror=null;this.src='https://placehold.co/300x400/e2e8f0/4a5568?text=Aksesoris';" alt="Gambar Aksesoris" class="w-full h-80 object-cover rounded-lg shadow-md mb-4">
                            <p class="text-sm text-gray-500 mb-1">Bonus Aksesoris (opsional)</p>
                            <h3 class="text-lg font-semibold text-gray-700">{{ $rekomendasi['aksesoris']->name }}</h3>
                        </div>
                    @endif

                </div>
            </div>
        @else
            {{-- Tampilan jika tidak ada rekomendasi --}}
            <div class="max-w-md mx-auto bg-white rounded-xl shadow-lg p-8 text-center">
                <div class="text-5xl mb-4">😥</div>
                <h2 class="text-2xl font-bold text-gray-800">Yah, Maaf!</h2>
                <p class="text-gray-600 mt-4">Sepertinya belum ada kombinasi outfit yang cocok. Coba ubah preferensimu!</p>
            </div>
        @endif

        <div class="text-center mt-12">
            <a href="/" class="inline-block py-2 px-6 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700">
                Cari Lagi!
            </a>
        </div>
    </div>

</body>
</html>
