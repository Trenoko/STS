@extends('admin.layout')

@section('content')
<!-- Menu Content Box -->
<div class="rounded-lg shadow-lg p-6" style="background-color:#F5F5F5;">
    <div class="flex flex-col md:flex-row gap-6">
        <!-- Page Title + Category Toggle-->
        <div class="w-full md:w-1/4">
            <h1 class="text-2xl font-bold text-gray-900 mb-3">Menu</h1>

            @isset($categories)
            <div class="space-y-2">
                @foreach($categories as $category)
                    <div class="flex items-center justify-between bg-white rounded-lg px-3 py-1 shadow-sm text-sm">
                        <div class="mr-3">
                            <div class="font-semibold text-gray-900">{{ $category->name }}</div>
                            <div class="text-[10px] text-gray-500">Slug: {{ $category->slug }}</div>
                        </div>
                        <form method="POST" action="{{ route('admin.categories.toggle', $category->id) }}">
                            @csrf
                            <button type="submit" class="relative inline-flex items-center h-5 rounded-full w-10 focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-blue-500"
                                style="background-color: {{ $category->is_active ? '#4ade80' : '#e5e7eb' }};">
                                <span class="sr-only">Toggle category</span>
                                <span class="inline-block h-4 w-4 rounded-full bg-white shadow transform transition-transform duration-200 {{ $category->is_active ? 'translate-x-5' : 'translate-x-0' }}"></span>
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
            @endisset
        </div>

        <!-- Search, Add Menu, Recipe Grid -->
        <div class="flex-1">
            <div class="flex items-center justify-end mb-4 space-x-4">
            <!-- Search Bar -->
            <form method="GET" action="{{ route('admin.menu') }}" class="flex">
                <div class="relative">
                    <input type="text" 
                           name="search"
                           value="{{ request('search') }}"
                           placeholder="Search menus..." 
                           class="w-64 px-4 py-2 pl-4 pr-10 text-gray-900 bg-white border border-blue-500 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                           id="searchInput">
                    <button type="submit" class="absolute inset-y-0 right-0 flex items-center pr-3">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>   
                </div>
            </form>
            
            <!-- Add Menu Button -->
            <a href="{{ route('admin.menu.create') }}" 
               class="bg-gray-100 hover:bg-gray-200 border border-gray-300 text-gray-700 px-4 py-2 rounded-lg flex items-center space-x-2 transition-colors">
                <span>+</span>
                <span>Add Menu</span>
            </a>
            </div>

            <!-- Grid Recipe Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6" id="recipeGrid">
        @forelse($recipes as $recipe)
        <a href="{{ route('admin.menu.edit', $recipe->id) }}" class="block bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
            <!-- Recipe Image -->
            <div class="relative">
                <img src="{{ asset('images/' . $recipe->image) }}" 
                     alt="{{ $recipe->title }}" 
                     class="w-full h-48 object-cover">
            </div>
            
            <!-- Recipe Info -->
            <div class="p-4">
                <!-- Recipe Name + Active Toggle -->
                <div class="flex items-center justify-between mb-3">
                    <h3 class="text-lg font-bold text-gray-900">{{ $recipe->title }}</h3>

                    <form method="POST" action="{{ route('admin.menu.toggleActive', $recipe->id) }}" onclick="event.stopPropagation();">
                        @csrf
                        <button type="submit" class="relative inline-flex items-center h-4 rounded-full w-8 focus:outline-none focus:ring-1 focus:ring-offset-1 focus:ring-blue-500"
                            style="background-color: {{ $recipe->is_active ? '#4ade80' : '#e5e7eb' }};">
                            <span class="sr-only">Toggle recipe active</span>
                            <span class="inline-block h-3 w-3 rounded-full bg-white shadow transform transition-transform duration-200 {{ $recipe->is_active ? 'translate-x-4' : 'translate-x-0' }}"></span>
                        </button>
                    </form>
                </div>
                
                <div class="flex items-center justify-between text-sm text-gray-600">
                    <!-- Views -->
                    <div class="flex items-center space-x-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        <span>{{ $recipe->views ?? 0 }}</span>
                    </div>
                    
                    <!-- Favorites -->
                    <div class="flex items-center space-x-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                        <span>{{ $recipe->favorites ?? 0 }}</span>
                    </div>
                    
                    <!-- Time -->
                    <div class="flex items-center space-x-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        @php
                            $durationLabels = [
                                'express' => 'Express',
                                '30menit' => '30 Menit',
                                '1jam' => '1 Jam',
                                '2jam+' => '2 Jam+',
                            ];
                        @endphp
                        <span>{{ $durationLabels[$recipe->duration_category] ?? $recipe->duration_category }}</span>
                    </div>
                </div>
            </div>
        </a>
        @empty
        <div class="col-span-full text-center py-12">
            <div class="text-gray-500 text-lg">No recipes found</div>
            <p class="text-gray-400 mt-2">{{ request('search') ? 'Try searching for something else.' : 'Start by adding your first recipe!' }}</p>
        </div>
        @endforelse
            </div>

            <!-- Pagination -->
            @if($recipes->hasPages())
            <div class="mt-8 flex justify-center">
                {{ $recipes->links() }}
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Js Auto Search -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    let searchTimeout;
    
    // Auto search on input
    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        
        searchTimeout = setTimeout(() => {
            if (this.value.length > 0) {
                this.form.submit();
            } else if (this.value.length === 0) {
                this.form.submit();
            }
        }, 300);
    });
});
</script>
@endsection
