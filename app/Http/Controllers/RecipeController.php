<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    /**
     * list resep landing page.
     */
    public function landing()
    {
        // resep trend (view)
        $trendingRecipes = Recipe::active()
            ->withActiveCategory()
            ->with('category')
            ->orderBy('views', 'desc')
            ->limit(3)
            ->get();

        // resep andalan (favorite)
        $featuredRecipes = Recipe::active()
            ->withActiveCategory()
            ->with('category')
            ->orderBy('favorites', 'desc')
            ->limit(6)
            ->get();

        $categories = Category::active()->ordered()->get();

        // favorite recipes untuk user login
        $liked = auth()->user()
            ? auth()->user()->favoriteRecipes()->pluck('recipes.id')->toArray()
            : [];

        // itung active recipes & active non-admin users
        $recipeCount = Recipe::active()->withActiveCategory()->count();
        $userCount = User::where('status', 'Active')->where('is_admin', false)->count();

        return view('landing', compact('trendingRecipes', 'featuredRecipes', 'categories', 'userCount', 'recipeCount', 'liked'));
    }

    /**
     * nampilin list resep guest.
     */
    public function guestIndex()
    {
        // resep trend (view), (guest)
        $trendingRecipes = Recipe::active()
            ->withActiveCategory()
            ->with('category')
            ->orderBy('views', 'desc')
            ->limit(3)
            ->get();

        // resep andalan (favorite) (guest)
        $featuredRecipes = Recipe::active()
            ->withActiveCategory()
            ->with('category')
            ->orderBy('favorites', 'desc')
            ->limit(6)
            ->get();

        $categories = Category::active()
            ->ordered()
            ->get();

        // guest view
        $recipeCount = Recipe::active()->count();
        $userCount = User::where('status', 'Active')->where('is_admin', false)->count();

        return view('guest-landing', compact('trendingRecipes', 'featuredRecipes', 'categories', 'userCount', 'recipeCount'));
    }

    /**
     * Display hasil search sesuai dengan filter buat user sudah login.
     */
    public function search(Request $request)
    {
        $query = Recipe::active()->withActiveCategory()->with('category');

        // Search by text
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->byCategory($request->category);
        }

        // Filter by duration
        if ($request->filled('duration')) {
            $query->byDuration($request->duration);
        }

        // Filter by budget
        if ($request->filled('budget')) {
            $query->byBudget($request->budget);
        }

        // Filter by nutrition
        if ($request->filled('nutrition')) {
            $query->whereJsonContains('nutrition_info->type', $request->nutrition);
        }

        $recipes = $query->orderBy('created_at', 'desc')->paginate(12);
        $categories = Category::active()->ordered()->get();

        $liked = $request->user()
            ? $request->user()->favoriteRecipes()->pluck('recipes.id')->toArray()
            : [];

        return view('search', compact('recipes', 'categories', 'liked'));
    }

    /**
     * Display hasil search seusai dengan filters untuk guest users.
     */
    public function guestSearch(Request $request)
    {
        $query = Recipe::active()->withActiveCategory()->with('category');

        // Search by text
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->byCategory($request->category);
        }

        // Filter by duration
        if ($request->filled('duration')) {
            $query->byDuration($request->duration);
        }

        // Filter by budget
        if ($request->filled('budget')) {
            $query->byBudget($request->budget);
        }

        // Filter by nutrition
        if ($request->filled('nutrition')) {
            $query->whereJsonContains('nutrition_info->type', $request->nutrition);
        }

        $recipes = $query->orderBy('created_at', 'desc')->paginate(12);
        $categories = Category::active()->ordered()->get();

        return view('guest-search', compact('recipes', 'categories'));
    }


    /**
     * Display the specified recipe.
     */
    public function show($slug)
    {
        $recipe = Recipe::active()
            ->withActiveCategory()
            ->where('slug', $slug)
            ->firstOrFail();
        $recipe->incrementViews();
        $recipe->load('category');

        $user = auth()->user();
        $isLiked = $user
            ? $user->favoriteRecipes()->where('recipes.id', $recipe->id)->exists()
            : false;

        return view('recipes.show', compact('recipe', 'isLiked'));
    }


    /**
     *  toggle favorite status untuk recipe.
     */
    public function toggleFavorite(Recipe $recipe, Request $request)
    {
        $user = $request->user();

        if (! $user) {
            return response()->json(['success' => false], 401);
        }

        $alreadyLiked = $user->favoriteRecipes()->where('recipes.id', $recipe->id)->exists();

        if ($alreadyLiked) {
            // Unlike
            $user->favoriteRecipes()->detach($recipe->id);
            $recipe->decrementFavorites();
        } else {
            // Like
            $user->favoriteRecipes()->attach($recipe->id);
            $recipe->incrementFavorites();
        }

        return response()->json([
            'success' => true,
            'favorites' => $recipe->favorites,
            'liked' => ! $alreadyLiked,
        ]);
    }

    /**
     * tampilin yang di favorite pada profile.
     */
    public function favorites(Request $request)
    {
        $user = $request->user();

        $recipes = $user
            ? $user->favoriteRecipes()
                ->active()
                ->withActiveCategory()
                ->with('category')
                ->orderBy('favorites', 'desc')
                ->get()
            : collect();

        return view('profile-favorites', compact('recipes'));
    }
}
