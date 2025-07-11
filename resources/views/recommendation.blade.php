<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari Outfit Impianmu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        /* Custom style untuk slider agar terlihat lebih baik */
        input[type=range] {
            -webkit-appearance: none;
            appearance: none;
            width: 100%;
            height: 8px;
            background: #e5e7eb; /* gray-200 */
            border-radius: 9999px;
            outline: none;
            opacity: 0.7;
            transition: opacity .2s;
        }
        input[type=range]:hover {
            opacity: 1;
        }
        input[type=range]::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 20px;
            height: 20px;
            background: #4f46e5; /* indigo-600 */
            cursor: pointer;
            border-radius: 50%;
            box-shadow: 0 0 2px rgba(0,0,0,0.2);
        }
        input[type=range]::-moz-range-thumb {
            width: 20px;
            height: 20px;
            background: #4f46e5;
            cursor: pointer;
            border-radius: 50%;
            border: none;
        }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen px-4 py-8">

    <div class="w-full max-w-lg">
        <div class="text-center mb-8">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800">Cari Outfit Impianmu!</h1>
            <p class="text-gray-500 mt-2">Geser slider dan pilih style yang kamu banget!</p>
        </div>

        <div class="p-8 space-y-6 bg-white rounded-xl shadow-lg">
            
            <form action="/recommend" method="POST" class="space-y-8">
                @csrf

                {{-- Slider untuk Formalitas --}}
                <div>
                    <label for="target_formality" class="block text-sm font-medium text-gray-700 mb-2">
                        Tingkat Formalitas: <span id="formality_value" class="font-bold text-indigo-600">5</span>
                    </label>
                    <div class="flex items-center space-x-4 text-xs text-gray-500">
                        <span>Santai</span>
                        <input type="range" name="target_formality" id="target_formality" min="1" max="10" value="5" class="w-full">
                        <span>Resmi</span>
                    </div>
                </div>
                
                {{-- Slider untuk Kehangatan --}}
                <div>
                    <label for="target_warmth" class="block text-sm font-medium text-gray-700 mb-2">
                        Tingkat Kehangatan: <span id="warmth_value" class="font-bold text-indigo-600">5</span>
                    </label>
                     <div class="flex items-center space-x-4 text-xs text-gray-500">
                        <span>Adem</span>
                        <input type="range" name="target_warmth" id="target_warmth" min="1" max="10" value="5" class="w-full">
                        <span>Hangat</span>
                    </div>
                </div>

                {{-- Slider untuk Kenyamanan --}}
                <div>
                    <label for="target_comfort" class="block text-sm font-medium text-gray-700 mb-2">
                        Tingkat Kenyamanan: <span id="comfort_value" class="font-bold text-indigo-600">5</span>
                    </label>
                     <div class="flex items-center space-x-4 text-xs text-gray-500">
                        <span>Praktis</span>
                        <input type="range" name="target_comfort" id="target_comfort" min="1" max="10" value="5" class="w-full">
                        <span>Nyaman</span>
                    </div>
                </div>

                {{-- Pilihan Style/Genre --}}
                <div>
                    <label for="target_style_genre" class="block text-sm font-medium text-gray-700 mb-1">Pilih Gaya Kamu:</label>
                    <select name="target_style_genre" id="target_style_genre" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition">
                        <option value="Bumi">Cewek Bumi (Earth Tone)</option>
                        <option value="Kue">Cewek Kue (Colorful)</option>
                        <option value="Mamba">Cewek Mamba (Serba Hitam)</option>
                        <option value="Anak Senja">Anak Senja (Indie)</option>
                        <option value="Rapi">Kampus Boy (Rapi)</option>
                        <option value="Streetwear">Streetwear (Hypebeast)</option>
                        <option value="Netral">Netral / Basic</option>
                    </select>
                </div>

                <div>
                    <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out">
                        Cari Outfit! ✨
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // JavaScript sederhana untuk update nilai slider secara real-time
        function setupSlider(sliderId, valueId) {
            const slider = document.getElementById(sliderId);
            const valueDisplay = document.getElementById(valueId);
            
            if (slider && valueDisplay) {
                // Set nilai awal saat halaman dimuat
                valueDisplay.textContent = slider.value;
                
                // Update nilai saat slider digeser
                slider.addEventListener('input', function() {
                    valueDisplay.textContent = this.value;
                });
            }
        }

        // Panggil fungsi untuk setiap slider
        setupSlider('target_formality', 'formality_value');
        setupSlider('target_warmth', 'warmth_value');
        setupSlider('target_comfort', 'comfort_value');
    </script>
</body>
</html>
