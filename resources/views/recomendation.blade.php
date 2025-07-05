<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekomendasi Outfit</title>
    {{-- Memuat Tailwind CSS untuk styling --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md p-8 space-y-6 bg-white rounded-xl shadow-lg">
        <div class="text-center">
            <h1 class="text-3xl font-bold text-gray-800">Mau Pergi Kemana Hari Ini?</h1>
            <p class="text-gray-500 mt-2">Pilih acara biar aku bantu cariin outfit yang pas!</p>
        </div>

        {{-- Form ini akan mengirim data ke route '/recommend' dengan metode POST --}}
        <form action="/recommend" method="POST" class="space-y-6">
            {{-- @csrf adalah token keamanan wajib dari Laravel --}}
            @csrf

            <div>
                <label for="occasion_id" class="block text-sm font-medium text-gray-700">Pilih Acara:</label>
                <select name="occasion_id" id="occasion_id" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    {{-- Loop semua data acara yang dikirim dari Controller --}}
                    @foreach ($occasions as $occasion)
                        <option value="{{ $occasion->id }}">{{ $occasion->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out">
                    Cari Outfit! ✨
                </button>
            </div>
        </form>
    </div>

</body>
</html>
