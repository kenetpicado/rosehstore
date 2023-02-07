<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i<10; $i++) {
            Product::create([
            'SKU' => "sw220709399294441" . $i,
            'description' => $i . ": SHEIN SXY Jeans con bolsillo oblicuo de pierna ancha",
            'default_cost' => 29 * $i,
            'default_price' => 30 * $i,
            'user_id' => 2,
            'category_id' => 1,
            'image' => "https://img.ltwebstatic.com/images3_pi/2022/07/19/1658209617483a8df128ab0be46a19ce21e4a2b77f_thumbnail_600x.webp"
            ]);
        }
    }
}