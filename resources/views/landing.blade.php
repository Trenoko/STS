<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MasakKu - Platform Resep #1 di Indonesia</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Croissant+One&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind Config -->
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
                <!-- Logo / Brand -->
                <div class="flex items-center space-x-3">
                    <!-- Logo - Hidden on mobile -->
                    <img src="{{ asset('images/masakku-logo.png') }}" alt="MasakKu Logo" class="h-14 w-auto object-contain hidden md:block">
                    <!-- MasakKu Text - Always visible -->
                    <h1 class="text-2xl font-croissant text-gray-900">MasakKu</h1>
                </div>
                
                <!-- Search Bar -->
                <div class="flex-1 mx-2 md:mx-8 md:max-w-md">
                    <div class="relative">
                        <input type="text" placeholder="Input text" class="w-full px-4 py-2 pl-10 pr-10 text-gray-900 bg-white border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                            <img src="{{ asset('images/icon-search.svg') }}" alt="Search" class="w-5 h-5 text-gray-400">
                        </div>
                    </div>
                </div>
                
                <!-- Profile -->
                <div class="flex items-center space-x-3">
                    <!-- Hide greeting on mobile -->
                    <span class="text-gray-900 font-inter font-semibold hidden md:block">Hello Kenneth!</span>
                    <div class="w-10 h-10 bg-gray-300 rounded-full overflow-hidden">
                        <img src="{{ asset('images/profile.png') }}" alt="Profile" class="w-full h-full object-cover">
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Image blur -->
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
                <!-- Ayam Bumbu Rujak -->
                <div class="relative h-36 rounded-lg overflow-hidden">
                    <img src="{{ asset('images/Ayam-bumbu.png') }}" alt="Ayam Bumbu Rujak" class="w-full h-full object-cover blur-sm">
                    <div class="absolute inset-0 flex items-center justify-center">
                        <h3 class="text-white text-lg font-bold text-center">Ayam Bumbu Rujak</h3>
                    </div>
                </div>
                
                <!-- Udang Saus Padang -->
                <div class="relative h-36 rounded-lg overflow-hidden">
                    <img src="{{ asset('images/udasaus.png') }}" alt="Udang Saus Padang" class="w-full h-full object-cover blur-sm">
                    <div class="absolute inset-0 flex items-center justify-center">
                        <h3 class="text-white text-lg font-bold text-center">Udang Saus Padang</h3>
                    </div>
                </div>
                
                <!-- Cumi Asam Manis -->
                <div class="relative h-36 rounded-lg overflow-hidden">
                    <img src="{{ asset('images/cumiman.png') }}" alt="Cumi Asam Manis" class="w-full h-full object-cover blur-sm">
                    <div class="absolute inset-0 flex items-center justify-center">
                        <h3 class="text-white text-lg font-bold text-center">Cumi Asam Manis</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Resep Andalan -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center text-gray-900 mb-12">Resep Andalan</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Nasi Goreng -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="relative">
                        <img src="{{ asset('images/nasgor.png') }}" alt="Nasi Goreng" class="w-full h-48 object-cover">
                        <button class="absolute top-4 right-4 w-8 h-8 bg-white rounded-full flex items-center justify-center shadow-md">
                            <img src="{{ asset('images/favourite.png') }}" alt="Favourite" class="w-5 h-5">
                        </button>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Nasi Goreng</h3>
                        <div class="flex items-center space-x-6 text-sm text-gray-600">
                            <div class="flex items-center space-x-1">
                                <img src="{{ asset('images/view.png') }}" alt="View" class="w-4 h-4">
                                <span>1</span>
                            </div>
                            <div class="flex items-center space-x-1">
                                <img src="{{ asset('images/favourite.png') }}" alt="favourite" class="w-4 h-4">
                                <span>199</span>
                            </div>
                            <div class="flex items-center space-x-1">
                                <img src="{{ asset('images/time-left.png') }}" alt="Time" class="w-4 h-4">
                                <span>25</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Ayam Asam Manis -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="relative">
                        <img src="{{ asset('images/ayamam.png') }}" alt="Ayam Asam Manis" class="w-full h-48 object-cover">
                        <button class="absolute top-4 right-4 w-8 h-8 bg-white rounded-full flex items-center justify-center shadow-md">
                            <img src="{{ asset('images/favourite.png') }}" alt="Favourite" class="w-5 h-5">
                        </button>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Ayam Asam Manis</h3>
                        <div class="flex items-center space-x-6 text-sm text-gray-600">
                            <div class="flex items-center space-x-1">
                                <img src="{{ asset('images/view.png') }}" alt="View" class="w-4 h-4">
                                <span>2</span>
                            </div>
                            <div class="flex items-center space-x-1">
                                <img src="{{ asset('images/favourite.png') }}" alt="favourite" class="w-4 h-4">
                                <span>199</span>
                            </div>
                            <div class="flex items-center space-x-1">
                                <img src="{{ asset('images/time-left.png') }}" alt="Time" class="w-4 h-4">
                                <span>30</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pasta Aglio Olio -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="relative">
                        <img src="{{ asset('images/pasta.png') }}" alt="Pasta Aglio Olio" class="w-full h-48 object-cover">
                        <button class="absolute top-4 right-4 w-8 h-8 bg-white rounded-full flex items-center justify-center shadow-md">
                            <img src="{{ asset('images/favourite.png') }}" alt="Favourite" class="w-5 h-5">
                        </button>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Pasta Aglio Olio</h3>
                        <div class="flex items-center space-x-6 text-sm text-gray-600">
                            <div class="flex items-center space-x-1">
                                <img src="{{ asset('images/view.png') }}" alt="View" class="w-4 h-4">
                                <span>1</span>
                            </div>
                            <div class="flex items-center space-x-1">
                                <img src="{{ asset('images/favourite.png') }}" alt="favourite" class="w-4 h-4">
                                <span>199</span>
                            </div>
                            <div class="flex items-center space-x-1">
                                <img src="{{ asset('images/time-left.png') }}" alt="Time" class="w-4 h-4">
                                <span>20</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Additional Recipe Cards Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Pisang Keju Crispy -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="relative">
                        <img src="{{ asset('images/pisangkeju.png') }}" alt="Pisang Keju Crispy" class="w-full h-48 object-cover">
                        <button class="absolute top-4 right-4 w-8 h-8 bg-white rounded-full flex items-center justify-center shadow-md">
                            <img src="{{ asset('images/favourite.png') }}" alt="Favourite" class="w-5 h-5">
                        </button>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Pisang Keju Crispy</h3>
                        <div class="flex items-center space-x-6 text-sm text-gray-600">
                            <div class="flex items-center space-x-1">
                                <img src="{{ asset('images/view.png') }}" alt="View" class="w-4 h-4">
                                <span>1</span>
                            </div>
                            <div class="flex items-center space-x-1">
                                <img src="{{ asset('images/favourite.png') }}" alt="favourite" class="w-4 h-4">
                                <span>298</span>
                            </div>
                            <div class="flex items-center space-x-1">
                                <img src="{{ asset('images/time-left.png') }}" alt="Time" class="w-4 h-4">
                                <span>15</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tom Yum Seafood -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="relative">
                        <img src="{{ asset('images/tomyum.png') }}" alt="Tom Yum Seafood" class="w-full h-48 object-cover">
                        <button class="absolute top-4 right-4 w-8 h-8 bg-white rounded-full flex items-center justify-center shadow-md">
                            <img src="{{ asset('images/favourite.png') }}" alt="Favourite" class="w-5 h-5">
                        </button>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Tom Yum Seafood</h3>
                        <div class="flex items-center space-x-6 text-sm text-gray-600">
                            <div class="flex items-center space-x-1">
                                <img src="{{ asset('images/view.png') }}" alt="View" class="w-4 h-4">
                                <span>4</span>
                            </div>
                            <div class="flex items-center space-x-1">
                                <img src="{{ asset('images/favourite.png') }}" alt="favourite" class="w-4 h-4">
                                <span>167</span>
                            </div>
                            <div class="flex items-center space-x-1">
                                <img src="{{ asset('images/time-left.png') }}" alt="Time" class="w-4 h-4">
                                <span>35</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Es Kopi Gula Aren -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="relative">
                        <img src="{{ asset('images/eskopi.png') }}" alt="Es Kopi Gula Aren" class="w-full h-48 object-cover">
                        <button class="absolute top-4 right-4 w-8 h-8 bg-white rounded-full flex items-center justify-center shadow-md">
                            <img src="{{ asset('images/favourite.png') }}" alt="Favourite" class="w-5 h-5">
                        </button>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Es Kopi Gula Aren</h3>
                        <div class="flex items-center space-x-6 text-sm text-gray-600">
                            <div class="flex items-center space-x-1">
                                <img src="{{ asset('images/view.png') }}" alt="View" class="w-4 h-4">
                                <span>1</span>
                            </div>
                            <div class="flex items-center space-x-1">
                                <img src="{{ asset('images/favourite.png') }}" alt="favourite" class="w-4 h-4">
                                <span>230</span>
                            </div>
                            <div class="flex items-center space-x-1">
                                <img src="{{ asset('images/time-left.png') }}" alt="Time" class="w-4 h-4">
                                <span>10</span>
                            </div>
                        </div>
                    </div>
                </div>
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
                <!-- Masakan Utama -->
                <div class="bg-gray-100 rounded-lg p-4 text-center">
                    <div class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-3" style="background-color: #F3CEDA;">
                        <img src="{{ asset('images/masakan-utama.png') }}" alt="Masakan Utama" class="w-8 h-8">
                    </div>
                    <p class="text-sm font-medium text-gray-900">Masakan Utama</p>
                </div>
                
                <!-- Minuman -->
                <div class="bg-gray-100 rounded-lg p-4 text-center">
                    <div class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-3" style="background-color: #B8D3E0;">
                        <img src="{{ asset('images/minuman.png') }}" alt="Minuman" class="w-8 h-8">
                    </div>
                    <p class="text-sm font-medium text-gray-900">Minuman</p>
                </div>
                
                <!-- Dessert -->
                <div class="bg-gray-100 rounded-lg p-4 text-center">
                    <div class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-3" style="background-color: #F7EED4;">
                        <img src="{{ asset('images/dessert.png') }}" alt="Dessert" class="w-8 h-8">
                    </div>
                    <p class="text-sm font-medium text-gray-900">Dessert</p>
                </div>
                
                <!-- Sea Food -->
                <div class="bg-gray-100 rounded-lg p-4 text-center">
                    <div class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-3" style="background-color: #AFCFAF;">
                        <img src="{{ asset('images/sea-food.png') }}" alt="Sea Food" class="w-8 h-8">
                    </div>
                    <p class="text-sm font-medium text-gray-900">Sea Food</p>
                </div>
                
                <!-- Sup & Kuah -->
                <div class="bg-gray-100 rounded-lg p-4 text-center">
                    <div class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-3" style="background-color: #D3C8EA;">
                        <img src="{{ asset('images/sup.png') }}" alt="Sup & Kuah" class="w-8 h-8">
                    </div>
                    <p class="text-sm font-medium text-gray-900">Sup & Kuah</p>
                </div>
                
                <!-- Cemilan -->
                <div class="bg-gray-100 rounded-lg p-4 text-center">
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
                <!-- Left Side - Text and Stats -->
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
                                <div class="text-3xl font-bold" style="color: #5E3E36;">5K+</div>
                                <div class="text-sm" style="color: #9D7C7B;">Resep</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold" style="color: #5E3E36;">0</div>
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
