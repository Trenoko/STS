<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verify Email - MasakKu</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Fonts -->
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
        <!-- Left: Logo -->
        <div class="flex-1 flex flex-col items-center justify-center p-8">
            <div class="text-center mb-6">
                <div class="w-60 h-44 mx-auto mb-4">
                    <img src="{{ asset('images/masakku-logo.png') }}" alt="MasakKu Logo" class="w-full h-full object-contain">
                </div>
                <div class="text-4xl text-[#8B4513] font-croissant">MasakKu</div>
            </div>
        </div>

        <!-- Right: Form -->
        <div class="flex-1 flex items-center justify-center p-6 md:p-10">
            <div class="w-full max-w-md bg-white border border-gray-200 rounded-2xl shadow-sm px-8 py-8">
                <h1 class="text-3xl text-center text-[#8B4513] font-croissant mb-2">Verify email kamu!</h1>
                <p class="text-sm text-center text-gray-600 font-inter mb-6">
                    Kami sudah mengirimkan 6-digit kode verfikasi ke gmail mu. Silahkan Masukkan ke input di bawah untuk melanjutkan registrasi.
                </p>

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

                <form method="POST" action="{{ route('register.verify') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="code" class="block text-sm font-medium text-gray-700 mb-1 font-inter">Verification code</label>
                        <div class="relative">
                            <input
                                type="text"
                                id="code"
                                name="code"
                                inputmode="numeric"
                                pattern="[0-9]*"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm font-inter focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent tracking-[0.4em] text-center"
                                placeholder="______"
                                value="{{ old('code') }}"
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
                        Verify and continue
                    </button>
                </form>

                <div class="mt-6 text-center text-sm text-gray-700 font-inter">
                    Salah email?
                    <a href="{{ route('register') }}" class="text-indigo-600 hover:text-indigo-700 hover:underline">Go back to sign up</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
