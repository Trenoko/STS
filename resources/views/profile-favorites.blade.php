<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favorite Recipes - MasakKu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Croissant+One&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'croissant': ['Croissant One', 'cursive'],
                        'inter': ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-[#faf6f2] min-h-screen flex justify-center items-start py-10">
    <div class="w-full max-w-6xl bg-white rounded-2xl shadow-lg px-8 py-8">
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center space-x-3">
                <img src="{{ asset('images/masakku-logo.png') }}" alt="MasakKu Logo" class="h-14 w-auto object-contain">
                <h1 class="text-3xl font-croissant text-gray-900">MasakKu</h1>
            </div>
            <a href="{{ route('profile') }}" class="text-red-500 font-semibold hover:text-red-600">&lt; Back to Profile</a>
        </div>

        <h2 class="text-4xl font-croissant text-center text-gray-900 mb-8">Favorite Recipes</h2>

        @if($recipes->isEmpty())
            <div class="text-center text-gray-500 font-inter">
                Kamu belum memiliki resep favorit. Coba like beberapa resep dulu di halaman utama.
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($recipes as $recipe)
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:scale-105 hover:shadow-xl transition-all duration-300 cursor-pointer" onclick="window.location.href='{{ route('recipes.show', $recipe->slug) }}'">
                        <div class="relative">
                            <img src="{{ asset('images/' . $recipe->image) }}" alt="{{ $recipe->title }}" class="w-full h-48 object-cover">
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $recipe->title }}</h3>
                            <div class="flex items-center space-x-6 text-sm text-gray-600">
                                <div class="flex items-center space-x-1">
                                    <img src="{{ asset('images/view.png') }}" alt="View" class="w-4 h-4">
                                    <span>{{ $recipe->views }}</span>
                                </div>
                                <div class="flex items-center space-x-1">
                                    <img src="{{ asset('images/favourite.png') }}" alt="Favorite" class="w-4 h-4">
                                    <span>{{ $recipe->favorites }}</span>
                                </div>
                                @php
                                    $durationText = $recipe->total_time;
                                    if (! $durationText && $recipe->duration_category) {
                                        $durationLabels = [
                                            'express' => 'Express',
                                            '30menit' => '30 Menit',
                                            '1jam' => '1 Jam',
                                            '2jam+' => '2 Jam+',
                                        ];
                                        $key = $recipe->duration_category;
                                        $durationText = $durationLabels[$key] ?? ucfirst($key);
                                    }
                                @endphp
                                @if($durationText)
                                    <div class="flex items-center space-x-1">
                                        <img src="{{ asset('images/time-left.png') }}" alt="Time" class="w-4 h-4">
                                        <span>{{ $durationText }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</body>
</html>
