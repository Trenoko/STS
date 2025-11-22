<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - MasakKu</title>
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
    <div class="w-full max-w-5xl bg-white rounded-2xl shadow-lg px-10 py-8">
        <!-- Header -->
        <div class="flex items-center justify-between mb-10">
            <div class="flex items-center space-x-3">
                <img src="{{ asset('images/masakku-logo.png') }}" alt="MasakKu Logo" class="h-14 w-auto object-contain">
                <h1 class="text-3xl font-croissant text-gray-900">MasakKu</h1>
            </div>
            <a href="{{ route('landing') }}" class="text-red-500 font-semibold hover:text-red-600">&lt; Back</a>
        </div>

        <h2 class="text-4xl font-croissant text-center text-gray-900 mb-10">Profile</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <!-- Profile -->
            <div class="flex flex-col items-center">
                <div class="w-40 h-40 rounded-full overflow-hidden bg-gray-200 mb-6">
                    <img
                        src="{{ Auth::user()->profile_picture ? asset('images/' . Auth::user()->profile_picture) : asset('images/default-user.png') }}"
                        alt="Profile"
                        class="w-full h-full object-cover"
                    >
                </div>

                <a
                    href="{{ route('profile.edit') }}"
                    class="px-10 py-2 rounded-full border border-[#5E3E36] text-[#5E3E36] text-sm tracking-wide font-inter hover:bg-[#5E3E36]/5 inline-flex items-center justify-center">
                    Edit Profile
                </a>
            </div>

            <!-- Info -->
            <div class="space-y-6 text-gray-900">
                <div>
                    <div class="text-lg font-croissant">Username</div>
                    <div class="text-xl mt-1 font-inter">{{ Auth::user()->name }}</div>
                </div>
                <div>
                    <div class="text-lg font-croissant">Birthday</div>
                    <div class="text-xl mt-1 text-gray-500 font-inter">
                        {{ Auth::user()->birthday ? Auth::user()->birthday->format('d F Y') : '-' }}
                    </div>
                </div>
                <div>
                    <div class="text-lg font-croissant">Email</div>
                    <div class="text-xl mt-1 font-inter">{{ Auth::user()->email }}</div>
                </div>

                <div class="pt-6 flex flex-wrap gap-4">
                    <a
                        href="{{ route('profile.favorites') }}"
                        class="px-10 py-2 rounded-full border border-yellow-400 text-yellow-700 text-sm tracking-wide font-inter hover:bg-yellow-50 inline-flex items-center justify-center">
                        Favorite Recipes
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="px-10 py-2 rounded-full border border-red-400 text-red-500 text-sm tracking-wide font-inter hover:bg-red-50">
                            Sign Out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
