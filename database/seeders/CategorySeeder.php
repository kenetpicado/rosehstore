<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Ropa',
            'Joyeria',
            'Accesorios',
            'Zapatos',
            'Cosmeticos',
        ];

        foreach ($categories as $category) {
            \App\Models\Category::create([
                'name' => $category,
            ]);

            if ($category == 'Ropa') {
                $subcategories = ['Niños', 'Deportiva', 'Damas', 'Caballeros'];

                foreach ($subcategories as $subcategory) {
                    \App\Models\Category::create([
                        'name' => $subcategory,
                        'parent_id' => 1,
                    ]);
                }
            }
        }
    }
}
