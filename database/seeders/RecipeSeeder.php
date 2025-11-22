<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Recipe;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create categories
        $categories = [
            [
                'name' => 'Masakan Utama',
                'slug' => 'masakan-utama',
                'sort_order' => 1,
            ],
            [
                'name' => 'Minuman',
                'slug' => 'minuman',
                'sort_order' => 2,
            ],
            [
                'name' => 'Dessert',
                'slug' => 'dessert',
                'sort_order' => 3,
            ],
            [
                'name' => 'Sea Food',
                'slug' => 'sea-food',
                'sort_order' => 4,
            ],
            [
                'name' => 'Sup & Kuah',
                'slug' => 'sup-kuah',
                'sort_order' => 5,
            ],
            [
                'name' => 'Cemilan',
                'slug' => 'cemilan',
                'sort_order' => 6,
            ],
        ];

        foreach ($categories as $categoryData) {
            Category::create($categoryData);
        }

        // Get category IDs
        $masakanUtama = Category::where('slug', 'masakan-utama')->first();
        $minuman = Category::where('slug', 'minuman')->first();
        $dessert = Category::where('slug', 'dessert')->first();
        $seaFood = Category::where('slug', 'sea-food')->first();

        // Create recipes
        $recipes = [
            [
                'title' => 'Nasi Goreng',
                'slug' => 'nasi-goreng',
                'description' => 'Nasi goreng klasik dengan bumbu yang pas dan rasa yang nikmat',
                'ingredients' => "5  bawang merah\n3 siung bawang putih\n5 buah cabai rawit merah\n2 buah cabai merah keriting\n3 sdm minyak goreng\n1 bungkus AJINOMOTO® Terasi Udang\n½ sdt garam\n½ sdt Masako® Ayam\n2 butir telur\n300 gr nasi putih\n2 buah sosis sapi\nminyak untuk menumis",
                'image' => 'nasgor.png',
                'servings' => 2,
                'difficulty' => 'easy',
                'duration_category' => '30menit',
                'budget_category' => '15-30k', 
                'nutrition_info' => [
                    'type' => ['karbohidrat'],
                    'detail' => [
                        'karbohidrat' => 'Sumber energi utama dari nasi dan sosis.',
                    ],
                ],
                'views' => 1,
                'favorites' => 199,
                'category_id' => $masakanUtama->id,
            ],
            [
                'title' => 'Ayam Asam Manis',
                'slug' => 'ayam-asam-manis',
                'description' => 'Ayam goreng dengan saus asam manis yang segar',
                'ingredients' => "500 gr daging ayam fillet\n100 gr tepung terigu\n2 butir telur\n1 buah bawang bombay\n1 buah paprika merah\n1 buah paprika hijau\n3 sdm saus tomat\n2 sdm cuka\n2 sdm gula pasir\n1 sdt garam\nminyak untuk menggoreng",
                'image' => 'ayamam.png',
                'servings' => 3,
                'difficulty' => 'medium',
                'duration_category' => '1jam',
                'budget_category' => '100k+',
                'nutrition_info' => [
                    'type' => ['protein'],
                    'detail' => [
                        'protein' => 'Ayam sebagai sumber protein hewani yang tinggi.',
                    ],
                ],
                'views' => 2,
                'favorites' => 199,
                'category_id' => $masakanUtama->id,
            ],
            [
                'title' => 'Pasta Aglio Olio',
                'slug' => 'pasta-aglio-olio',
                'description' => 'Pasta sederhana dengan bawang putih dan minyak zaitun',
                'ingredients' => "Pasta spaghetti\nBawang putih\nCabai merah\nMinyak zaitun\nParsley\nGaram",
                'image' => 'pasta.png',
                'servings' => 2,
                'difficulty' => 'easy',
                'duration_category' => '30menit',
                'budget_category' => '15-30k',
                'nutrition_info' => [
                    'type' => ['karbohidrat'],
                    'detail' => [
                        'karbohidrat' => 'Pasta sebagai sumber karbohidrat kompleks.',
                    ],
                ],
                'views' => 1,
                'favorites' => 199,
                'category_id' => $masakanUtama->id,
            ],
            [
                'title' => 'Tom Yum Seafood',
                'slug' => 'tom-yum-seafood',
                'description' => 'Sup asam pedas Thailand dengan seafood segar',
                'ingredients' => "Udang\nCumi\nJamur\nTomat\nDaun jeruk\nSerai\nCabai\nAir jeruk nipis",
                'image' => 'tomyum.png',
                'servings' => 4,
                'difficulty' => 'medium',
                'duration_category' => '30menit',
                'budget_category' => '30-50k',
                'nutrition_info' => [
                    'type' => ['protein', 'mineral'],
                    'detail' => [
                        'protein' => 'Seafood kaya akan protein berkualitas tinggi.',
                        'mineral' => 'Mengandung mineral seperti zinc dan selenium dari seafood.',
                    ],
                ],
                'views' => 4,
                'favorites' => 167,
                'category_id' => $seaFood->id,
            ],
            [
                'title' => 'Pisang Keju Crispy',
                'slug' => 'pisang-keju-crispy',
                'description' => 'Pisang goreng crispy dengan keju parut yang melimpah',
                'ingredients' => "Pisang kepok\nTepung terigu\nTelur\nKeju parut\nTepung roti\nMinyak goreng",
                'image' => 'pisangkeju.png',
                'servings' => 3,
                'difficulty' => 'easy',
                'duration_category' => 'express',
                'budget_category' => '15-30k',
                'nutrition_info' => [
                    'type' => ['karbohidrat', 'lemak'],
                    'detail' => [
                        'karbohidrat' => 'Pisang dan tepung sebagai sumber karbohidrat.',
                        'lemak' => 'Minyak goreng dan keju memberikan kandungan lemak.',
                    ],
                ],
                'views' => 1,
                'favorites' => 298,
                'category_id' => $dessert->id,
            ],
            [
                'title' => 'Es Kopi Gula Aren',
                'slug' => 'es-kopi-gula-aren',
                'description' => 'Minuman kopi dingin dengan gula aren yang nikmat',
                'ingredients' => "Kopi bubuk\nGula aren\nSusu\nEs batu\nAir panas",
                'image' => 'eskopi.png',
                'servings' => 1,
                'difficulty' => 'easy',
                'duration_category' => 'express',
                'budget_category' => '15-30k',
                'nutrition_info' => [
                    'type' => ['karbohidrat'],
                    'detail' => [
                        'karbohidrat' => 'Gula aren sebagai sumber karbohidrat sederhana.',
                    ],
                ],
                'views' => 1,
                'favorites' => 230,
                'category_id' => $minuman->id,
            ],
        ];

        foreach ($recipes as $recipeData) {
            Recipe::create($recipeData);
        }
    }
}
