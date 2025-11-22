@extends('admin.layout')

@section('content')
<div class="rounded-lg shadow-lg p-8 max-w-4xl mx-auto bg-white">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Edit Menu</h1>
        <a href="{{ route('admin.menu') }}" class="text-red-500 font-semibold">&lt; Back</a>
    </div>

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.menu.update', $recipe->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Food Title</label>
            <input type="text" name="title" value="{{ old('title', $recipe->title) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Image</label>
            <div class="flex items-center space-x-4">
                <div class="w-32 h-20 rounded-lg overflow-hidden bg-gray-100 flex items-center justify-center">
                    @if($recipe->image)
                        <img src="{{ asset('images/' . $recipe->image) }}" alt="{{ $recipe->title }}" class="w-full h-full object-cover">
                    @else
                        <span class="text-gray-400 text-sm">No image</span>
                    @endif
                </div>
                <div>
                    <input type="file" name="image" class="text-sm" accept="image/*">
                    <p class="text-xs text-gray-500 mt-1">Leave empty to keep current image.</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Durasi</label>
                <select name="duration_category" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="express" {{ old('duration_category', $recipe->duration_category)=='express' ? 'selected' : '' }}>Express</option>
                    <option value="30menit" {{ old('duration_category', $recipe->duration_category)=='30menit' ? 'selected' : '' }}>30 menit</option>
                    <option value="1jam" {{ old('duration_category', $recipe->duration_category)=='1jam' ? 'selected' : '' }}>1 jam</option>
                    <option value="2jam+" {{ old('duration_category', $recipe->duration_category)=='2jam+' ? 'selected' : '' }}>2 jam+</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                <select name="category_id" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $recipe->category_id)==$category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Budget</label>
                <select name="budget_category" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="15-30k" {{ old('budget_category', $recipe->budget_category)=='15-30k' ? 'selected' : '' }}>15-30k</option>
                    <option value="30-50k" {{ old('budget_category', $recipe->budget_category)=='30-50k' ? 'selected' : '' }}>30-50k</option>
                    <option value="50-100k" {{ old('budget_category', $recipe->budget_category)=='50-100k' ? 'selected' : '' }}>50-100k</option>
                    <option value="100k+" {{ old('budget_category', $recipe->budget_category)=='100k+' ? 'selected' : '' }}>100k≤</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Difficulty</label>
                <select name="difficulty" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="easy" {{ old('difficulty', $recipe->difficulty)=='easy' ? 'selected' : '' }}>Easy</option>
                    <option value="medium" {{ old('difficulty', $recipe->difficulty)=='medium' ? 'selected' : '' }}>Medium</option>
                    <option value="hard" {{ old('difficulty', $recipe->difficulty)=='hard' ? 'selected' : '' }}>Hard</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Kandungan Gizi</label>
                @php
                    $storedNutrition = optional($recipe->nutrition_info)['type'] ?? [];
                    if (!is_array($storedNutrition)) {
                        $storedNutrition = $storedNutrition ? [$storedNutrition] : [];
                    }
                    $currentNutrition = old('nutrition_info', $storedNutrition);
                    if (!is_array($currentNutrition)) {
                        $currentNutrition = $currentNutrition ? [$currentNutrition] : [];
                    }
                @endphp
                @php
                    $storedDetail = optional($recipe->nutrition_info)['detail'] ?? [];
                    if (!is_array($storedDetail)) {
                        $storedDetail = [];
                    }
                @endphp
                <div class="flex flex-col space-y-2 text-sm text-gray-700">
                    <div>
                        <label class="inline-flex items-center space-x-2">
                            <input type="checkbox" name="nutrition_info[]" value="karbohidrat" class="rounded border-gray-300 nutrition-checkbox" data-target="#nutrition-detail-karbohidrat-edit" {{ in_array('karbohidrat', $currentNutrition) ? 'checked' : '' }}>
                            <span>Karbohidrat</span>
                        </label>
                        <input type="text" id="nutrition-detail-karbohidrat-edit" name="nutrition_detail[karbohidrat]" value="{{ old('nutrition_detail.karbohidrat', $storedDetail['karbohidrat'] ?? '') }}" class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 {{ in_array('karbohidrat', $currentNutrition) ? '' : 'hidden' }}" placeholder="Detail karbohidrat (opsional)">
                    </div>
                    <div>
                        <label class="inline-flex items-center space-x-2">
                            <input type="checkbox" name="nutrition_info[]" value="protein" class="rounded border-gray-300 nutrition-checkbox" data-target="#nutrition-detail-protein-edit" {{ in_array('protein', $currentNutrition) ? 'checked' : '' }}>
                            <span>Protein</span>
                        </label>
                        <input type="text" id="nutrition-detail-protein-edit" name="nutrition_detail[protein]" value="{{ old('nutrition_detail.protein', $storedDetail['protein'] ?? '') }}" class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 {{ in_array('protein', $currentNutrition) ? '' : 'hidden' }}" placeholder="Detail protein (opsional)">
                    </div>
                    <div>
                        <label class="inline-flex items-center space-x-2">
                            <input type="checkbox" name="nutrition_info[]" value="lemak" class="rounded border-gray-300 nutrition-checkbox" data-target="#nutrition-detail-lemak-edit" {{ in_array('lemak', $currentNutrition) ? 'checked' : '' }}>
                            <span>Lemak</span>
                        </label>
                        <input type="text" id="nutrition-detail-lemak-edit" name="nutrition_detail[lemak]" value="{{ old('nutrition_detail.lemak', $storedDetail['lemak'] ?? '') }}" class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 {{ in_array('lemak', $currentNutrition) ? '' : 'hidden' }}" placeholder="Detail lemak (opsional)">
                    </div>
                    <div>
                        <label class="inline-flex items-center space-x-2">
                            <input type="checkbox" name="nutrition_info[]" value="mineral" class="rounded border-gray-300 nutrition-checkbox" data-target="#nutrition-detail-mineral-edit" {{ in_array('mineral', $currentNutrition) ? 'checked' : '' }}>
                            <span>Mineral</span>
                        </label>
                        <input type="text" id="nutrition-detail-mineral-edit" name="nutrition_detail[mineral]" value="{{ old('nutrition_detail.mineral', $storedDetail['mineral'] ?? '') }}" class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 {{ in_array('mineral', $currentNutrition) ? '' : 'hidden' }}" placeholder="Detail mineral (opsional)">
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Servings</label>
                <input type="number" name="servings" min="1" value="{{ old('servings', $recipe->servings) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="e.g. 2">
            </div>
        </div>

        <div id="ingredients-wrapper" class="space-y-2">
            <label class="block text-sm font-medium text-gray-700 mb-1">Ingredients</label>
            @php
                $oldIngredients = old('ingredients');
                if (is_null($oldIngredients)) {
                    // Pecah string ingredients dari koma/baris baru
                    $stored = $recipe->ingredients
                        ? preg_split("/(\r\n|\n|\r|,)/", $recipe->ingredients)
                        : [];

                    // trim spasi sama buang yang kosong
                    $stored = array_map('trim', $stored);
                    $stored = array_filter($stored, function ($value) {
                        return $value !== '';
                    });

                    $ingredients = !empty($stored) ? $stored : [''];
                } else {
                    $ingredients = is_array($oldIngredients) ? $oldIngredients : [$oldIngredients];
                }
            @endphp
            @foreach($ingredients as $index => $ingredient)
                <div class="flex items-center space-x-2 ingredient-item">
                    <span class="text-gray-600 w-24 ingredient-label">Ingredient {{ $index + 1 }}</span>
                    <input type="text" name="ingredients[]" value="{{ $ingredient }}" class="flex-1 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Tulis bahan">
                    <button type="button" class="ml-2 px-3 py-1 text-sm rounded border border-red-300 text-red-500 hover:bg-red-50 remove-ingredient">Remove</button>
                </div>
            @endforeach
        </div>

        <div class="flex justify-end">
            <button type="button" id="add-ingredient" class="flex items-center px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100">
                <span class="text-lg mr-2">+</span>
                <span>Tambah Ingredient</span>
            </button>
        </div>

        <div id="steps-wrapper" class="space-y-3">
            <label class="block text-sm font-medium text-gray-700 mb-1">Steps</label>
            @php
                $oldSteps = old('steps');
                $steps = !is_null($oldSteps) ? $oldSteps : $recipe->steps->pluck('instruction')->toArray();
                if (empty($steps)) { $steps = ['']; }
            @endphp
            @foreach($steps as $index => $step)
                <div class="flex items-center space-x-2 step-item">
                    <span class="text-gray-600 w-20 step-label">Step {{ $index + 1 }}</span>
                    <input type="text" name="steps[]" value="{{ $step }}" class="flex-1 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Input text">
                    <button type="button" class="ml-2 px-3 py-1 text-sm rounded border border-red-300 text-red-500 hover:bg-red-50 remove-step">Remove</button>
                </div>
            @endforeach
        </div>

        <div class="flex justify-end">
            <button type="button" id="add-step" class="flex items-center px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100">
                <span class="text-lg mr-2">+</span>
                <span>Tambah Step</span>
            </button>
        </div>

        <div class="flex justify-end space-x-4 mt-6">
            <a href="{{ route('admin.menu') }}" class="px-6 py-2 rounded-full border border-red-400 text-red-500 hover:bg-red-50">Cancel</a>
            <button type="submit" class="px-6 py-2 rounded-full bg-blue-500 text-white hover:bg-blue-600">Save Changes</button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const addStepBtn = document.getElementById('add-step');
        const stepsWrapper = document.getElementById('steps-wrapper');

        const addIngredientBtn = document.getElementById('add-ingredient');
        const ingredientsWrapper = document.getElementById('ingredients-wrapper');

        function renumberSteps() {
            const items = stepsWrapper.querySelectorAll('.step-item');
            items.forEach((item, index) => {
                const label = item.querySelector('.step-label');
                if (label) {
                    label.textContent = 'Step ' + (index + 1);
                }
            });
        }

        addStepBtn.addEventListener('click', function () {
            const index = stepsWrapper.querySelectorAll('.step-item').length;
            const wrapper = document.createElement('div');
            wrapper.className = 'flex items-center space-x-2 step-item mt-1';
            wrapper.innerHTML = `
                <span class="text-gray-600 w-20 step-label">Step ${index + 1}</span>
                <input type="text" name="steps[]" class="flex-1 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Input text">
                <button type="button" class="ml-2 px-3 py-1 text-sm rounded border border-red-300 text-red-500 hover:bg-red-50 remove-step">Remove</button>
            `;
            stepsWrapper.appendChild(wrapper);
        });

        // nambah ingridient baru
        addIngredientBtn.addEventListener('click', function () {
            const index = ingredientsWrapper.querySelectorAll('.ingredient-item').length;
            const wrapper = document.createElement('div');
            wrapper.className = 'flex items-center space-x-2 ingredient-item';
            wrapper.innerHTML = `
                <span class="text-gray-600 w-24 ingredient-label">Ingredient ${index + 1}</span>
                <input type="text" name="ingredients[]" class="flex-1 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Tulis bahan">
                <button type="button" class="ml-2 px-3 py-1 text-sm rounded border border-red-300 text-red-500 hover:bg-red-50 remove-ingredient">Remove</button>
            `;
            ingredientsWrapper.appendChild(wrapper);
        });

        stepsWrapper.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-step')) {
                const item = e.target.closest('.step-item');
                if (item) {
                    item.remove();
                    renumberSteps();
                }
            }
        });

        // hapus ingredient
        ingredientsWrapper.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-ingredient')) {
                const item = e.target.closest('.ingredient-item');
                if (item) {
                    item.remove();
                    renumberIngredients();
                }
            }
        });

        // Toggle nutrition input dari check box
        document.querySelectorAll('.nutrition-checkbox').forEach(function (checkbox) {
            const targetSelector = checkbox.getAttribute('data-target');
            const target = document.querySelector(targetSelector);
            if (!target) return;

            const updateVisibility = () => {
                if (checkbox.checked) {
                    target.classList.remove('hidden');
                } else {
                    target.classList.add('hidden');
                    target.value = '';
                }
            };

            checkbox.addEventListener('change', updateVisibility);
            updateVisibility();
        });
    });
</script>
@endsection
