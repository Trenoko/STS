<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - MasakKu</title>
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
<body>
    <div class="flex flex-col h-screen">
        <div class="flex items-center justify-center px-8 py-8">
            <div class="flex items-center space-x-3">
                <img src="{{ asset('images/masakku-logo.png') }}" alt="MasakKu Logo" class="h-12 w-auto object-contain">
                <h1 class="text-xl font-croissant text-gray-900">MasakKu</h1>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="flex-1 overflow-hidden relative">
            <!-- Navigation -->
            <div class="absolute left-8 top-8 w-56 rounded-lg shadow-lg z-10" style="background-color: #F5F5F5;">
                <nav class="p-4">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center mb-2 px-6 py-4 text-gray-700 text-lg hover:bg-gray-300 rounded-lg transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-gray-200 border-l-4 border-gray-500' : '' }}">
                        <img src="{{ asset('images/bar-chart-2.png') }}" alt="Dashboard" class="w-6 h-6 mr-3">
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('admin.menu') }}" class=" flex items-center mb-2 px-6 py-4 text-gray-700 text-lg hover:bg-gray-300 rounded-lg transition-colors {{ request()->routeIs('admin.menu') ? 'bg-gray-200 border-l-4 border-gray-500' : '' }}">
                        <img src="{{ asset('images/menu.png') }}" alt="Menu" class="w-6 h-6 mr-3">
                        <span>Menu</span>
                    </a>
                    <a href="{{ route('admin.users') }}" class="flex items-center mb-2 px-6 py-4 text-gray-700 text-lg hover:bg-gray-300 rounded-lg transition-colors {{ request()->routeIs('admin.users') ? 'bg-gray-200 border-l-4 border-gray-500' : '' }}">
                        <img src="{{ asset('images/people.png') }}" alt="Users" class="w-6 h-6 mr-3">
                        <span>Users</span>
                    </a>

                    <a href="{{ route('landing') }}" class="flex items-center mb-2 px-6 py-4 text-gray-700 text-lg hover:bg-gray-300 rounded-lg transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9.75h4.875a2.625 2.625 0 0 1 0 5.25H12M8.25 9.75 10.5 7.5M8.25 9.75 10.5 12m9-7.243V21.75l-3.75-1.5-3.75 1.5-3.75-1.5-3.75 1.5V4.757c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0c1.1.128 1.907 1.077 1.907 2.185Z" />
                        </svg>
                        <span>Landing Page</span>
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="mb-2">
                        @csrf
                        <button type="submit" class="w-full flex items-center px-6 py-4 text-gray-700 text-lg hover:bg-gray-300 rounded-lg transition-colors">
                            <img src="{{ asset('images/logout.png') }}" alt="Logout" class="w-6 h-6 mr-3">
                            <span>Logout</span>
                        </button>
                    </form>

                </nav>
            </div>
            
            <!-- Page Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto h-full">
                <div class="ml-72 px-8 py-8">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
</body>
</html>

