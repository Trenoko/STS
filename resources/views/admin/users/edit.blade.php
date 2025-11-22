@extends('admin.layout')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6 max-w-xl mx-auto">
    <h1 class="text-2xl font-bold text-gray-900 mb-4">Edit User</h1>

    @if ($errors->any())
        <div class="mb-4 bg-red-50 border border-red-200 text-red-700 rounded px-4 py-3 text-sm">
            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('error'))
        <div class="mb-4 bg-red-50 border border-red-200 text-red-700 rounded px-4 py-3 text-sm">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('admin.users.update', $user) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name', $user->name) }}"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                required
            >
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email', $user->email) }}"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                required
            >
        </div>

        <div>
            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
            <select
                id="status"
                name="status"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                required
            >
                <option value="Active" {{ old('status', $user->status) === 'Active' ? 'selected' : '' }}>Active</option>
                <option value="Inactive" {{ old('status', $user->status) === 'Inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <div class="flex items-center">
            <input
                type="checkbox"
                id="is_admin"
                name="is_admin"
                value="1"
                class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                {{ old('is_admin', $user->is_admin) ? 'checked' : '' }}
            >
            <label for="is_admin" class="ml-2 block text-sm text-gray-700">Administrator</label>
        </div>

        <div class="flex items-center justify-between mt-6">
            <a href="{{ route('admin.users') }}" class="text-sm text-gray-600 hover:text-gray-800">Cancel</a>

            <button
                type="submit"
                class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1"
            >
                Save Changes
            </button>
        </div>
    </form>
</div>
@endsection
