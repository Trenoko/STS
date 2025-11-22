<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->text('ingredients')->nullable();
            $table->string('image')->nullable(); 
            $table->integer('servings')->nullable(); 
            $table->enum('difficulty', ['easy', 'medium', 'hard'])->default('easy');
            $table->enum('duration_category', ['express', '30menit', '1jam', '2jam+'])->default('express');
            $table->enum('budget_category', ['15-30k', '30-50k', '50-100k', '100k+'])->default('15-30k');
            $table->json('nutrition_info')->nullable();
            $table->integer('views')->default(0);
            $table->integer('favorites')->default(0);
            $table->boolean('is_active')->default(true);
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};

