<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile - MasakKu</title>
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
            <a href="{{ route('profile') }}" class="text-red-500 font-semibold hover:text-red-600">&lt; Back</a>
        </div>

        <h2 class="text-4xl font-croissant text-center text-gray-900 mb-10">Edit Profile</h2>

        @if ($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded">
                <ul class="list-disc pl-5 text-sm font-inter">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-12 items-start">
            @csrf

            <!-- Profile -->
            <div class="flex flex-col items-center">
                <label class="w-40 h-40 rounded-full overflow-hidden bg-gray-200 mb-6 relative cursor-pointer">
                    <img
                        src="{{ $user->profile_picture ? asset('images/' . $user->profile_picture) : asset('images/default-user.png') }}"
                        alt="Profile"
                        class="w-full h-full object-cover opacity-80"
                    >
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="w-10 h-10 rounded-full bg-black/70 flex items-center justify-center">
                            <img src="{{ asset('images/edit.png') }}" alt="Edit" class="w-5 h-5">
                        </div>
                    </div>
                    <input
                        type="file"
                        name="profile_picture"
                        accept="image/*"
                        class="hidden"
                    >
                </label>
                <p class="text-sm text-gray-500 font-inter">Klik foto untuk mengganti profile picture.</p>
            </div>

            <!-- Form -->
            <div class="space-y-5 text-gray-900">
                <div>
                    <label class="block text-lg font-croissant mb-1">Username</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 font-inter focus:outline-none focus:ring-2 focus:ring-pink-500">
                </div>

                <div>
                    <label class="block text-lg font-croissant mb-1">Birthday</label>
                    <input
                        type="date"
                        name="birthday"
                        value="{{ old('birthday', optional($user->birthday)->format('Y-m-d')) }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 font-inter focus:outline-none focus:ring-2 focus:ring-pink-500"
                    >
                </div>

                <div>
                    <label class="block text-lg font-croissant mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" readonly
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 font-inter bg-gray-100 cursor-not-allowed focus:outline-none">
                </div>

                <div class="pt-2">
                    <label class="block text-lg font-croissant mb-1">Current Password</label>
                    <input type="password" name="current_password" placeholder="Enter current password to change"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 font-inter focus:outline-none focus:ring-2 focus:ring-pink-500">
                </div>

                <div>
                    <label class="block text-lg font-croissant mb-1">New Password</label>
                    <input type="password" name="password" placeholder="Leave blank to keep current password"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 font-inter focus:outline-none focus:ring-2 focus:ring-pink-500">
                </div>

                <div>
                    <label class="block text-lg font-croissant mb-1">Confirm New Password</label>
                    <input type="password" name="password_confirmation"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 font-inter focus:outline-none focus:ring-2 focus:ring-pink-500">
                </div>

                <div class="pt-4 flex items-center justify-between">
                    <button type="submit" class="px-10 py-2 rounded-full text-white text-sm tracking-wide font-inter" style="background-color:#5E3E36;">
                        Confirm
                    </button>
                    <a href="{{ route('password.request') }}" class="text-sm font-inter text-red-600 hover:underline">Forgot password?</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
