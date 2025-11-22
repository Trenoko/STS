<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Recipe;
use App\Models\RecipeStep;

class RecipeStepsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $recipeSteps = [
            'nasi-goreng' => [
                [
                    'step_number' => 1,
                    'instruction' => 'Masukkan bawang merah, bawang putih, cabai rawit merah, cabai merah keriting, dan minyak ke dalam blender. Haluskan.'
                ],
                [
                    'step_number' => 2,
                    'instruction' => 'Di wajan yang panas, tambahkan minyak lalu tumis bumbu hingga harum dan matang serta tambahkan telur. Aduk hingga rata.'
                ],
                [
                    'step_number' => 3,
                    'instruction' => 'Masukkan sosis lalu aduk rata. Kemudian, tambahkan nasi aduk hingga rata.'
                ],
                [
                    'step_number' => 4,
                    'instruction' => 'Tambahkan garam, kaldu Masako® Ayam, dan Ajinomoto® Terasi Udang, aduk hingga rata. Kemudian sajikan di atas piring.'
                ]
            ],
            'ayam-asam-manis' => [
                [
                    'step_number' => 1,
                    'instruction' => 'Potong ayam menjadi kotak-kotak kecil, balur dengan tepung terigu.'
                ],
                [
                    'step_number' => 2,
                    'instruction' => 'Kocok telur, celupkan ayam ke dalam telur, lalu goreng hingga kuning keemasan.'
                ],
                [
                    'step_number' => 3,
                    'instruction' => 'Tumis bawang bombay hingga harum, tambahkan paprika merah dan hijau.'
                ],
                [
                    'step_number' => 4,
                    'instruction' => 'Masukkan saus tomat, cuka, gula, dan garam. Masak hingga mengental.'
                ],
                [
                    'step_number' => 5,
                    'instruction' => 'Masukkan ayam goreng, aduk rata hingga ayam terbalut saus. Sajikan hangat.'
                ]
            ],
            'pasta-aglio-olio' => [
                [
                    'step_number' => 1,
                    'instruction' => 'Rebus pasta spaghetti dalam air mendidih dengan sedikit garam hingga al dente.'
                ],
                [
                    'step_number' => 2,
                    'instruction' => 'Tiriskan pasta, sisihkan sedikit air rebusan pasta.'
                ],
                [
                    'step_number' => 3,
                    'instruction' => 'Panaskan minyak zaitun, tumis bawang putih iris dan cabai merah hingga harum.'
                ],
                [
                    'step_number' => 4,
                    'instruction' => 'Masukkan pasta yang sudah ditiriskan, aduk rata. Tambahkan sedikit air rebusan pasta jika terlalu kering.'
                ],
                [
                    'step_number' => 5,
                    'instruction' => 'Beri garam secukupnya, taburi dengan parsley cincang. Sajikan segera.'
                ]
            ],
            'tom-yum-seafood' => [
                [
                    'step_number' => 1,
                    'instruction' => 'Rebus air dalam panci, masukkan serai yang sudah dimemarkan dan daun jeruk.'
                ],
                [
                    'step_number' => 2,
                    'instruction' => 'Setelah mendidih, masukkan udang dan cumi. Masak hingga setengah matang.'
                ],
                [
                    'step_number' => 3,
                    'instruction' => 'Tambahkan jamur dan tomat, masak hingga layu.'
                ],
                [
                    'step_number' => 4,
                    'instruction' => 'Masukkan cabai rawit sesuai selera pedas.'
                ],
                [
                    'step_number' => 5,
                    'instruction' => 'Matikan api, beri perasan air jeruk nipis. Aduk rata dan sajikan hangat.'
                ]
            ],
            'pisang-keju-crispy' => [
                [
                    'step_number' => 1,
                    'instruction' => 'Kupas pisang kepok dan potong sesuai selera (bisa memanjang atau melintang).'
                ],
                [
                    'step_number' => 2,
                    'instruction' => 'Balur pisang dengan tepung terigu hingga rata.'
                ],
                [
                    'step_number' => 3,
                    'instruction' => 'Celupkan pisang ke dalam telur yang sudah dikocok.'
                ],
                [
                    'step_number' => 4,
                    'instruction' => 'Balur dengan tepung roti hingga seluruh permukaan tertutup.'
                ],
                [
                    'step_number' => 5,
                    'instruction' => 'Goreng dalam minyak panas hingga kuning keemasan dan crispy.'
                ],
                [
                    'step_number' => 6,
                    'instruction' => 'Angkat, tiriskan, dan taburi dengan keju parut melimpah. Sajikan hangat.'
                ]
            ],
            'es-kopi-gula-aren' => [
                [
                    'step_number' => 1,
                    'instruction' => 'Seduh kopi bubuk dengan air panas secukupnya, biarkan hingga kopi larut sempurna.'
                ],
                [
                    'step_number' => 2,
                    'instruction' => 'Larutkan gula aren dengan sedikit air panas hingga menjadi sirup.'
                ],
                [
                    'step_number' => 3,
                    'instruction' => 'Dinginkan kopi yang sudah diseduh hingga suhu ruang.'
                ],
                [
                    'step_number' => 4,
                    'instruction' => 'Siapkan gelas, masukkan es batu secukupnya.'
                ],
                [
                    'step_number' => 5,
                    'instruction' => 'Tuang sirup gula aren ke dalam gelas, lalu tuang kopi yang sudah dingin.'
                ],
                [
                    'step_number' => 6,
                    'instruction' => 'Tambahkan susu sesuai selera, aduk rata dan sajikan.'
                ]
            ],
        ];

        // Create steps untuk tiap recipe
        foreach ($recipeSteps as $recipeSlug => $steps) {
            $recipe = Recipe::where('slug', $recipeSlug)->first();
            
            if ($recipe) {
                foreach ($steps as $stepData) {
                    RecipeStep::create([
                        'recipe_id' => $recipe->id,
                        'step_number' => $stepData['step_number'],
                        'instruction' => $stepData['instruction']
                    ]);
                }
            }
        }
    }
}
