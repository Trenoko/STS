@extends('admin.layout')

@section('content')
<div class="rounded-lg shadow-lg p-8 max-w-4xl mx-auto bg-white">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Add Menu</h1>
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

    <form action="{{ route('admin.menu.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Add Food Title</label>
            <input type="text" name="title" value="{{ old('title') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Nasi Goreng">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Add Image</label>
            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 flex flex-col items-center justify-center bg-gray-50">
                <svg class="w-10 h-10 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4-4 4 4 4-4 4 4"/></svg>
                <span class="text-gray-500 mb-2">Upload image</span>
                <input type="file" name="image" class="text-sm" accept="image/*">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Durasi</label>
                <select name="duration_category" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="express" {{ old('duration_category')=='express' ? 'selected' : '' }}>Express</option>
                    <option value="30menit" {{ old('duration_category')=='30menit' ? 'selected' : '' }}>30 menit</option>
                    <option value="1jam" {{ old('duration_category')=='1jam' ? 'selected' : '' }}>1 jam</option>
                    <option value="2jam+" {{ old('duration_category')=='2jam+' ? 'selected' : '' }}>2 jam+</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                <select name="category_id" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id')==$category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Budget</label>
                <select name="budget_category" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="15-30k" {{ old('budget_category')=='15-30k' ? 'selected' : '' }}>15-30k</option>
                    <option value="30-50k" {{ old('budget_category')=='30-50k' ? 'selected' : '' }}>30-50k</option>
                    <option value="50-100k" {{ old('budget_category')=='50-100k' ? 'selected' : '' }}>50-100k</option>
                    <option value="100k+" {{ old('budget_category')=='100k+' ? 'selected' : '' }}>100k≤</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Difficulty</label>
                <select name="difficulty" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="easy" {{ old('difficulty')=='easy' ? 'selected' : '' }}>Easy</option>
                    <option value="medium" {{ old('difficulty')=='medium' ? 'selected' : '' }}>Medium</option>
                    <option value="hard" {{ old('difficulty')=='hard' ? 'selected' : '' }}>Hard</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Kandungan Gizi</label>
                @php
                    $oldNutrition = old('nutrition_info', []);
                    if (!is_array($oldNutrition)) {
                        $oldNutrition = $oldNutrition ? [$oldNutrition] : [];
                    }
                @endphp
                <div class="flex flex-col space-y-2 text-sm text-gray-700">
                    <div>
                        <label class="inline-flex items-center space-x-2">
                            <input type="checkbox" name="nutrition_info[]" value="karbohidrat" class="rounded border-gray-300 nutrition-checkbox" data-target="#nutrition-detail-karbohidrat" {{ in_array('karbohidrat', $oldNutrition) ? 'checked' : '' }}>
                            <span>Karbohidrat</span>
                        </label>
                        <input type="text" id="nutrition-detail-karbohidrat" name="nutrition_detail[karbohidrat]" value="{{ old('nutrition_detail.karbohidrat') }}" class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 {{ in_array('karbohidrat', $oldNutrition) ? '' : 'hidden' }}" placeholder="Detail karbohidrat (opsional)">
                    </div>
                    <div>
                        <label class="inline-flex items-center space-x-2">
                            <input type="checkbox" name="nutrition_info[]" value="protein" class="rounded border-gray-300 nutrition-checkbox" data-target="#nutrition-detail-protein" {{ in_array('protein', $oldNutrition) ? 'checked' : '' }}>
                            <span>Protein</span>
                        </label>
                        <input type="text" id="nutrition-detail-protein" name="nutrition_detail[protein]" value="{{ old('nutrition_detail.protein') }}" class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 {{ in_array('protein', $oldNutrition) ? '' : 'hidden' }}" placeholder="Detail protein (opsional)">
                    </div>
                    <div>
                        <label class="inline-flex items-center space-x-2">
                            <input type="checkbox" name="nutrition_info[]" value="lemak" class="rounded border-gray-300 nutrition-checkbox" data-target="#nutrition-detail-lemak" {{ in_array('lemak', $oldNutrition) ? 'checked' : '' }}>
                            <span>Lemak</span>
                        </label>
                        <input type="text" id="nutrition-detail-lemak" name="nutrition_detail[lemak]" value="{{ old('nutrition_detail.lemak') }}" class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 {{ in_array('lemak', $oldNutrition) ? '' : 'hidden' }}" placeholder="Detail lemak (opsional)">
                    </div>
                    <div>
                        <label class="inline-flex items-center space-x-2">
                            <input type="checkbox" name="nutrition_info[]" value="mineral" class="rounded border-gray-300 nutrition-checkbox" data-target="#nutrition-detail-mineral" {{ in_array('mineral', $oldNutrition) ? 'checked' : '' }}>
                            <span>Mineral</span>
                        </label>
                        <input type="text" id="nutrition-detail-mineral" name="nutrition_detail[mineral]" value="{{ old('nutrition_detail.mineral') }}" class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 {{ in_array('mineral', $oldNutrition) ? '' : 'hidden' }}" placeholder="Detail mineral (opsional)">
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Servings</label>
                <input type="number" name="servings" min="1" value="{{ old('servings') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="e.g. 2">
            </div>
        </div>

        <div id="ingredients-wrapper" class="space-y-2">
            <label class="block text-sm font-medium text-gray-700 mb-1">Ingredients</label>
            @php
                $oldIngredients = old('ingredients', ['']);
                if (!is_array($oldIngredients)) {
                    $oldIngredients = [$oldIngredients];
                }
            @endphp
            @foreach($oldIngredients as $index => $ingredient)
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
                $oldSteps = old('steps', ['']);
            @endphp
            @foreach($oldSteps as $index => $step)
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
            <button type="submit" class="px-6 py-2 rounded-full bg-blue-500 text-white hover:bg-blue-600">Submit</button>
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

        // tambah step baru
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

        // tambah ingredient
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

        // hapus step
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

        // Toggle nutrition input
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
