<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'ingredients',
        'image',
        'servings',
        'difficulty',
        'duration_category',
        'budget_category',
        'nutrition_info',
        'views',
        'favorites',
        'is_active',
        'category_id',
    ];

    protected $casts = [
        'nutrition_info' => 'array',
        'is_trending' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * Ambil kategori yang pakai resep ini.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * users yang menandai resep ini sebagai favorit.
     */
    public function favoritedBy(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
    }

    /**
     * Ambil step untuk resep ini.
     */
    public function steps(): HasMany
    {
        return $this->hasMany(RecipeStep::class)->orderBy('step_number');
    }

    /**
     * Scope query untuk ambil resep yang aktif.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope query untuk ambil resep dengan kategorinya aktif.
     */
    public function scopeWithActiveCategory($query)
    {
        return $query->whereHas('category', function ($q) {
            $q->where('is_active', true);
        });
    }

    /**
     * Scope query untuk ambil resep yang sedang trending.
     */
    public function scopeTrending($query)
    {
        return $query->where('is_trending', true);
    }

    /**
     * Scope query untuk ambil resep yang ditandain featured.
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope query untuk memfilter berdasarkan kategori.
     */
    public function scopeByCategory($query, $categorySlug)
    {
        return $query->whereHas('category', function ($q) use ($categorySlug) {
            $q->where('slug', $categorySlug);
        });
    }

    /**
     * Scope query untuk memfilter berdasarkan durasi.
     */
    public function scopeByDuration($query, $duration)
    {
        return $query->where('duration_category', $duration);
    }

    /**
     * Scope query untuk memfilter berdasarkan kategori budget.
     */
    public function scopeByBudget($query, $budget)
    {
        return $query->where('budget_category', $budget);
    }

    /**
     * Scope query untuk mencari resep berdasarkan judul atau deskripsi.
     */
    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%");
        });
    }

    /**
     * Menambah jumlah view resep.
     */
    public function incrementViews()
    {
        $this->increment('views');
    }

    /**
     * Menambah jumlah favorit resep.
     */
    public function incrementFavorites()
    {
        $this->increment('favorites');
    }

    /**
     * Mengurangi jumlah favorit resep (kalau masih di atas 0).
     */
    public function decrementFavorites()
    {
        if ($this->favorites > 0) {
            $this->decrement('favorites');
        }
    }
}

