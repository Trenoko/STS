<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MasakKu - Platform Resep #1 di Indonesia</title>
    
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
    
    <style>
        .hero-bg {
            background-image: url('{{ asset("images/nasgorblur.png") }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
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
                
                <!-- Search Bar (guest) -->
                <div class="flex-1 mx-2 md:mx-8 md:max-w-md">
                    <div class="relative">
                        <input type="text" placeholder="Search recipes..." class="w-full px-4 py-2 pl-10 pr-10 text-gray-900 bg-white border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent cursor-pointer" onclick="window.location.href='{{ route('guest.search') }}'" readonly>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <img src="{{ asset('images/icon-search.svg') }}" alt="Search" class="w-5 h-5 text-gray-400">
                        </div>
                    </div>
                </div>
                
                <!-- Login/Register Buttons -->
                <div class="flex items-center space-x-3">
                    <a href="{{ route('login') }}" class="text-gray-900 font-inter font-semibold hover:text-pink-500 transition-colors hidden md:block">Login</a>
                    <a href="{{ route('register') }}" style="background-color: #5E3E36;" class="text-white px-3 py-1.5 md:px-4 md:py-2 rounded-full font-inter font-semibold hover:bg-pink-600 transition-colors text-sm md:text-base">Register</a>
                </div>
            </div>
        </div>
    </header>

    <!-- Blur -->
    <section class="hero-bg relative min-h-[400px] flex items-center justify-center">
        <div class="text-center text-white">
            <h2 class="text-5xl font-bold mb-2">Temukan Resep</h2>
            <h2 class="text-5xl font-bold">Rumahan Terbaikmu</h2>
        </div>
    </section>

    <!-- Resep Trending -->
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-center text-gray-900 mb-8">Resep yang Lagi Trend</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse($trendingRecipes as $recipe)
                <div class="relative h-36 rounded-lg overflow-hidden hover:scale-105 transition-all duration-300 cursor-pointer" onclick="window.location.href='{{ route('recipes.show', $recipe->slug) }}'">
                    <img src="{{ asset('images/' . $recipe->image) }}" alt="{{ $recipe->title }}" class="w-full h-full object-cover blur-sm">
                    <div class="absolute inset-0 flex items-center justify-center">
                        <h3 class="text-white text-lg font-bold text-center">{{ $recipe->title }}</h3>
                    </div>
                </div>
                @empty
                <div class="col-span-3 text-center text-gray-500">
                    <p>Tidak ada resep trending saat ini.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Resep Andalan -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center text-gray-900 mb-12">Resep Andalan</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($featuredRecipes->take(3) as $recipe)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:scale-105 hover:shadow-xl transition-all duration-300 cursor-pointer" onclick="window.location.href='{{ route('recipes.show', $recipe->slug) }}'">
                    <div class="relative">
                        <img src="{{ asset('images/' . $recipe->image) }}" alt="{{ $recipe->title }}" class="w-full h-48 object-cover">
                        <!-- Dak ada like button harus login -->
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
                                <span>{{ $durationText }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-3 text-center text-gray-500">
                    <p>Tidak ada resep andalan saat ini.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Recipe Cards Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($featuredRecipes->skip(3) as $recipe)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:scale-105 hover:shadow-xl transition-all duration-300 cursor-pointer" onclick="window.location.href='{{ route('recipes.show', $recipe->slug) }}'">
                    <div class="relative">
                        <img src="{{ asset('images/' . $recipe->image) }}" alt="{{ $recipe->title }}" class="w-full h-48 object-cover">
                        <!-- No like harus login -->
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
                                <span>{{ $durationText }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-3 text-center text-gray-500">
                    <p>Tidak ada resep tambahan saat ini.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Explore Kategori -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Jelajahi Kategori</h2>
                <p class="text-lg text-gray-600">Temukan resep</p>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-6 gap-4">
                <div class="bg-gray-100 rounded-lg p-4 text-center hover:scale-105 hover:bg-gray-200 transition-all duration-300 cursor-pointer" onclick="window.location.href='{{ route('guest.search', ['category' => 'masakan-utama']) }}'">
                    <div class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-3" style="background-color: #F3CEDA;">
                        <img src="{{ asset('images/masakan-utama.png') }}" alt="Masakan Utama" class="w-8 h-8">
                    </div>
                    <p class="text-sm font-medium text-gray-900">Masakan Utama</p>
                </div>

                <div class="bg-gray-100 rounded-lg p-4 text-center hover:scale-105 hover:bg-gray-200 transition-all duration-300 cursor-pointer" onclick="window.location.href='{{ route('guest.search', ['category' => 'minuman']) }}'">
                    <div class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-3" style="background-color: #B8D3E0;">
                        <img src="{{ asset('images/minuman.png') }}" alt="Minuman" class="w-8 h-8">
                    </div>
                    <p class="text-sm font-medium text-gray-900">Minuman</p>
                </div>

                <div class="bg-gray-100 rounded-lg p-4 text-center hover:scale-105 hover:bg-gray-200 transition-all duration-300 cursor-pointer" onclick="window.location.href='{{ route('guest.search', ['category' => 'dessert']) }}'">
                    <div class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-3" style="background-color: #F7EED4;">
                        <img src="{{ asset('images/dessert.png') }}" alt="Dessert" class="w-8 h-8">
                    </div>
                    <p class="text-sm font-medium text-gray-900">Dessert</p>
                </div>

                <div class="bg-gray-100 rounded-lg p-4 text-center hover:scale-105 hover:bg-gray-200 transition-all duration-300 cursor-pointer" onclick="window.location.href='{{ route('guest.search', ['category' => 'sea-food']) }}'">
                    <div class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-3" style="background-color: #AFCFAF;">
                        <img src="{{ asset('images/sea-food.png') }}" alt="Sea Food" class="w-8 h-8">
                    </div>
                    <p class="text-sm font-medium text-gray-900">Sea Food</p>
                </div>

                <div class="bg-gray-100 rounded-lg p-4 text-center hover:scale-105 hover:bg-gray-200 transition-all duration-300 cursor-pointer" onclick="window.location.href='{{ route('guest.search', ['category' => 'sup-kuah']) }}'">
                    <div class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-3" style="background-color: #D3C8EA;">
                        <img src="{{ asset('images/sup.png') }}" alt="Sup &amp; Kuah" class="w-8 h-8">
                    </div>
                    <p class="text-sm font-medium text-gray-900">Sup &amp; Kuah</p>
                </div>

                <div class="bg-gray-100 rounded-lg p-4 text-center hover:scale-105 hover:bg-gray-200 transition-all duration-300 cursor-pointer" onclick="window.location.href='{{ route('guest.search', ['category' => 'cemilan']) }}'">
                    <div class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-3" style="background-color: #DDD9D5;">
                        <img src="{{ asset('images/cemilan.png') }}" alt="Cemilan" class="w-8 h-8">
                    </div>
                    <p class="text-sm font-medium text-gray-900">Cemilan</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Bagian Kiri -->
                <div>
                    <h2 class="text-4xl font-bold text-gray-900 mb-6">
                        Mengapa Pilih <div style="color:#E699B3"">Platform Kami?</div>
                    </h2>
                    <p class="text-lg text-gray-600 mb-8">
                        Kami hadir untuk membantu anak muda Indonesia belajar masak dengan cara yang fun dan mudah. 
                        Dari resep tradisional hingga fusion modern, semuanya ada di sini!
                    </p>
                    
                    <!-- Resep #1 -->
                    <div class="rounded-lg p-8" style="background-color: #F3CEDA;">
                        <div class="grid grid-cols-3 gap-8 mb-6">
                            <div class="text-center">
                                <div class="text-3xl font-bold" style="color: #5E3E36;">{{ $recipeCount }}</div>
                                <div class="text-sm" style="color: #9D7C7B;">Resep</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold" style="color: #5E3E36;">{{ $userCount }}</div>
                                <div class="text-sm" style="color: #9D7C7B;">Pengguna</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold" style="color: #5E3E36;">4.9</div>
                                <div class="text-sm" style="color: #9D7C7B;">Rating</div>
                            </div>
                        </div>
                        <div class="text-center">
                            <h3 class="text-2xl font-bold mb-2" style="color: #5E3E36;">Platform Resep #1 di Indonesia</h3>
                            <p style="color: #9D7C7B;">Dipercaya oleh ribuan food enthusiast untuk belajar masak</p>
                        </div>
                    </div>
                </div>
                
                <!-- Kanan - Feature Cards -->
                <div class="grid grid-cols-2 gap-4">
                    <!-- Ribuan Resep -->
                    <div class="p-6 rounded-lg bg-gray-100">
                        <div class="w-12 h-12 rounded-lg flex items-center justify-center mb-4" style="background-color: #F3CEDA;">
                            <img src="{{ asset('images/ribuan-resep.png') }}" alt="Ribuan Resep" class="w-6 h-6">
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Ribuan Resep</h3>
                        <p class="text-sm text-gray-600">Koleksi lengkap resep dari seluruh nusantara hingga internasional</p>
                    </div>
                    
                    <!-- Komunitas Aktif -->
                    <div class="p-6 rounded-lg bg-gray-100">
                        <div class="w-12 h-12 rounded-lg flex items-center justify-center mb-4" style="background-color: #AFCFAF;">
                            <img src="{{ asset('images/komunitas-aktif.png') }}" alt="Komunitas Aktif" class="w-6 h-6">
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Komunitas Aktif</h3>
                        <p class="text-sm text-gray-600">Bergabung dengan ribuan food lover Indonesia yang saling berbagi</p>
                    </div>
                    
                    <!-- Resep Terpercaya -->
                    <div class="p-6 rounded-lg bg-gray-100">
                        <div class="w-12 h-12 rounded-lg flex items-center justify-center mb-4" style="background-color: #F7EED4;">
                            <img src="{{ asset('images/resep-terpercaya.png') }}" alt="Resep Terpercaya" class="w-6 h-6">
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Resep Terpercaya</h3>
                        <p class="text-sm text-gray-600">Semua resep sudah diuji dan mendapat rating tinggi dari komunitas</p>
                    </div>
                    
                    <!-- Mudah Dipahami -->
                    <div class="p-6 rounded-lg bg-gray-100">
                        <div class="w-12 h-12 rounded-lg flex items-center justify-center mb-4" style="background-color: #B8D3E0;">
                            <img src="{{ asset('images/mudah-dipahami.png') }}" alt="Mudah Dipahami" class="w-6 h-6">
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Mudah Dipahami</h3>
                        <p class="text-sm text-gray-600">Tutorial step-by-step yang mudah diikuti, cocok untuk pemula</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
