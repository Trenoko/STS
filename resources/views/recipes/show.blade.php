<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $recipe->title }} - MasakKu</title>
    
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
<body class="bg-white">
    <!-- Header -->
    <header class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <!-- Logo-->
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('images/masakku-logo.png') }}" alt="MasakKu Logo" class="h-14 w-auto object-contain hidden md:block">
                    <h1 class="text-2xl font-croissant text-gray-900">MasakKu</h1>
                </div>
                
                <!-- Back Button -->
                <div class="flex items-center space-x-3">
                    <a href="{{ url()->previous() }}" class="text-red-500 font-inter font-semibold hover:text-red-600 transition-colors">&lt; Back</a>
                </div>
            </div>
        </div>
    </header>

    <!-- Recipe Content -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Title -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $recipe->title }}</h1>
        </div>

        <!-- Recipe Image -->
        <div class="relative mb-6">
            <img src="{{ asset('images/' . $recipe->image) }}" alt="{{ $recipe->title }}" class="w-full h-96 object-cover rounded-lg shadow-lg">
        </div>

        <!-- Filter Tags , Favorite Button -->
        <div class="flex flex-wrap items-center justify-between gap-3 mb-8">
            <!-- Tags Section -->
            <div class="flex flex-wrap items-center gap-3">
                <!-- Category Tag (from related category) -->
                <div class="bg-lime-400 text-black px-4 py-2 rounded-lg font-medium">
                    {{ $recipe->category->name }}
                </div>
            </div>
            
            @auth
            <!-- Favorite Button (login only) -->
            <div class="flex items-center space-x-2">
                <button id="favorite-btn"
                        class="text-gray-600 hover:text-red-500 transition-colors"
                        type="button">
                    <svg class="w-6 h-6 {{ $isLiked ? 'text-red-500 fill-red-500' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                </button>
                <span class="text-gray-900 font-medium" id="favorite-label">{{ $isLiked ? 'Favorit' : 'Favorit' }}</span>
            </div>
            @endauth
        </div>

        <!-- Recipe Content Layout -->
        <div class="space-y-8">
            <!-- Durasi, Porsi, Difficulty, Budget -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h2 class="text-xl font-bold text-gray-900 mb-3">Durasi</h2>
                    <p class="text-lg text-gray-700 mb-6">
                        @php
                            $durationLabels = [
                                'express' => 'Express',
                                '30menit' => '30 Menit',
                                '1jam' => '1 Jam',
                                '2jam+' => '2 Jam+',
                            ];
                        @endphp
                        {{ $durationLabels[$recipe->duration_category] ?? ucfirst($recipe->duration_category) }}
                    </p>

                    @if(!is_null($recipe->servings))
                        <h2 class="text-xl font-bold text-gray-900 mb-3">Porsi</h2>
                        <p class="text-lg text-gray-700">{{ $recipe->servings }} porsi</p>
                    @endif
                </div>

                <div>
                    @if(!empty($recipe->difficulty))
                        <h2 class="text-xl font-bold text-gray-900 mb-3">Difficulty</h2>
                        <p class="text-lg text-gray-700 mb-6">{{ ucfirst($recipe->difficulty) }}</p>
                    @endif

                    @if(!empty($recipe->budget_category))
                        <h2 class="text-xl font-bold text-gray-900 mb-3">Budget</h2>
                        @php
                            $budgetLabels = [
                                '15k' => '15-30k',
                                '30k' => '30k-50k',
                                '50-100k' => '50k-100k',
                                '100k+' => '100k≤',
                            ];
                            $budgetText = $budgetLabels[$recipe->budget_category] ?? strtoupper($recipe->budget_category);
                        @endphp
                        <p class="text-lg text-gray-700">{{ $budgetText }}</p>
                    @endif
                </div>
            </div>

            <!-- Ingredients + Kandungan Gizi Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Ingredients -->
                <div>
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Bahan-bahan</h2>
                    <div class="text-gray-700 space-y-2">
                        @if($recipe->ingredients)
                            @php
                                // Split ingredients by line breaks or commas
                                $ingredients = $recipe->ingredients;
                                
                                // First try to split by line breaks
                                if (strpos($ingredients, "\n") !== false) {
                                    $ingredientList = preg_split('/\n+/', $ingredients);
                                } else {
                                    // If no line breaks, split by commas
                                    $ingredientList = array_map('trim', explode(',', $ingredients));
                                }
                            @endphp
                            @foreach($ingredientList as $ingredient)
                                @php
                                    $cleanIngredient = trim($ingredient);
                                    // Remove any leading numbers or bullets
                                    $cleanIngredient = preg_replace('/^[\d\.\-\*\s]+/', '', $cleanIngredient);
                                    $cleanIngredient = trim($cleanIngredient);
                                @endphp
                                @if($cleanIngredient)
                                    <p class="flex items-start">
                                        <span class="text-gray-700 mr-2">-</span>
                                        <span class="text-gray-700">{{ $cleanIngredient }}</span>
                                    </p>
                                @endif
                            @endforeach
                        @else
                            <p class="text-gray-500">Bahan-bahan belum tersedia.</p>
                        @endif
                    </div>
                </div>

                <!-- Kandungan Gizi -->
                <div>
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Kandungan Gizi</h2>
                    @php
                        $nutritionInfo = $recipe->nutrition_info ?? null;
                        $nutritionTypes = is_array($nutritionInfo) && !empty($nutritionInfo['type']) && is_array($nutritionInfo['type'])
                            ? $nutritionInfo['type']
                            : [];
                        $nutritionDetail = is_array($nutritionInfo) && !empty($nutritionInfo['detail']) && is_array($nutritionInfo['detail'])
                            ? $nutritionInfo['detail']
                            : [];
                        $nutritionLabels = [
                            'karbohidrat' => 'Karbohidrat',
                            'protein' => 'Protein',
                            'lemak' => 'Lemak',
                            'mineral' => 'Mineral',
                        ];
                    @endphp

                    @if(!empty($nutritionTypes))
                        <div class="text-gray-700 space-y-2">
                            @foreach($nutritionTypes as $type)
                                @php
                                    $label = $nutritionLabels[$type] ?? ucfirst($type);
                                    $detail = $nutritionDetail[$type] ?? null;
                                @endphp
                                <p class="flex flex-col">
                                    <span class="font-semibold text-gray-900">{{ $label }}</span>
                                    @if($detail)
                                        <span class="text-gray-700 text-sm">{{ $detail }}</span>
                                    @endif
                                </p>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500">Kandungan gizi belum tersedia.</p>
                    @endif
                </div>
            </div>

            <!-- Instructions -->
            <div>
                <h2 class="text-xl font-bold text-gray-900 mb-6">Langkah-langkah</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @if($recipe->steps->count() > 0)
                        @foreach($recipe->steps as $step)
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-red-500 text-white rounded-full flex items-center justify-center font-bold text-sm">
                                        {{ $step->step_number }}
                                    </div>
                                </div>
                                <p class="text-gray-700 flex-1">{{ $step->instruction }}</p>
                            </div>
                        @endforeach
                    @elseif($recipe->instructions)
                        @php
                            // Fallback to old instructions field if no steps exist
                            $instructions = trim($recipe->instructions);
                            $steps = preg_split('/\n+/', $instructions);
                            $stepNumber = 1;
                        @endphp
                        @foreach($steps as $step)
                            @php
                                $cleanStep = preg_replace('/^\d+\.?\s*/', '', trim($step));
                                $cleanStep = preg_replace('/\\n\d+\.?\s*/', ' ', $cleanStep);
                                $cleanStep = trim($cleanStep);
                            @endphp
                            @if($cleanStep)
                                <div class="flex items-start space-x-4">
                                    <div class="flex-shrink-0">
                                        <div class="w-8 h-8 bg-red-500 text-white rounded-full flex items-center justify-center font-bold text-sm">
                                            {{ $stepNumber }}
                                        </div>
                                    </div>
                                    <p class="text-gray-700 flex-1">{{ $cleanStep }}</p>
                                </div>
                                @php $stepNumber++; @endphp
                            @endif
                        @endforeach
                    @else
                        <div class="col-span-2">
                            <p class="text-gray-500">Langkah-langkah belum tersedia.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Js Favorite Function-->
    @auth
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const favoriteBtn = document.getElementById('favorite-btn');
            const favoriteLabel = document.getElementById('favorite-label');

            if (!favoriteBtn) return;

            favoriteBtn.addEventListener('click', function () {
                fetch("{{ route('recipes.favorite', $recipe) }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({})
                }).then(response => response.json())
                  .then(data => {
                      if (data && data.success) {
                          const icon = favoriteBtn.querySelector('svg');
                          if (icon) {
                              if (data.liked) {
                                  icon.classList.add('text-red-500', 'fill-red-500');
                              } else {
                                  icon.classList.remove('text-red-500', 'fill-red-500');
                              }
                          }
                          if (favoriteLabel) {
                              favoriteLabel.textContent = data.liked ? 'Favorit' : 'Favorit';
                          }
                      }
                  }).catch(() => {
                      console.error('Gagal memperbarui status favorit');
                  });
            });
        });
    </script>
    @endauth
</body>
</html>

