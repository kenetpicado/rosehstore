<?php

namespace Database\Seeders;

use App\Models\Egress;
use App\Models\Hire;
use App\Models\Income;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Product::factory(30)->create();
        Income::factory(50)->create();
        Egress::factory(50)->create();
        Hire::factory(50)->create();
    }
}
