@extends('admin.layout')

@section('content')
<!-- Users Content Box -->
<div class="bg-white rounded-lg shadow-lg p-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Users</h1>
        
        <!-- Search Bar -->
        <div class="w-1/3">
            <form action="{{ route('admin.users') }}" method="GET" class="relative">
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}"
                    placeholder="Search by name or email..." 
                    class="w-full px-4 py-2 pr-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    id="adminUserSearch"
                >
                <button type="submit" class="absolute right-3 top-1/2 transform -translate-y-1/2">
                    <svg class="w-5 h-5 text-gray-400 hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>
            </form>
        </div>
    </div>

    <!-- Users Table -->
    <div class="overflow-x-auto">
        <!-- Status Filter -->
        <div class="flex items-center justify-between mb-2">
            <div class="flex items-center space-x-2 text-sm">
                <span class="text-gray-600 font-medium">Filter Status:</span>
                <form action="{{ route('admin.users') }}" method="GET" id="statusFilterForm" class="flex items-center space-x-1">
                    <input type="hidden" name="search" value="{{ request('search') }}">

                    <button type="submit" name="status" value="" class="px-3 py-1 rounded-full border text-xs {{ request('status') === null || request('status') === '' ? 'bg-gray-900 text-white border-gray-900' : 'border-gray-300 text-gray-700 hover:bg-gray-100' }}">
                        All
                    </button>
                    <button type="submit" name="status" value="Active" class="px-3 py-1 rounded-full border text-xs {{ request('status') === 'Active' ? 'bg-green-600 text-white border-green-600' : 'border-gray-300 text-gray-700 hover:bg-gray-100' }}">
                        Active
                    </button>
                    <button type="submit" name="status" value="Inactive" class="px-3 py-1 rounded-full border text-xs {{ request('status') === 'Inactive' ? 'bg-red-600 text-white border-red-600' : 'border-gray-300 text-gray-700 hover:bg-gray-100' }}">
                        Inactive
                    </button>
                </form>
            </div>
        </div>

        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($users as $user)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-500">{{ $user->email }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($user->status === 'Active')
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Active
                            </span>
                        @else
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                Inactive
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('admin.users.edit', $user) }}" class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>

                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this user?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">
                        No users found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($users->hasPages())
    <div class="mt-6 flex justify-center">
        {{ $users->links() }}
    </div>
    @endif
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('adminUserSearch');
    if (searchInput && searchInput.form) {
        let searchTimeout;

        searchInput.addEventListener('input', function () {
            clearTimeout(searchTimeout);

            searchTimeout = setTimeout(() => {
                this.form.submit();
            }, 300);
        });
    }
});
</script>
@endsection
