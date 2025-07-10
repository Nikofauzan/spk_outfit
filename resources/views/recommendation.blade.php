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
        /* Custom style untuk slider */
        input[type=range]::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 20px;
            height: 20px;
            background: #4f46e5; /* Indigo */
            cursor: pointer;
            border-radius: 50%;
        }
        input[type=range]::-moz-range-thumb {
            width: 20px;
            height: 20px;
            background: #4f46e5;
            cursor: pointer;
            border-radius: 50%;
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
                    <label for="target_formality" class="block text-sm font-medium text-gray-700 mb-1">
                        Tingkat Formalitas: <span id="formality_value" class="font-bold text-indigo-600">5</span>
                    </label>
                    <div class="flex items-center space-x-4 text-xs text-gray-500">
                        <span>Santai</span>
                        <input type="range" name="target_formality" id="target_formality" min="1" max="10" value="5" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer">
                        <span>Resmi</span>
                    </div>
                </div>
                
                {{-- Slider untuk Kehangatan --}}
                <div>
                    <label for="target_warmth" class="block text-sm font-medium text-gray-700 mb-1">
                        Tingkat Kehangatan: <span id="warmth_value" class="font-bold text-indigo-600">5</span>
                    </label>
                     <div class="flex items-center space-x-4 text-xs text-gray-500">
                        <span>Adem</span>
                        <input type="range" name="target_warmth" id="target_warmth" min="1" max="10" value="5" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer">
                        <span>Hangat</span>
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
        const formalitySlider = document.getElementById('target_formality');
        const formalityValue = document.getElementById('formality_value');
        formalitySlider.oninput = function() {
            formalityValue.textContent = this.value;
        }

        const warmthSlider = document.getElementById('target_warmth');
        const warmthValue = document.getElementById('warmth_value');
        warmthSlider.oninput = function() {
            warmthValue.textContent = this.value;
        }
    </script>
</body>
</html>
