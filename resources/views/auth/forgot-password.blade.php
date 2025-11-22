<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forgot Password - MasakKu</title>

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
                <h1 class="text-2xl text-center text-[#8B4513] font-croissant mb-4">Please fill your email</h1>

                @if (session('status'))
                    <div class="mb-4 bg-green-50 border border-green-200 text-green-700 rounded px-4 py-3 text-sm font-inter">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-4 bg-red-50 border border-red-200 text-red-700 rounded px-4 py-3 text-sm font-inter">
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}" id="forgotPasswordForm" class="space-y-5">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1 font-inter">Email</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg class="w-4 h-4 text-gray-400" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                                </svg>
                            </span>
                            <input
                                type="email"
                                name="email"
                                id="email"
                                class="w-full pl-9 pr-3 py-2 border border-gray-300 rounded-lg text-sm font-inter focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent"
                                placeholder="Confirm email"
                                required
                                autofocus
                            >
                        </div>
                    </div>

                    <button
                        type="submit"
                        class="w-full py-2.5 mt-1 rounded-full text-white text-sm font-inter tracking-wide"
                        style="background-color:#8B4513;"
                    >
                        Confirm
                    </button>
                </form>

                <div class="mt-6 text-center text-sm text-gray-700 font-inter">
                    <a href="{{ route('login') }}" class="text-[#8B4513] hover:underline">Back to Login</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('forgotPasswordForm').addEventListener('submit', function(e) {
            const email = document.getElementById('email').value;
            
            if (email.trim() === '') {
                e.preventDefault();
                alert('Please enter your email address.');
            }
        });
    </script>
</body>
</html>
