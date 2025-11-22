<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Category;
use App\Models\RecipeStep;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    /**
     * tampilin dashboard admin.
     */
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalMenu = Recipe::count();

        $topMenu = Recipe::orderByDesc('views')
            ->orderByDesc('favorites')
            ->first();

        // user register per bulan
        $startDate = Carbon::now()->subMonths(5)->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();

        $rawStats = User::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as ym, COUNT(*) as total')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('ym')
            ->orderBy('ym')
            ->pluck('total', 'ym');

        $chartLabels = [];
        $chartData = [];

        $cursor = $startDate->copy();
        while ($cursor <= $endDate) {
            $key = $cursor->format('Y-m');
            $chartLabels[] = $cursor->translatedFormat('M');
            $chartData[] = (int) ($rawStats[$key] ?? 0);
            $cursor->addMonth();
        }

        return view('admin.dashboard', [
            'totalUsers' => $totalUsers,
            'totalMenu' => $totalMenu,
            'topMenu' => $topMenu,
            'chartLabels' => $chartLabels,
            'chartData' => $chartData,
        ]);
    }

    public function menu(Request $request)
    {
        $query = Recipe::with('category');
        
        // Search
        if ($request->has('search') && $request->search) {
            $query->search($request->search);
        }
        
        // pagination
        $recipes = $query->orderBy('created_at', 'desc')->paginate(4);

        // semua categories buat toggle control
        $categories = Category::ordered()->get();
        
        return view('admin.menu.index', compact('recipes', 'categories'));
    }

    /**
     * Toggle makanan active status.
     */
    public function toggleRecipeStatus(Recipe $recipe)
    {
        $recipe->is_active = ! $recipe->is_active;
        $recipe->save();

        return redirect()->route('admin.menu');
    }

    /**
     * Toggle category active status.
     */
    public function toggleCategoryStatus(Category $category)
    {
        $category->is_active = ! $category->is_active;
        $category->save();

        return redirect()->route('admin.menu');
    }
    
    /**
     * tampilin form create.
     */
    public function createMenu()
    {
        $categories = Category::active()->ordered()->get();
        
        return view('admin.menu.create', compact('categories'));
    }

    /**
     * simpan menu baru.
     */
    public function storeMenu(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'duration_category' => 'required|in:express,30menit,1jam,2jam+',
            'category_id' => 'required|exists:categories,id',
            'budget_category' => 'required|in:15-30k,30-50k,50-100k,100k+',
            'servings' => 'nullable|integer|min:1',
            'difficulty' => 'required|in:easy,medium,hard',
            'nutrition_info' => 'nullable|array',
            'nutrition_info.*' => 'in:karbohidrat,protein,lemak,mineral',
            'nutrition_detail' => 'nullable|array',
            'nutrition_detail.*' => 'nullable|string',
            'ingredients' => 'nullable|array',
            'ingredients.*' => 'nullable|string',
            'steps' => 'nullable|array',
            'steps.*' => 'nullable|string',
        ]);

        // image upload
        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images'), $imageName);
        }

        // siapin nutrition info value
        $nutrition = $validated['nutrition_info'] ?? null;
        $nutritionDetail = $validated['nutrition_detail'] ?? [];

        // ingridient jadi 1 string
        $ingredientsArray = array_filter($validated['ingredients'] ?? [], function ($item) {
            return !is_null($item) && $item !== '';
        });
        $ingredientsText = !empty($ingredientsArray) ? implode("\n", $ingredientsArray) : null;

        $recipe = Recipe::create([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']) . '-' . uniqid(),
            'description' => null,
            'ingredients' => $ingredientsText,
            'instructions' => null,
            'image' => $imageName,
            'servings' => $validated['servings'] ?? null,
            'difficulty' => $validated['difficulty'],
            'duration_category' => $validated['duration_category'],
            'budget_category' => $validated['budget_category'],
            'nutrition_info' => $nutrition ? ['type' => $nutrition, 'detail' => $nutritionDetail] : null,
            'views' => 0,
            'favorites' => 0,
            'is_trending' => false,
            'is_featured' => false,
            'is_active' => true,
            'category_id' => $validated['category_id'],
        ]);

        // nyimpan steps
        if (!empty($validated['steps'])) {
            $stepNumber = 1;
            foreach ($validated['steps'] as $stepText) {
                if (!empty($stepText)) {
                    RecipeStep::create([
                        'recipe_id' => $recipe->id,
                        'step_number' => $stepNumber++,
                        'instruction' => $stepText,
                    ]);
                }
            }
        }

        return redirect()->route('admin.menu')->with('success', 'Menu created successfully.');
    }

    /**
     * tampilin menu edit form .
     */
    public function editMenu(Recipe $recipe)
    {
        $categories = Category::active()->ordered()->get();

        return view('admin.menu.edit', compact('recipe', 'categories'));
    }

    /**
     * update menu.
     */
    public function updateMenu(Request $request, Recipe $recipe)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'duration_category' => 'required|in:express,30menit,1jam,2jam+',
            'category_id' => 'required|exists:categories,id',
            'budget_category' => 'required|in:15k,30k,50-100k,100k+',
            'servings' => 'nullable|integer|min:1',
            'difficulty' => 'required|in:easy,medium,hard',
            'nutrition_info' => 'nullable|array',
            'nutrition_info.*' => 'in:karbohidrat,protein,lemak,mineral',
            'nutrition_detail' => 'nullable|array',
            'nutrition_detail.*' => 'nullable|string',
            'ingredients' => 'nullable|array',
            'ingredients.*' => 'nullable|string',
            'steps' => 'nullable|array',
            'steps.*' => 'nullable|string',
        ]);

        // edit gambar optional
        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images'), $imageName);
            $recipe->image = $imageName;
        }

        $nutrition = $validated['nutrition_info'] ?? null;
        $nutritionDetail = $validated['nutrition_detail'] ?? [];

        // siapkan ingredients sebagai satu string dari array
        $ingredientsArray = array_filter($validated['ingredients'] ?? [], function ($item) {
            return !is_null($item) && $item !== '';
        });
        $ingredientsText = !empty($ingredientsArray) ? implode("\n", $ingredientsArray) : null;

        $recipe->title = $validated['title'];
        $recipe->slug = Str::slug($validated['title']) . '-' . uniqid();
        $recipe->ingredients = $ingredientsText;
        $recipe->servings = $validated['servings'] ?? null;
        $recipe->difficulty = $validated['difficulty'];
        $recipe->duration_category = $validated['duration_category'];
        $recipe->budget_category = $validated['budget_category'];
        $recipe->nutrition_info = $nutrition ? ['type' => $nutrition, 'detail' => $nutritionDetail] : null;
        $recipe->category_id = $validated['category_id'];

        $recipe->save();

        // update
        $recipe->steps()->delete();
        if (!empty($validated['steps'])) {
            $stepNumber = 1;
            foreach ($validated['steps'] as $stepText) {
                if (!empty($stepText)) {
                    RecipeStep::create([
                        'recipe_id' => $recipe->id,
                        'step_number' => $stepNumber++,
                        'instruction' => $stepText,
                    ]);
                }
            }
        }

        return redirect()->route('admin.menu')->with('success', 'Menu updated successfully.');
    }

    /**
     * tampilin admin users page.
     */
    public function users(Request $request)
    {
        $query = User::query();
        
        // fungsi search
        if ($request->has('search') && $request->search) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('email', 'like', '%' . $searchTerm . '%');
            });
        }

        // filter status (Active / Inactive)
        if ($request->filled('status')) {
            $status = $request->status;
            if (in_array($status, ['Active', 'Inactive'])) {
                $query->where('status', $status);
            }
        }
        
        // ambil user dri database, urut nama alfabet (A-Z)
        $users = $query->orderBy('name', 'asc')->paginate(10);
        
        return view('admin.users.index', compact('users'));
    }

    /**
     * tampilin form kalau edit user.
     */
    public function editUser(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * update user.
     */
    public function updateUser(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'status' => 'required|in:Active,Inactive',
            'is_admin' => 'nullable|boolean',
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->status = $validated['status'];
        $user->is_admin = $request->has('is_admin');

        $user->save();

        return redirect()->route('admin.users')->with('success', 'User updated successfully.');
    }

    /**
     * delet user.
     */
    public function destroyUser(User $user)
    {
        if (auth()->id() === $user->id) {
            return redirect()->route('admin.users')->with('error', 'Jan Apus woi.');
        }

        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
    }
}

