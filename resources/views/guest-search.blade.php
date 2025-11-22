<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MasakKu - Cari Resep</title>
    
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
<body class="bg-gray-50">
    <header class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <!-- Logo -->
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('images/masakku-logo.png') }}" alt="MasakKu Logo" class="h-14 w-auto object-contain hidden md:block">
                    <h1 class="text-2xl font-croissant text-gray-900">MasakKu</h1>
                </div>
                
                <!-- Search Bar -->
                <div class="flex-1 mx-2 md:mx-8 md:max-w-md">
                    <form action="{{ route('guest.search') }}" method="GET" class="relative">
                        <input type="text" name="search" id="searchInput" value="{{ request('search') }}" placeholder="Cari resep..." class="w-full px-4 py-2 pl-10 pr-10 text-gray-900 bg-white border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent">
                        <button type="submit" class="absolute inset-y-0 right-0 flex items-center pr-3">
                            <img src="{{ asset('images/icon-search.svg') }}" alt="Search" class="w-5 h-5 text-gray-400">
                        </button>
                    </form>
                </div>
                
                <!-- User Info / Login Button -->
                <div class="flex items-center space-x-3">
                    <!-- Guest user -->
                    <a href="{{ route('login') }}" class="text-gray-900 font-inter font-semibold hover:text-pink-500 transition-colors hidden md:block">Login</a>
                    <a href="{{ route('guest.landing') }}" class="text-red-500 font-inter font-semibold hover:text-red-600 transition-colors">&lt; Back</a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Filter -->
            <div class="lg:w-1/4">
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-8">Filter</h2>
                    
                    <!-- Durasi -->
                    <div class="mb-8">
                        <button class="w-full text-left px-4 py-3 rounded-full text-sm font-semibold mb-4 transition-colors" style="background-color: #F3CEDA; color: #5E3E36;">Durasi</button>
                        <div class="flex flex-wrap gap-2">
                            @php $currentDuration = request('duration'); @endphp
                            <a href="{{ route('guest.search', array_merge(request()->except(['page','duration']), ['duration' => '2jam+'])) }}"
                               class="px-4 py-2 rounded-full text-sm font-medium text-white transition-all duration-200 hover:scale-105 {{ $currentDuration === '2jam+' ? 'opacity-80' : '' }}"
                               style="background-color: #5E3E36;">
                                2 jam +
                            </a>
                            <a href="{{ route('guest.search', array_merge(request()->except(['page','duration']), ['duration' => '1jam'])) }}"
                               class="px-4 py-2 rounded-full text-sm font-medium text-white transition-all duration-200 hover:scale-105 {{ $currentDuration === '1jam' ? 'opacity-80' : '' }}"
                               style="background-color: #8B7355;">
                                1 jam
                            </a>
                            <a href="{{ route('guest.search', array_merge(request()->except(['page','duration']), ['duration' => '30menit'])) }}"
                               class="px-4 py-2 rounded-full text-sm font-medium text-white transition-all duration-200 hover:scale-105 {{ $currentDuration === '30menit' ? 'opacity-80' : '' }}"
                               style="background-color: #A8C8D8;">
                                30 menit
                            </a>
                            <a href="{{ route('guest.search', array_merge(request()->except(['page','duration']), ['duration' => 'express'])) }}"
                               class="px-4 py-2 rounded-full text-sm font-medium transition-all duration-200 hover:scale-105 {{ $currentDuration === 'express' ? 'opacity-80' : '' }}"
                               style="background-color: #E0F0FF; color: #2B5A7A;">
                                Express
                            </a>
                        </div>
                    </div>

                    <!-- Kategori -->
                    <div class="mb-8">
                        <button class="w-full text-left px-4 py-3 rounded-full text-sm font-semibold mb-4 transition-colors" style="background-color: #F3CEDA; color: #5E3E36;">Kategori</button>
                        <div class="flex flex-wrap gap-2">
                            @php $currentCategory = request('category'); @endphp
                            <a href="{{ route('guest.search', array_merge(request()->except(['page','category']), ['category' => 'masakan-utama'])) }}"
                               class="px-4 py-2 rounded-full text-sm font-medium text-white transition-all duration-200 hover:scale-105 {{ $currentCategory === 'masakan-utama' ? 'opacity-80' : '' }}"
                               style="background-color: #FFD700;">
                                Masakan Utama
                            </a>
                            <a href="{{ route('guest.search', array_merge(request()->except(['page','category']), ['category' => 'minuman'])) }}"
                               class="px-4 py-2 rounded-full text-sm font-medium text-white transition-all duration-200 hover:scale-105 {{ $currentCategory === 'minuman' ? 'opacity-80' : '' }}"
                               style="background-color: #FF6B6B;">
                                Minuman
                            </a>
                            <a href="{{ route('guest.search', array_merge(request()->except(['page','category']), ['category' => 'sea-food'])) }}"
                               class="px-4 py-2 rounded-full text-sm font-medium text-white transition-all duration-200 hover:scale-105 {{ $currentCategory === 'sea-food' ? 'opacity-80' : '' }}"
                               style="background-color: #4ECDC4;">
                                Sea food
                            </a>
                            <a href="{{ route('guest.search', array_merge(request()->except(['page','category']), ['category' => 'dessert'])) }}"
                               class="px-4 py-2 rounded-full text-sm font-medium text-white transition-all duration-200 hover:scale-105 {{ $currentCategory === 'dessert' ? 'opacity-80' : '' }}"
                               style="background-color: #95E1D3;">
                                Dessert
                            </a>
                            <a href="{{ route('guest.search', array_merge(request()->except(['page','category']), ['category' => 'sup-kuah'])) }}"
                               class="px-4 py-2 rounded-full text-sm font-medium text-white transition-all duration-200 hover:scale-105 {{ $currentCategory === 'sup-kuah' ? 'opacity-80' : '' }}"
                               style="background-color: #D3C8EA;">
                                Sup &amp; Kuah
                            </a>
                            <a href="{{ route('guest.search', array_merge(request()->except(['page','category']), ['category' => 'cemilan'])) }}"
                               class="px-4 py-2 rounded-full text-sm font-medium text-white transition-all duration-200 hover:scale-105 {{ $currentCategory === 'cemilan' ? 'opacity-80' : '' }}"
                               style="background-color: #DDD9D5;">
                                Cemilan
                            </a>
                        </div>
                    </div>

                    <!-- Budget -->
                    <div class="mb-8">
                        <button class="w-full text-left px-4 py-3 rounded-full text-sm font-semibold mb-4 transition-colors" style="background-color: #F3CEDA; color: #5E3E36;">Budget</button>
                        <div class="flex flex-wrap gap-2">
                            @php $currentBudget = request('budget'); @endphp
                            <a href="{{ route('guest.search', array_merge(request()->except(['page','budget']), ['budget' => '100k+'])) }}"
                               class="px-4 py-2 rounded-full text-sm font-medium text-white transition-all duration-200 hover:scale-105 {{ $currentBudget === '100k+' ? 'opacity-80' : '' }}"
                               style="background-color: #FF69B4;">
                                100k+
                            </a>
                            <a href="{{ route('guest.search', array_merge(request()->except(['page','budget']), ['budget' => '50-100k'])) }}"
                               class="px-4 py-2 rounded-full text-sm font-medium text-white transition-all duration-200 hover:scale-105 {{ $currentBudget === '50-100k' ? 'opacity-80' : '' }}"
                               style="background-color: #4169E1;">
                                50-100K
                            </a>
                            <a href="{{ route('guest.search', array_merge(request()->except(['page','budget']), ['budget' => '30-50k'])) }}"
                               class="px-4 py-2 rounded-full text-sm font-medium text-white transition-all duration-200 hover:scale-105 {{ $currentBudget === '30-50k' ? 'opacity-80' : '' }}"
                               style="background-color: #8A2BE2;">
                                30-50K
                            </a>
                            <a href="{{ route('guest.search', array_merge(request()->except(['page','budget']), ['budget' => '15-30k'])) }}"
                               class="px-4 py-2 rounded-full text-sm font-medium text-white transition-all duration-200 hover:scale-105 {{ $currentBudget === '15-30k' ? 'opacity-80' : '' }}"
                               style="background-color: #32CD32;">
                                15-30K
                            </a>
                        </div>
                    </div>

                    <!-- Kandungan Gizi -->
                    <div class="mb-8">
                        <button class="w-full text-left px-4 py-3 rounded-full text-sm font-semibold mb-4 transition-colors" style="background-color: #F3CEDA; color: #5E3E36;">Kandungan Gizi</button>
                        <div class="flex flex-wrap gap-2">
                            @php $currentNutrition = request('nutrition'); @endphp
                            <a href="{{ route('guest.search', array_merge(request()->except(['page','nutrition']), ['nutrition' => 'karbohidrat'])) }}"
                               class="px-4 py-2 rounded-full text-sm font-medium text-white transition-all duration-200 hover:scale-105 {{ $currentNutrition === 'karbohidrat' ? 'opacity-80' : '' }}"
                               style="background-color: #ADFF2F;">
                                Karbohidrat
                            </a>
                            <a href="{{ route('guest.search', array_merge(request()->except(['page','nutrition']), ['nutrition' => 'protein'])) }}"
                               class="px-4 py-2 rounded-full text-sm font-medium text-white transition-all duration-200 hover:scale-105 {{ $currentNutrition === 'protein' ? 'opacity-80' : '' }}"
                               style="background-color: #DDA0DD;">
                                Protein
                            </a>
                            <a href="{{ route('guest.search', array_merge(request()->except(['page','nutrition']), ['nutrition' => 'lemak'])) }}"
                               class="px-4 py-2 rounded-full text-sm font-medium text-white transition-all duration-200 hover:scale-105 {{ $currentNutrition === 'lemak' ? 'opacity-80' : '' }}"
                               style="background-color: #FFA500;">
                                Lemak
                            </a>
                            <a href="{{ route('guest.search', array_merge(request()->except(['page','nutrition']), ['nutrition' => 'mineral'])) }}"
                               class="px-4 py-2 rounded-full text-sm font-medium text-white transition-all duration-200 hover:scale-105 {{ $currentNutrition === 'mineral' ? 'opacity-80' : '' }}"
                               style="background-color: #191970;">
                                Mineral
                            </a>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Hasil Recipe -->
            <div class="lg:w-3/4">
                @php
                    $hasActiveFilters = request()->hasAny(['duration','category','budget','nutrition']);
                    $durationLabels = [
                        'express' => 'Express',
                        '30menit' => '30 Menit',
                        '1jam' => '1 Jam',
                        '2jam+' => '2 Jam+',
                    ];
                    $categoryLabels = [
                        'masakan-utama' => 'Masakan Utama',
                        'minuman' => 'Minuman',
                        'sea-food' => 'Sea Food',
                        'dessert' => 'Dessert',
                        'sup-kuah' => 'Sup & Kuah',
                        'cemilan' => 'Cemilan',
                    ];
                    $budgetLabels = [
                        '100k+' => '100k+',
                        '50-100k' => '50-100k',
                        '30-50k' => '30-50K',
                        '15-30k' => '15-30K',
                    ];
                    $nutritionLabels = [
                        'karbohidrat' => 'Karbohidrat',
                        'protein' => 'Protein',
                        'lemak' => 'Lemak',
                        'mineral' => 'Mineral',
                    ];
                @endphp

                @if ($hasActiveFilters)
                    <div class="mb-6">
                        <div class="bg-white rounded-lg shadow-sm p-4">
                            <div class="flex items-center justify-between mb-3">
                                <h3 class="text-lg font-semibold text-gray-900">Filter Aktif:</h3>
                                <a href="{{ route('guest.search', request()->only('search')) }}" class="text-sm text-red-500 hover:text-red-600 font-medium">Hapus Semua</a>
                            </div>
                            <div class="flex flex-wrap gap-2">
                                @if (request('duration'))
                                    <a href="{{ route('guest.search', request()->except('duration')) }}" class="bg-pink-100 text-pink-800 px-3 py-1 rounded-full text-sm hover:bg-pink-200 transition-colors">
                                        Durasi: {{ $durationLabels[request('duration')] ?? request('duration') }}
                                    </a>
                                @endif
                                @if (request('category'))
                                    <a href="{{ route('guest.search', request()->except('category')) }}" class="bg-pink-100 text-pink-800 px-3 py-1 rounded-full text-sm hover:bg-pink-200 transition-colors">
                                        Kategori: {{ $categoryLabels[request('category')] ?? request('category') }}
                                    </a>
                                @endif
                                @if (request('budget'))
                                    <a href="{{ route('guest.search', request()->except('budget')) }}" class="bg-pink-100 text-pink-800 px-3 py-1 rounded-full text-sm hover:bg-pink-200 transition-colors">
                                        Budget: {{ $budgetLabels[request('budget')] ?? request('budget') }}
                                    </a>
                                @endif
                                @if (request('nutrition'))
                                    <a href="{{ route('guest.search', request()->except('nutrition')) }}" class="bg-pink-100 text-pink-800 px-3 py-1 rounded-full text-sm hover:bg-pink-200 transition-colors">
                                        Gizi: {{ $nutritionLabels[request('nutrition')] ?? request('nutrition') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Recipe Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @forelse($recipes as $recipe)
                    <div class="recipe-card bg-white rounded-lg shadow-lg overflow-hidden hover:scale-105 hover:shadow-xl transition-all duration-300 cursor-pointer" data-recipe="{{ $recipe->slug }}" onclick="window.location.href='{{ route('recipes.show', $recipe->slug) }}'">
                        <div class="relative">
                            <img src="{{ asset('images/' . $recipe->image) }}" alt="{{ $recipe->title }}" class="w-full h-48 object-cover">
                            <!-- No like button for guests -->
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-4">{{ $recipe->title }}</h3>
                            <div class="flex items-center space-x-6 text-sm text-gray-600">
                                <div class="flex items-center space-x-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                    </svg>
                                    <span>{{ $recipe->views }}</span>
                                </div>
                                <div class="flex items-center space-x-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                    </svg>
                                    <span>{{ $recipe->favorites }}</span>
                                </div>
                                <div class="flex items-center space-x-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                    @php
                                        $durationText = $recipe->total_time;
                                        if (! $durationText && $recipe->duration_category) {
                                            $durationLabelsMap = [
                                                'express' => 'Express',
                                                '30menit' => '30 Menit',
                                                '1jam' => '1 Jam',
                                                '2jam+' => '2 Jam+',
                                            ];
                                            $key = $recipe->duration_category;
                                            $durationText = $durationLabelsMap[$key] ?? ucfirst($key);
                                        }
                                    @endphp
                                    <span>{{ $durationText }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-2 text-center text-gray-500 py-8">
                        <p>Tidak ada resep yang ditemukan.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const activeFiltersDiv = document.getElementById('activeFilters');
            const filterTagsDiv = document.getElementById('filterTags');
            const clearAllFiltersBtn = document.getElementById('clearAllFilters');
            const filterButtons = document.querySelectorAll('.filter-btn');
            
            let activeFilters = [];

            filterButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const filterType = this.getAttribute('data-filter');
                    const filterValue = this.getAttribute('data-value');
                    const filterText = this.textContent.trim();
                    
                    // Cek filter aktif
                    const existingFilterIndex = activeFilters.findIndex(filter => 
                        filter.type === filterType && filter.value === filterValue
                    );
                    
                    if (existingFilterIndex !== -1) {
                        activeFilters.splice(existingFilterIndex, 1);
                        this.style.opacity = '1';
                        this.style.transform = 'scale(1)';
                    } else {
                        // Add filter
                        activeFilters.push({
                            value: filterValue,
                            text: filterText,
                            type: filterType
                        });
                        this.style.opacity = '0.7';
                        this.style.transform = 'scale(0.95)';
                    }
                    
                    updateActiveFiltersDisplay();
                });
            });

            function updateActiveFiltersDisplay() {
                filterTagsDiv.innerHTML = '';
                
                if (activeFilters.length === 0) {
                    activeFiltersDiv.classList.add('hidden');
                    return;
                }
                
                activeFiltersDiv.classList.remove('hidden');
                
                activeFilters.forEach((filter, index) => {
                    const tag = document.createElement('div');
                    tag.className = 'flex items-center space-x-2 bg-pink-100 text-pink-800 px-3 py-1 rounded-full text-sm';
                    tag.innerHTML = `
                        <span>${filter.text}</span>
                        <button class="remove-filter text-pink-600 hover:text-pink-800 font-bold" data-filter-type="${filter.type}" data-filter-value="${filter.value}">×</button>
                    `;
                    filterTagsDiv.appendChild(tag);
                });
                
                document.querySelectorAll('.remove-filter').forEach(btn => {
                    btn.addEventListener('click', function() {
                        const filterType = this.getAttribute('data-filter-type');
                        const filterValue = this.getAttribute('data-filter-value');
                        
                        // Remove from active filters array
                        activeFilters = activeFilters.filter(filter => 
                            !(filter.type === filterType && filter.value === filterValue)
                        );
                        
                        filterButtons.forEach(button => {
                            if (button.getAttribute('data-filter') === filterType && 
                                button.getAttribute('data-value') === filterValue) {
                                button.style.opacity = '1';
                                button.style.transform = 'scale(1)';
                            }
                        });
                        
                        updateActiveFiltersDisplay();
                    });
                });
            }

            clearAllFiltersBtn.addEventListener('click', function() {
                activeFilters = [];
                filterButtons.forEach(button => {
                    button.style.opacity = '1';
                    button.style.transform = 'scale(1)';
                });
                updateActiveFiltersDisplay();
            });

            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                filterRecipes(searchTerm);
            });

            function filterRecipes(searchTerm = '') {
                const recipeCards = document.querySelectorAll('.recipe-card');
                
                recipeCards.forEach(card => {
                    const recipeName = card.querySelector('h3').textContent.toLowerCase();
                    const recipeData = card.getAttribute('data-recipe');
                    
                    let showCard = true;
                    
                    if (searchTerm && !recipeName.includes(searchTerm)) {
                        showCard = false;
                    }
                    
                    if (activeFilters.length > 0) {
                        let matchesFilter = false;
                        
                        activeFilters.forEach(filter => {
                            if (matchesRecipeFilter(recipeData, filter)) {
                                matchesFilter = true;
                            }
                        });
                        
                        if (!matchesFilter) {
                            showCard = false;
                        }
                    }
                    
                    if (showCard) {
                        card.style.display = 'block';
                        card.style.opacity = '1';
                        card.style.transform = 'scale(1)';
                    } else {
                        card.style.display = 'none';
                        card.style.opacity = '0';
                        card.style.transform = 'scale(0.95)';
                    }
                });
            }

            function matchesRecipeFilter(recipeData, filter) {
                const recipeInfo = {
                    'nasi-goreng': { category: 'main-dish', duration: '30menit', budget: '15k', nutrition: 'karbohidrat' },
                    'ayam-asam-manis': { category: 'main-dish', duration: '1jam', budget: '30k', nutrition: 'protein' },
                    'pasta-aglio-olio': { category: 'main-dish', duration: '30menit', budget: '15k', nutrition: 'karbohidrat' },
                    'tom-yum-seafood': { category: 'seafood', duration: '30menit', budget: '50-100k', nutrition: 'protein' }
                };
                
                const recipe = recipeInfo[recipeData];
                if (!recipe) return false;
                
                switch(filter.type) {
                    case 'category':
                        return recipe.category === filter.value;
                    case 'duration':
                        return recipe.duration === filter.value;
                    case 'budget':
                        return recipe.budget === filter.value;
                    case 'nutrition':
                        return recipe.nutrition === filter.value;
                    default:
                        return false;
                }
            }

            const originalUpdateActiveFiltersDisplay = updateActiveFiltersDisplay;
            updateActiveFiltersDisplay = function() {
                originalUpdateActiveFiltersDisplay();
                filterRecipes(searchInput.value.toLowerCase());
            };
        });
    </script>
</body>
</html>


