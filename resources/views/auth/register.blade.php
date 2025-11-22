<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign up - MasakKu</title>

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
<body class="min-h-screen bg-white flex items-center justify-center">
    <div class="w-full max-w-5xl flex flex-col md:flex-row bg-white">
        <!-- Logo -->
        <div class="flex-1 flex flex-col items-center justify-center p-8">
            <div class="text-center mb-6">
                <div class="w-60 h-44 mx-auto mb-4">
                    <img src="{{ asset('images/masakku-logo.png') }}" alt="MasakKu Logo" class="w-full h-full object-contain">
                </div>
                <div class="text-4xl text-[#8B4513] font-croissant">MasakKu</div>
            </div>
        </div>

        <!-- Form -->
        <div class="flex-1 flex items-center justify-center p-6 md:p-10">
            <div class="w-full max-w-md bg-white border border-gray-200 rounded-2xl shadow-sm px-8 py-8">
                <h1 class="text-3xl text-center text-[#8B4513] font-croissant mb-6">Sign up</h1>

                @if ($errors->any())
                    <div class="mb-4 bg-red-50 border border-red-200 text-red-700 rounded px-4 py-3 text-sm font-inter">
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register.post') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-700 mb-1 font-inter">Username</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                <img src="{{ asset('images/icon-user.svg') }}" alt="User Icon" class="w-4 h-4 text-gray-400">
                            </span>
                            <input
                                type="text"
                                id="username"
                                name="username"
                                class="w-full pl-9 pr-3 py-2 border border-gray-300 rounded-lg text-sm font-inter focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent"
                                placeholder="Username"
                                value="{{ old('username') }}"
                                required
                                autofocus
                            >
                        </div>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1 font-inter">Email</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                <img src="{{ asset('images/icon-email.svg') }}" alt="Email Icon" class="w-4 h-4 text-gray-400">
                            </span>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                class="w-full pl-9 pr-3 py-2 border border-gray-300 rounded-lg text-sm font-inter focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent"
                                placeholder="Email"
                                value="{{ old('email') }}"
                                required
                            >
                        </div>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1 font-inter">Password</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                <img src="{{ asset('images/icon-password.svg') }}" alt="Password Icon" class="w-4 h-4 text-gray-400">
                            </span>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="w-full pl-9 pr-3 py-2 border border-gray-300 rounded-lg text-sm font-inter focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent"
                                placeholder="Password"
                                required
                            >
                        </div>
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1 font-inter">Confirm password</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                <img src="{{ asset('images/icon-password.svg') }}" alt="Password Icon" class="w-4 h-4 text-gray-400">
                            </span>
                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                class="w-full pl-9 pr-3 py-2 border border-gray-300 rounded-lg text-sm font-inter focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent"
                                placeholder="Confirm password"
                                required
                            >
                        </div>
                    </div>

                    <button
                        type="submit"
                        class="w-full py-2.5 mt-1 rounded-full text-white text-sm font-inter tracking-wide"
                        style="background-color:#8B4513;"
                    >
                        Sign up
                    </button>
                </form>

                <div class="mt-6 text-center text-sm text-gray-700 font-inter">
                    Already have an account?
                    <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-700 hover:underline">Click here</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
