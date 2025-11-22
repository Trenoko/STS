<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Redirect ke guest kalau belum auth
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('landing');
    }
    return redirect()->route('guest.landing');
});

// Protected landing page perlu auth
Route::get('/landing', [RecipeController::class, 'landing'])->name('landing')->middleware('auth');

Route::get('/login', function () {
    if (Auth::check()) {
        return redirect()->route('landing');
    }
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', function () {
    if (Auth::check()) {
        return redirect()->route('landing');
    }
    return view('auth.register');
})->name('register');

Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::get('/register/verify', [AuthController::class, 'showRegisterVerificationForm'])->name('register.verify.form');

Route::post('/register/verify', [AuthController::class, 'verifyRegisterCode'])->name('register.verify');

Route::get('/password/reset', function () {
    return view('auth.forgot-password');
})->name('password.request');

Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');

Route::get('/password/reset/{token}', function ($token) {
    return view('auth.reset-password', ['token' => $token]);
})->name('password.reset');

Route::post('/password/reset', [AuthController::class, 'resetPassword'])->name('password.update');

Route::get('/guest', function () {
    if (Auth::check()) {
        return redirect()->route('landing');
    }
    return app(RecipeController::class)->guestIndex();
})->name('guest.landing');

// Guest search
Route::get('/guest/search', function () {
    if (Auth::check()) {
        return redirect()->route('landing');
    }
    return app(RecipeController::class)->guestSearch(request());
})->name('guest.search');

// Public recipe
Route::get('/recipes/{slug}', [RecipeController::class, 'show'])->name('recipes.show');

// Protected routes perlu auth
Route::middleware(['auth'])->group(function () {
    Route::get('/search', [RecipeController::class, 'search'])->name('search');
    Route::post('/recipes/{recipe}/favorite', [RecipeController::class, 'toggleFavorite'])->name('recipes.favorite');
    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');
    Route::get('/profile/favorites', [RecipeController::class, 'favorites'])->name('profile.favorites');
    Route::get('/profile/edit', [AuthController::class, 'editProfile'])->name('profile.edit');
    Route::post('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');
});

// Admin routes
Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::get('/menu', [AdminController::class, 'menu'])->name('menu');
    Route::get('/menu/create', [AdminController::class, 'createMenu'])->name('menu.create');
    Route::post('/menu', [AdminController::class, 'storeMenu'])->name('menu.store');
    Route::get('/menu/{recipe}/edit', [AdminController::class, 'editMenu'])->name('menu.edit');
    Route::post('/menu/{recipe}', [AdminController::class, 'updateMenu'])->name('menu.update');
    Route::post('/menu/{recipe}/toggle-active', [AdminController::class, 'toggleRecipeStatus'])->name('menu.toggleActive');
    Route::post('/categories/{category}/toggle', [AdminController::class, 'toggleCategoryStatus'])->name('categories.toggle');
    Route::get('/users', [AdminController::class, 'users'])->name('users');

    Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('users.edit');
    Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('users.update');
    Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('users.destroy');
});
